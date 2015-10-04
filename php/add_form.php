<?php
include_once "../db/login.php";
include_once "global.php";
include_once "mysql_query.php";
include_once "html.php";
include_once "deck_util.php";
?>

<?php
$link = @mysql_connect("$servername", "$username", "$password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
@mysql_select_db($database) or die( "Unable to select database");

print_add_form();

# close 
mysql_close($link);
?>

<?php
function print_add_form() {
    global $CARD_TABLE_NAME, $CARD_VALID_ID_CONSTRAINT;

    $is_post = false;
    $error = false;

    $data = array();
    $card = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $is_post = true;
    }

    $attributes = array("name", "class", "creator", "link", "comment");
    foreach ($attributes as $attr) {
        $data[$attr] = get_current_post_value($attr);
        if ($data[$attr] == "") {
            $error = true;
        }
    }

    echo "<form id=\"add_form\">";
    print_add_form_input_line("name", $is_post);

    echo "class: ";
    $class_values = get_attribute_values($CARD_TABLE_NAME, "playerClass");
    print_form_select("class", $class_values, get_current_post_value("class"), false);
    echo "<br>";

    print_add_form_input_line("creator", $is_post, 40);
    print_add_form_input_line("link", $is_post);

    echo "comment: ";
    $comment_value = get_current_post_value("comment");
    echo "<textarea name=\"comment\" maxlength=\"255\">$comment_value</textarea>";
    if ($is_post) {
        check_empty($comment_value);
    }
    echo "<br>";
    #echo "</form>";

    #echo "<form id=\"add_form_card\">";
    #$all_card_names = get_attribute_values($CARD_TABLE_NAME, "name", "id RLIKE '[0-9_][0-9]$'");
    $all_card_names = get_attribute_values($CARD_TABLE_NAME, "name", $CARD_VALID_ID_CONSTRAINT);
    #var_dump($all_card_names);
    echo "<datalist id=\"card_name\">";
    foreach ($all_card_names as $value) {
        echo "<option value=\"$value\">";
    }
    echo "</datalist>";

    for ($i = 1; $i <= 20; ++$i) {
        $card_value = get_current_post_value("card_$i");
        echo "card_$i: <input list=\"card_name\" name=\"card_$i\" value=\"$card_value\">";
        $card_num_value = get_current_post_value("card_num_$i");
        echo "<input type=\"number\" name=\"card_num_$i\" min=\"1\" max=\"5\" value=\"$card_num_value\">";
        if ($card_value != "") {
            if (!in_array($card_value, $all_card_names)) {
                #echo "<span class>*invalid card name";
                echo "<span class=\"error\">*incalid card name card</span>";
                $error = true;
            } else if ($card_num_value == "") {
                echo "<span class=\"error\">*at least 1</span>";
                #echo "*at least 1";
                $error = true;
            } else {
                $card[$card_value] = $card_num_value;
            }
        }

        echo "<br>";
    }
    $data["num"] = deck_count_card($card);
    if ($is_post) {
        if ($data["num"] == 0) {
            echo "<span class=\"error\">*at least 1 card</span>";
            echo "<br>";
        }
    }


    echo "<input type=\"submit\" name=\"submit\" value=\"add\" id=\"add_button\">";
    echo "</form>";

    if ($is_post && !$error) {
        $data["id"] = get_deck_new_id($data["class"]);

        if ($data["num"] != 0) {
            foreach ($data as $key => $value) {
                $data[$key] = test_input($value);
            } 

            create_new_deck($data, $card);
            echo "Add deck \"" . $data["name"] . "\" successfully";
            echo "<br>";
        }
    }
    
    #var_dump($data);
    #echo "<br>";
    #var_dump($card);
    #echo "<br>";
    #var_dump($error);
    #echo "<br>";
}

?>

<?php
function print_add_form_input_line($attr, $is_post, $maxlength=255) {
    echo "$attr: ";
    $value = get_current_post_value($attr);
    print_form_input($attr, $value, $maxlength);
    if ($is_post) {
        check_empty($value);
    }
    echo "<br>";
}

function check_empty($value) {
    if ($value == "") {
        echo "<span class=\"error\">*</span>";
    }
}

?>

<script>
$(document).ready(function(){
    $('#add_button').click(function(e) {
        e.preventDefault();
        var name_and_value = get_child_name_and_value($("#add_form")[0]);
        //var php_get_string = $.param(name_and_value);
        //alert (php_get_string);
        //var name_and_value = get_child_name_and_value($("#add_form_card")[0]);
        //var php_get_string = $.param(name_and_value);
        //alert (php_get_string);
        //$('ul').addClass('expanded');
        //$('ul.expanded').fadeIn(300);
        //console.log("my object: %o", name_and_value);
        //return false;
        $.post("php/add_form.php", name_and_value, function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            $("#main").html(data);
        });
    });
});
</script>


<script>
//$(document).ready(function(){
//    $("#add_button").click(function(){
//        var name_and_value = get_child_name_and_value($("#add_form")[0]);
//        //console.log("my object: %o", php_get_string);
//        var php_get_string = $.param(name_and_value);
//        alert (php_get_string);
//        //console.log("my object: %o", php_get_string);
//        //$.get("php/deck_form_result.php?" + php_get_string, function(data, status){
//        //    $("#deck_table").html(data);
//        //});
//    });
//});
</script>

