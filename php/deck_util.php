<?php
include_once "mysql_query.php";
include_once "html.php";
include_once "global.php";
?>

<?php
function create_new_deck($data, $card) {
    global $DECK_TABLE_NAME;

    $query = mysql_insert_str($DECK_TABLE_NAME, $data);
    #echo $query;
    #echo "<br>";
    exec_mysql_query($query);

    $deck_table_name = get_deck_table_name($data["id"]);

    create_deck_table($deck_table_name);
    insert_card_to_deck($deck_table_name, $card);

    return $deck_table_name;
}

function insert_card_to_deck($table, $card) {
    global $CARD_TABLE_NAME, $CARD_VALID_ID_CONSTRAINT; 

    foreach ($card as $name => $num) {
        #$query = "SELECT id FROM $CARD_TABLE_NAME WHERE name = \"$name\" AND id RLIKE '[0-9_][0-9]$';";
        $query = "SELECT id FROM $CARD_TABLE_NAME WHERE name = \"$name\" AND $CARD_VALID_ID_CONSTRAINT;";
        #echo $query;
        #echo "<br>";

        $result = mysql_query($query);
        $count = @mysql_numrows($result);
        check_single_tuple($count, $name);
        #if ($count != 1) {
        #    error_msg("multiple($count) \"$name\"");
        #    #echo "ERROR: multiple $name";
        #    #echo "<br>"
        #}
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
    $to_name = true;
    foreach ($tokens as $token) {
        if ($to_name) {
            if ($token == "by") {
                $to_name = false;
            } else {
                array_push($name_arr, $token);
            }
        } else {
            array_push($creator_arr, $token);
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
        $sum += $num;
    }
    return $sum;
}

function get_deck_new_id($class) {
    global $DECK_TABLE_NAME;

    $all_deck_ids = get_attribute_values($DECK_TABLE_NAME, "id");

    for ($i = 0; $i < 10000; $i++) {
        $new_id = "add_$class" . "_$i";
        if (!in_array($new_id, $all_deck_ids)) {
            return $new_id;
        }
    }

    return "error_id";
}

?>
