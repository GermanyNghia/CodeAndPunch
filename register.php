<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <h1>Đăng Ký</h1>

    <form action="register.php" method="post" id = "page">
        <div>
            <label>New username:</label> <br>
            <input type="text" name="username"> <br>
        </div>


        <div>
            <label>New password:</label> <br>
            <input type="password" name="password"> <br>
            <label>Re entering password:</label> <br>
            <input type="password" name="repassword"> <br>
        </div>

        <div>
            <label>Email:</label> <br>
            <input type="email" name="email" placeholder="example@gmail.com"> <br>
        </div>

        <div>
            <label>DoB:</label> <br>
            <input type="date" name="DoB"> <br>
        </div>

        <div>
            <label>Gender: </label>
            <input type="radio" name="gender" value="Male">
            Male
            <input type="radio" name="gender" value="Female">
            Female
            <input type="radio" name="gender" value="Other">
            Other
            <br>
        </div>

        <div>
            <input type="submit" name="register" value="Register">
        </div>

    </form>
</body>

</html>
<?php
include("logindb.php");
if ($connect) {
    echo "ok";
}
if (isset($_POST["register"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $repassword = filter_input(INPUT_POST, "repassword", FILTER_SANITIZE_SPECIAL_CHARS);
    $hash = hash('sha256', $password);

    if (empty($username) || empty($password) || empty($repassword)) {
        echo '<span style="color:red;">Username or password is empty</span>';
    } elseif ($password == $repassword && $username != "admin") {
        $sql = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";
        try {
            mysqli_query($connect, $sql);
            echo "Registed";
            header("Location: login.php");
        } catch (mysqli_sql_exception) {
            echo "Could not register";
        }
    } else {

        echo '<span style="color:red;">Username cannot be admin and password must be the same</span>';
    }
}
mysqli_close($connect);
?>