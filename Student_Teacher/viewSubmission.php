<!DOCTYPE html>
<html>

<head>
    <title>View Submission</title>
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
    <h2>List of Submission</h2>
    <button><a href="../home.php"> Home</a></button>
    <button onclick="history.back()">Back</button>
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
            $directory = "../Student/uploadByStudent/"; // Specify the directory path where the files are uploaded
            include("../Database/registerDB.php");
            // Get the list of files in the directory
            $files = scandir($directory);
            $result = mysqli_query($connect, "SELECT * FROM file ORDER BY challenge ASC");
            // while($res = mysqli_fetch_assoc($result)){
            //     echo "<tr>";
            //     echo "<td>".$res['id']."</td>";
            //     echo "<td>".$res['Challenge']."</td>";
            // }
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo "<tr>";
                    while ($res = mysqli_fetch_assoc($result)) {
                        echo "<td>" . $res['studentID'] . "</td>";
                        echo "<td>" . $res['challenge'] . "</td>";
                        echo "<td>"  . $res['fileName'] . "</td>";
                        echo "<td><a href='$directory$res[fileName]' target='_blank' download>Download</a></td>";
                        echo "<tr>";
                    }
                    // echo "<td><a href='$directory$file' target='_blank'>Download</a></td>";
                    // echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>