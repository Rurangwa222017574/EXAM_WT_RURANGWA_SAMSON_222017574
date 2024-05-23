<?php
session_start();
$role=$_SESSION['role0'];

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit(); // Stop further execution
}
include 'db.php';
$data=$_SESSION['user_id'];

// Fetch instructor data
$getInstructors = mysqli_query($con, "SELECT * FROM instructor 
INNER JOIN course ON instructor.course_id=course.course_id 
INNER JOIN workshops ON workshops.instructor_id=instructor.instructor_id
INNER JOIN attendance ON attendance.workshop_id=attendance.workshop_id WHERE user_id='$data'");
if (!$getInstructors) {
    die("Error: " . mysqli_error($con)); // Handle query error
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
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 fixed-top border-bottom">
        
            <a class="navbar-brand" href="home.php">virtual learning machineplatform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="course.php">COURSE </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feedback.php">FEEDBACK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payement.php">PAYEMENT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="machinelearning.php">MACHINE LEARNING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php#services">SERVICES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php#contact">CONTACT</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $role; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-key-fill"></i> Change password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-power"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="heros">
        <div class="container">
            <div class="row mt-5 pt-4">
                <div class="col-md-4">
                    <h3 class="text-center mb-4">Instructors</h3>
                    <a href="instructor.php" class="btn btn-primary">View Instructors</a>
                </div>
                

                <div class="col-md-4">
                    <h3 class="text-center mb-4">Certificates</h3>
                    <a href="certificates.php" class="btn btn-primary">View Certificates</a>
                </div>

                <div class="col-md-4">
                    <h3 class="text-center mb-4">Attendance</h3>
                    <a href="attendance.php" class="btn btn-primary">View Attendance</a>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col"></div>
        <div class="col">
        
    <h2 class="text-center mb-4">Attendance</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Course</th>
                        <th>Instructor</th>
                        <th>Workshop</th>
                        <th>Location</th>
                        <th>registration time</th>
                        <th>status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $a=1;
                    while ($row = mysqli_fetch_assoc($getInstructors)) { ?>
                        <tr>
                            <td><?php echo $a++; ?></td>
                            <td><?php echo $row["course_name"]." ".$row["instructor_Lname"]; ?></td>
                            <td><?php echo $row["instructor_Fname"]." ".$row["instructor_Lname"]; ?></td>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo $row["location"]; ?></td>
                            <td><?php echo $row["registration_time"]; ?></td>
                            <td><?php echo $row["status"]; ?></td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
        <div class="col"></div>
    </div>
    <section id="courseSubmission">
        <div class="container">
            <div class="row mt-5 pt-4">
                <div class="col-md-3"></div>
                <div class="col-md-6 mb-5">
   
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-light">
        <div class="container">
            <div class="row pt-4">
                <div class="col-md-4">
                    <h5 class="mb-3">About</h5>
                    <div id="detail" class="mb-3">
                        virtual learning machine platform could be interpreted in a few different ways, but it likely refers to a software or online service designed to facilitate virtual learning through the use of machine learning algorithms or technologie
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Useful links</h5>
                    <div id="detail" class="mb-3 ps-3">
                        <a href="course.php" class="d-block">&rarr; course</a>
                        <a href="certificate.php" class="d-block">&rarr; certificate</a>
                        <a href="feedback.php" class="d-block">&rarr; feedback</a>
                        <a href="machinelearning.php" class="d-block">&rarr; machinelearning</a>
                        <a href="payment.php" class="d-block">&rarr; payment</a>
                        <a href="#services" class="d-block">&rarr; Services</a>
                        <a href="#contact" class="d-block">&rarr; Contact</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Reach to us</h5>
                    <div id="detail" class="mb-3">
                        <h6><a href="tel:0780000000"><i class="bi bi-telephone"></i> 0780000000</h6>
                        <h6><a href="whatsapp:0780000000"><i class="bi bi-whatsapp"></i> 0780000000</h6>
                        <h6><a href="mailto:virtuallearning@gmail.com"><i class="bi bi-envelope-open"></i> l@gmail.com</a></h6>
                        <br>
                        <h5>Kigali Rwanda</h5>
                        <h5>KK 509 ST</h5>
                    </div>
                </div>
            </div>
            <div class="text-center pb-4">Designed and implemented by Samson RURANGWA&reg;, @UR CBE BIT, 2024. &copy; All rights reserved.</div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

</body>
</html>
