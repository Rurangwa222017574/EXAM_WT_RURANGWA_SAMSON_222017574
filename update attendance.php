<?php
include('db.php');

// Check if attendee_id is set
if (isset($_REQUEST['attendee_id'])) {
    $attendee_id = $_REQUEST['attendee_id'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM attendance WHERE attendee_id=?");
    $stmt->bind_param("i", $attendee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['attendee_id'];
        $y = $row['user_id'];
        $z = $row['workshop_id'];
        $w = $row['registration_time'];
        $v = $row['status'];
    } else {
        echo "Attendance record not found.";
    }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Attendance</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update attendance form -->
    <h2><u>Update Form of Attendance</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="text" name="workshop_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="registration_time">Registration Time:</label>
        <input type="text" name="registration_time" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">

    </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    $workshop_id = $_POST['workshop_id'];
    $registration_time = $_POST['registration_time'];
    $status = $_POST['status'];

    // Update the attendance record in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE attendance SET user_id=?, workshop_id=?, registration_time=?, status=? WHERE attendee_id=?");
    $stmt->bind_param("iisssi", $user_id, $workshop_id, $registration_time, $status, $attendee_id);
    $stmt->execute();

    // Redirect to attendance.php or wherever you want to redirect
    header('Location: attendance.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
