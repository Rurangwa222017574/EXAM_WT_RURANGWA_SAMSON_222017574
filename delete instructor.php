<?php
include('db.php');

// Check if instructor_id is set
if(isset($_REQUEST['id'])) {
    $instructor_id = $_REQUEST['id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $con->prepare("DELETE FROM instructor WHERE instructor_id=?");
    $stmt->bind_param("i", $instructor_id);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="instructor_id" value="<?php echo $instructor_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
               
                header("Location:instructor2.php");
            } else {
                echo "Error deleting data: " . $stmt->error;
            }
        }
        ?>
    </body>
    </html>
    <?php

    $stmt->close();
} else {
    echo "Instructor ID is not set.";
}

$con->close();
?>
