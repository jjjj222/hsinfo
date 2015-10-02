<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>608 - project 1</title>
        <link rel="shortcut icon" href="pic/cacophony.jpg">
        <link type="text/css" rel="stylesheet" href="css/navi.css">
        <link type="text/css" rel="stylesheet" href="css/layout.css">
        <!-- <link type="text/css" rel="stylesheet" href="css/default.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
<body>
    <!-- <p id="change2" onclick="changeText()">test</p> -->
    <script>
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
    </script>

    <script>
    $(document).ready(function(){
        $("p").click(function(){
            $(this).hide();
        });
    });
    </script>

    <header>
        header
    </header>
    <nav>
        <ul>
          <li><a href="#home" onclick="changeText()">Home</a></li>
          <li><a href="#news">News</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#nono">NONO</a></li>
          <li><a href="#qq">QQ</a></li>
        </ul>
    </nav>

    <!--
    <nav id="nav2">
        <ul>
          <li><a href="#home" onclick="changeText()">Home</a></li>
          <li><a href="#news">News</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#nono">NONO</a></li>
          <li><a href="">QQ</a></li>
        </ul>
    </nav>
    -->

    <aside>
        QQ
    </aside>

    <section id="main">
        <h1>London</h1>
        <p>
        London is the capital city of England. It is the most populous city in the United Kingdom,
        with a metropolitan area of over 13 million inhabitants.
        </p>
        <p>If you click on me, I will disappear.</p>
        <p>Click me away!</p>
        <p>Click me too!</p>
    </section>

    <script>
    $(document).ready(function(){
        $("button").click(function(){
            $("#div1").load("index.php");
        });
    });
    </script>

    <button>Get External Content</button>
    <div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>



    <footer>
        footer
    </footer>
</body>
</html>
