<?php
// include("solarSystem.html");
session_start();

function end_Section(){


        session_destroy();
        header("Location: login.php");
}
try {

    if (!isset($_SESSION[$_COOKIE["users"]])) {
        end_Section();
    } else {
        if ($_SESSION[$_COOKIE["users"]] == $_SESSION[$_COOKIE["users"]]) {
            echo "<h1 style='color: green;'> Welcome {$_COOKIE["users"]} </h1>";
        } else {
            setcookie("users", "user1", time() + 3600, "/Website");
            echo "<h1 style='color: white;'>Welcome anonymous</h1>";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>Document</title>
    <link rel="stylesheet" href="home1.css">
    <link rel="stylesheet" href="solarSystem.css">
</head>

<body>
    <h1>This is Home </h1> <br>

    <img src="images\home.jpg" height="100" title="Home">
    <audio background src="music\past_lives.mp3"> </audio>
    <audio controls src="music\my_war.mp3"> </audio>
    <form action="home.php" method="post">
        <input type="submit" name="logout" value="Log out">

    </form>
    <input id ="button2" type="submit" name="clickme" value="Click me">
    <div id="box1">
        <div id="box2">
            <div class="container">
                <div class="sun"></div>
                <div class="earth">
                    <div class="moon"></div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

<?php

if (isset($_POST["logout"])) {
end_Section();
}

?>