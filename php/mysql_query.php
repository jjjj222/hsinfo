<?php
include "../db/login.php";
include "util.php";
include "global.php";

#------------------------------------------------------------------------------
#   data type
#------------------------------------------------------------------------------
function get_attribute_type($table, $attribute) {
    global $CARD_TABLE_NAME;
    if ($table == "$CARD_TABLE_NAME") {
        switch($attribute) {
            case "setSeq":
            case "cost":
            case "attack":
            case "durability":
            case "health":
            case "elite":
            case "collectible":
                return "int";
            default:
        }
    }
    return "char";
}

#------------------------------------------------------------------------------
#   insert
#------------------------------------------------------------------------------
#INSERT INTO table_name (column1, column2, column3,...)
#VALUES (value1, value2, value3,...);
function mysql_insert_str($table, $data) {
    $attributes = array();
    $values = array();
    foreach($data as $key => $value) {
        array_push($attributes, $key);
        $attribute_type = get_attribute_type($table, $key);
        if ($attribute_type == "int" || $attribute_type == "tinyint") {
            array_push($values, "$value");
        } else {
            array_push($values, "'$value'");
        }
    }

    $attributes_list_str = get_sql_array_str($attributes);
    $values_list_str = get_sql_array_str($values);
    $query = "
        INSERT INTO $table $attributes_list_str
        VALUES $values_list_str;
    ";
    return $query;
}


function drop_table($table) {
    $query = "DROP TABLE $table;";
    exec_mysql_query($query);
}

function create_table($table) {
    $file_name = "../schema/create_" . "$table" . "_table";
    $query = read_file($file_name);
    exec_mysql_query($query);
}

#function drop_deck_table($file_name) {
#    drop_table(get_deck_table_name($file_name));
#}

function create_deck_table($table) {
    $query = "CREATE TABLE $table (id CHAR(20) PRIMARY KEY, num INT);";
    exec_mysql_query($query);
}

function exec_mysql_query($query) {
    $result = mysql_query($query);
    if ( $result === false ){
        error_msg($query);
        #echo "ERROR!! " . $query;
        #echo "<br>";
    }
}

function get_deck_table_name($file_name) {
    return "Deck_$file_name";
}

?>
