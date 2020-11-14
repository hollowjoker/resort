<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_localhost = "mysql7.000webhost.com";
$database_localhost = "fa4309695_hans";
$username_localhost = "a4309695_admin";
$password_localhost = "Hackers25";
$localhost = mysql_pconnect($hostname_localhost, $username_localhost, $password_localhost) or trigger_error(mysql_error(),E_USER_ERROR); 
?>