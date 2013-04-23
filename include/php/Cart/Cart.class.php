<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class Cart {

	/* Add a single book to a user's cart */
	public static function AddToCart($user_id, $book_id, $quantity){
	
		$query = "INSERT INTO shopping_cart
		          VALUES (?, ?, ?)"; 
				  
		return Database::Query($query, "isi", $user_id, $book_id, $quantity);
	
	}
	
	/* Remove an existing item from a user's cart */
	public static function RemoveFromCart($user_id, $book_id){
	
		$query = "DELETE FROM shopping_cart
		          WHERE user_id = ? AND book_id = ?";
				  
		return Database::Query($query, "is",  $user_id, $book_id);
	}
	
	/* Update the quantity of a particular book the user is ordering */
	public static function UpdateQuantity($user_id, $book_id, $quantity){
	
		$query = "UPDATE shopping_cart
		          SET quantity = ?
				  WHERE user_id = ? AND book_id = ?";
				  
		return Database::Query($query, "iis", $quantity, $user_id, $book_id; );
	}
	
	/* Get all the items in a user's cart */
	public static function GetCart($user_id){
		
		$query = "SELECT shopping_cart.user_id,
		                 shopping_cart.book_id,
						 books.price, books.title,
						 books.price * shopping_cart.quantity AS total
                  FROM shopping_cart
                  INNER JOIN books
                  ON shopping_cart.book_id = books.isbn
                  WHERE shopping_cart.user_id = ?";
				  
		return Database::Query($query, "i", $user_id);
	}
	
	/* Remove all exisiting items in a user's shopping_cart */
	public static function EmptyCart($user_id){
	
		$query = "DELETE FROM shopping_cart
		          WHERE user_id = ?";
				  
		return Database::Query($query, "i", $user_id);
	
	}

}

?>