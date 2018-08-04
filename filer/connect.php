<?php
/**
 * User: Alexandra
 * Date: 18.09.2016
 * Time: 22:46
 */
// Connect info
// Defining constants
// copied from webdesign2 project. change values according to new database.
include('/var/www/dikult205/secret/1FW17.inc');
// Create connection
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Unable to connect to database");
}
$conn->set_charset("utf8");
$conn->query("SET NAMES 'utf8'");

?>