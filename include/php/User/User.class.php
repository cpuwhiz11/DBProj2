<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/include/php/Database/Database.class.php");

class User {

	/* Get the books a user has ordered */
	public static function MakeOrder($user_id, $shipping_address,
	                                   $total_price, $tax, $shipping) {
		// Create order entry						   
		$query = "INSERT INTO orders (date, user_id, shipping_address, total_price, tax, shipping)
		          VALUES (NOW(), ?, ?, ?, ?, ?)"; 
				  
            Database::Query($query, "isiii", $user_id, $shipping_address, $total_price,
                                             $tax, $shipping);
										 
            $query = "SELECT LAST_INSERT_ID()
                      FROM orders";
		
            // Get the id of the order we just made									
            $order_id = Database::Query($query);
                        
            $order_id = $order_id[0]["LAST_INSERT_ID()"];
		
            // Get all the book isbns and quantities the user has in cart
            $cartArray = Cart::GetCart($user_id);
		
            // Save the books the user bought in orders
            // For each book run a seperate query
            foreach($cartArray as $book) {
                    $query = "INSERT INTO order_items (order_id, isbn, quantity)
                              VALUES (?, ?, ?)";
		
                    Database::Query($query, "isi", $order_id, $book["book_id"], $book["quantity"]);
            }
		
            // Delete cart for this user
            return Cart::EmptyCart($user_id);
        }
	
	
	/* Get the orders user has placed */
	public static function GetOrderHistory($user_id){
						   
		$query = "SELECT id, user_id, shipping_address, total_price,
		                 tax, shipping
		          FROM orders
			  WHERE user_id = ?"; 
				  
	    return Database::Query($query, "i", $user_id);
		
	}
	
	/* Get the books a user made on a order */
	public static function GetOrderBooks($order_id ){
						   
		$query = "SELECT title, quantity, books.isbn 
		          FROM order_items
                  INNER JOIN books ON order_items.isbn = books.isbn
                  WHERE order_id =  ?";
				 
	    return Database::Query($query, "i", $order_id );
		
	}
	
}


?>
