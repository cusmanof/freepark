<html>
<body>


<?php

$conn = mysql_connect("localhost", "root", "rootmysql");
if (!$conn) {
    die('Connect Error (' . mysql__error());
}


//Select Database
$db_selected = mysql_select_db('test');
if (!$db_selected) {
	file_put_contents("pe2.txt",'Can\'t use db : ' . mysql_error());
    die ('Can\'t use db : ' . mysql_error());
}

$PP = file_get_contents("php://input");
$data = json_decode($PP);
//file_put_contents("pp.txt",$PP);


/* $conn = mysql_connect(":/cloudsql/freepark-1091:frank", "root", ""); */

$name = $data->name;
$parkId = $data->parkId;

for ($i = 0; $i < count($data->dates); $i++) {
$dd = $data->dates[$i];
$sql = "INSERT INTO freedays_tbl (name, parkId, date) VALUES ('$name','$parkId','$dd')";
file_put_contents("pn.txt", $sql);
$result = mysql_query($sql);
}


//Perform Query

?>
</body>
</html>
