<?php
session_start();
include_once 'includes/db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT usn, pwd FROM studentlogin WHERE uname = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $usn, $hashedPwd);
    mysqli_stmt_fetch($stmt);

    if (password_verify($password, $hashedPwd)) {
        $_SESSION['usn'] = $usn;
        header("Location: apply.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    mysqli_stmt_close($stmt);
}
?>
