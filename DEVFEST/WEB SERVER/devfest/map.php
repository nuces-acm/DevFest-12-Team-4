<?php
 /*
 Irfan Ul Haq
 03455225983
 haq.irfan89@gmail.com
 
 */
 
session_start();
include("DataBase.class.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>SMS Based Location Aware Data Builder</title>
<!--Link the css style sheet with this page-->
<link type="text/css" rel="stylesheet" href="./css/style.css" />
<?php
if(!isset($_SESSION['user']))
{
header("Location:index.php");
}else
{
$userId = $_SESSION['userId'];
$userPermission = $_SESSION['userPermissions'];
}
?>
<?php
 /*
 Irfan Ul Haq
 03455225983
 haq.irfan89@gmail.com
 
 */
 
$dbname ='mapdatabase'; //Name of the database
$dbuser ='root'; //Username for the db
$dbpass =''; //Password for the db
$dbserver ='localhost'; //Name of the mysql server

$db = new dataBase("$dbuser", "$dbpass", "$dbserver");
$dbcnx = $db->connectDb();
$db->selectDb($dbname);
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 80%; margin: 0; padding: 1% }
  #map_canvas { height: 100% }
</style>

<script type="text/javascript"
    src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDPSp1M16ckyF1iY2c7CNReZN3MtekUfPg&sensor=true">
</script>
<script type="text/javascript"
    src="http://code.google.com/apis/gears/gears_init.js">
</script>

<script type="text/javascript">

var initialLocation;
var siberia = new google.maps.LatLng(60, 105);
var newyork = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
var browserSupportFlag =  new Boolean();

var map = null;
var latlng = null;
var dmarkersArray = [];
var pmarkersArray = [];
var currentPopup = null;

function addMarker(lat, lng, name, bodyData, id, color) {
	latlng = new google.maps.LatLng(lat, lng);
	var pinColor = "00FF00";
	if(color == "d"){
	    pinColor = "00FF00";
	}else if(color == "p"){
		pinColor = "FF0000";
	}
    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
    var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
        new google.maps.Size(40, 37),
        new google.maps.Point(0, 0),
        new google.maps.Point(12, 35));
	
 var marker = new google.maps.Marker({
 position: latlng,
 animation: google.maps.Animation.DROP,
 map: map,
 icon: pinImage,
 shadow: pinShadow,
 draggable:false,
  title:name
 });
 	if(color == 'd'){
	    dmarkersArray.push(marker);
		var popup = new google.maps.InfoWindow({
 content: "<b>Name: "+name+"</b>"+"<br/>Specialization: "+bodyData, 
 maxWidth: 300
 });
	}else if(color == 'p'){
		pmarkersArray.push(marker);
				popup = new google.maps.InfoWindow({
 content: "<b>Id: "+id+"</b>"+"<br/>Desease: "+bodyData, 
 maxWidth: 300
 });
	}
  
 google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
         //marker.openInfoWindowHtml(htmlString);
 popup.open(map, marker);
 currentPopup = popup;
 });
 }
 
 
  function initialize() {
	  
    
    var myOptions = {
      zoom: 6,
      //center: new google.maps.LatLng(47.608940, -122.340141),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }; 
     map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
		
		  if(navigator.geolocation) {
    browserSupportFlag = true;
    navigator.geolocation.getCurrentPosition(function(position) {
      initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
	  var infowindow = new google.maps.InfoWindow({
              map: map,
              position: initialLocation,
              content: 'You are here',
			  maxWidth: 100
            });
      map.setCenter(initialLocation);
    }, function() {
      handleNoGeolocation(browserSupportFlag);
    });
	
  // Try Google Gears Geolocation
  } else if (google.gears) {
    browserSupportFlag = true;
    var geo = google.gears.factory.create('beta.geolocation');
    geo.getCurrentPosition(function(position) {
      initialLocation = new google.maps.LatLng(position.latitude,position.longitude);
      map.setCenter(initialLocation);
    }, function() {
      handleNoGeoLocation(browserSupportFlag);
    });
  // Browser doesn't support Geolocation
  } else {
    browserSupportFlag = false;
    handleNoGeolocation(browserSupportFlag);
  }
  
  function handleNoGeolocation(errorFlag) {
    if (errorFlag == true) {
      alert("Geolocation service failed. Go to Newyork since It's google problem so have fun there.");
      initialLocation = newyork;
    } else {
      alert("Your browser doesn't support geolocation. I've placed you in Siberia. hahahahah");
      initialLocation = siberia;
    }
    map.setCenter(initialLocation);
  }
var marker1 = new google.maps.Marker({
 position: initialLocation,
 animation: google.maps.Animation.DROP
 });
 <?php
 if($userPermission == "power" || $userPermission == "user"){ 
 $query = $db->selectFrom("*","pmarkers");
  while ($row = mysql_fetch_array($query))
 { 
 $id=$row['id'];
 $na=$row['name'];
 $lat=$row['lat']; 
  $lon=$row['lng']; 
  $desc=$row['disease']; 
  echo ("addMarker($lat, $lon,'$na', '$desc',$id, 'p');\n"); 
  } 
  $query = $db->selectFrom("*","dmarkers");
  while ($row = mysql_fetch_array($query))
 { 
 $id=$row['id'];
 $na=$row['name'];
 $lat=$row['lat']; 
  $lon=$row['lng']; 
  $desc=$row['specialization']; 
  echo ("addMarker($lat, $lon,'$na', '$desc',$id, 'd');\n"); 
  } 
 }else if($userPermission == "guest"){
 $query = $db->selectFrom("*","dmarkers");
  while ($row = mysql_fetch_array($query))
 { 
 $id=$row['id'];
 $na=$row['name'];
 $lat=$row['lat']; 
  $lon=$row['lng']; 
  $desc=$row['specialization']; 
  echo ("addMarker($lat, $lon,'$na', '$desc',$id, 'd');\n"); 
  } 
 }

  ?>
	//marker1.setMap(map);		
  }
  function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
  document.body.appendChild(script);
}
  
window.onload = loadScript;
  

</script>
</head>
<body onload="initialize()">
<div><form action="logout.php" meathod="post">
<?php echo ("You are currently Logged in as <b>\"".$_SESSION['user']."\"</b>             ")?>
<input name="logout" type="submit" value="Log out" />
</form></div>
<div id="map_canvas" style="width:100%; height:100%"></div>
<?php
if($_SESSION['user']=="admin")
{
?>
<div style="position:absolute; left:1115px; top:13px;"><form  action="dashboard.php" meathod="post">
<input name="submit" type="submit" value="Open Dashboard" />
 
</form></div>
<div style="position:absolute; left:1250px; top:12px;"><form action="delete.php" meathod="post">
<input name="submit" type="submit" value="Delete" />
 
</form></div>

<?php
}
?>
  
</body>
<div align="center">
  <?php include 'footer/footer.php'?>
</div>
</html>