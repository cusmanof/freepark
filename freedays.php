<?php
$conn = mysql_connect(":/cloudsql/fpark-1098:frank", "root", "");
//$conn = mysql_connect("localhost:3307", "root", "rootmysql");
if (!$conn) {
	echo 'Connect Error (' . mysql_error();
    die('Connect Error (' . mysql_error());
}

$db_selected = mysql_select_db('freepark');
//$db_selected = mysql_select_db('test');
if (!$db_selected) {
	echo 'Can\'t use db : ' . mysql_error();
    die ('Can\'t use db : ' . mysql_error());
}
$PP = file_get_contents("php://input");
$data = json_decode($PP);
$name = $data->name;
$parkId = $data->parkId;
$cmd = $data->cmd;
$ret = array();
$ret['cmd']='ret';
$ret['name']=$name;
$ret['parkId']=$parkId;
$ret['dates'] = array();
$ret['used'] = array();

//Select Database

//file_put_contents ( "zpp.txt" , $PP); 
	
if ($cmd == "put") {
	//remove unused entries first.
	$sql = "DELETE FROM freedays_tbl WHERE parkId='$parkId' AND userId='';";
	$result = mysql_query($sql);
	for ($i = 0; $i < count($data->dates); $i++) {
		$dd = $data->dates[$i];
		$sql = "SELECT * from freedays_tbl WHERE userId !='' AND free_date ='$dd' AND parkId=''";
		$result = mysql_query($sql);
		if (mysql_num_rows($result) > 0) {
			$sql = "UPDATE freedays_tbl SET owner='$name',parkId='$parkId' WHERE  userId !='' AND free_date ='$dd' AND parkId='' LIMIT 1";
			$result = mysql_query($sql);
		} else {		
			$sql = "INSERT INTO freedays_tbl (owner, parkId, free_date) VALUES ('$name','$parkId','$dd');";
			$result = mysql_query($sql);
		}
		
	}
}
if ( $cmd == "get" || $cmd  == "put") {
	$sql = "SELECT * from freedays_tbl WHERE parkId='$parkId'";
	$result = mysql_query($sql);
	if ($result) {
		// output data of each row
		$idx=0;
		while($row = mysql_fetch_array($result)) {	
			 $dts[$idx] = $row['free_date'];
			 $used[$idx] = $row['userId'];
			 $idx++;
		}
		if ($dts != null) {
			$ret['dates'] = $dts;
			$ret['used'] = $used;
		}
		echo json_encode($ret);
	}
}
if ( $cmd == "rel" ) {
	$sql = "UPDATE freedays_tbl SET userId = '' WHERE userId ='$data->userId'  AND free_date = '$data->date'";
	$result = mysql_query($sql);
}
if ( $cmd == "res" ) {
	$sql = "UPDATE freedays_tbl SET userId = '$data->userId' WHERE userId=''  AND free_date = '$data->date' LIMIT 1";
	$result = mysql_query($sql);
}
if ( $cmd == "req" ) {
	$sql = "SELECT * from freedays_tbl WHERE userId ='$data->userId' AND free_date ='$data->date' AND parkId=''";
//	file_put_contents ( "z3.txt" , $sql . " : ". $result);
	$result = mysql_query($sql);
	if (mysql_num_rows($result) > 0) {
		$sql = "DELETE FROM freedays_tbl WHERE userId ='$data->userId' AND free_date ='$data->date' AND parkId=''";
		$result = mysql_query($sql);
//		file_put_contents ( "z1.txt" , $sql . " : ". $result); 
	} else {
		$sql = "INSERT INTO freedays_tbl (userId, free_date) VALUES ('$data->userId','$data->date');";
		$result = mysql_query($sql);
//		file_put_contents ( "z2.txt" , $sql . " : ". $result); 
	}		
}
if ( $cmd == "all" || $cmd == "rel" || $cmd == "res"  || $cmd == "req") {
	$sql = "SELECT * from freedays_tbl WHERE free_date >= CURDATE()";
	$result = mysql_query($sql);
	if ($result) {
		// output data of each row
		$idx=0;
		while($row = mysql_fetch_array($result)) {
			 $own[$idx] = $row['owner'];
			 $prk[$idx] = $row['parkId'];
			 $usr[$idx] = $row['userId'];
			 $fre[$idx] = $row['free_date'];
			 $idx++;
		}
		if ($fre != null) {
			$ret['name'] = $own;
			$ret['parkId'] = $prk;
			$ret['used'] = $usr;
			$ret['dates'] = $fre;
		}

	}
	echo json_encode($ret);
}
mysql_close();
?>


