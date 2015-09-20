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
if ($_SERVER['SERVER_NAME'] == "localhost") {
    $servername = "localhost";
} else {
    $servername = "database2.cs.tamu.edu";
}
$username = "jjjj222";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

</body>
</html>
