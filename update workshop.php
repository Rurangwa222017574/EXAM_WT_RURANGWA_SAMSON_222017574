<?php
session_start();
$role = $_SESSION['role'];
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include 'db.php';

// Check if workshop_id is set
if (isset($_REQUEST['id'])) {
    $workshop_id = $_REQUEST['id'];

    // Prepare statement with parameterized query to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM workshop WHERE workshop_id = ?");
    $stmt->bind_param("i", $workshop_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Workshop record not found.";
        exit();
    }

    $stmt->close(); // Close the statement after use
} else {
    echo "No workshop ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VIRTUAL LEARNING MACHINE PLATFORM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 fixed-top border-bottom">
        <div class="container">
            <a class="navbar-brand" href="home2.php">virtual learning machine platform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <!-- Navbar items -->
                </ul>
            </div>
        </div>
    </nav>

    <section id="heros">
        <div class="container">
            <div class="row mt-5 pt-4">
                <div class="col-3"></div>
                <div class="col-6">
                    <h2>Update Form of Workshop</h2>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description:</label>
                            <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($row['description']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="col-form-label">Start Time:</label>
                            <input type="datetime-local" class="form-control" name="start_time" value="<?php echo htmlspecialchars($row['start_time']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="end_time" class="col-form-label">End Time:</label>
                            <input type="datetime-local" class="form-control" name="end_time" value="<?php echo htmlspecialchars($row['end_time']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="col-form-label">Location:</label>
                            <input type="text" class="form-control" name="location" value="<?php echo htmlspecialchars($row['location']); ?>">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="update" value="Update">
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>

<?php
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];

    // Update the workshop record in the database
    $stmt = $con->prepare("UPDATE workshop SET title = ?, description = ?, start_time = ?, end_time = ?, location = ? WHERE workshop_id = ?");
    $stmt->bind_param("sssssi", $title, $description, $start_time, $end_time, $location, $workshop_id);
    $stmt->execute();

    // Redirect after update
    echo "<script>window.location.replace('workshop2.php');</script>";
}

// Close the connection
mysqli_close($con);
?>
<footer class="bg-dark text-light">
    <div class="container">
        <div class="row pt-4">
            <!-- Footer content -->
        </div>
        <div class="text-center pb-4">Designed and implemented by Samson RURANGWA&reg;, @UR CBE BIT, 2024. &copy; All rights reserved.</div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
