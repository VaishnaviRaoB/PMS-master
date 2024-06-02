<?php 
include_once 'includes/head.php';
include_once 'includes/nav.php';

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'includes/db.inc.php'; // Make sure this file includes your database connection code
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Companies Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php'; ?>
    <form action="php/viewcomp.inc.php" method="POST">
        <div class="container">
            <h1 class="mt-4">Company Details</h1>
            <?php 
            if (isset($_GET['id'])) {
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                // Modify the SQL query to filter data based on the current user's username
                $user = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                $sql = "SELECT * FROM applied WHERE id='$id' AND student_name='$user';";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo '<div class="form-group row">';
                        echo '<label for="id" class="col-sm-2 col-form-label">ID</label>';
                        echo '<div class="col-sm-10">';
                        echo '<input type="text" class="form-control" id="id" name="id" value="'.$row['id'].'" readonly>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="form-group row">';
                        echo '<label for="name" class="col-sm-2 col-form-label">Student Name</label>';
                        echo '<div class="col-sm-10">';
                        echo '<input type="text" class="form-control" id="name" name="name" value="'.$row['name'].'" readonly>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="form-group row">';
                        echo '<label for="company" class="col-sm-2 col-form-label">Company Name</label>';
                        echo '<div class="col-sm-10">';
                        echo '<input type="text" class="form-control" id="company" name="company" value="'.$row['company'].'" readonly>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="form-group row">';
                        echo '<label for="status" class="col-sm-2 col-form-label">Status</label>';
                        echo '<div class="col-sm-10">';
                        echo '<select class="form-control" id="status" name="status">';
                        echo '<option value="'.$row['status'].'">'.$row['status'].'</option>';
                        echo '<option value="Unknown">Unknown</option>';
                        echo '<option value="Attended">Attended</option>';
                        echo '<option value="Selected">Selected</option>';
                        echo '<option value="Rejected">Rejected</option>';
                        echo '</select>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="form-group row">';
                        echo '<div class="col-sm-10 offset-sm-2">';
                        echo '<button type="submit" class="btn btn-primary" name="update">Update</button>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '<p class="lead"><b>Note:</b> Update only if you received any mail/message from the company</p>';
                    }
                }
            }
            ?>
        </div>
    </form>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>

