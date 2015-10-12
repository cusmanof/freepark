<?php
//This is an example PHP page that connects to Google Cloud SQL databases from an App Engine application

/*
Connect to Cloud SQL
  Usage: Update the connection string with your connection information
    -Replace "project_id" with the Project ID of your Cloud SQL Project
    -Replace "demo-db" with the name of your instance in Cloud SQL
    -Replace "root" with your user name
*/
$conn = mysql_connect("localhost", "root", "rootmysql");
if (!$conn) {
    die('Connect Error (' . mysql__error());
}

/*
$conn = mysql_connect(":/cloudsql/freepark-1091:frank", "root", "");
if (!$conn) {
    die('Connect Error (' . mysql__error());
}
*/
/*
//Select Database
$db_selected = mysql_select_db('freepark', $conn);
if (!$db_selected) {
    die ('Can\'t use db : ' . mysql_error());
}
//Perform Query
$result = mysql_query("SELECT name, date  FROM freedays_tbl;");
//Show Results
echo "<!doctype html>";
echo "<body>";
echo "<h3>Results from Google Cloud SQL</h3>";
echo "<table class=simpletable border=1>";
echo "<tr><th align=left>Name</th><th>date</th></tr>";
while ($row = mysql_fetch_assoc($result)) {
    echo "<tr><td align=left>" . $row['name'] . "</td>";
    echo "<td align=center class=addCommas>" . $row['size'] . "</td></tr>";
}
echo "</table>";
*/

//Select Database
$db_selected = mysql_select_db('test', $conn);
if (!$db_selected) {
    die ('Can\'t use db : ' . mysql_error());
}
$sql = "CREATE TABLE freedays_tbl( ".
       "owner VARCHAR(40) NOT NULL, ".
	   "parkId VARCHAR(40) NOT NULL, ".
       "user VARCHAR(40) , ".
       "submission_date DATE); ";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not create table: ' . mysql_error());
}
echo "Table created successfully\n";
mysql_close($conn);

?>


<!-- Style the results table -->
<style type="text/css">
h3 {font-family:verdana;font-size:24px;color:#181C26;}
table.simpletable {font-family:verdana;font-size:15px;color:#40434A;border-width:1px;border-color:#778AB8;border-collapse:collapse;}
table.simpletable th {border-width: 1px;padding: 10px;border-style: solid;border-color:#778AB8;background-color:#dedede;}
table.simpletable td {border-width: 1px;padding: 10px;border-style: solid;border-color: #778AB8;background-color: #ffffff;}
</style>

<!-- Add commas to numbers appearing in the table cell with the attribute 'class=addCommas'-->
<script type="text/javascript">
function formatNumberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
var elements = document.querySelectorAll('td.addCommas');
var i;
for (i in elements) {
   if(elements[i].innerHTML != undefined) {
         elements[i].innerHTML = formatNumberWithCommas(elements[i].innerHTML);
   }
}
</script>

</body>
</html>


