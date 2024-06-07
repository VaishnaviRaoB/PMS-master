<?php
if (isset($_POST['edit'])) {
    include_once '../includes/db.inc.php'; // Include the database connection file

    // Retrieve form data
    $usn = $_POST['usn'];
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $yop = $_POST['yop'];
    $percentage = $_POST['percentage'];
    $sslc = $_POST['sslc'];
    $puc = $_POST['puc'];

    // Prepare an SQL statement to prevent SQL injection
    $sql = "UPDATE studentlogin SET 
            uname=?, 
            fname=?, 
            lname=?, 
            email=?, 
            phone=?, 
            course=?, 
            yop=?, 
            percentage=?, 
            sslc=?, 
            puc=? 
            WHERE usn=?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        ?>
        <script>
            alert("SQL error occurred!");
            window.location.replace("../editprofile.php");
        </script>
        <?php
    } else {
        mysqli_stmt_bind_param($stmt, "sssssssssss", $uname, $fname, $lname, $email, $phone, $course, $yop, $percentage, $sslc, $puc, $usn);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            ?>
            <script>
                alert("Profile has been edited successfully.");
                window.location.replace("../editprofile.php");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Profile couldn't be edited or no changes were made.");
                window.location.replace("../editprofile.php");
            </script>
            <?php
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>
