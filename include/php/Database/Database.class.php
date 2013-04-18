<?php
/* Core MySQLi Wrapper */

require_once("db.inc.php");

class Database
{
	private static $_DB_;
	
	private static function Connect()
	{
		if (!Database::$_DB_)
		{
			Database::$_DB_ = new mysqli(DB::DB_LOCATION, DB::DB_USER, DB::DB_PASS, DB::DB_NAME);
			if (Database::$_DB_->connect_error)
			{
				die("Cannot connect to database. Error " . Database::$_DB_->connect_errno);	
			}
		}
	}
	
	public static function Query($query)
	{
		Database::Connect();
		
		if ($query = Database::$_DB_->prepare($query))
		{
			if (func_num_args() > 1)
			{
				$x = func_get_args();
				$args = array_merge(array(func_get_arg(1)), array_slice($x, 2));
				$args_ref = array();
				foreach($args as $k => &$arg)
					$args_ref[$k] = &$arg;
				
				call_user_func_array(array($query, "bind_param"), $args_ref);
			}
			$query->execute();

			if ($query->errno)
				return false;

			if ($query->affected_rows > -1)
				return $query->affected_rows;

			$params = array();
			$meta = $query->result_metadata();
			while ($field = $meta->fetch_field())
				$params[] = &$row[$field->name];

			call_user_func_array(array($query, "bind_result"), $params);

			$result = array();
			while ($query->fetch())
			{
				$r = array();
				foreach ($row as $key => $val)
					$r[$key] = $val;

				$result[] = $r;
			}
			$query->close();
			return $result;
		}
		else
			return false;
	}
	
	public static function StartTransaction()
	{
		Database::Connect();
		Database::$_DB_->autocommit(false);
	}
	
	public static function EndTransaction()
	{
		Database::$_DB_->commit();
		Database::$_DB_->autocommit(true);
	}
	
	public static function RawQuery($query)
	{
		Database::Connect();
		
		return Database::$_DB_->query($query);
	}
	
	public static function GetError()
	{
		return Database::$_DB_->errno;	
	}
}

?>