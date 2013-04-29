<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

/* Class to handle book searches */
class Search {
	
	/*
	 * Returns an array of books matching the search criteria
	 * $searchIn must be equal to "title", "author", "keywords"
	 * $search is the search string entered
	 */
	public static function GetBooks($searchIn, $search, $order = "stars", $dir = "desc") {
		
		$keywords = explode(" ", $search);
				
		$query = "SELECT * FROM books
					LEFT JOIN authors
						ON books.author_id = authors.id
					LEFT JOIN publishers
						ON books.publisher_id = publishers.id
					INNER JOIN categories
						ON categories.id = books.category_id
				  WHERE ";
		
		$keywordCount = count($keywords);
		
		if($keywordCount > 0) {
			
			/* Search in title */
			if($searchIn == "title") {
			
				$query .= "books.title LIKE '%" . $search . "%'";				
			
			}
			/* Search in author */
			else if($searchIn == "author") {
				
				$query .= "authors.author LIKE '%" . $search . "%'";
				
			}
			else if($searchIn == "category") {
				
				$query .= "categories.category = '" . $search . "'";
				
			}
			/* Search in keywords */
			else {
				
				for($i = 0; $i < $keywordCount; $i++) {

					if($i < ($keywordCount - 1)) {
						$query .= "books.tags LIKE '%" . $keywords[$i] . "%' OR ";
					}
					else {
						$query .= "books.tags LIKE '%" . $keywords[$i] . "%'";
					}

				}
				
			}
						
			if($order == "stars") {
				$query .= " ORDER BY (stars / ratings) $dir";
			}
			else {
				$query .= " ORDER BY $order $dir";
			}
			
		}
		else {
			return null;
		}
		
		return Database::Query($query);
		
	}
	
	/* Returns an array of the categories */
	public static function GetCategories() {
		
		return Database::Query("SELECT id, category FROM categories");
		
	}
	
}

?>
