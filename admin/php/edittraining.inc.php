<?php
session_start();
include_once '../includes/db.inc.php';

if (isset($_POST['update'])) {
    $cid = $_POST['cid'];
    $course = $_POST['course'];
    $lecturer = $_POST['lecturer'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];

    $sql = "UPDATE training SET course='$course', lecturer='$lecturer', description='$description', start_date='$start_date', end_date='$end_date', duration='$duration' WHERE id='$cid';";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "Course updated successfully!";
        // Redirect or perform any other actions after successful update
    } else {
        echo "Error updating course: " . mysqli_error($conn);
    }
} else {
    echo "No data submitted for update.";
}
?>
