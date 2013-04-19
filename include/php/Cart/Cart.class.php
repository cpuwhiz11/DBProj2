<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class Cart {

	/* Add a single book to a user's cart */
	public static function AddToCart($user_id, $book_id){
	
		$query = "INSERT INTO shopping_cart
		          VALUES (?, ?)", "is", $user_id, $book_id; 
				  
		return Database::Query($query);
	
	}
	
	/* Remove an existing item from a user's cart */
	public static function RemoveFromCart($user_id, $book_id){
	
		$query = "DELETE FROM shopping_cart
		          WHERE user_id = ? AND book_id = ?", "is",  $user_id, $book_id; 
				  
		return Database::Query($query);
	}
	
	/* Get all the items in a user's cart */
	public static function GetCart($user_id){
	
		$query = "SELECT *
		          FROM shopping_cart
				  WHERE user_id = ?", "i", $user_id;
				  
		return Database::Query($query);
	}
	
	/* Remove all exisiting items in a user's shopping_cart */
	public static function EmptyCart($user_id){
	
		$query = "DELETE FROM shopping_cart
		          WHERE user_id = ?", "i", $user_id;
				  
		return Database::Query($query);
	
	}

}

?>