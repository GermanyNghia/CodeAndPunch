<!DOCTYPE html>
<html>

<head>
  <title>Upload File for Teacher's Challenge</title>
</head>

<body>
  <h2>Upload File for Teacher's Challenge</h2>
  <p>
    <a href="viewChallenge.php">Home</a>
  </p>

  <?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a form field named 'student_id' to capture the student ID
    $studentId = $_POST['id'];
    $challenge = $_POST['challenge'];

    // Process the uploaded file
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    if (isset($_POST['upload'])) {

      //UPLOAD FILE
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png', 'gif', 'docx', 'txt');
      if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
          if ($fileSize < 1000000) {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'uploadByStudent/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            //SAVE FILE NAME TO DATABASE
            $conn = mysqli_connect("127.0.0.1", "root", "", "users");
            $sql = "INSERT INTO file (id,challenge,fileUpload) VALUES ('$studentId','$challenge','$fileNameNew')";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            echo "File uploaded successfully for $studentId";
          } else {
            echo "File is too large.";
          }
        } else {
          echo "There was an error uploading your file.";
        }
      } else {
        echo "You cannot upload files of this type.";
      }
    }
  }
  ?>

  <form method="POST" enctype="multipart/form-data">
    <label for="id">Student ID:</label>
    <input type="text" name="id" required><br>

    <label for="challenge">Challenge:</label>
    <input type="int" name="challenge" required><br>

    <label for="file">Select File:</label>
    <input type="file" name="file" required><br>

    <button type="submit" name="upload">Upload file</button>
  </form>
</body>

</html>