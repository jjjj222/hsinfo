<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../css/table.css">
    </head>
<body>
<?php
include_once "html.php";
include_once "mysql_query.php";
#include_once "global.php";
?>


<?php
$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

print_form();

mysql_close($link);
?>

<?php
function print_form() {
    echo "<a href=\"card_section.php\">reset</a>";

    global $CARD_TABLE_NAME, $CARD_TABLE_SELECT_ATTR, $CARD_TABLE_SHOW_ATTR, $CARD_TABLE_TYPE_ATTR;
    echo "<form action=\"card_section.php\">";
    #print_form_select("type", $values, get_current_get_value("type"));
    print_all_form_select($CARD_TABLE_NAME, $CARD_TABLE_SELECT_ATTR);
    echo_br();
    #$name_value = get_current_get_value("name");
    #echo "name: <input type=\"text\" name=\"name\" value=\"$value\">";
    print_all_form_input($CARD_TABLE_TYPE_ATTR);
    #print_form_input("name", get_current_get_value("name"));

    echo "<br><br>";
    echo "<input type=\"submit\" value=\"search\">";
    echo "</form>";

    $constraints = get_all_get_values($CARD_TABLE_SHOW_ATTR);
    print_card_select_table($CARD_TABLE_NAME, $CARD_TABLE_SHOW_ATTR, $constraints);
}

function print_card_select_table($table, $attributes, $constraints) {
    #var_dump($constraints);
    $attr_list_str = implode(', ', $attributes);
    $query = "SELECT $attr_list_str FROM $table";
    if (!empty($constraints)) {
        $cons_str = mysql_where_str($constraints);
        $query .= " WHERE $cons_str";
    }
    $query .= ";";
    #print_msg($query);

    $result = mysql_query($query);
    $num = @mysql_numrows($result);

    print_msg("total = $num");

    echo "<table>";
    echo "<tr>";
    foreach ($attributes as $attr) {
        echo "<th>";
        echo $attr;
        echo "</th>";
    }
    echo "</tr>";

    $i = 0;
    while ($i < $num) {
        echo "<tr>";
        foreach ($attributes as $attr) {
            echo "<td>";
            echo mysql_result($result, $i, $attr);
            echo "</td>";
        }
        echo "</tr>";
        $i++;
    }
    echo "</table>";

    return $num;
}
?>

</body>
</html>
