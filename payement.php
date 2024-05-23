<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit(); // Stop further execution
}
include 'db.php';
$userid = $_SESSION['user_id'];

// Fetch payments
$getPayments = mysqli_query($con, "SELECT * FROM `payement`");

// Insert, update, delete operations will be added here

// Handle insert operation
if(isset($_POST['submit'])) {
    // Retrieve form data
    $payment_id = $_POST['payment_id'];
    $user_id = $_POST['user_id'];
    $workshop_id = $_POST['workshop_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    $transaction_id = $_POST['transaction_id'];
    $status = $_POST['status'];
    
    // Insert into database
    $insertQuery = "INSERT INTO `payement` (payment_id, user_id, workshop_id, amount, payment_date, payment_method, transaction_id, status, created_at, updated_at) 
                    VALUES ('$payment_id', '$user_id', '$workshop_id', '$amount', '$payment_date', '$payment_method', '$transaction_id', '$status', NOW(), NOW())";
    
    if(mysqli_query($con, $insertQuery)) {
        // Success message or redirect
        header("Location: payement.php");
        exit(); // Stop further execution
    } else {
        // Error message
        echo "Error: " . mysqli_error($con);
    }
}

// Handle delete operation
if(isset($_GET['delete'])) {
    $payment_id = $_GET['delete'];
    $deleteQuery = "DELETE FROM `payement` WHERE payment_id='$payment_id'";
    if(mysqli_query($con, $deleteQuery)) {
        // Success message or redirect
        header("Location: payement.php");
        exit(); // Stop further execution
    } else {
        // Error message
        echo "Error: " . mysqli_error($con);
    }
}

// Handle update operation
// Similar process as insert, just with UPDATE query
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
    <title>VIRTUAL LEARNINGMACHINE PLATFORM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 fixed-top border-bottom">
        <!-- Navbar content -->
    </nav>

    <section id="heros">
        <div class="container">
            <div class="row mt-5 pt-4">
                <!-- Form for inserting new payment -->
                <div class="col-md-4">
                    <h3 class="text-center mb-4">Add New Payment</h3>
                    <form method="post">
                        <!-- Add input fields for payment information -->
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <!-- Table for displaying existing payments -->
                <div class="col-md-8">
                    <h3 class="text-center mb-4">Payements</h3>
                    <div class="card mb-4 bg-white" id="contact-form">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Workshop ID</th>
                                        <th>Amount</th>
                                        <th>Payment Date</th>
                                        <th>Payment Method</th>
                                        <th>Transaction ID</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php while ($rows = mysqli_fetch_array($getPayements)) { ?>
                                        <tr>
                                            <td><?php echo $rows["payment_id"]; ?></td>
                                            <td><?php echo $rows["user_id"]; ?></td>
                                            <td><?php echo $rows["workshop_id"]; ?></td>
                                            <td><?php echo $rows["amount"]; ?></td>
                                            <td><?php echo $rows["payment_date"]; ?></td>
                                            <td><?php echo $rows["payment_method"]; ?></td>
                                            <td><?php echo $rows["transaction_id"]; ?></td>
                                            <td><?php echo $rows["status"]; ?></td>
                                            <td>
                                                <a href="?delete=<?php echo $rows['payment_id']; ?>" class="btn btn-danger">Delete</a>
                                                <!-- Add edit button for update operation -->
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light">
        <!-- Footer content -->
    </footer>

    <!-- JavaScript includes -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

