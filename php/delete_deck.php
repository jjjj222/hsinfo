<?php
include_once "../db/login.php";
include_once "global.php";
include_once "mysql_query.php";
include_once "html.php";
include_once "deck_util.php";
?>

<?php
$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

#print_add_form();
$id = get_current_get_value("id");
$ids = get_attribute_values($DECK_TABLE_NAME, "id");
if (in_array($id, $ids)) {
    $deck_table_name = get_deck_table_name($id);
    drop_table($deck_table_name);

    $query = "DELETE FROM $DECK_TABLE_NAME WHERE id=\"$id\";";
    exec_mysql_query($query);
}
# close 
mysql_close($link);
?>
