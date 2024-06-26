<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <?php include_once 'includes/head.php' ?>

</head>
<body>
<div>
    <img id="img2" src="../images/trainingicon.png" width="600px" style="position: absolute; position: fixed; z-index: 1; margin-left: 55%; margin-top: 20vh;">
</div>
<img src="../images/training.png" id="img1" style="position: fixed;">
<?php include_once 'includes/nav.php' ?>
<br><br> <br> <br><br>
<div class="content" style="margin-top: 40px; margin-left: 20px;">
    <h2 style="margin-left: 100px;">Join for a Training</h2>
</div>
<br> <br> <br> <br> <br>
<form action="join.php" method="POST">
    <div class="form-group col-md-3">
        <label for="exampleInputEmail1">Select a Course</label>
        <select class="custom-select" name="course">
        <?php 
            include_once '../includes/db.inc.php'; // Include database connection file

            $sql = "SELECT * FROM training;";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <option value="<?php echo $row['course']; ?>"><?php echo $row['course']; ?></option>
        <?php
                }
            }
        ?>
        </select>
    </div>
    <div class="form-group col-md-3">
        <input class="btn" type="submit" name="joinnow" value="Join Now" style="width: 150px; color: white; font-weight: bold; background: linear-gradient(to left, #6C63FF, #3F3D56);"> 
    </div>
</form>

<?php
    session_start();
    include_once '../includes/db.inc.php';

    // Check if the form was submitted
    if (isset($_POST['joinnow'])) {
        $course = $_POST['course']; // Get selected course from the form
        $username = $_SESSION['username']; // Get username from session

        // Fetch USN from the database based on the username
        $sql_usn = "SELECT usn FROM studentlogin WHERE fname = ?";
        $stmt_usn = mysqli_prepare($conn, $sql_usn);
        mysqli_stmt_bind_param($stmt_usn, "s", $username);
        mysqli_stmt_execute($stmt_usn);
        mysqli_stmt_bind_result($stmt_usn, $usn);
        mysqli_stmt_fetch($stmt_usn);
        mysqli_stmt_close($stmt_usn);

        // Insert into join_course table
        $sql_insert = "INSERT INTO join_course (course_name, student_name, usn) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "sss", $course, $username, $usn); // Assuming usn is a string
        if (mysqli_stmt_execute($stmt_insert)) {
            // Display success message if insertion was successful
            echo '<div class="alert alert-success" role="alert">Successfully joined the course!</div>';
        } else {
            // Display error message if there was an issue with the query
            echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
        }
        mysqli_stmt_close($stmt_insert);
    }
?>


<?php include_once 'includes/footer.php' ?>
<script>
    $(document).ready(function() {
        $("#home").removeClass("active");
        $("#apply").addClass("active");
    });
</script>
</body>
</html>
