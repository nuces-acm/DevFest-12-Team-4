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
	var uname=document.forms["login"]["userName"].value;
	var pass=document.forms["login"]["userPassword"].value;
	<!--Checking the Fields are empty or not-->
	if(uname=="")
	{
		alert("Please enter username.");
		 return false;
		}if(pass=="")
	{
		alert("Please enter password.");
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
<div align="center" class="center">
<div align="center"><font size="6" ><b class="col">SMS</b> Based Location Aware Data Builder </font> </div><br>
<!--form for take user input-->
<form action="login.php" method="post" name="login" onSubmit="return validateform()">
  <div align="center">
    <table width="300" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="96"><p>username</p></td>
        <td width="204"><input name="userName" type="text" class="textfield" size="20">
        </td>
      </tr>
        <td colspan="2"><p></p><tr> 
        <td><p>password</p></td>
        <td><input name="userPassword" type="password" class="textfield" size="20">
        </td>
      </tr>
      <tr> 
        <td colspan="2"><div align="center"> 
            <input type="submit" name="Submit" value="Login">
          </div>
          <!--Link for signup page-->
      </td>
      </tr>
    </table>
  </div>
</form>
</div>
</body>
<!--Include the footer-->
<div align="center">
  <?php include 'footer/footer.php'?>
</div>
</html>
</body>
</html>
<!--End of index-->