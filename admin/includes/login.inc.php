<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    include_once '../../includes/db.inc.php'; // Include your database connection file

    $sql = "SELECT uname, pwd FROM adminlogin WHERE uname = '$user' AND pwd = '$pass'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);

    if ($check > 0) {
        $_SESSION['user'] = $user; // Store the username in the session
        header("Location: ../index.php?result=success"); // Redirect to the success page
        exit; // Stop further execution
    } else {
        header("Location: ../login.php?result=fail"); // Redirect to the login page with a failure message
        exit;
    }
} else {
    header("Location: ../login.php?result=failure"); // Redirect if the form wasn't submitted
    exit;
}
?>
