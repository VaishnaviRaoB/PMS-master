<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../includes/db.inc.php'; // Include the database connection file

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user = isset($_SESSION['username']) ? $_SESSION['username'] : '';
if (!empty($user)) {
    $sql = "SELECT * FROM studentlogin WHERE fname='$user';";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
    } else {
        echo "<p>No user found!</p>";
        exit();
    }
} else {
    echo "<p>User not logged in!</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <?php include_once 'includes/head.php'; ?>
</head>
<body>
    <div>
        <img id="img2" src="../images/editicon.png" width="650px" style="position: absolute; position: fixed; z-index: 1; 
        margin-left: 55%; margin-top: 13vh;">
    </div>
    <img src="../images/edit.png" id="img1" style="position: fixed;">
    <?php include_once 'includes/nav.php'; ?>
    <div class="content" style="margin-top: 40px; margin-left: 20px;">
        <h1 class="form-row justify-content-center" style="margin-left: 100px;">Edit Profile</h1> <br>
        
        <?php
        if (isset($_GET['update']) && $_GET['update'] == 'success') {
            echo '<p style="color: green;">Profile has been edited successfully.</p>';
        } elseif (isset($_GET['error'])) {
            if ($_GET['error'] == 'sqlerror') {
                echo '<p style="color: red;">SQL error occurred.</p>';
            } elseif ($_GET['error'] == 'noupdate') {
                echo '<p style="color: red;">Profile couldn\'t be edited or no changes were made.</p>';
            }
        }
        ?>
        
        <form action="php/edit.inc.php" method="POST">
            <div class="row justify-content-center align-items-baseline">
                <div class="center one">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="usn">Student ID</label>
                            <input type="text" class="form-control" id="usn" name="usn" value="<?php echo $row['usn']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uname">Student Username</label>
                            <input type="text" class="form-control" id="uname" name="uname" value="<?php echo $row['uname']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row['fname']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row['lname']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                    </div> <br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="course">Course</label>
                            <select class="custom-select" name="course">
                                <option value="<?php echo $row['course'] ?>"><?php echo $row['course'] ?></option>
                                <option value="BE/BTECH">BE/BTECH</option>
                                <option value="BBA">BBA</option>
                                <option value="BCOM">BCOM</option>
                                <option value="BCA">BCA</option>
                                <option value="ME/MTECH">ME/MTECH</option>
                                <option value="MCOM">MCOM</option>
                                <option value="MBA">MBA</option>
                                <option value="MCA">MCA</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="yop">Year Of Pass</label>
                            <select class="custom-select" name="yop">
                                <option value="<?php echo $row['yop']; ?>"><?php echo $row['yop']; ?></option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="percentage">Percentage</label>
                            <input type="text" class="form-control" id="percentage" name="percentage" value="<?php echo $row['percentage']; ?>">
                            <small>Aggregate of 3 Years</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sslc">10th Percentage</label>
                            <input type="text" class="form-control" id="sslc" name="sslc" value="<?php echo $row['sslc']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="puc">12th Percentage</label>
                            <input type="text" class="form-control" id="puc" name="puc" value="<?php echo $row['puc']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" name="edit" class="btn btn-primary" style="background-color: #3f78e0;">Edit Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>

