<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>608 - project 1</title>
    <link rel="shortcut icon" href="../pic/cacophony.jpg">
    <link type="text/css" rel="stylesheet" href="../css/default.css">
</head>
<body>

<?php
#------------------------------------------------------------------------------
#   include
#------------------------------------------------------------------------------
include "mysql_query_str.php";
include "../db/login.php";
include "global.php";
?>

<?php
#------------------------------------------------------------------------------
#   link mysql
#------------------------------------------------------------------------------
$link = mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");
?>

<?php
#------------------------------------------------------------------------------
#   run
#------------------------------------------------------------------------------
# decode json
$file_name = "../data/AllSets.json";
$json_str = read_file($file_name);
$json_arr = json_decode($json_str);
#dump_attributes($json_arr);

# rebuild data
drop_table($CARD_TABLE_NAME);
create_table($CARD_TABLE_NAME);
insert_data($CARD_TABLE_NAME, $json_arr);
?>

<?php
#------------------------------------------------------------------------------
#   build data
#------------------------------------------------------------------------------
function drop_table($table) {
    $query = "DROP TABLE $table;";
    exec_mysql_query($query);
}

function create_table($table) {
    $file_name = "../schema/create_" . "$table" . "_table";
    $query = read_file($file_name);
    exec_mysql_query($query);
}

function insert_data($table, $arr) {
    foreach($arr as $set_type => $card_obj) {
        $card_array = (array)$card_obj;
        foreach($card_array as $set_seq => $card_info_obj) {
            $data = array();
            $data["setType"] = $set_type;
            $data["setSeq"] = $set_seq;
            $card_info_array = (array)$card_info_obj;
            foreach($card_info_array as $key => $value) {
                $value_type = gettype($value);
                $value_all = "";
                if ($value_type == "array") {
                    $value_all = implode(', ',  $value);
                } else if ($value_type == "object") {
                    $value_all = implode(', ', (array)$value);
                } else {
                    if ($value === false) {
                        $value_all = 0;
                    } else {
                        $value_all = $value;
                    }
                }
                #echo "setType=$set_type, setSeq=$set_seq";
                #echo "<br>";
                $data[$key] = mysql_real_escape_string($value_all);
            }
            $query = mysql_insert_str($table, $data);
            #echo $query;
            #echo "<br>";
            exec_mysql_query($query);
            #if ($data["id"] == "EX1_066") {
            #    exec_mysql_query($query);
            #}
        }
    }
}

function exec_mysql_query($query) {
    $result = mysql_query($query);
    if ( $result === false ){
        echo "ERROR!! " . $query;
        echo "<br>";
    }
}

#------------------------------------------------------------------------------
#   debug
#------------------------------------------------------------------------------
function dump_attributes($arr) {
    $all_attribute = array();
    foreach($arr as $set_type => $card_obj) {
        $card_array = (array)$card_obj;
        foreach($card_array as $set_seq => $card_info_obj) {
            $card_info_array = (array)$card_info_obj;
            foreach($card_info_array as $key => $value) {
                $all_attribute[$key] = 1;
            }
        }
    }

    $i = 0;
    foreach($all_attribute as $key => $value) {
        echo $i++ . ": ";
        echo $key;
        echo "<br>";
    }
}
?>
</body>
</html>
