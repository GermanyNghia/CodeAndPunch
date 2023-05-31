<?php
session_start();
include("authentication.php");
// Retrieve the selected student's information from the database
include("registerDB.php");
if (isset($_GET['id'])) {
    $id= $_GET['id'];
    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $student = mysqli_fetch_assoc($result);
}

// Display the form to edit the student's information
if (isset($student)) {
?>
    <form method="POST" action="editstudent.php?id=<?php echo $id; ?>">
        <input type="text" name="student_name" value="<?php echo $student['student_name']; ?>">
        <input type="text" name="student_email" value="<?php echo $student['student_email']; ?>">
		<input type="text" name="student_class" value="<?php echo $student['student_class']; ?>">
		<input type="text" name="student_ID" value="<?php echo $student['student_ID']; ?>">
        <input type="text" name="phone_num" value="<?php echo $student['phone_num']; ?>">
        <input type="submit" name="submit" value="Update">
    </form>
<?php
}

// Handle form submission to update the student's information
if (isset($_POST['submit'])) {
    $name = $_POST['student_name'];
    $email = $_POST['student_email'];
	$class = $_POST['student_class'];
	$ID = $_POST['student_ID'];
    $phone = $_POST['phone_num'];
    $query = "UPDATE students SET student_name='$name', student_email='$email', student_class='$class', 
	student_ID='$ID' ,phone_num='$phone' WHERE id = $id";
    mysqli_query($connect, $query);
    header("Location: viewStudent.php");
    exit();
}
?>