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
echo "My first PHP script! -- QQ";
?>

<a href="test.php">test</a>
<a href="ecc.php">ecc</a>

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

<?php
include "db/login.php";

$link = mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
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

</body>
</html>
