

<!DOCTYPE html>
<html>
<head>
    <title>HomeWork</title>
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
    <h2>List of HomeWork</h2>
    <p>
		<a href="uploadFile.php">Add New HomeWork</a>
	</p>
    <table>
        <thead>
            <tr>
                <th>File Name</th>
                <th>Download</th>
                <th>Add Submission</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directory = "uploads/"; // Specify the directory path where the files are uploaded

            // Get the list of files in the directory
            $files = scandir($directory);

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo "<tr>";
                    echo "<td>$file</td>";
                    echo "<td><a href='$directory$file' target='_blank'>Download</a></td>";
                    echo "<td><a href='uploadFile.php' target='_blank'>Add submission</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>