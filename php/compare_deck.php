<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../css/table.css">
        <link type="text/css" rel="stylesheet" href="../css/layout.css">
    </head>
<body>

<!-- <a href="../info.php">back to info</a> -->

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

print_compare_form($deck1_id, $deck2_id);
#echo "<div id=\"compare_table\"><div>";
#$total = print_table($DECK_TABLE_NAME, $DECK_TABLE_ATTR, 'print_deck_table_callback');
#print_msg("total = $total");
if ($deck1_id != "" && $deck2_id != "") {
    if ($deck1_id == $deck2_id) {
        print_msg("same table");
        return;
    }
    
    $table1 = get_deck_table_name($deck1_id);
    $table2 = get_deck_table_name($deck2_id);

    #echo "<aside class=\"left\">";
    echo "<aside>";
    print_msg($deck1_id);
    $total = print_table($table1, $DECK_SINGLE_TABLE_ATTR);
    print_msg("total = $total");
    echo "</aside>";
    echo "<aside>";
    print_msg($deck2_id);
    $total = print_table($table2, $DECK_SINGLE_TABLE_ATTR);
    print_msg("total = $total");
    echo "</aside>";
    
    $table1_attr = array();
    $table2_attr = array();
    $table1_attr["id"] = "id";
    $table1_attr["num"] = "num1";
    $table2_attr["num"] = "num2";
    $join_attr["id"] = "id";
    $sub_query_1 = mysql_join_str($join_attr, $table1, $table1_attr, $table2, $table2_attr, "LEFT");

    $table1_attr = array();
    $table2_attr = array();
    $table1_attr["num"] = "num1";
    $table2_attr["id"] = "id";
    $table2_attr["num"] = "num2";
    $join_attr["id"] = "id";
    $sub_query_2 = mysql_join_str($join_attr, $table1, $table1_attr, $table2, $table2_attr, "RIGHT");
    $sub_query = "$sub_query_1 UNION $sub_query_2";
    #$sub_query = "SELECT Deck_mage_1.id AS id, Deck_mage_1.num AS num1, Deck_mage_2.num AS num2 FROM Deck_mage_1 LEFT JOIN Deck_mage_2 ON Deck_mage_1.id = Deck_mage_2.id UNION SELECT Deck_mage_2.id AS id, Deck_mage_1.num AS num1, Deck_mage_2.num AS num2 FROM Deck_mage_1 RIGHT JOIN Deck_mage_2 ON Deck_mage_1.id = Deck_mage_2.id";

    print_msg($sub_query);


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

