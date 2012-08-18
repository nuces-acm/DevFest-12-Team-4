<!-- Here the index page of iqra quest-->
<html>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<head>
<!--title of iqraquest-->
<title>SMS Based Location Aware Data Builder</title>
<!--Link the css style sheet with this page-->
<link type="text/css" rel="stylesheet" href="./css/style.css" />
<!--Applying java script for form validation-->

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




<script type="text/javascript">
function validateform()
{
	var name=document.forms["add_info"]["name"].value;
	var no=document.forms["add_info"]["no"].value;
		var address=document.forms["add_info"]["address"].value;
	var cnic=document.forms["add_info"]["cnic"].value;
	var special=document.forms["add_info"]["special"].value;
	<!--Checking the Fields are empty or not-->
	if(name=="")
	{
		alert("Please Complete Fields");
		 return false;
		}
		if(no=="")
	{
		alert("Please Complete Fields");
		 return false;
		}
		if(address=="")
	{
		alert("Please Complete Fields");
		 return false;
		}
		if(cnic=="")
	{
		alert("Please Complete Fields");
		 return false;
		}
		if(special=="")
	{
		alert("Please Complete Fields");
		 return false;
		}
}
</script>
<body>
<font size="6">Add new doctor Info</font> </div><br>
<!--form for take user input-->
<form action="dashboard.php" method="post" name="add_info" onSubmit="return validateform()">

    <table width="300" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="96"><p>Name</p></td>
        <td width="204"><input name="name" type="text" class="textfield" size="20">
        </td>
      </tr>
        <td colspan="2"><p></p><tr> 
        <td><p>Phone NO#</p></td>
        <td><input name="no" type="text" class="textfield" size="20">
        </td>
      </tr>
	  <td colspan="2"><p></p><tr> 
        <td><p>Address</p></td>
        <td><input name="address" type="text" class="textfield" size="20">
        </td>
      </tr>
	  <td colspan="2"><p></p><tr> 
        <td><p>CNIC NO#</p></td>
        <td><input name="cnic" type="text" class="textfield" size="20">
        </td>
      </tr>
	  <td colspan="2"><p></p><tr> 
        <td><p>Specialization </p></td>
        <td><input name="special" type="text" class="textfield" size="20">
        </td>
      </tr>
      <tr> 
        <td colspan="2"><div align="center"> 
            <input type="submit" name="Submit" value="Save">
          <!--Link for signup page-->
		  </div>
      </td>
      </tr>
    </table>
</form>
</body>
<!--Include the footer-->
<div align="center">
  <?php
   /*
 Muhammad Zulqarnain
 03466641508
 zulqarnain_mian@ymail.com
 
 */
  include 'footer/footer.php'?>
</div>
</html>
</body>
</html>
<!--End of index-->