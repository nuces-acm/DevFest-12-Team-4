<?php
 /*
 Irfan Ul Haq
 03455225983
 haq.irfan89@gmail.com
 
 */
 
class dataBase
{	
var $dbname; //Name of the database
var $dbuser; //Username for the db
var $dbpass; //Password for the db
var $dbserver; //Name of the mysql server
var $dbcnx;


function dataBase($user, $dbpass, $dbserver)
{
	$this->dbuser = $user;
	$this->dbpass = $dbpass;
	$this->dbserver = $dbserver;	
}

function connectDb()
{
	$dbcnx = mysql_connect ($this->dbserver, $this->dbuser, $this->dbpass);	
	$this->dbcnx = $dbcnx;
	return $dbcnx;
}

function selectDb($dbname)
{
	$this->dbname = $dbname;
	mysql_select_db("$dbname", $this->dbcnx) or die(mysql_error());
	
}
function selectFromWhere($select, $from, $where)
{
	$query = "SELECT ".$select." FROM ".$from." WHERE ".$where;
	return mysql_query("$query",$this->dbcnx);
}

function selectFrom($select, $from)
{
	$query = "SELECT ".$select." FROM ".$from;
	return mysql_query("$query",$this->dbcnx);
}

//function under construction.
function delete($table,$id)
{
	if(mysql_query("DELETE FROM pmarkers WHERE id=\"$id\""))
	{
		return true;
		}
		else {return false;}
}
function insert()
{
	mysql_query("INSERT INTO `markers` (`name`, `address`, `lat`, `lng`, `type`) VALUES ('$name', '$address', '$lng', '$lat', '$type')");
	return mysql_insert_id($this->dbcnx);
}

}

?>