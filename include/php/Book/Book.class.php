<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

/* Class to manage things related to an individual book */
class Book {

	/* Update the ratings for a book */
	public static function UpdateRating($isbn, $stars){
	
		$query = "UPDATE books
		          SET stars = stars + ?, ratings = ratings + 1
				  WHERE isbn = ?";
				  
		return Database::Query($query, "is", $stars, $isbn);
	
	}
	
	/* Truncates the title of a book but limiting the length to 40 characters and add an ellipse at the end */
	public static function TruncateTitle($title) {
		
		if(strlen($title) > 40) {
			
			return substr($title, 0, 40) . "...";
			
		}
		
		return $title;
		
	}
	
}

?>