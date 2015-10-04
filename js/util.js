
function get_child_name_and_value(element){
    //console.log("my object: %o", element);
    var childs = element.childNodes;
    var name_and_value = {};
    for (var i = 0; i < childs.length; i++) {
        var tag_name = childs[i].tagName;
        //console.log("my object: %o", tag_name);
        if (tag_name == "SELECT" || tag_name == "INPUT" || tag_name == "TEXTAREA") {
            var name = childs[i].getAttribute("name");
            var value = childs[i].value;
            name_and_value[name] = value;
        }
    }
    //console.log("my object: %o", name_and_value);
    return name_and_value;
}
