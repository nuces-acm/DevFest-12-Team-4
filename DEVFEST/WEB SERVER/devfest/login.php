<?php
 /*
 Irfan Ul Haq
 03455225983
 haq.irfan89@gmail.com
 
 */
 
session_start();
include("DataBase.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$userName = $_POST['userName'];
$password = $_POST['userPassword'];

$dbname ='mapdatabase'; //Name of the database
$dbuser ='root'; //Username for the db
$dbpass =''; //Password for the db
$dbserver ='localhost'; //Name of the mysql server

$db = new dataBase("$dbuser", "$dbpass", "$dbserver");
$dbcnx = $db->connectDb();
$db->selectDb($dbname);

$query = $db->selectFrom("*","login", "userName = ".$userName." AND userPassword = ".$password);
 // $query = mysql_query("SELECT * FROM markers");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
</head>
<body>
<?php
if($userName != "guest"){
 if($query > 0)
 {
	 $data = mysql_fetch_array($query);
	 //echo $data['userId'];
	 //$userid = $query['userId'];
	 $_SESSION['userId'] = $data['userId'];
	 $_SESSION['userPermissions'] = $data['permissions'];
	 $_SESSION['user'] = $userName;
	// echo $userid;
header("Location:map.php");
}
else
{
echo 'Invalid information';
echo "We are going back in 5.4.3.2.1...";
header('Refresh: 5; URL=index.html');
}
}else{
		 $_SESSION['userId'] = "guest";
	 $_SESSION['userPermissions'] = "guest";
	 $_SESSION['user'] = $userName;
	// echo $userid;
header("Location:map.php");
}
?>
</body>
</html>