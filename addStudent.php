<?php
session_start();
include("authentication.php");
include("student_restrict.php");
function check_mail($email)
{

  if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/", $email)) {
    return true;
  } else {
    return false;
  }
}
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
  <button>
    <a href="home.php">Home</a>
  </button>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <h2 class="card-title text-center">Add New Student <a href="stylesheet.css"></a></h2>
          <link rel="stylesheet" href="stylesheet.css">
          <div class="card-body py-md-4">
            <form action="addStudent.php" method="POST">

              <div class="form-group">
                <input type="text" class="form-control" name="username" id="username" placeholder="username">
              </div>

              <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="password">
              </div>

              <div class="form-group">
                <input type="password" class="form-control" name="repassword" id="repassword" placeholder="repassword">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="student_name" id="student_name" placeholder="student_name">
              </div>

              <div class="form-group">
                <input type="email" class="form-control" name="student_email" id="student_email" placeholder="student_email">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="student_class" id="student_class" placeholder="student_class">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="student_ID" id="student_ID" placeholder="student_ID">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="phone_num" id="phone_num" placeholder="Phone Number">
              </div>
              <div class="d-flex flex-row align-items-center justify-content-between">
                <input type="submit" class="btn btn-primary" name="addStudent" value="Add Student">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php
// Thông tin kết nối đến cơ sở dữ liệu
$host = 'localhost';
$db   = 'users';
$user = 'root';
$pass = '';
// Lấy dữ liệu từ biểu mẫu

if (isset($_POST["addStudent"])) {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  $repassword = filter_input(INPUT_POST, "repassword", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_name = filter_input(INPUT_POST, "student_name", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_email   = filter_input(INPUT_POST, "student_email", FILTER_SANITIZE_SPECIAL_CHARS);

  $student_class   = filter_input(INPUT_POST, "student_class", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_ID = filter_input(INPUT_POST, "student_ID", FILTER_SANITIZE_SPECIAL_CHARS);
  $phone_num = filter_input(INPUT_POST, "phone_num", FILTER_SANITIZE_SPECIAL_CHARS);
  $hash1 = hash('sha256', $password);
  $hash2 = hash('sha256', $repassword);


  // Thực hiện kết nối đến cơ sở dữ liệu
  try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
  } catch (PDOException $e) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $e->getMessage());
  }

  // Thực hiện truy vấn để thêm sinh viên vào cơ sở dữ liệu
  try {

    if (empty($username) || empty($password) || empty($repassword) || empty($teacher_name) || 
    empty($teacher_name) || empty($teacher_email) || empty($teacher_class) ||empty( $teacher_ID)|| 
    empty($phone_num) ) {
      echo '<span style="color:red;">Somthing is empty</span>';
    }
    elseif (check_mail($student_email)) {
      echo "Invalid email address";
    } else {
      if ($hash1 == $hash2) {
        $stmt = $pdo->prepare("INSERT INTO students (username, password, student_name, student_email, 
      student_class, student_ID ,phone_num) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
          $username, $hash1, $student_name, $student_email, $student_class, $student_ID,
          $phone_num
        ]);
        echo "Thêm sinh viên thành công!" . "<br>";
        echo "<button> <a href=studentList.php>BACK</a>";
      } else {
        echo ("Mật khẩu không trùng khớp");
      }
    }
      
    
  } catch (PDOException $e) {
    if ($e->getCode() == '23000') {
      echo "Dữ liệu bị trùng";
    } else {
      echo "Lỗi khi thêm sinh viên: " . $e->getMessage();
    }
  } catch (Exception $e) {
    $e->getMessage();
  }
}
?>