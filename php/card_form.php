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

print_form();

mysql_close($link);
?>

<?php
function print_form() {
    global $CARD_TABLE_NAME, $CARD_TABLE_SELECT_ATTR, $CARD_TABLE_SHOW_ATTR, $CARD_TABLE_TYPE_ATTR;
    echo "<form id=\"card_form\">";
    print_all_form_select($CARD_TABLE_NAME, $CARD_TABLE_SELECT_ATTR);
    echo "<br>";
    print_all_form_input($CARD_TABLE_TYPE_ATTR);
    echo "</form>";

    echo "<div id=\"card_table\"></div>";
}
?>

<script>
$(document).ready(function(){
    $.get("php/card_form_result.php", function(data, status){
        $("#card_table").html(data);
    });
});

$(document).ready(function(){
    $("#card_form").change(function(){
        var name_and_value = get_child_name_and_value($(this)[0]);
        var php_get_string = $.param(name_and_value);
        //console.log("my object: %o", php_get_string);
        $.get("php/card_form_result.php?" + php_get_string, function(data, status){
            $("#card_table").html(data);
        });
    });
});

function get_child_name_and_value(element){
    //console.log("my object: %o", element);
    var childs = element.childNodes;
    var name_and_value = {};
    for (var i = 0; i < childs.length; i++) {
        var tag_name = childs[i].tagName;
        //console.log("my object: %o", tag_name);
        if (tag_name == "SELECT" || tag_name == "INPUT") {
            var name = childs[i].getAttribute("name");
            var value = childs[i].value;
            name_and_value[name] = value;
        }
    }
    //console.log("my object: %o", name_and_value);
    return name_and_value;
}
</script>
