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
        // Store the password as plain text
        $sql = "UPDATE adminlogin SET pwd='$newPassword' WHERE uname='$user';";
        if (mysqli_query($conn, $sql)) {
            ?>
            <script>
                alert("Password has been changed successfully");
                window.location.replace("../changepass.php");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("An error occurred while changing the password.");
                window.location.replace("../changepass.php");
            </script>
            <?php
        }
    }
}
?>
