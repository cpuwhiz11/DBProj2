<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class Cart {

	/* Add a single book to a user's cart */
	public static function addToCart($userId, $bookId){
	
		$query = "INSERT INTO Cart
		          VALUES ('" . $userId . "' , '" . $bookId . "')";
				  
		return Database::Query($query);
	
	}
	
	/* Remove an existing item from a user's cart */
	public static function removeFromCart($userId, $bookId){
	
		$query = "DELETE FROM Cart
		          WHERE userId ='" . $userId . "'" . " AND bookId ='" . $bookId . "'"; 
				  
		return Database::Query($query);
	}
	
	/* Get all the items in a user's cart */
	public static function getCart($userId){
	
		$query = "SELECT *
		          FROM Cart
		          WHERE userId= '" . $userId . "'"; 
				  
		return Database::Query($query);
	}
	
	/* Remove all exisiting items in a user's cart */
	public static function emptyCart($userId){
	
		$query = "DELETE FROM Cart
		          WHERE userId ='" . $userId ."'"; 
				  
		return Database::Query($query);
	
	}

}

?>