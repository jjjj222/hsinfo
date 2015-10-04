<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../css/table.css">
    </head>
<body>

<?php
include "../db/login.php";
include "html.php";
include "util.php";
include "global.php";

$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

#print_table($CARD_TABLE_NAME, $CARD_TABLE_ATTR);
$total = print_table($CARD_TABLE_NAME, $CARD_TABLE_ATTR);
print_msg("total = $total");

# close 
mysql_close($link);
?>
</body>
</html>

