<?php
session_start();
$role=$_SESSION['role0'];
if(!isset($_SESSION['user_id'])){
  header("Location: login.html");
}
include 'db.php';
$userid = $_SESSION['user_id'];
$getResources = mysqli_query($con, "SELECT * FROM `machine_learning_resources`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VIRTUAL LEARNINGMACHINE PLATFORM</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<!-- <body style="background-image: url('./Images/stock.avif');"> -->
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 fixed-top border-bottom">
    <div class="container">
      <a class="navbar-brand" href="home.php">virtuallearning platform</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="course.php">COURSE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="machine_learning_resources.php">FEEDBACK</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="machine_learning_resources.php">PAYEMENT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="machine_learning_resources.php">MACHINE LEARNING</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php#services">SERVICES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php#contact">CONTACT</a>
          </li>
          <!-- Other menu items -->
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
      <div class="row  mt-5 pt-4">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <h3 class="text-center mb-4">MACHINE LEARNING RESOURCES</h3>
          <div class="card mb-4 bg-white" id="contact-form">
            <div class="card-body">
              <div class="table-responsive">  
                <table class="table table-striped table-hover table-bordered">
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                  <?php
                  while($row = mysqli_fetch_array($getResources)){
                  ?>
                  <tr>
                    <td><?php echo $row["resource_id"]; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><a href="<?php echo $row["url"]; ?>"><?php echo $row["url"]; ?></a></td>
                    <td><?php echo $row["created_at"]; ?></td>
                    <td><?php echo $row["updated_at"]; ?></td>
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </section>

  <footer class="bg-dark text-light">
    <!-- Footer content -->
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
