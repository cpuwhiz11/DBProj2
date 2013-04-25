<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Book/Book.class.php");

var_dump($_POST);

echo Book::UpdateRating($_POST["isbn"], $_POST["stars"]);

?>