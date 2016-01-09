<?php 
$db_host = "localhost"; // Giữ mặc định là localhost 
$db_name    = 'bookstore';// Can thay doi 
$db_username    = 'root'; //Can thay doi 
$db_password    = '';//Can thay doi 
mysql_connect("{$db_host}", "{$db_username}", "{$db_password}") or die("Không thể kế
t nối database"); 
mysql_select_db("{$db_name}") or die("Không thể chọn database"); 
mysql_query("set names 'utf8'");
?> 
 