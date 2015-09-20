<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>608 - project 1</title>
        <link rel="shortcut icon" href="pic/cacophony.jpg">
        <link type="text/css" rel="stylesheet" href="css/default.css">
    </head>
<body>
<?php
$json = '{"a":1,"b":2,"c":3,"d": ["a", "b"],"e":5}';

#var_dump(json_decode($json));
$arr = json_decode($json);
var_dump($arr);
#var_dump(json_decode($json, true));

?>

</body>
</html>
