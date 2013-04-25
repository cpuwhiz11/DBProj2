<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class Book {

	/* Update the ratings for a book */
	public static function updateRating($isbn, $stars){
	
		$query = "UPDATE books
		          SET stars = ?
				  WHERE isbn = ?";
				  
		return Database::Query($query, "si", $stars, $isbn);
	
	}
	
}

?>