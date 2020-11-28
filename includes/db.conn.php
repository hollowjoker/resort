<?php
define("MYSQL_SERVER", "localhost11");
define("MYSQL_USER", "root1");
define("MYSQL_PASSWORD", "");
define("MYSQL_DATABASE", "dbhotel1");

$mysqli = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE); 
if (mysqli_connect_errno()) {  printf("Connect failed: %s
", mysqli_connect_error());  exit(); }
?>