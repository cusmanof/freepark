<?php
$conn = mysql_connect(":/cloudsql/freepark-1091:frank", "root", "");
if (!$conn) {
    die('Connect Error (' . mysql__error());
}

$db_selected = mysql_select_db('freepark');
if (!$db_selected) {
    die ('Can\'t use db : ' . mysql_error());
}	


	$sql = "DROP TABLE IF EXISTS freedays_tbl";
	$retval = mysql_query( $sql );
	
	$sql = "CREATE TABLE freedays_tbl (
	  owner varchar(64) ,
	  parkId varchar(64),
	  userId varchar(64),
	  free_date date,
	  PRIMARY KEY  (parkId,free_date)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	
	$retval = mysql_query( $sql );
?>



