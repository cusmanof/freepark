<?php

$mysqli = mysqli_connect("/cloudsql/fpark-1098:frank", "root", "", 'freepark');
//$mysqli = mysqli_connect("localhost:3307", "root", "rootmysql",'test' );
if ($mysqli->connect_errno) {
	die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
$q = "select * from ci_sessions";
$result = mysqli_query($mysqli, $q);
echo $result;
while ($row = mysql_fetch_array($result)) {
    echo $row;
}

$q = "DROP TABLE IF EXISTS ci_sessions";
mysqli_query($mysqli, $q);

$q=" CREATE TABLE  ci_sessions (
	session_id varchar(40),
	ip_address varchar(45),
	user_agent varchar(120),
	last_activity int(10),
	user_data text,
	PRIMARY KEY (session_id),
	KEY last_activity_idx (last_activity)";

$res = mysqli_query($mysqli, $q);
echo "res " . $res;

$query = file_get_contents("create.sql");
echo $query;
/* execute multi query */
if (mysqli_multi_query($mysqli, $query)) {
    do {
        /* store first result set */
        if ($result = mysqli_store_result($mysqli)) {
            while ($row = mysqli_fetch_row($result)) {
                printf("%s\n<BR>", $row[0]);
            }
            mysqli_free_result($result);
        }
        /* print divider */
        if (mysqli_more_results($mysqli)) {
            printf("-----------------\n<BR>");
        }
    } while (mysqli_next_result($mysqli));
}
 echo "Any errors?  (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
/* close connection */
mysqli_close($mysqli);	
?>



