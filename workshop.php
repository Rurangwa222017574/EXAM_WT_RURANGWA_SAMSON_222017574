<?php include('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshop Form</title>
</head>
<style type="text/css">
    
</style>
<body>
<header style="font: Arial Rounded MT Bold; font-size: 22;">
    <div style="display: flex; align-items: center;">

    <div>  <img src="./image/logo.jpeg" width="100" height="35" alt="Logo">
    </div>

    <div style="display: flex; flex: 1;">
      <div>  
        <a href="home.php">Home</a>
        <a href="about.html">About</a>
        <a href="code."></a>
        <a href="table.html">Table</a>
        <a href="form.html">Form</a>
        <a href="formtable.html">Form2</a>
        <a href="audio.html">Audio</a>
        <a href="video.html">Video</a>
        <a href="images.html">Image</a>
      </div>

      <div style="flex: 1; text-align: right;">
        <a href="contact.html">Contact</a>
        <a href="login.html">Login</a>
      </div>
    </div>

  </div>
</header>
<hr>
<main style="color:grey;">
    <center>
        <section>
            <form action="#" method="POST">
                <h1>Workshop Information</h1>
                <p>
                    <label for="workshop_id">Workshop ID</label> 
                    <input type="text" name="workshop_id" id="workshop_id" placeholder="Workshop ID">
                </p>
                <p>
                    <label for="instructor_id">Instructor ID</label> 
                    <input type="text" name="instructor_id" id="instructor_id" placeholder="Instructor ID">
                </p>
                <p>
                    <label for="title">Workshop Title</label> 
                    <input type="text" name="title" id="title" placeholder="Workshop Title">
                </p>
                <p>
                    <label for="description">Description</label> 
                    <textarea name="description" id="description" placeholder="Description"></textarea>
                </p>
                <p>
                    <label for="start_time">Start Time</label> 
                    <input type="text" name="start_time" id="start_time" placeholder="Start Time">
                </p>
                <p>
                    <label for="end_time">End Time</label> 
                    <input type="text" name="end_time" id="end_time" placeholder="End Time">
                </p>
                <p>
                    <label for="location">Location</label> 
                    <input type="text" name="location" id="location" placeholder="Location">
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="reset" value="Reset">
                </p>
            </form>
        </section>
    </center>
</main>
<hr>
<footer>
    <center> UR CBE B BIT &copy, 2024 &reg</center>
</footer>
</body>
</html>
