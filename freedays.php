<?php
$conn = mysql_connect(":/cloudsql/freepark-1091:frank", "root", "");
/*$conn = mysql_connect("localhost:3306", "root", "rootmysql"); */
if (!$conn) {
	echo 'Connect Error (' . mysql_error();
    die('Connect Error (' . mysql_error());
}

$db_selected = mysql_select_db('freepark');
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
$ret[cmd]="ret";
$ret[name]=$name;
$ret[parkId]=$parkId;
$ret[dates] = array();
$ret[used] = array();


mysql_close();

?>


