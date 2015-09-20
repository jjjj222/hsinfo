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

$query = "SELECT * FROM Persons";

$result = mysql_query($query);
$num = mysql_numrows($result);
echo "$num";
echo "<hr>";

##for ($i = 0; i < $num; ++$i) {
$i = 0;
while ($i < $num) {
#    #$tuple = array(0, "", "", "", "");
    $id = mysql_result($result, $i, "PersonID");
    $last_name = mysql_result($result, $i, "LastName");
    $first_name = mysql_result($result, $i, "FirstName");
    $address = mysql_result($result, $i, "Address");
    $city = mysql_result($result, $i, "City");
#
    echo "$id, $last_name, $first_name, $address, $city";
#
    #echo "$id";
    echo "<br>";
$i++;
}

mysql_close($link);

// Create connection
#$conn = new mysqli($servername, $username, $password);
#
#// Check connection
#if (
#    die("Connection failed: " . $conn->connect_error);
#}
#echo "Connected successfully";


#try {
#    #$conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
#    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
#    // set the PDO error mode to exception
#    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
#    echo "Connected successfully";
#    }
#catch(PDOException $e)
#    {
#    echo "Connection failed: " . $e->getMessage();
#    }
?>

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
