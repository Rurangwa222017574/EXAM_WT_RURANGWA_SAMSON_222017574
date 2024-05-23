<?php
session_start();
$role=$_SESSION['role'];
  if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
  }
  include 'db.php';
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
            <a class="navbar-brand" href="home2.php">virtual learning machineplatform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home2.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="course2.php">COURSE </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feedback2.php">FEEDBACK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payement2.php">PAYEMENT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="machine learning resources2.php">MACHINE LEARNING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home2.php#services">SERVICES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home2.php#contact">CONTACT</a>
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
                

               
                
            </div>
        </div>
    </section>
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Add workshop</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New workshop</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="instructor2.php">
          <div class="mb-3">
            <label for="First-name" class="col-form-label">FirstName:</label>
            <input type="text" class="form-control" name="First-name">
          </div>
          <div class="mb-3">
            <label for="Last-name" class="col-form-label">LastName:</label>
            <input type="text" class="form-control" name="Last-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Course:</label>
            <select class="form-control" id="message-text" name="Course-name">
                <option  class="value">Choose Course</option>
                <?php
                $getCourses = mysqli_query($con, "SELECT * FROM course ");
                while ($courses= mysqli_fetch_assoc($getCourses)) { ?>
                <option  value="<?php echo $courses['course_id'];?>"><?php echo $courses['course_name'];?></option>
                <?php
                }
                ?>
            </select>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="insert" value="Add">
      </div>
    </form>
    </div>
  </div>
</div>
    <section id="courseSubmission">
        <div class="container">
            <div class="row mt-5 pt-4">
                <div class="col-4"></div>
                <div class="col-5 mb-5 ">
                    
    
        
        <!-- PHP Code to Insert Data -->
        <?php
        include('db.php');

        // Check if the form is submitted for insert
        if ( isset($_POST['insert'])) {
            $Fname=$_POST['First-name'];
            $Lname=$_POST['Last-name'];
            $Cname=$_POST['Course-name'];
            // Insert section
            $stmt = mysqli_query($con,"INSERT INTO instructor VALUES ('','$Fname','$Lname','$Cname')");
            if($stmt){
                ?>
                  <script>
        window.location.replace("instructor2.php");
                </script>
            <?php
            }
            else{
                echo mysqli_error($con);
            }
        }
        ?>

        <!-- Displaying Table of Instructors -->
        <center><h2>Table of workshops</h2></center>
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th>No</th>
                <th>WORKSHOP Name</th>
                <th>Description/th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
             include('db.php');

            // SQL query to fetch data from the instructors table
            $sql = "SELECT * FROM workshops";
            $result = mysqli_query($con,$sql);
            $no=1;

            if (mysqli_num_rows($result)> 0) {
                while ($row =mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row["title"]; ?></td>
                        <td><?php echo $row["description"]; ?></td>
                        <td><?php echo $row["start_time"]; ?></td>
                        <td><?php echo $row["end_time"]; ?></td>
                        <td><?php echo $row["location"]; ?></td>
                        <td><a href="update workshop.php?id=<?php echo $row["instructor_id"]; ?>" class="btn btn-primary ">Update</a></td>
                        <td><a href="delete workshop.php?id=<?php echo $row["instructor_id"]; ?>" class="btn btn-danger ">Delete</a></td>
                        
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            // Close connection
            $con->close();
            ?>
        </table>
        </div>

    </section>

                            
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
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

    
