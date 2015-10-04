<?php
include_once "html.php";
include_once "mysql_query.php";
?>

<?php
$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

$constraints = get_all_get_values($CARD_TABLE_SHOW_ATTR);
print_card_select_table($CARD_TABLE_NAME, $CARD_TABLE_SHOW_ATTR, $constraints);

mysql_close($link);
?>

<?php
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
    if ($num == 0) {
        return;
    }

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
}
?>
