<?php
function get_sql_array_str($arr, $del = ", ") {
   return "(" . implode($del, $arr) . ")";
}

function read_file($file_name) {
    $file = fopen("$file_name", "r") or die("Unable to open file: $file_name !!");
    $content = fread($file, filesize("$file_name"));
    fclose($file);
    return $content;
}

function print_msg($msg) {
    echo $msg;
    echo "<br>";
}

function error_msg($msg) {
    echo "ERROR!! " . $msg;
    echo "<br>";
}

function echo_br() {
    echo "<br>";
}

function check_single_tuple($num, $value) {
    if ($num != 1) {
        error_msg("multiple($num) \"$value\"");
    }
}

function get_current_post_value($name) {
    #print_msg($name);
    if (isset($_POST[$name])) {
        return $_POST[$name];
    } else {
        return "";
    }
}

function get_current_get_value($name) {
    if (isset($_GET[$name])) {
        return $_GET[$name];
    } else {
        return "";
    }
}

function get_all_get_values($names) {
    $values = array();
    foreach($names as $name) {
        $value = get_current_get_value($name);
        $value = str_replace(";", "", $value);
        if ($value != "") {
            $values[$name] = $value;
        }
    }
    return $values;
}

?>
