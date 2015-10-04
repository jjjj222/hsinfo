<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../css/table.css">
    </head>
<body>
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
    $error = false;

    $data = array();
    $card = array();

    $attributes = array("name", "class", "creator", "link", "comment");
    foreach ($attributes as $attr) {
        $data[$attr] = get_current_post_value($attr);
        if ($data[$attr] == "") {
            $error = true;
        }
    }
    #var_dump($data);
    #var_dump($error);

    global $CARD_TABLE_NAME;

    echo "<form method=\"post\" action=\"add_deck.php\">";

    echo "name: ";
    print_form_input("name", get_current_post_value("name"));
    echo "<br>";
    echo "class: ";
    $class_values = get_attribute_values($CARD_TABLE_NAME, "playerClass");
    print_form_select("class", $class_values, get_current_post_value("class"));
    echo "<br>";
    echo "creator: ";
    print_form_input("creator", get_current_post_value("creator"), 40);
    echo "<br>";
    echo "link: ";
    print_form_input("link", get_current_post_value("link"));
    echo "<br>";
    echo "comment: ";
    $comment_value = get_current_post_value("comment");
    echo "<textarea name=\"comment\" maxlength=\"255\">$comment_value</textarea>";
    echo "<br>";

    $all_card_names = get_attribute_values($CARD_TABLE_NAME, "name");
    for ($i = 1; $i <= 10; ++$i) {
        $card_value = get_current_post_value("card_$i");
        echo "card_$i: <input list=\"card_name\" name=\"card_$i\" value=\"$card_value\">";
        $card_num_value = get_current_post_value("card_num_$i");
        echo "<input type=\"number\" name=\"card_num_$i\" min=\"1\" max=\"5\" value=\"$card_num_value\">";
        if ($card_value != "") {
            if (!in_array($card_value, $all_card_names)) {
                echo "*invalid card name";
                $error = true;
            } else if ($card_num_value == "") {
                echo "*at least 1";
                $error = true;
            } else {
                $card[$card_value] = $card_num_value;
            }
        }

        echo "<br>";
    }

    echo "<datalist id=\"card_name\">";
    foreach ($all_card_names as $value) {
        echo "<option value=\"$value\">";
    }
    echo "</datalist>";

    echo "<input type=\"submit\" name=\"submit\" value=\"add\">";
    echo "</form>";

    if (!$error) {
        $data["id"] = get_deck_new_id($data["class"]);
        $data["num"] = deck_count_card($card);

        if ($data["num"] != 0) {
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


</body>
</html>
