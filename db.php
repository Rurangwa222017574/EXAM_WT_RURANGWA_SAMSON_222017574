<?php
    // Establishing database connection
    $con = mysqli_connect("localhost", "RURANGWAsamson", "lms", "vml");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>