<?php
// include("solarSystem.html");
session_start();
function check_cookie()
{

    if ($_COOKIE["users"] == "admin") {
       include("html/login.html");
    } else {
        include("html/login1.html");
    }
}

function end_Section(){
        session_destroy();
        header("Location: login.php");
}
try {

    if (!isset($_SESSION[$_COOKIE["users"]])) {
        end_Section();
    } else {
        if ($_SESSION[$_COOKIE["users"]] == $_SESSION[$_COOKIE["users"]]) {
            include("home.html");
        } else {
            setcookie("users", "user1", time() + 3600, "/Website");
            echo "<h1 style='color: white;'>Welcome anonymous</h1>";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}





if (isset($_POST["logout"])) {
end_Section();
}
?>