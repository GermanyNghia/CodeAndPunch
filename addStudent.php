<?php
session_start();

include("authentication.php");
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
                <input type="text" class="form-control" name="student_name" id="student_name" 
                placeholder="student_name">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="student_email" id="student_email" 
                placeholder="student_email">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="student_class" id="student_class" 
                placeholder="student_class">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="student_ID" id="student_ID" 
                placeholder="student_ID">
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="phone_num" id="phone_num"
                placeholder="Phone Number">
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
  $student_name	 = $_POST["student_name"];
  $student_email	 = $_POST["student_email"];
  $student_class	 = $_POST["student_class"];
  $student_ID = $_POST["student_ID"];
  $phone_num = $_POST["phone_num"];


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
  $stmt = $pdo->prepare("INSERT INTO students ( student_name, student_email, 
  student_class, student_ID ,phone_num) VALUES ( ?, ?, ?, ?, ?)");
  $stmt->execute([$student_name, $student_email, $student_class , $student_ID , $phone_num]);
  echo "Thêm sinh viên thành công!";
} catch (PDOException $e) {
  if ($e->getCode() == '23000') {
    echo "Dữ liệu bị trùng";
} else {
  echo "Lỗi khi thêm sinh viên: " . $e->getMessage();
}

}
}
?>
