<?php
session_start(); // Start the session

// Establishing database connection
$connection = new mysqli("localhost", "RURANGWAsamson", "lms", "vml");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT * FROM user WHERE email=?";
    $stmt = $connection->prepare($sql);
    
    if ($stmt) { // Check if the prepare statement succeeded
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the hashed password
            if ($password == $row['password']) {
                $_SESSION['user_id'] = $row['user_id'];

                // Redirect user to home page
                if($row['role'] == 1){
                    $_SESSION['role'] = "Admin";
                    header("Location: home2.php");
                }
                else if($row['role'] == 0){
                    $_SESSION['role0'] = $row['firstname'];
                    header("Location: home.php");
                }
                exit();
            } else {
                // Incorrect password
                echo "<script>alert('Invalid email or password');</script>";
            }
        } else {
            // User not found
            echo "<script>alert('User not found');</script>";
        }
    } 
}

// Close database connection
$connection->close();
?>
