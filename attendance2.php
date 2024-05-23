<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance Form</title>
    <style>
        /* Your CSS styles here */
        body {
            background-color:grey;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        header{
    background-color:darkgray;
    padding:20px;
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    background-color: deepskyblue;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:grey;
  }  
    </style>
</head>
<header>
<header>
  <body>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">HOME</a></li>
</header>
<body>
    <section>
        <h1>Attendance Form</h1>
        <form method="post" action="attendance.php">
            <label for="attendee_id">Attendee ID:</label>
            <input type="number" id="attendee_id" name="attendee_id" required><br><br>
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" required><br><br>
            <label for="workshop_id">Workshop ID:</label>
            <input type="number" id="workshop_id" name="workshop_id" required><br><br>
            <input type="submit" name="insert" value="Insert"><br><br>
        </form>

        <!-- PHP Code to Insert Data -->
        <?php
        include('db.php');

        // Check if the form is submitted for insert
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
            // Insert section
            $stmt = $connection->prepare("INSERT INTO attendance (attendee_id, user_id, workshop_id, registration_time, status, created_at, updated_at) VALUES (?, ?, ?, NOW(), 'Active', NOW(), NOW())");
            $stmt->bind_param("iii", $attid, $uid, $wid);

            // Set parameters from POST and execute
            $attid = $_POST['attendee_id'];
            $uid = $_POST['user_id'];
            $wid = $_POST['workshop_id'];

            if ($stmt->execute()) {
                echo "New record has been added successfully.<br><br>";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }

            $stmt->close();
        }
        ?>

        <!-- Displaying Table of Attendance -->
        <center><h2>Table of Attendance</h2></center>
        <table>
            <tr>
                <th>Attendee ID</th>
                <th>User ID</th>
                <th>Workshop ID</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
             include('database_connection.php');

            // SQL query to fetch data from the attendance table
            $sql = "SELECT * FROM attendance";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $attid = $row["attendee_id"]; // Added this line to fetch attendee_id
                    echo "<tr>
                        <td>" . $row["attendee_id"] . "</td>
                        <td>" . $row["user_id"] . "</td>
                        <td>" . $row["workshop_id"] . "</td> 
                        <td><a href='delete_attendance.php?attendee_id=$attid'>Delete</a></td> 
                        <td><a href='update_attendance.php?attendee_id=$attid'>Update</a></td> 
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data found</td></tr>";
            }
            // Close connection
            $connection->close();
            ?>
        </table>
    </section>

    
<footer>
  <center> 
    <b><h2><i>Designed and implemented by Samson RURANGWA&reg, @UR CBE BIT, 2024. &copy All right reserved <i></h2></b>
  </center>
</footer>
</body>
</html>
