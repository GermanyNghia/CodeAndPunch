<?php
session_start();
if ($_SESSION[$_COOKIE["users"]] == "admin"){
    setcookie("users", "admin", time() + 3600, "/Website");
    echo "<h1 style='color: green;'> Welcome admin </h1>";
}elseif ($_SESSION[$_COOKIE["users"]] == "user"){
    setcookie("users", "user", time() + 3600, "/Website");
    echo "<h1 style='color: white;'> Welcome user </h1>";
}else{
    setcookie("users", "user1", time() + 3600, "/Website");
    echo "<h1 style='color: white;'>Welcome anonymous</h1>";
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
</head>

<body style="background-color: black;">
    <h1 style="color: red;">This is Home</h1> <br>

    <img src="images\home.jpg" height="100" title="Home" >
    <audio controls autoplay src="music\past_lives.mp3" > </audio>
    <audio controls autoplay src="music\my_war.mp3" > </audio>
    <form action="home.php" method="post">
    <input type="submit" name="logout" value="Log out">
    </form>
</body>

</html>

<?php

if(isset($_POST["logout"])){

    session_destroy();
    header("Location: login.php");
}
?>