<?php
include "../db/login.php";
include "util.php";
include "global.php";

#------------------------------------------------------------------------------
#   data type
#------------------------------------------------------------------------------
#function get_attribute_type($table, $attribute) {
function get_attribute_type($attribute) {
    #global $CARD_TABLE_NAME;
    #if ($table == "$CARD_TABLE_NAME") {
        switch($attribute) {
            case "setSeq":
            case "cost":
            case "attack":
            case "durability":
            case "health":
            case "elite":
            case "collectible":
            case "num":
                return "int";
            default:
        }
    #}
    return "char";
}

#------------------------------------------------------------------------------
#   insert
#------------------------------------------------------------------------------
#INSERT INTO $table (column1, column2, column3,...)
#VALUES (value1, value2, value3,...);
function mysql_insert_str($table, $data) {
    $attributes = array();
    $values = array();
    foreach($data as $key => $value) {
        array_push($attributes, $key);
        #$attribute_type = get_attribute_type($table, $key);
        $attribute_type = get_attribute_type($key);
        #if ($attribute_type == "int" || $attribute_type == "tinyint") {
        if ($attribute_type == "int") {
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

function mysql_where_str($constraints) {
    $cons_strs = array();
    foreach($constraints as $key => $value) {
        #array_push($attributes, $key);
        $constraint = "";
        $attribute_type = get_attribute_type($key);
        if ($key == "name" || $key == "text") {
            $constraint = "$key LIKE \"%$value%\"";
        } elseif ($attribute_type == "int") {
            $constraint = "$key=$value";
        } else {
            $constraint = "$key=\"$value\"";
        }
        array_push($cons_strs, $constraint);
    }
    return get_sql_array_str($cons_strs, " AND ");
}

#SELECT Deck_mage_1.id AS id, Deck_mage_1.num AS num1, Deck_mage_2.num AS num2
#FROM Deck_mage_1
#LEFT JOIN Deck_mage_2
#ON Deck_mage_1.id = Deck_mage_2.id
#
#UNION
#
#SELECT Deck_mage_2.id AS id, Deck_mage_1.num AS num1, Deck_mage_2.num AS num2
#FROM Deck_mage_1
#RIGHT JOIN Deck_mage_2
#ON Deck_mage_1.id = Deck_mage_2.id
function mysql_join_str($attr, $table1, $table1_attr, $table2, $table2_attr, $type = "INNER") {
    $select_str_arr_1 = mysql_select_str_arr($table1, $table1_attr);
    $select_str_arr_2 = mysql_select_str_arr($table2, $table2_attr);
    $select_str_arr = array_merge($select_str_arr_1, $select_str_arr_2);
    $select_str = implode(", ", $select_str_arr);
    
    $constraint = mysql_on_str($attr, $table1, $table2);
    $query = "SELECT $select_str FROM $table1 $type JOIN $table2 ON $constraint";    
    return $query;
}

function mysql_select_str_arr($table, $attributes) {
    $arr = array();
    foreach ($attributes as $key => $value) {
        $select_str = "$table.$key AS $value";
        array_push($arr, $select_str);
    }
    return $arr;
}

function mysql_on_str($attr, $table1, $table2) {
    $arr = array();
    foreach ($attr as $key => $value) {
        $constraint = "$table1.$key = $table2.$value";
        array_push($arr, $constraint);
    }
    return implode(" AND ", $arr);
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

function create_deck_table($table) {
    $query = "CREATE TABLE $table (id CHAR(20) PRIMARY KEY, num INT);";
    exec_mysql_query($query);
}

function exec_mysql_query($query) {
    $result = mysql_query($query);
    if ( $result === false ){
        error_msg($query);
    }
}

function get_deck_table_name($file_name) {
    return "Deck_$file_name";
}

function get_attribute_values($table, $attr, $constraint="") {
    #$query = "SELECT DISTINCT $attr FROM $table ORDER BY $attr;";
    $query = "SELECT DISTINCT $attr FROM $table";
    if ($constraint != "") {
        $query .= " WHERE $constraint";
    }
    $query .= " ORDER BY $attr;";
    #print_msg($query);

    $result = mysql_query($query);
    $num = @mysql_numrows($result);
    $values = array();

    $i = 0;
    while ($i < $num) {
        $value = mysql_result($result, $i, $attr);
        if ($value != NULL) {
            array_push($values, $value);
        }
        $i++;
    }

    return $values;
}

function get_deck_name_by_id($id) {
    global $DECK_TABLE_NAME;
    $query = "SELECT name FROM $DECK_TABLE_NAME WHERE id=\"$id\";";
    #print_msg($query);
    $result = mysql_query($query);
    $num = @mysql_numrows($result);
    check_single_tuple($num, $id);

    return mysql_result($result, 0, "name");
}

function get_card_name_by_id($id) {
    global $CARD_TABLE_NAME;
    $query = "SELECT name FROM $CARD_TABLE_NAME WHERE id=\"$id\";";
    #print_msg($query);
    $result = mysql_query($query);
    $num = @mysql_numrows($result);
    check_single_tuple($num, $id);

    return mysql_result($result, 0, "name");
}
?>
