<?php
define("MYSQL_SERVER", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASSWORD", "");
define("MYSQL_DATABASE", "dbhotel");

$mysqli = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE); 
if (mysqli_connect_errno()) {  printf("Connect failed: %s
", mysqli_connect_error());  exit(); }
?>