<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="javascript.js"></script>
    <title>Chess</title>
</head>
<body>
<?php
    require_once("logic/process_move.php");

    require_once("logic/logic.php");

    if( isset($_GET['gamemode'])){
        $gamemode = $_GET['gamemode'];
    }else{
        $gamemode = "solo";
    }

    if( isset($_GET['color'])){
        $color = $_GET['color'];
    }else
        $color = "white";

    echo $gamemode ." ". $color;
    echo "<div class='container'>";

    echo "<div class='center'> <h1> Info <h1></div>";

    
    $logic = new logic($gamemode); //start game
    $_SESSION['chess_logic'] = $logic;

    echo "<div class='center'> <h1>Moves</h1>";
    echo "<p id='movehistory'>test</p>";
    echo  "</div>";

    echo "</div>";

    echo "<div id='ajax_response'></div>";
?>
</body>
</html>