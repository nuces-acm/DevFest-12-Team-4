<?php
 /*
 Irfan Ul Haq
 03455225983
 haq.irfan89@gmail.com
 
 */
 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Logout</title>
<!--Link the css style sheet with this page-->
<link type="text/css" rel="stylesheet" href="./css/style.css" />
</head>

<body>
<?php
session_destroy();
echo "Successfully loged out!\n";
echo "Redirecting in 5 seconds...";
header('Refresh: 5; URL=index.php');
?>
</body>
<div align="center">
  <?php include 'footer/footer.php'?>
</div>
</html>