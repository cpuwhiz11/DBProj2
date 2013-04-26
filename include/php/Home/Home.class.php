<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class Home {

	/* Get the highest rated books */
	public static function HighestRatedBooks()
	{
		$query = "SELECT *
                  FROM books
                  GROUP BY stars / ratings DESC
                  LIMIT 5";
				  
		return Database::Query($query);
	}
	
	/* Get the most rated books */
	public static function MostRatedBooks()
	{
		$query = "SELECT *
                  FROM books
                  ORDER BY stars DESC
                  LIMIT 5";
				  
		return Database::Query($query);
	}
	

}

?>