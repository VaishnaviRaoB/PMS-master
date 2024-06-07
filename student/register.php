<?php
include_once 'includes/db.inc.php';
if (isset($_POST['signup'])) {
    $uname = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $secque = $_POST['secque'];
    $secans = $_POST['secans'];

    // Generate unique student ID (USN)
    $usnPrefix = "USN"; // You can change this prefix as needed
    $uniqueId = uniqid(); // Generates a unique identifier based on time
    $usn = $usnPrefix . $uniqueId;

    // Hash the password before storing it
    $hashedPwd = password_hash($pwd1, PASSWORD_DEFAULT);

    // Handle database operations here
    $sql = "INSERT INTO users (username, usn, first_name, last_name, email, phone, password, security_question, security_answer) VALUES ('$uname', '$usn', '$fname', '$lname', '$email', '$phone', '$hashedPwd', '$secque', '$secans');";

    if (mysqli_query($conn, $sql)) {
        // Display success message if insertion was successful
        echo '<div class="alert alert-success" role="alert">Successfully signed up!</div>';
    } else {
        // Display error message if there was an issue with the query
        echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>
