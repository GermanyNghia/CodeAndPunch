<?php

    $db_server = "EHCodeAndPunch";
    $db_user = "admin";
    $db_pass = "1234";
    $db_name = "users";
    $connect = "";


    try{
        $connect = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }catch(mysqli_sql_exception){
        echo "Something went wrong";
    }catch(TypeError){
        echo "Something went wrong";
    }
