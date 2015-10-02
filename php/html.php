<?php
function print_table($table, $attributes) {
    $attr_list_str = implode(', ', $attributes);
    $query = "SELECT $attr_list_str FROM $table";

    $result = mysql_query($query);
    $num = @mysql_numrows($result);

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

<?php
#$i = 0;
#while ($i < $num) {
#    echo "<tr>";
#    echo "<td>" . mysql_result($result, $i, "Id") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Name") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Class") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Rarity") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Type") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Race") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Mana") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Attack") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Health") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "SetName") . "</td>";
#    echo "<td>" . mysql_result($result, $i, "Ability") . "</td>";
#    echo "</tr>";
##    #$tuple = array(0, "", "", "", "");
#$i++;
?>
