<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>608 - project 1</title>
        <link rel="shortcut icon" href="pic/cacophony.jpg">
        <link type="text/css" rel="stylesheet" href="css/default.css">
    </head>
<body>

<?php
include "db/login.php";

$link = mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
@mysql_select_db($database) or die( "Unable to select database");

$query = "SELECT * FROM Cards";

$result = mysql_query($query);
$num = mysql_numrows($result);
echo "$num";
echo "<hr>";
?>

<p>some paragraph</p>
<table>
<tr>
<!--
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Phone</font></th>
<th><font face="Arial, Helvetica, sans-serif">Mobile</font></th>
<th><font face="Arial, Helvetica, sans-serif">Fax</font></th>
<th><font face="Arial, Helvetica, sans-serif">E-mail</font></th>
<th><font face="Arial, Helvetica, sans-serif">Website</font></th>
--!>
<th>Id</th>
<th>Name</th>
<th>Class</th>
<th>Rarity</th>
<th>Type</th>
<th>Race</th>
<th>Mana</th>
<th>Attack</th>
<th>Health</th>
<th>SetName</th>
<th>Ability</th>
</tr>

<?php
##for ($i = 0; i < $num; ++$i) {
$i = 0;
while ($i < $num) {
    #Id varchar(255),
    #Name varchar(255),
    #Class varchar(255),
    #Rarity varchar(255),
    #Type varchar(255),
    #Race varchar(255),
    #Mana varchar(255),
    #Attack varchar(255),
    #Health varchar(255),
    #SetName varchar(255),
    #Ability varchar(255)
    echo "<tr>";
    echo "<td>" . mysql_result($result, $i, "Id") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Name") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Class") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Rarity") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Type") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Race") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Mana") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Attack") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Health") . "</td>";
    echo "<td>" . mysql_result($result, $i, "SetName") . "</td>";
    echo "<td>" . mysql_result($result, $i, "Ability") . "</td>";
    echo "</tr>";
#    #$tuple = array(0, "", "", "", "");
     #mysql_result($result, $i, "PersonID");
     #mysql_result($result, $i, "LastName");
     #mysql_result($result, $i, "FirstName");
    #$address = mysql_result($result, $i, "Address");
    #$city = mysql_result($result, $i, "City");
#
    #echo "$id, $last_name, $first_name, $address, $city";
#
    #echo "$id";
    #echo "<br>";
$i++;
}

mysql_close($link);
?>
</table>

</br>
<?php 
echo "<hr>";
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_REFERER'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
echo "<br>";
echo "<hr>";
?>

</body>
</html>
