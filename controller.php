<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <h2 class="card-title text-center">Add New Student <a href="stylesheet.css"></a></h2>
          <link rel="stylesheet" href="stylesheet.css">
          <div class="card-body py-md-4">
            <form action="controller.php" method="POST">
              <div class="form-group">
                <input type="number" class="form-control" name="id" placeholder="id">
              </div>


              <div class="form-group">
                <input type="text" class="form-control" name="ten" placeholder="ten">
              </div>




              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="so_dien_thoai" placeholder="Phone Number">
              </div>
              <div class="d-flex flex-row align-items-center justify-content-between">
                <input type="submit" name="addStudent" value="Add Student">
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
  echo "Thêm sinh viên thành công!";
  $id = $_POST["id"];
  $ten = $_POST["ten"];
  $email = $_POST["email"];
  $so_dien_thoai = $_POST["id"];
}


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
  $stmt = $pdo->prepare("INSERT INTO student (id, ten, email, so_dien_thoai) VALUES (?, ?, ?, ?)");
  $stmt->execute([$id, $ten, $email, $so_dien_thoai]);
  echo "Thêm sinh viên thành công!";
} catch (PDOException $e) {
  echo "Lỗi khi thêm sinh viên: " . $e->getMessage();
}
?>