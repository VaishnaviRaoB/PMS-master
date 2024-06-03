
<?php
include_once 'includes/head.php';
include_once 'includes/nav.php';
session_start(); // Start the session

if (isset($_POST['login'])) {
    include_once '../../includes/db.inc.php'; // Adjust the path as necessary

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM studentlogin WHERE uname = ? AND pwd = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['user'] = $user;
            header("Location: ../feed.php?result=success");
            exit();
        }
    } else {
        header("Location: ../login.php?result=fail");
        exit();
    }
} else {
    header("Location: ../login.php?result=failure");
    exit();
}
?>
