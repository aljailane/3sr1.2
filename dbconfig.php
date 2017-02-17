<?php

	$DB_HOST = 'sql310.alju.ga';
	$DB_USER = '4lju_19203492';
	$DB_PASS = '0509354461';
	$DB_NAME = '4lju_19203492_ameed';
   $SETTINGS["USERS"] = 'php_users_login'; 
mysql_set_charset('utf8');
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
