<?php
$mysqli = mysqli_connect(":/cloudsql/fpark-1098:frank", "root", "", 'freepark');
//$mysqli = mysqli_connect("localhost:3307", "root", "rootmysql",'test' );
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$q="CREATE TABLE IF NOT EXISTS ci_sessions ( session_id varchar(40) DEFAULT '0' NOT NULL, ip_address varchar(45) DEFAULT '0' NOT NULL, user_agent varchar(120) NOT NULL, last_activity int(10) unsigned DEFAULT 0 NOT NULL, user_data text NOT NULL, PRIMARY KEY (session_id), KEY last_activity_idx (last_activity) )";

$mysqli->query($q);


$query = file_get_contents("create.sql");
/* execute multi query */
if ($mysqli->multi_query($query)) {
    do {
        /* store first result set */
        if ($result = $mysqli->store_result()) {
            while ($row = $result->fetch_row()) {
                printf("%s\n<BR>", $row[0]);
            }
            $result->free();
        }
        /* print divider */
        if ($mysqli->more_results()) {
            printf("-----------------\n<BR>");
        }
    } while ($mysqli->next_result());
}

/* close connection */
$mysqli->close();	
?>



