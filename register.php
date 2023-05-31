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

    <form action="register.php" method="post" id="page">

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
        <label>New teacher's name:</label> <br>
        <input type="text" name="teacher_name"> <br>
        </div>

        <div>
            <label>New teacher's email:</label> <br>
            <input type="text" name="teacher_email"> <br>
        </div>

        <div>
            <label>New teacher's class:</label> <br>
            <input type="text" name="teacher_class"> <br>
        </div>

        <div>
            <label>New teacher's ID:</label> <br>
            <input type="text" name="teacher_ID"> <br>
        </div>

        <div>
            <label>New teacher's phonenumber:</label> <br>
            <input type="text" name="phone_num"> <br>
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
include("registerDB.php");
if (isset($_POST["register"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $repassword = filter_input(INPUT_POST, "repassword", FILTER_SANITIZE_SPECIAL_CHARS);
    $teacher_name = filter_input(INPUT_POST, "teacher_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $teacher_email = filter_input(INPUT_POST, "teacher_email", FILTER_SANITIZE_SPECIAL_CHARS);
    $teacher_class= filter_input(INPUT_POST, "teacher_class", FILTER_SANITIZE_SPECIAL_CHARS);
    $teacher_ID = filter_input(INPUT_POST, "teacher_ID", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone_num= filter_input(INPUT_POST, "phone_num", FILTER_SANITIZE_SPECIAL_CHARS);   
    $hash = hash('sha256', $password);

    if (empty($username) || empty($password) || empty($repassword) || empty($teacher_name) || 
    empty($teacher_name) || empty($teacher_email) || empty($teacher_class) ||empty( $teacher_ID)|| 
    empty($phone_num) ) {
        echo '<span style="color:red;">Somthing is empty</span>';
    } elseif ($password == $repassword && $username != "admin") {
        $sql = "INSERT INTO teachers (username, password, teacher_name, teacher_email, 
        teacher_class, teacher_ID, phone_num)  VALUES ('$username', '$hash', '$teacher_name', 
        '$teacher_email', '$teacher_class', '$teacher_ID', '$phone_num')";
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