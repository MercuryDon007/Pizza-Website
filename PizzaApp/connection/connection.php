<?php

		session_start();

		define('HOST', 'localhost');
		define('USERNAME', 'root');
		define('PASSWORD', '');
		define('DB', 'pizzaapp');

		
		$con=mysqli_connect(HOST,USERNAME,PASSWORD,DB) 
		or die(mysqli_connect_error());	

?>