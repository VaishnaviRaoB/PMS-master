<?php
include_once '../../includes/db.inc.php';

if (isset($_POST['update'])) {
    $course = $_POST['course'];
    $lecturer = $_POST['lecturer'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];

    // Use course name to identify the record to update
    $sql = "UPDATE training SET lecturer='$lecturer', description='$description', start_date='$start_date', end_date='$end_date', duration='$duration' WHERE course='$course'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "<script>alert('Training course could not be updated'); window.location.replace('../edittraining.php?result=fail');</script>";
    } else {
        echo "<script>alert('Training course has been updated'); window.location.replace('../viewtrainings.php?result=success');</script>";
    }
}
?>
