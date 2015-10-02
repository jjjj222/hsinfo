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
#include "util.php";
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
drop_table($DECK_TABLE_NAME);
create_table($DECK_TABLE_NAME);
print_msg("reset $DECK_TABLE_NAME");

insert_deck_data($DECK_TABLE_NAME, $dir);

# close 
mysql_close($link);
?>

<?php
function insert_deck_data($table, $dir) {
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
        $query = mysql_insert_str($table, $data);
        #echo $query;
        #echo "<br>";
        exec_mysql_query($query);

        $deck_table_name = get_deck_table_name($file_name);

        drop_table($deck_table_name);
        create_deck_table($deck_table_name);
        insert_card_to_deck($deck_table_name, $card);
        print_msg("reset $deck_table_name");
    }
}

function insert_card_to_deck($table, $card) {
    global $CARD_TABLE_NAME; 

    foreach ($card as $name => $num) {
        $query = "SELECT id FROM $CARD_TABLE_NAME WHERE name = \"$name\" AND id RLIKE '[0-9][0-9]$';";
        #echo $query;
        #echo "<br>";

        $result = mysql_query($query);
        $count = @mysql_numrows($result);
        if ($count != 1) {
            error_msg("multiple($count) \"$name\"");
            #echo "ERROR: multiple $name";
            #echo "<br>"
        }
        $id = mysql_result($result, 0, "id");
        #echo "id: $id, num: $num";
        #echo "<br>";
        $tuple = array();
        $tuple["id"] = $id;
        $tuple["num"] = $num;
        $query = mysql_insert_str($table, $tuple);
        #echo $query;
        #echo "<br>";
        exec_mysql_query($query);
    }
}


function deck_get_name_and_creator($line) {
    $tokens = explode(' ', $line);
    $name_arr = array();
    $creator_arr = array();
    $to_name = false;
    foreach ($tokens as $token) {
        if ($to_name) {
            array_push($name_arr, $token);
        } else {
            if ($token == "by") {
                $to_name = true;
            } else {
                array_push($creator_arr, $token);

            }
        }
    }

    $name = implode(' ', $name_arr);
    $creator = implode(' ', $creator_arr);
    $result = array($name, $creator);
    return $result;
}

function deck_get_class($line) {
    $tokens = explode(' ', $line);
    return $tokens[1];
}

function deck_get_cards($card_arr) {
    $cards = array();
    foreach ($card_arr as $card_line) {
        $tokens = explode(' ', $card_line);
        if (count($tokens) < 2) {
            continue;
        }
        $card_name = implode(' ', array_slice($tokens, 1));
        $cards[$card_name] = $tokens[0];
    }
    #var_dump($cards);
    return $cards;
}

function deck_count_card($cards) {
    $sum = 0;
    foreach ($cards as $name => $num) {
        #echo $name . " " . $num;
        #echo "<br>";
        $sum += $num;
    }
    return $sum;
}

?>

</body>
</html>
