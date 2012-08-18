

<!-- Here the index page of iqra quest-->
<html>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<head>
<!--title of iqraquest-->
<title>SMS Based Location Aware Data Builder</title>
<!--Link the css style sheet with this page-->
<link type="text/css" rel="stylesheet" href="./css/style.css" />
<!--Applying java script for form validation-->
<script type="text/javascript">
function validateform()
{
	var table=document.forms["delete"]["table"].value;
	var id=document.forms["delete"]["id"].value;
	<!--Checking the Fields are empty or not-->
	if(table=="")
	{
		alert("Please complete Fields.");
		 return false;
		}if(id=="")
	{
		alert("Please complete Fields.");
		 return false;
		}
}
</script>
<!--Here css style -->
<style>
.col
{
	color:#F00;}
	.center {
   padding:5%;
   }
  
</style>
</head>
<body>
<?php 
 /*
 Irfan Ul Haq
 03455225983
 haq.irfan89@gmail.com
 
 */
 
include("DataBase.class.php");
if(isset($_POST['table']))
{
	$table=$_POST['table'];
	$id=$_POST['id'];
	
	$dbname ='mapdatabase'; //Name of the database
	$dbuser ='root'; //Username for the db
	$dbpass =''; //Password for the db
	$dbserver ='localhost'; //Name of the mysql server
	
	$db = new dataBase("$dbuser", "$dbpass", "$dbserver");
	$dbcnx = $db->connectDb();
	$db->selectDb($dbname);
	if($db->delete($table,$id))
	{
	echo "Data Deleted \n";
	echo "Redirecting in 5 seconds...";
     header('Refresh: 5; URL=map.php');
	}
	else 
	{
echo "Not Deleted \n";
	echo "Redirecting in 5 seconds...";
     header('Refresh: 5; URL=delete.php');
	
		}
}
else
{
?>
<div align="center" class="center">
<div align="center"><font size="6" >Enter Table name and ID you want to delete</font> </div><br>
<!--form for take user input-->
<form action="delete.php" method="post" name="delete" onSubmit="return validateform()">
  <div align="center">
    <table width="300" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="96"><p>Table name</p></td>
        <td width="204"><input name="table" type="text" class="textfield" size="20">
        </td>
      </tr>
        <td colspan="2"><p></p><tr> 
        <td><p>ID</p></td>
        <td><input name="id" type="text" class="textfield" size="20">
        </td>
      </tr>
      <tr> 
        <td colspan="2"><div align="center"> 
            <input type="submit" name="Submit" value="Delete">
          </div>
          <!--Link for signup page-->
      </td>
      </tr>
    </table>
  </div>
</form>
</div>
<?php
}
?>
</body>
<!--Include the footer-->
<div align="center">
  <?php include 'footer/footer.php'?>
</div>
</html>
</body>
</html>
<!--End of index-->