<?php
$dbname = 'mapdatabase';
$dbuser ='root'; //Username for the db
$dbpass =''; //Password for the db
$dbserver ='localhost'; //Name of the mysql server
$dbcnx = mysql_connect ("$dbserver", "$dbuser", "$dbpass");
mysql_select_db("$dbname") or die(mysql_error());
mysql_query("INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('Pan Africa Market', '1521 1st Ave, Seattle, WA', '47.608941', '-122.340145', 'restaurant')");
?>