<?php

$authors_fh = fopen("authors.csv", "r");
$books_fh = fopen("test.csv", "r");

$authorIDs = array();
$books = array();

while(($data = fgetcsv($authors_fh)) !== FALSE) {
	
	$authorIDs[] = $data[0];
	
}

while(($data = fgetcsv($books_fh)) !== FALSE) {
	
	if(!in_array($data[3], $authorIDs)) {
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		
	}
	
}


echo "<pre>";
print_r($books);
echo "</pre>";

?>