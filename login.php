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
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="loginBox">
        <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
        <h3>Đăng Nhập</h3>
        <form action="login.php" method="post">
            <div class="inputBox"> 
                <input id="uname" type="text" name="username" placeholder="Username"> 
                <input id="pass" type="password" name="password" placeholder="Password"> 
            </div> 
            <input type="submit" value="Log in" name="login"> <br>
        </form>
    </div>
</body>

</html>

<?php
try {
    include("registerDB.php");
    function hash_cookie($check)
    {

        if ($check == "admin") {
            return password_hash($check, PASSWORD_DEFAULT);
        } elseif ($check == "teachers") {
            return password_hash($check, PASSWORD_DEFAULT);
        } else {
            return password_hash($check, PASSWORD_DEFAULT);
        }
    }
    if (isset($_POST["login"])) {

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $admin_pass = "!123@456!";
        $hash = password_hash($admin_pass, PASSWORD_DEFAULT);
        $hash2 = hash('sha256', $password);

        $sql = "SELECT * FROM students WHERE username='$username' AND password='$hash2' ";
        $sql1 = "SELECT * FROM teachers WHERE username='$username' AND password='$hash2' ";
        $result = mysqli_query($connect, $sql);
        $result1 = mysqli_query($connect, $sql1);

        if (empty($username) || empty($password)) {
            echo '<span style="color:red;">Username or password is empty</span>';
        } else {
            if (($username == "admin") & (password_verify($password, $hash))) {
                // setcookie("users","admin", time()+ 4000,"/Website");
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;

                $_COOKIE["users"] = "admin";
                if (password_verify("admin", hash_cookie($_COOKIE["users"]))) {
                    setcookie("users", "admin", time() + 3600, "/Website");
                    $_SESSION[$_COOKIE["users"]] = "admin";
                    header("Location: home.php");
                }
            } elseif (mysqli_num_rows($result) > 0) {
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $_COOKIE["users"] = "students";

                if (password_verify("students", hash_cookie($_COOKIE["users"]))) {
                    setcookie("users", "students", time() + 3600, "/Website");
                    $_SESSION[$_COOKIE["users"]] = "students";
                    header("Location: home.php");
                }
            } elseif (mysqli_num_rows($result1) > 0) {
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $_COOKIE["users"] = "teachers";
                if (password_verify("teachers", hash_cookie($_COOKIE["users"]))) {
                    setcookie("users", "teachers", time() + 3600, "/Website");
                    $_SESSION[$_COOKIE["users"]] = "teachers";
                    header("Location: home.php");
                }
            } else
                echo '<span style="color:red;">Username or Password is invalid</span>';
        }
    }
    mysqli_close($connect);
} catch (TypeError) {
    echo '<h1>There is an Error</h1>';
}
?>