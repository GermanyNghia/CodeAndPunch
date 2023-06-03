<!DOCTYPE html>
<html>

<head>
    <title>View Uploaded Files</title>
</head>

<body>
    <h1>View Uploaded Files</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="id">Student ID:</label>
        <input type="text" name="id" required><br>

        <button type="submit" name="upload">Upload file</button>
    </form>
    <?php
    // Database connection
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "users";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Student ID
        $studentId = $_POST['id']; // Replace with the actual student ID

        // Fetch uploaded files for the student from the database
        $sql = "SELECT * FROM file WHERE id = $studentId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h1>Uploaded Files</h1>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Challenge</th><th>File Name</th></tr>";

            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $challenge = $row['challenge'];
                $fileName = $row['fileUpload'];

                echo "<tr>";
                echo "<td>$id</td>";
                echo " <td>$challenge</td>";
                echo "<td>$fileName</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No uploaded files found for the student.";
        }

        $conn->close();
    }
    ?>
</body>

</html>