<!DOCTYPE html>
<html>
<body>
<p>
	    <a href="viewfile.php">Home</a>
</p>

<form action="uploadFile.php" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php
// Check if image file is a actual image or fake image
   
    if (isset($_POST['submit'])) {
      
        $uploadDirectory = "uploads/";

        $errors = []; // Store errors here
    
        $fileExtensionsAllowed = ['jpeg','jpg','png','docx','txt']; // These will be the only file extensions allowed 
    
        $fileName = $_FILES['fileToUpload']['name'];
        $fileSize = $_FILES['fileToUpload']['size'];
        $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
        $fileType = $_FILES['fileToUpload']['type'];
    
        $uploadPath = $uploadDirectory . basename($fileName);
    
        $fileExtension = strtolower(pathinfo($uploadPath,PATHINFO_EXTENSION));

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed.";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
          echo "The file " . basename($fileName) . " has been uploaded";
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
?>
