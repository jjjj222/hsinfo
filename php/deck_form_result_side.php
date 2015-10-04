<?php
include_once "html.php";
include_once "mysql_query.php";
?>

<?php
$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

#$constraints = get_all_get_values($DECK_TABLE_SHOW_ATTR);
#print_deck_select_table($DECK_TABLE_NAME, $DECK_TABLE_SHOW_ATTR, $constraints);
#
#echo "<div id=\"deck_table_side\"><div>";
if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
    $table = get_deck_table_name($id);
    if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '$table'")) == 1) {
        #echo "<aside>";
        print_msg(get_deck_name_by_id($id));
        $total = print_table($table, $DECK_SINGLE_TABLE_ATTR, 'print_single_deck_table_callback');
        print_msg("total = $total");
        #echo "</aside>";
    }
}
#echo "QQQQQQQ";

mysql_close($link);
?>

