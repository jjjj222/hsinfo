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

echo "<aside id=\"deck_table_side\"></aside>";

$constraints = get_all_get_values($DECK_TABLE_SHOW_ATTR);
print_deck_select_table($DECK_TABLE_NAME, $DECK_TABLE_SHOW_ATTR, $constraints);

#if (array_key_exists("id", $_GET)) {
#    $id = $_GET["id"];
#    $table = get_deck_table_name($id);
#    if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '$table'")) == 1) {
#        echo "<aside>";
#        print_msg($id);
#        $total = print_table($table, $DECK_SINGLE_TABLE_ATTR);
#        print_msg("total = $total");
#        echo "</aside>";
#    }
#}

mysql_close($link);
?>

<?php
function print_deck_select_table($table, $attributes, $constraints) {
    array_push($attributes, "id");
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
        if ($attr != "id") {
            echo "<th>";
            echo $attr;
            echo "</th>";
        }
    }
    echo "</tr>";

    $i = 0;
    while ($i < $num) {
        $id = mysql_result($result, $i, "id");
        echo "<tr id=\"$id\">";
        foreach ($attributes as $attr) {
            if ($attr != "id") {
                echo "<td>";
                echo mysql_result($result, $i, $attr);
                echo "</td>";
            }
        }
        echo "</tr>";
        $i++;
    }
    echo "</table>";
}
?>

<script>
$(document).ready(function(){
    $("tr").mouseenter(function(){
        var id = $(this)[0].id;
        //console.log("my object: %o", id);
        //$("#deck_table_side").html("qqqqqqqqqqqqq");
        //var name_and_value = get_child_name_and_value($(this)[0]);
        //var php_get_string = $.param(name_and_value);
        ////console.log("my object: %o", php_get_string);
        $.get("php/deck_form_result_side.php?id=" + id, function(data, status){
            $("#deck_table_side").html(data);
        });
    });
});

//$(document).ready(function(){
//    $("tr").click(function(){
//        var id = $(this)[0].id;
//        //console.log("my object: %o", id);
//        //$("#deck_table_side").html("qqqqqqqqqqqqq");
//        //var name_and_value = get_child_name_and_value($(this)[0]);
//        //var php_get_string = $.param(name_and_value);
//        ////console.log("my object: %o", php_get_string);
//        //$.get("php/deck_form_result_side.php?id=" + id, function(data, status){
//        //    $("#deck_table_side").html(data);
//        //});
//        $("#deck_form").hide();
//        $("#deck_table").hide();
//        $("#deck_detail").html("<p>yaya</p>");
//    });
//});
//
//function get_child_name_and_value(element){
//    //console.log("my object: %o", element);
//    var childs = element.childNodes;
//    var name_and_value = {};
//    for (var i = 0; i < childs.length; i++) {
//        var tag_name = childs[i].tagName;
//        //console.log("my object: %o", tag_name);
//        if (tag_name == "SELECT" || tag_name == "INPUT") {
//            var name = childs[i].getAttribute("name");
//            var value = childs[i].value;
//            name_and_value[name] = value;
//        }
//    }
//    //console.log("my object: %o", name_and_value);
//    return name_and_value;
//}
</script>
