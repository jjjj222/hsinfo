<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>608 - project 1</title>
        <link rel="shortcut icon" href="pic/cacophony.jpg">
        <!-- <link type="text/css" rel="stylesheet" href="css/default.css"> -->
        <link type="text/css" rel="stylesheet" href="css/table.css">
    </head>
<body>

<?php
include "db/login.php";
include "php/html.php";
include "php/util.php";
include "php/global.php";

$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

#print_table($CARD_TABLE_NAME, $CARD_TABLE_ATTR);
print_table($CARD_TABLE_NAME, $CARD_TABLE_INPORTANT_ATTR);
#$file_name = "deck/druid_1";
#$dir    = 'data/deck';
#$files = scandir($dir);
#
#foreach ($files as $file_name) {
#    if ($file_name == "." || $file_name == "..") {
#        continue;
#    }
#    #echo $file_name;
#    #echo "<br>";
#
#    $deck_file = read_file("$dir/$file_name");
#    $deck_file_line_arr = explode("\n", $deck_file);
#
#    $i = 0;
#    foreach ($deck_file_line_arr as $line) {
#        #echo $line;
#        #echo "<br>";
#        $tokens = explode(' ', $line);
#        foreach ($tokens as $token) {
#            echo $token;
#            echo "<br>";
#        }
#        $i++;
#    }
#    echo "<br>";
#}

#print_r($files1);
?>

</body>
</html>
