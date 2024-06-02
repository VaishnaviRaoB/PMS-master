<?php
include_once '../../includes/db.inc.php'; // Include your database connection file

if (isset($_POST['add'])) {
    $course = $_POST['course'];
    $lecturer = $_POST['lecturer'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO `training` (`course`, `lecturer`, `description`, `start_date`, `end_date`, `duration`) 
            VALUES ('$course', '$lecturer', '$description', '$start_date', '$end_date', '$duration')";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "Error adding training course: " . mysqli_error($conn);
    } else {
        echo "Training course added successfully!";
    }
}

if (isset($_POST['update'])) {
    $course = $_POST['course'];
    $lecturer = $_POST['lecturer'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];

    $sql = "UPDATE `training` SET `course`='$course', `lecturer`='$lecturer', `description`='$description', 
            `start_date`='$start_date', `end_date`='$end_date', `duration`='$duration' WHERE course='$course'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "Error updating training course: " . mysqli_error($conn);
    } else {
        echo "Training course updated successfully!";
    }
}
?>
