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
    global $DECK_TABLE_NAME;

    echo "<form id=\"compare_form\">";

    $ids = get_attribute_values($DECK_TABLE_NAME, "id");
    print_deck_compare_select("deck1", $ids);
    print_deck_compare_select("deck2", $ids);

    echo "</form>";

    echo "<div id=\"compare_table\"></div>";
}
?>

<script>
$(document).ready(function(){
    $("#compare_form").change(function(){
        var name_and_value = get_child_name_and_value($(this)[0]);
        var php_get_string = $.param(name_and_value);
        //console.log("my object: %o", php_get_string);
        $.get("php/compare_form_result.php?" + php_get_string, function(data, status){
            $("#compare_table").html(data);
        });
    });
});
</script>
