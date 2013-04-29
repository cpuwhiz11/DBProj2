<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Book/Book.class.php");

/* Update the rating of the book */
Book::UpdateRating($_POST["isbn"], $_POST["stars"]);

?>