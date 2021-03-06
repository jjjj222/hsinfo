<?php
function print_table($table, $attributes, $callback=NULL) {
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
            if ($callback != NULL) {
                $value = mysql_result($result, $i, $attr);
                $callback($attr, $value);
            } else {
                echo mysql_result($result, $i, $attr);
            }
            echo "</td>";
        }
        echo "</tr>";
        $i++;
    }
    echo "</table>";

    return $num;
}

function print_relation($result, $attributes, $callback="") {
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
            if ($callback != NULL) {
                $value = mysql_result($result, $i, $attr);
                $callback($attr, $value);
            } else {
                echo mysql_result($result, $i, $attr);
            }
            echo "</td>";
        }
        echo "</tr>";
        $i++;
    }
    echo "</table>";

    return $num;
}

function print_deck_table_callback($attr, $value) {
    if ($attr == "id") {
        $link = "deck_info.php?id=$value";
        echo "<a href=\"$link\">";
        echo $value;
        echo "</a>";
    } elseif ($attr == "link") {
        echo "<a href=\"$value\">";
        echo $value;
        echo "</a>";
    } else {
        echo $value;
    }
}

function print_single_deck_table_callback($attr, $value) {
    if ($attr == "id") {
        echo get_card_name_by_id($value);
    } else {
        echo $value;
    }
}

function print_form_select($name, $values, $default="", $with_empty=true) {

    echo "<select name=\"$name\">";
    if ($with_empty) {
        echo "<option value=\"\"></option>";
    }
    foreach($values as $value) {
        echo "<option value=\"$value\"";
        if ($value == $default) {
            echo "selected";
        }
        echo ">";
        echo "$value</option>";
    }
    echo "</select>";
}

function print_all_form_select($table, $attributes) {
    foreach($attributes as $attr) {
        $values = get_attribute_values($table, $attr);
        echo "$attr: ";
        print_form_select($attr, $values, get_current_get_value($attr));
        echo "&nbsp;";
        echo "&nbsp;";
        echo "&nbsp;";
    }
}

function print_form_input($attr, $default="", $maxlength="255") {
    echo "<input type=\"text\" name=\"$attr\" value=\"$default\" maxlength=\"$maxlength\">";
    echo "&nbsp;";
    echo "&nbsp;";
    echo "&nbsp;";
}

function print_all_form_input($attributes) {
    foreach($attributes as $attr) {
        echo "$attr: ";
        print_form_input($attr, get_current_get_value($attr));
    }
}

function print_deck_compare_select($name, $ids, $default="") {

    echo "<select name=\"$name\">";
    echo "<option value=\"\"></option>";
    foreach($ids as $id) {
        $deck_name = get_deck_name_by_id($id);
        echo "<option value=\"$id\"";
        if ($id == $default) {
            echo "selected";
        }
        echo ">";
        echo "$deck_name</option>";
    }
    echo "</select>";
}

function print_aside_deck($id) {
    global $DECK_SINGLE_TABLE_ATTR;

    $table = get_deck_table_name($id);
    print_msg(get_deck_name_by_id($id));
    $total = print_table($table, $DECK_SINGLE_TABLE_ATTR, 'print_single_deck_table_callback');
    print_msg("total = $total");
}
?>
