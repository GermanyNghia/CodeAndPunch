<?php
session_start();
setcookie("users", "user", time() + 3600, "/Website");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Đăng Nhập</h1>

    <form action="login.php" method="post">
        <label>username:</label> <br>
        <input type="text" name="username"> <br>
        <label>password:</label> <br>
        <input type="password" name="password"> <br>
        <input type="submit" value="Log in" name="login"> <br> 
        Does not have an account <br>
        Register here <br>
        <input type="submit" value="Register" name="register"> <br>
    </form>
</body>

</html>

<?php
try{
include("logindb.php");
$connect = mysqli_connect("localhost", "root", "", "login");
function check_cookie()
{

    if ($_COOKIE["users"] == "admin") {
        return true;
    } else {
        echo "You are not admin";
    }
}
if ($_COOKIE["users"] == "user") {
    if (isset($_POST["login"])) {

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $admin_pass = "!123@456!";
        $hash = password_hash($admin_pass, PASSWORD_DEFAULT);
        $hash2 = hash('sha1',$password);
        $sql = "SELECT * FROM users WHERE user='$username' AND password='$hash2' ";
        $result = mysqli_query($connect, $sql);       

        if (empty($username) || empty($password)) {
            echo '<span style="color:red;">Username or password is empty</span>';
        }else{
            if (($username == "admin") & (password_verify($password, $hash))) {
                // setcookie("users","admin", time()+ 4000,"/Website");
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
    
                $_COOKIE["users"] = "admin";
                if (check_cookie() == true) {
                    setcookie("users", "admin", time() + 3600, "/Website");
                    $_SESSION["admin"] = "admin";
                    header("Location: home.php");
                }
            }elseif (mysqli_num_rows($result) > 0){
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $_SESSION["user"] = "user";
                header("Location: home.php");
            }
             else
                echo "Username or Password is invalid";
        }

    } else {
        echo "Please enter your username and password";
    }
    if(isset($_POST["register"])){
        header("Location: register.php");
    }
}

    mysqli_close($connect);
}
catch(TypeError){
        echo '<h1>There is an Error</h1>';
}  
?>