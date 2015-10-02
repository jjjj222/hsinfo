<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../css/table.css">
    </head>
<body>

<?php
include "../db/login.php";
include "mysql_query.php";
include "html.php";
#include "util.php";
include "global.php";

$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
    $table = get_deck_table_name($id);
    if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '$table'")) == 1) {
        echo "<aside>";
        print_msg($id);
        $total = print_table($table, $DECK_SINGLE_TABLE_ATTR);
        print_msg("total = $total");
        echo "</aside>";
    }
}

$total = print_table($DECK_TABLE_NAME, $DECK_TABLE_ATTR, 'print_deck_table_callback');
print_msg("total = $total");

# close 
mysql_close($link);
?>

<?php
function print_deck_table_callback($attr, $value) {
    if ($attr == "id") {
        $link = "deck_info.php?id=$value";
        echo "<a href=\"$link\">";
        echo $value;
        echo "</a>";
    } elseif ($attr == "link") {
        echo "<a href=\"$value\">";
        echo $value;
        echo "</a>";
    } else {
        echo $value;
    }
}

?>
</body>
</html>

