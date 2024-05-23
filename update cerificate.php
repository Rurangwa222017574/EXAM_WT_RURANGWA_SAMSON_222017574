<?php
include('db.php');

// Check if certificate_id is set
if (isset($_REQUEST['certificate_id'])) {
    $certificate_id = $_REQUEST['certificate_id'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM certificate WHERE certificate_id=?");
    $stmt->bind_param("i", $certificate_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['certificate_id'];
        $y = $row['attendee_id'];
        $z = $row['workshop_id'];
        $w = $row['certificate_url'];
        $v = $row['issued_date'];
        $u = $row['expiration_date'];
    } else {
        echo "Certificate record not found.";
    }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Certificate</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update certificate form -->
    <h2><u>Update Form of Certificate</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="attendee_id">Attendee ID:</label>
        <input type="text" name="attendee_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="text" name="workshop_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="certificate_url">Certificate URL:</label>
        <input type="text" name="certificate_url" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="issued_date">Issued Date:</label>
        <input type="text" name="issued_date" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <label for="expiration_date">Expiration Date:</label>
        <input type="text" name="expiration_date" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">

    </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $attendee_id = $_POST['attendee_id'];
    $workshop_id = $_POST['workshop_id'];
    $certificate_url = $_POST['certificate_url'];
    $issued_date = $_POST['issued_date'];
    $expiration_date = $_POST['expiration_date'];

    // Update the certificate record in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE certificate SET attendee_id=?, workshop_id=?, certificate_url=?, issued_date=?, expiration_date=? WHERE certificate_id=?");
    $stmt->bind_param("iisssi", $attendee_id, $workshop_id, $certificate_url, $issued_date, $expiration_date, $certificate_id);
    $stmt->execute();

    // Redirect to certificate.php or wherever you want to redirect
    header('Location: certificate.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
