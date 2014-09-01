<?php 
	$path = "";
	$host = "localhost";
	$username="embrace4";
	$password="embrace321$";
	$db_name="embrace4_embrace"; 
	mysql_connect("$host", "$username", "$password")or die("cannot connect to server");
	mysql_select_db("$db_name")or die("cannot select db");
?>