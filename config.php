<?php
include"inc/rights.php";


/* Define MySQL connection details and database table name */ 
$SETTINGS["hostname"] = 'sql310.alju.ga';
$SETTINGS["mysql_user"] = '4lju_19203492';
$SETTINGS["mysql_pass"] = '0509354461';
$SETTINGS["mysql_database"] = '4lju_19203492_ameed';
$SETTINGS["USERS"] = 'php_users_login'; 
mysql_set_charset('utf8');
// this is the default table name that we used

/* Connect to MySQL */
$connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');
$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');
?>