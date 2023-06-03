<!DOCTYPE html>
<html>

<head>
    <title>HomeWork</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
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
    <h2>List of HomeWork Uploaded</h2>
    <p>
        <a href="uploadFile.php">Add New HomeWork</a>
    </p>
    <table>
        <thead>
            <tr>
                <th>Challenge ID</th>
                <th>File Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directory = "uploads/"; // Specify the directory path where the files are uploaded
            // Get the list of files in the directory
            $files = scandir($directory);

            include("Database/userdb.php");
            // Get the list of files in the directory
            $result = mysqli_query($connect, "SELECT * FROM challenge ORDER BY challengeID ASC");

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo "<tr>";
                    while ($res = mysqli_fetch_assoc($result)) {
                        echo "<td>" . $res['challengeID'] . "</td>";
                        echo "<td>" . $res['challengeName'] . "</td>";
                        echo "</tr>";
                    }
                    // echo "<td><a href='viewSubmission.php' target='_blank'>View submission</a></td>";
                }
            }
            echo "<td><a href='viewSubmission.php' target='_blank'>View submission</a></td>";
            ?>
        </tbody>
    </table>
</body>

</html>