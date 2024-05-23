<?php
include('db.php');

// Check if feedback_id is set
if (isset($_REQUEST['feedback_id'])) {
    $feedback_id = $_REQUEST['feedback_id'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE feedback_id=?");
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['feedback_id'];
        $y = $row['workshop_id'];
        $z = $row['attendee_id'];
        $w = $row['rating'];
        $v = $row['comment'];
        $u = $row['created_at'];
        $t = $row['updated_at'];
    } else {
        echo "Feedback record not found.";
    }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Feedback</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update feedback form -->
    <h2><u>Update Form of Feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="workshop_id">Workshop ID:</label>
        <input type="text" name="workshop_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="attendee_id">Attendee ID:</label>
        <input type="text" name="attendee_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="rating">Rating:</label>
        <input type="text" name="rating" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="comment">Comment:</label>
        <input type="text" name="comment" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <label for="created_at">Created At:</label>
        <input type="text" name="created_at" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="updated_at">Updated At:</label>
        <input type="text" name="updated_at" value="<?php echo isset($t) ? $t : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">

    </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $workshop_id = $_POST['workshop_id'];
    $attendee_id = $_POST['attendee_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $created_at = $_POST['created_at'];
    $updated_at = $_POST['updated_at'];

    // Update the feedback record in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE feedback SET workshop_id=?, attendee_id=?, rating=?, comment=?, created_at=?, updated_at=? WHERE feedback_id=?");
    $stmt->bind_param("iiissii", $workshop_id, $attendee_id, $rating, $comment, $created_at, $updated_at, $feedback_id);
    $stmt->execute();

    // Redirect to feedback.php or wherever you want to redirect
    header('Location: feedback.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
