<?php
include_once '../includes/db.inc.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['change'])) {
    $user = $_SESSION['username'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];

    if ($pwd1 !== $pwd2) {
        echo "<script>
                alert('Passwords did not match!');
                window.location.replace('../changepass.php');
              </script>";
    } else {
        // Hash the new password
        $hashedPwd = password_hash($pwd1, PASSWORD_DEFAULT);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE studentlogin SET pwd=? WHERE fname=?");
        $stmt->bind_param("ss", $hashedPwd, $user);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Password has been changed successfully');
                    window.location.replace('../changepass.php');
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating password. Please try again.');
                    window.location.replace('../changepass.php');
                  </script>";
        }
        
        // Close the statement
        $stmt->close();
    }
}
?>
