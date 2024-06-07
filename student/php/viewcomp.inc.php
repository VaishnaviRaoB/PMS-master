<?php
include_once '../includes/db.inc.php'; // Ensure the correct path to your database connection script

if (isset($_POST['update'])) {
    $usn = $_POST['usn'];
    $status = $_POST['status'];
    
    // Construct the SQL query to update the status
    $sql = "UPDATE applied SET status='$status' WHERE usn='$usn'";
    
    // Execute the query
    $res = mysqli_query($conn, $sql);
    
    // Check if the query was successful
    if (!$res) {
        ?>
        <script>
            alert("Details couldn't be edited!");
            window.location.replace("../viewapply.php");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Details have been edited successfully");
            window.location.replace("../viewapply.php");
        </script>
        <?php
    }
}
?>
