<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hearthstone Deck Collector</title>
        <link rel="shortcut icon" href="pic/jjjj222.jpg">
        <link type="text/css" rel="stylesheet" href="css/form.css">
        <link type="text/css" rel="stylesheet" href="css/color.css">
        <link type="text/css" rel="stylesheet" href="css/navi.css">
        <link type="text/css" rel="stylesheet" href="css/layout.css">
        <link type="text/css" rel="stylesheet" href="css/table.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/util.js"></script>

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

        $(document).ready(function(){
            $(window).on('hashchange', function(e){
                load_page();
            });
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
        </script>
    </head>
<body>
    <header>
        <h1>Hearthstone Deck Collector</h1>
    </header>
    <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#card" id="card">Card</a></li>
          <li><a href="#deck" id="deck">Deck</a></li>
          <li><a href="#add" id="add">Add</a></li>
          <li><a href="#compare" id="compare">Compare</a></li>
          <li><a href="#raw" id="raw">Raw Data</a></li>
        </ul>
    </nav>

    <section id="main">
    </section>

    <footer>
        by jjjj222
    </footer>

    <script>
        load_page();
        //$("#main").load("php/add_form.php");
    </script>
</body>
</html>
