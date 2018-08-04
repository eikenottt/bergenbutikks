<?php
require_once("connect.php");
$conn->query("UPDATE stores set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  store_id=".$_POST["id"]);
?>