<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class Search {
	
	public static function GetBooks($searchIn, $search) {
		
		$keywords = explode(" ", $search);
				
		$query = "SELECT * FROM books
					LEFT JOIN authors
						ON books.author_id = authors.id
					LEFT JOIN publishers
						ON books.publisher_id = publishers.id
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
			/* Search in publishers */
			else if($searchIn == "publishers") {
				
				$query .= "publishers.name LIKE '%" . $search . "%'";
				
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
			
		}
		else {
			return null;
		}
		
		return Database::Query($query);
		
	}
	
	public static function GetCategories() {
		
		return Database::Query("SELECT id, category FROM categories");
		
	}
	
}

?>
