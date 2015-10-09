<?php
include_once "../db/login.php";
include_once "mysql_query.php";
include_once "html.php";
include_once "global.php";

$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

$deck1_id = get_current_get_value("deck1");
$deck2_id = get_current_get_value("deck2");

#print_compare_form($deck1_id, $deck2_id);
#echo "<div id=\"compare_table\"><div>";
#$total = print_table($DECK_TABLE_NAME, $DECK_TABLE_ATTR, 'print_deck_table_callback');
#print_msg("total = $total");
if ($deck1_id != "" && $deck2_id != "") {
    if ($deck1_id == $deck2_id) {
        print_msg("<h2>same deck</h2>");
        return;
    }
    $table1 = get_deck_table_name($deck1_id);
    $table2 = get_deck_table_name($deck2_id);

    echo "<aside class=\"left\">";
    #echo "<aside>";
    print_aside_deck($deck1_id);
    #print_msg(get_deck_name_by_id($deck1_id));
    #$total = print_table($table1, $DECK_SINGLE_TABLE_ATTR, 'print_single_deck_table_callback');
    #print_msg("total = $total");
    #$total = print_table($table1, $DECK_SINGLE_TABLE_ATTR);
    #print_msg("total = $total");
    echo "</aside>";
    echo "<aside>";
    print_aside_deck($deck2_id);
    #print_msg(get_deck_name_by_id($deck2_id));
    #$total = print_table($table2, $DECK_SINGLE_TABLE_ATTR);
    #print_msg("total = $total");
    echo "</aside>";

    $sub_query = "SELECT $table1.id AS id, $table1.num AS num1, $table2.num AS num2 FROM $table1 LEFT JOIN $table2 ON $table1.id = $table2.id UNION SELECT $table2.id AS id, $table1.num AS num1, $table2.num AS num2 FROM $table1 RIGHT JOIN $table2 ON $table1.id = $table2.id";

    #print_msg($sub_query);


    $show_attr = array("num1", "num2");
    $show_attr = array_merge($show_attr, $CARD_TABLE_SHOW_ATTR);
    $show_str = implode(', ', $show_attr);
    #$show_str = implode(', ', $CARD_TABLE_SHOW_ATTR);
    #$sub_query = "SELECT $table1.id AS id, $table1.num AS num1, $table2.num AS num2 FROM $table1 INNER JOIN $table2 ON $table1.id = $table2.id";
    $query = "SELECT $show_str FROM $CARD_TABLE_NAME INNER JOIN ($sub_query) sub ON $CARD_TABLE_NAME.id = sub.id;";
    #$query = "SELECT * FROM $table1 NATURAL JOIN SELECT * FROM $table2;";
    #print_msg($sub_query);
    #print_msg($query);
    $result = mysql_query($query);
    #print_relation($result, array("id", "num"));
    #print_relation($result, $CARD_TABLE_SHOW_ATTR);
    print_relation($result, $show_attr);
    
    ##$query = mysql_insert_str($DECK_TABLE_NAME, $data);
    ##$query = "SELECT $table1.id, $table1.num, $table2.num FROM $table1 INNER JOIN $table2 ON $table1.id = $table2.id;";
    ##$query = "SELECT $table1.id, $table1.num, $table2.num FROM $table1 INNER JOIN $table2 ON $table1.id = $table2.id;";
    #$query = "SELECT * FROM $CARD_TABLE_NAME WHERE $CARD_TABLE_NAME.id IN (SELECT $table1.id, $table1.num, $table2.num FROM $table1 INNER JOIN $table2 ON $table1.id = $table2.id);";
    ##$query = "SELECT * FROM $table1 NATURAL JOIN SELECT * FROM $table2;";
    #echo $query;
    #echo "<br>";
    #$result = mysql_query($query);
    ##print_relation($result, array("id", "num"));
    #print_relation($result, array("id", "$table1.num", "$table2.num"));

    #$query = "SELECT * FROM $table1 WHERE id NOT IN (SELECT id FROM $table2);";
    #echo $query;
    #echo "<br>";
    #$result = mysql_query($query);
    #print_relation($result, array("id", "num"));
    ##exec_mysql_query($query);
    #$query = "SELECT * FROM $table2 WHERE id NOT IN (SELECT id FROM $table1);";
    #echo $query;
    #echo "<br>";
    #$result = mysql_query($query);
    #print_relation($result, array("id", "num"));
}

# close 
mysql_close($link);
?>

<?php
function print_compare_form($default1, $default2) {
    global $DECK_TABLE_NAME;

    echo "<form id=\"compare_form\" action=\"compare_deck.php\">";

    $ids = get_attribute_values($DECK_TABLE_NAME, "id");
    print_deck_compare_select("deck1", $ids, $default1);
    print_deck_compare_select("deck2", $ids, $default2);

    echo "<input type=\"submit\" name=\"submit\" value=\"compare\">";
    echo "</form>";
}
?>

<?php
#function print_deck_compare_select($name, $ids, $default) {
#
#    echo "<select name=\"$name\">";
#    echo "<option value=\"\"></option>";
#    foreach($ids as $id) {
#        $deck_name = get_deck_name_by_id($id);
#        echo "<option value=\"$id\"";
#        if ($id == $default) {
#            echo "selected";
#        }
#        echo ">";
#        echo "$deck_name</option>";
#    }
#    echo "</select>";
#}
?>
</body>
</html>

