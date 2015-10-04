<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>608 - project 1</title>
        <link rel="shortcut icon" href="pic/cacophony.jpg">
        <!-- <link type="text/css" rel="stylesheet" href="css/default.css"> -->
        <!-- <link type="text/css" rel="stylesheet" href="css/table.css"> -->
    </head>
<body>

<?php
include "../db/login.php";
include "mysql_query.php";
include "html.php";
include_once "deck_util.php";
include "global.php";
?>

<?php
#------------------------------------------------------------------------------
#   run
#------------------------------------------------------------------------------
# link mysql
$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

# decode json
$dir    = '../data/deck';

# rebuild data
drop_all_deck();
drop_table($DECK_TABLE_NAME);
create_table($DECK_TABLE_NAME);
print_msg("reset $DECK_TABLE_NAME");

insert_deck_data($dir);

# close 
mysql_close($link);
?>

<?php
function drop_all_deck() {
    global $DECK_TABLE_NAME;
    $all_deck_ids = get_attribute_values($DECK_TABLE_NAME, "id");
    foreach ($all_deck_ids as $id) {
        $deck_table_name = get_deck_table_name($id);
        drop_table($deck_table_name);
        print_msg("drop $deck_table_name");
    }

}

function insert_deck_data($dir) {
    global $DECK_TABLE_NAME;

    $files = scandir($dir);
    $data = array();
    $card = array();
    foreach ($files as $file_name) {
        if ($file_name == "." || $file_name == "..") {
            continue;
        }
        $data["id"] = $file_name;
        $deck_file = read_file("$dir/$file_name");
        $deck_file_line_arr = explode("\n", $deck_file);
        $deck_head_arr = array_slice($deck_file_line_arr, 0, 3);
        $deck_card_arr = array_slice($deck_file_line_arr, 4);

        $result = deck_get_name_and_creator($deck_head_arr[0]);
        $data["name"] = $result[0];
        $data["creator"] = $result[1];
        $data["link"] = $deck_head_arr[1];
        $data["class"] = deck_get_class($deck_head_arr[2]);

        $card = deck_get_cards($deck_card_arr);
        $data["num"] = deck_count_card($card);
        $new_table_name = create_new_deck($data, $card);
        print_msg("create $new_table_name");
    }
}

?>

</body>
</html>
