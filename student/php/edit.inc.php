<?php
if (isset($_POST['edit'])) {
    include_once '../includes/db.inc.php';

    // Sanitize user inputs
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $yop = mysqli_real_escape_string($conn, $_POST['yop']);
    $percentage = mysqli_real_escape_string($conn, $_POST['percentage']);
    $sslc = mysqli_real_escape_string($conn, $_POST['sslc']);
    $puc = mysqli_real_escape_string($conn, $_POST['puc']);

    $sql = "UPDATE users SET uname='$uname', fname='$fname', lname='$lname', email='$email', phone='$phone',
            course='$course', yop='$yop', percentage='$percentage', sslc='$sslc', puc='$puc' WHERE id='$id';";
             
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        ?>
        <script>
            alert("An error occurred while editing the profile. Please try again.");
            window.location.replace("../editprofile.php");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Profile has been successfully edited.");
            window.location.replace("../editprofile.php");
        </script>
        <?php
    }
}
?>
