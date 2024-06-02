<?php
session_start();

include_once '../includes/db.inc.php'; // Include your database connection file

if (isset($_POST['change'])) {
    $user = $_SESSION['username'];
    $newPassword = $_POST['pwd1'];
    $confirmPassword = $_POST['pwd2'];

    if ($newPassword !== $confirmPassword) {
        ?>
        <script>
            alert("Passwords didn't match!");
            window.location.replace("../changepass.php");
        </script>
        <?php
    } else {
        // Hash the new password securely (use password_hash)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE adminlogin SET pwd='$hashedPassword' WHERE uname='$user';";
        mysqli_query($conn, $sql);

        ?>
        <script>
            alert("Password has been changed successfully");
            window.location.replace("../changepass.php");
        </script>
        <?php
    }
}
?>
