<?php
session_start();
$_SESSION["id"] = $_GET["id"];
header("Location: editStudent.php")
?>