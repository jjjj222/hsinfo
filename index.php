<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>608 - project 1</title>
        <link rel="shortcut icon" href="pic/cacophony.jpg">
        <link type="text/css" rel="stylesheet" href="css/color.css">
        <link type="text/css" rel="stylesheet" href="css/navi.css">
        <link type="text/css" rel="stylesheet" href="css/layout.css">
        <link type="text/css" rel="stylesheet" href="css/table.css">
        <!-- <link type="text/css" rel="stylesheet" href="css/default.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/util.js"></script>

        <!-- <script>
            function changeText() {
                document.getElementById("main").innerHTML = "<p> changed!  qQ </p>";
            }
        </script>

        <script>
        $(document).ready(function(){
            $("header").click(function(){
                $("li").hide();
            });
        });
        </script> -->

        <!-- <script>
        $(document).ready(function(){
            $("p").click(function(){
                $(this).hide();
            });
        });
        </script> -->
        <!-- <script>
        $(document).ready(function(){
            $("#card").click(function(){
                $("#div1").load("php/card_section.php");
            });
        });
        </script> -->
        <script>
        $(document).ready(function(){
            $("#card").click(function(){
                $("#main").load("php/card_form.php");
            });
        });

        $(document).ready(function(){
            $("#deck").click(function(){
                $("#main").load("php/deck_form.php");
            });
        });

        $(document).ready(function(){
            $("#compare").click(function(){
                $("#main").load("php/compare_form.php");
            });
        });

        $(document).ready(function(){
            $("#add").click(function(){
                $("#main").load("php/add_form.php");
            });
        });

        $(document).ready(function(){
            $("#raw").click(function(){
                $("#main").load("raw.php");
            });
        });
        </script>
    </head>
<body>
    <!-- <p id="change2" onclick="changeText()">test</p> -->

    <header>
        header
    </header>
    <nav>
        <ul>
          <!-- <li><a href="#home" onclick="changeText()">Home</a></li>> -->
          <li><a href="index.php">Home</a></li>
          <li><a href="#card" id="card">Card</a></li>
          <li><a href="#deck" id="deck">Deck</a></li>
          <li><a href="#add" id="add">Add</a></li>
          <li><a href="#compare" id="compare">Compare</a></li>
          <li><a href="#raw" id="raw">Raw Data</a></li>
        </ul>
    </nav>

    <section id="main">
        <!-- <p>hs card</p> -->
        <!-- <h1>London</h1> -->
        <!-- <p> -->
        <!-- London is the capital city of England. It is the most populous city in the United Kingdom, -->
        <!-- with a metropolitan area of over 13 million inhabitants. -->
        <!-- </p> -->
        <!-- <p>If you click on me, I will disappear.</p> -->
        <!-- <p>Click me away!</p> -->
        <!-- <p>Click me too!</p> -->
    </section>


    <!-- <button>Get External Content</button> -->
    <!-- <form> -->
        <!-- <select name="users" onchange="showUser(this.value)"> -->
        <!-- <option value="">Select a person:</option> -->
        <!-- <option value="1">Peter Griffin</option> -->
        <!-- <option value="2">Lois Griffin</option> -->
        <!-- <option value="3">Joseph Swanson</option> -->
        <!-- <option value="4">Glenn Quagmire</option> -->
        <!-- </select> -->
        <!-- </form> -->
        <!-- <br> -->
        <!-- <div id="txtHint"><b>Person info will be listed here.</b></div> -->

    <!-- <div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div> -->
    <!-- <div id="div2"><h2>Let jQuery AJAX Change This Text</h2></div> -->

    <script>
        //$("#main").load("php/deck_form.php");
        //$("#main").load("php/deck_form.php");
    </script>

    <script>
        //$("#main").load("php/home.php");
        //$(document).on('mousemove', function(e){
        //    $('#your_div_id').css({
        //       left:  e.pageX,
        //       top:   e.pageY
        //    });
        //});
        //$("#main").load("php/home.php");
    </script>
    <script>
        //load_page();
        //if(window.location.hash) {
            //$("#main").load("php/home.php");
            //load_page();
        //}
    </script>
    <script>
        $(window).on('hashchange', function(e){
            load_page();
        });

        function load_page() {
            if(window.location.hash) {
                var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
                //alert(hash);
                if (hash == "card") {
                    $("#main").load("php/card_form.php");
                } else if (hash == "deck") {
                    $("#main").load("php/deck_form.php");
                } else if (hash == "compare") {
                    $("#main").load("php/compare_form.php");
                } else if (hash == "add") {
                    $("#main").load("php/add_form.php");
                } else if (hash == "raw") {
                    $("#main").load("raw.php");
                } else {
                    //
                }
            } else {
                //alert("QQ");
                $("#main").load("php/home.php");
            }
        }
        //$(window).on("navigate", function (event, data) {
        //  var direction = data.state.direction;
        //  if (direction == 'back') {
        //    alert ("back");
        //    // do something
        //  }
        //  if (direction == 'forward') {
        //    alert ("forward");
        //    // do something else
        //  }
        //});
    </script>
    <footer>
        <a href="info.php">footer</a>
    </footer>

    <script>
        load_page();
        //$("#main").load("php/compare_form.php");
    </script>
</body>
</html>
