<?php
define("DB_HOST", "localhost");
define("DB_LOGIN", "svaro_60b");					
define("DB_PASSWORD", "1EF3zXQd4");
define("DB_NAME", "tableras");		
 
$count=0;	//хранить количество товаров в корзине пользователя и присвойте ей значение по умолчанию
mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die ("не могу подключиться к базе");//подключение к базе
mysql_select_db(DB_NAME) or die (mysql_error());//выбор базы

?>