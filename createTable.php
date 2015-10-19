<?php
echo "starting";
$conn = mysql_connect(":/cloudsql/fpark-1098:frank", "root", "");
//$conn = mysql_connect("localhost:3306", "root", "rootmysql");
if (!$conn) {
	echo mysql_error();
    die('Connect Error (' . mysql_error());
}

$db_selected = mysql_select_db('freepark');
if (!$db_selected) {
	echo mysql_error();
    die ('Can\'t use db : ' . mysql_error());
}	


	$sql = "DROP TABLE IF EXISTS freedays_tbl";
	$retval = mysql_query( $sql );
	
	$sql = "CREATE TABLE freedays_tbl (
	  owner varchar(64) ,
	  parkId varchar(64),
	  userId varchar(64),
	  free_date date,
	  PRIMARY KEY  (parkId,free_date,userId)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	
	$retval = mysql_query( $sql );
	echo "Any errors " . mysql_error();
?>



