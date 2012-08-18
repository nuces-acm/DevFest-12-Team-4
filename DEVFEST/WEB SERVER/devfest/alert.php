 <?php
 /*
 Irfan Ul Haq
 03455225983
 haq.irfan89@gmail.com
 
 */
 
 
 //variables to hold info coming from the link.
 include("DataBase.class.php");
$disease = $_GET ['disease'];
$location = $_GET ['location'];



$dbname ='mapdatabase'; //Name of the database
$dbuser ='root'; //Username for the db
$dbpass =''; //Password for the db
$dbserver ='localhost'; //Name of the mysql server

$db = new dataBase("$dbuser", "$dbpass", "$dbserver");
$dbcnx = $db->connectDb();
$db->selectDb($dbname);


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
$findquery = "SELECT 
  *, 
   ( 3959 * acos( cos( radians(42.290763) ) * cos( radians( $latlng[1] ) ) 
   * cos( radians($latlng[0]) - radians(-71.35368)) + sin(radians(42.290763)) 
   * sin( radians($latlng[1])))) AS distance 
FROM pmarkers WHERE disease = \"$disease\"
HAVING distance < 500000
ORDER BY distance;";
	$query1 = mysql_query($findquery,$dbcnx);
	//echo $query1[0];
	$row = mysql_fetch_array($query1);
	$b = mysql_num_rows($query1);
	//echo $row[1];
if($b > 5){
	echo ("alert");
}
}
}
?>