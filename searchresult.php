<?php
error_reporting(E_ALL);
  $q=mysql_real_escape_string($_GET["q"]);//added mysql_real_escape_string
require("http://www.website.com/config.php");

if (!$con)
{
die('Could not connect: ' . mysql_error());
}

mysql_select_db($db, $con);

$sql="SELECT * FROM Account WHERE username LIKE '%$q%' ORDER BY username ASC";//changed it to be: username='$q'";

$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Username</th>
<th>Email Address</th>
<th>Rank</th>
<th>Status</th>
</tr>";

while($row = mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['rank'] . "</td>";
echo "<td>" . $row['status'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysql_close($con);
?>