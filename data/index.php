<?php

/* File Handlers */
$books_fh = fopen("books.csv", "r");
$authors_fh = fopen("authors.csv", "r");
$publishers_fh = fopen("publishers.csv", "r");

/* Arrays to hold csv data */
$books = array();
$authors = array();
$publishers = array();

/* Build books array */
while(($data = fgetcsv($books_fh)) !== FALSE) {
	
	$books[] = $data;
	
}

/* Build authors array */
while(($data = fgetcsv($authors_fh)) !== FALSE) {
	
	$authors[] = $data;
	
}

/* Build publishers array */
while(($data = fgetcsv($publishers_fh)) !== FALSE) {
	
	$publishers[] = $data;
	
}

/* Array lengths */
$book_count = count($books);
$author_count = count($authors);
$publisher_count = count($publishers);

/* Loop through each book and replace the author and publisher with their id's */
for($i = 0; $i < $book_count; $i++) {
	
	/* Replace author id */
	for($j = 0; $j < $author_count; $j++) {
		
		if($books[$i][3] == $authors[$j][1]) {
			
			$key = $j;
			
			break;
			
		}
		
	}
	
	/* Set author to author id */
	$books[$i][3] = $key;
	
	/* Replace publisher id */
	for($k = 0; $k < $publisher_count; $k++) {
		
		if($books[$i][4] == $publishers[$k][1]) {
			
			$key = $k;
			
			break;
			
		}
		
	}
	
	/* Set publisher to publisher id */
	$books[$i][4] = $key;
	
}

/* Build new csv file */
foreach($books as $book) {
	$line = "";
	
	foreach($book as $item) {
		$line .= $item . ", ";
	}
	
	echo substr($line, 0, -1) . "<br>";
}

/* Close fild handlers */
fclose($authors_fh);
fclose($books_fh);
fclose($publishers_fh);

?>