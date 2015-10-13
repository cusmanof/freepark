<?php
/* $conn = mysql_connect(":/cloudsql/freepark-1091:frank", "root", ""); */
$conn = mysql_connect("localhost:3306", "root", "rootmysql");
if (!$conn) {
	file_put_contents("ze.txt",  mysql_error());
    die('Connect Error (' . mysql__error());
}


//Select Database
$db_selected = mysql_select_db('test');
if (!$db_selected) {
		file_put_contents("ze1.txt",  mysql_error());
    die ('Can\'t use db : ' . mysql_error());
}

$PP = file_get_contents("php://input");
$data = json_decode($PP);

$name = $data->name;
$parkId = $data->parkId;
$cmd = $data->cmd;
$ret = array();
$ret[cmd]="ret";
$ret[name]=$name;
$ret[parkId]=$parkId;
$dts = array();
$ret[dates] = $dts;
if ($cmd == "get") {
/*
	$sql = "CREATE TABLE freedays_tbl (
	  owner varchar(64) ,
	  parkId varchar(64),
	  user varchar(64),
	  free_date date,
	  PRIMARY KEY  (parkId,free_date)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	
	$retval = mysql_query( $sql );
	file_put_contents("ze2.txt",  mysql_error());
*/
	
	$sql = "SELECT free_date from freedays_tbl WHERE parkId='$parkId'";
	$result = mysql_query($sql);
	if ($result) {
		// output data of each row
		$idx=0;
		while($row = mysql_fetch_array($result)) {	
			 $dts[$idx++] = $row[0];
		}
		$ret[dates] = $dts;
	}
	$en = json_encode($ret);
	echo $en;
	file_put_contents("zos.txt", $en );
} elseif ($cmd == "put") {
	file_put_contents("zin.txt", $PP);
	//remove unused entries first.
	$sql = "DELETE FROM freedays_tbl WHERE parkId='$parkId' AND (user IS NULL OR user='');";
	$result = mysql_query($sql);
	for ($i = 0; $i < count($data->dates); $i++) {
		$dd = $data->dates[$i];
		$sql = "INSERT INTO freedays_tbl (owner, parkId, free_date) VALUES ('$name','$parkId','$dd');";
		$result = mysql_query($sql);
		
	}
}


mysql_close();


?>
