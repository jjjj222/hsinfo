<?php
function get_sql_array_str($arr) {
   return "(" . implode(", ", $arr) . ")";
}

function read_file($file_name) {
    $file = fopen("$file_name", "r") or die("Unable to open file: $file_name !!");
    $content = fread($file, filesize("$file_name"));
    fclose($file);
    return $content;
}

function error_msg($msg) {
    echo "ERROR!! " . $msg;
    echo "<br>";
}

function echo_br() {
    echo "<br>";
}

?>
