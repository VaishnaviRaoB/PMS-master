<?php
include_once '../includes/db.inc.php'; // Include your database connection file

if (isset($_POST['signup'])) {
    $uname = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['mailid'];
    $phone = $_POST['phone'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    if ($pwd1 == $pwd2) {
        // Store the password as plain text (NOT RECOMMENDED)
        $plainPwd = $pwd1;

        // Insert the data into the 'adminlogin' table
        $sql = "INSERT INTO adminlogin (uname, pwd, fname, lname, email, phone) VALUES ('$uname', '$plainPwd', '$fname', '$lname', '$email', '$phone')";
        mysqli_query($conn, $sql);

        // Redirect to the success page
        header("Location: ../addadmin.php?result=success");
        exit;
    } else {
        // Redirect to the registration page with a failure message
        header("Location: ../addadmin.php?result=fail");
        exit;
    }
}
?>
