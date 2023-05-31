<?php

function end_Section(){
    session_destroy();
    header("Location: login.php");
}
if (!isset($_SESSION[$_COOKIE["users"]])) {
    end_Section();
}
?>