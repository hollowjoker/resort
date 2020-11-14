<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_localhost = "sql304.freezoy.com";
$database_localhost = "frzoy_14382748_hans_db";
$username_localhost = "frzoy_14382748";
$password_localhost = "Hackers25";
$localhost = mysql_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error(mysql_error(),E_USER_ERROR); 
?>