 <?php
 //variables to hold info coming from the link.
 include("DataBase.class.php");
//$key = $_GET['key'];
$name = $_GET['name'];
$cnic = $_GET['cnic'];
$location = $_GET ['location'];
$disease = $_GET ['disease'];
$contact = $_GET['contact'];


$dbname ='mapdatabase'; //Name of the database
$dbuser ='root'; //Username for the db
$dbpass =''; //Password for the db
$dbserver ='localhost'; //Name of the mysql server

$db = new dataBase("$dbuser", "$dbpass", "$dbserver");
$dbcnx = $db->connectDb();
$db->selectDb($dbname);

//$query = $db->selectFrom("*","login", "key = ".$key);

//if($query > 0){

$google_maps_key='ABQIAAAAe8rhZlbrTrtYn3S4B8DbrBSiiq6SSn-FolLKfZOodfiXZD81ZRTNuab0TvJ-86gOsCgtlSG1BHnwtQ';
$adr = urlencode($location);
$url = "http://maps.google.com/maps/geo?q=".$adr."&output=xml&key=$google_maps_key";
$xml = simplexml_load_file($url);
$status = $xml->Response->Status->code;
if ($status='200') { //address geocoded correct, show results
//echo ("The address can be geocoded, we found the following results:<br/>");
foreach ($xml->Response->Placemark as $node) { // loop through the responses
$address = $node->address;
$quality = $node->AddressDetails['Accuracy'];
$coordinates = $node->Point->coordinates;
$latlng = explode(",",$coordinates);
//echo ($coordinates);
//echo ("Quality: $quality. $name. $address. $latlng[0]. $latlng[1]<br/>");

$id = store($name,$cnic,$address,$latlng[0],$latlng[1],$disease,$contact);
if($id != 0){
	//echo $latlng[0];
	$findquery = "SELECT 
  *, 
   ( 3959 * acos( cos( radians(42.290763) ) * cos( radians( $latlng[1] ) ) 
   * cos( radians($latlng[0]) - radians(-71.35368)) + sin(radians(42.290763)) 
   * sin( radians($latlng[1])))) AS distance 
FROM dmarkers  
HAVING distance < 10000
ORDER BY distance;";
	$query1 = mysql_query($findquery,$dbcnx);
echo ("Information has been added. Marker id:".$id);
if($query1 > 0){
	echo ("\nFollowing are the hospitals closer to your location.\n");
  while ($row = mysql_fetch_array($query1))
 { 
 echo $row['name']."\n";
 echo $row['location']."\n";
 echo $row['contact']."\n";
 echo "---------\n";  
  //$desc=$row['disease'];
 // echo ("addMarker($lat, $lon,'$na', '$desc',$id, 'p');\n"); 
  }
}
}else{
echo ("Unable to insert the record in database.");	
}
}
} else { // address couldn't be geocoded show error message
echo ("The address $adr could not be geocoded<br/>");
}
//}
?>
<?php
function store($name,$cnic,$address,$lat,$lng,$disease,$contact){
	//for local host
	
$dbname = 'mapdatabase';
$dbuser ='root'; //Username for the db
$dbpass =''; //Password for the db
$dbserver ='localhost'; //Name of the mysql server


$dbcnx = mysql_connect ("$dbserver", "$dbuser", "$dbpass");
mysql_select_db("$dbname") or die(mysql_error());
$quer = "INSERT INTO pmarkers (name, cnic, address, lat, lng, disease, contact) VALUES (\"$name\", \"$cnic\", \"$address\", $lng, $lat, \"$disease\", \"$contact\")";
mysql_query($quer,$dbcnx);
return mysql_insert_id($dbcnx);
}
?>