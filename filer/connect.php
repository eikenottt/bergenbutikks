<?php
/**
 * User: Alexandra
 * Date: 18.09.2016
 * Time: 22:46
 */
// Connect info
// Defining constants
// copied from webdesign2 project. change values according to new database.
define('USER', 'root');
define('PWD', 'root');
define('DB', 'bergenbutikker');
	
// Create connection
$con = @mysqli_connect("localhost", USER, PWD, DB) or die("Can't connect to database! : " . mysqli_connect_error());

$con->set_charset("utf8");
$con->query("SET NAMES 'utf8'");

?>