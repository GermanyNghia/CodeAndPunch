<?php
// include("solarSystem.html");
session_start();
function check_cookie()
{

    if ($_SESSION[$_COOKIE["users"]] == "admin") {
        return true;
        
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
        check_cookie();
        if ($_SESSION[$_COOKIE["users"]] == $_SESSION[$_COOKIE["users"]]) {
            if(check_cookie()){
                include("html/admin.html");
            }else{
                include("home.html");
            }
            
        } else {
            setcookie("users", "user1", time() + 3600, "/Website");
            echo "<h1 style='color: white;'>Welcome anonymous</h1>";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
if (isset($_POST["viewStudent"])) {
    header("Location: studentList.php");
    }
if (isset($_POST["view_teacher"])) {
        header("Location: teacherList.php");
        }
if (isset($_POST["add_teacher"])) {
            header("Location: register.php");
            }       


if (isset($_POST["logout"])) {
end_Section();
}
?>