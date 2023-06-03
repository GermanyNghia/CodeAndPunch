<!DOCTYPE html>
<html>
<head>
    <title>View Submission</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>List of Submission</h2>
    <table>
        <thead>
            <tr>
                <th>StudentID</th>
                <th>Challenge</th>
                <th>File Name</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            $directory = "uploadByStudent/"; // Specify the directory path where the files are uploaded
            include("connect.php");
            // Get the list of files in the directory
            $files = scandir($directory);
            $result = mysqli_query($connect, "SELECT * FROM file");
            while($res = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$res['id']."</td>";
                echo "<td>".$res['Challenge']."</td>";
            }
            foreach ($files as $file ) {
                if ($file !== '.' && $file !== '..') {
                    // echo "<tr>";
                    // echo "<td>".$res['id']."</td>";
                    // echo "<td>".$res['Challenge']."</td>";
                    echo "<td>$file</td>";
                    echo "<td><a href='$directory$file' target='_blank'>Download</a></td>";
                    echo "</tr>";
                }
        }
            ?>
        </tbody>
    </table>
</body>
</html>