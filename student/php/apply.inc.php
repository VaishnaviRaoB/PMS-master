<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
   
}
include_once '../includes/db.inc.php';

if (isset($_GET['comp'])) {
    $company_name = $_GET['comp'];
    $user_usn = $_SESSION['usn']; // Assuming the session stores the user's USN
    
    // Check if the company name and user USN exist before inserting
    $company_check = "SELECT name FROM company WHERE name='$company_name'";
    $company_res = mysqli_query($conn, $company_check);
    
    $user_check = "SELECT usn FROM studentlogin WHERE usn='$user_usn'";
    $user_res = mysqli_query($conn, $user_check);
    
    if (mysqli_num_rows($company_res) > 0 && mysqli_num_rows($user_res) > 0) {
        $sql = "INSERT INTO applied (usn, student_name, company) VALUES ('$user_usn', (SELECT fname FROM studentlogin WHERE usn='$user_usn'), '$company_name')";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            ?>
            <script>
                alert("Apply Unsuccessful, Try Again!");
                window.location.replace("../viewapply.php");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("You have applied for the company successfully!");
                window.location.replace("../viewapply.php");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Invalid company or user. Please try again.");
            window.location.replace("../viewapply.php");
        </script>
        <?php
    }
}
?>
