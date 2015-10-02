<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>608 - project 1</title>
        <link rel="shortcut icon" href="pic/cacophony.jpg">
        <!-- <link type="text/css" rel="stylesheet" href="css/default.css" -->
        <!-- <link type="text/css" rel="stylesheet" href="css/default.css" -->
    </head>
<body>
<?php
echo true;
echo false;
echo "<br>";
$json = '{"a":1,"b":2,"c":3,"d": ["a", "b"],"e":5}';
#var_dump(json_decode($json));
$arr = json_decode($json);
var_dump($arr);
#var_dump(json_decode($json, true));
?>

<?php
#$file_name = "data/test.json";
$file_name = "data/AllSets.json";
$myfile = fopen("$file_name", "r") or die("Unable to open file!");
$json_str = fread($myfile,filesize("$file_name"));
#echo "$json_str";
$obj = json_decode($json_str);
echo "<br>";
dump_array($obj, "");
#var_dump($obj);

function dump_array($arr, $indent) {
    $i = 0;
    foreach($arr as $key => $value) {
        $value_type = gettype($value);
        echo "$indent" . $i++ . ": ";
        #echo "$indent";
        echo "Key=" . $key . ", Value=";
        if ($value_type == "array") {
            echo "<br>";
            dump_array($value, $indent . "--> ");
            #dump_array_type($value, $indent . "--> ");
        } else if ($value_type == "object") {
            #echo $value_type;
            #var_dump($value);
            echo "<br>";
            dump_array((array)$value, $indent . "--> ");
        } else {
            echo $value;
            echo "<br>";
        }
    }
}

function dump_array_type($arr, $indent) {
    foreach($arr as $key => $value) {
        $value_type = gettype($value);
        echo "$indent";
        echo "Key=" . $key . ", Value=";
        echo $value_type;
        echo "<br>";
    }
}
fclose($myfile);
?>

</body>
</html>
