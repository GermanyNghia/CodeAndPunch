<?php
session_start();
include("authentication.php");
include("teacher_restrict.php");
// Retrieve the selected teacher's information from the database
include("registerDB.php");
if (isset($_GET['id'])) {
    $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    $query = "SELECT * FROM teachers WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
}

// Display the form to edit the teacher's information
if (isset($teacher)) {
?><header>
    <link rel="stylesheet" href="default.css">
</header>
<h1>Edit Teacher </h1>
    <form method="POST" action="editteacher.php?id=<?php echo $id; ?>">
    <label>Teacher's name:</label> <br>
        <input type="text" name="teacher_name" value="<?php echo $teacher['teacher_name']; ?>">
        <br>
        <label>Teacher's email:</label> <br>
        <input type="text" name="teacher_email" value="<?php echo $teacher['teacher_email']; ?>">
        <br>
        <label>Teacher's class:</label> <br>
		<input type="text" name="teacher_class" value="<?php echo $teacher['teacher_class']; ?>">
		<br>
        <label>Teacher's ID:</label> <br>
        <input type="text" name="teacher_ID" value="<?php echo $teacher['teacher_ID']; ?>">
        <br>
        <label>Teacher's phone number:</label> <br>
        <input type="text" name="phone_num" value="<?php echo $teacher['phone_num']; ?>">
        <br>
        <input type="submit" name="submit" value="Update">
    </form>
<?php
}

// Handle form submission to update the teacher's information
if (isset($_POST['submit'])) {
    $name = $_POST['teacher_name'];
    $email = $_POST['teacher_email'];
	$class = $_POST['teacher_class'];
	$ID = $_POST['teacher_ID'];
    $phone = $_POST['phone_num'];
    $query = "UPDATE teachers SET teacher_name='$name', teacher_email='$email', teacher_class='$class', 
	teacher_ID='$ID' ,phone_num='$phone' WHERE id = $id";
    mysqli_query($connect, $query);
    header("Location: viewTeacher.php");
    exit();
}
?>