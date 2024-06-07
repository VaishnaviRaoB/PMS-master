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
    $sql = "UPDATE training SET lecturer=?, description=?, start_date=?, end_date=?, duration=? WHERE course=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssds", $lecturer, $description, $start_date, $end_date, $duration, $course);
        $stmt->execute();
        $stmt->close();
        
        // Display alert message using JavaScript
        echo "<script>alert('Training course has been updated'); window.location.href = '../viewtraining.php?result=success';</script>";
        exit(); // Ensure script execution stops here
    } else {
        // Display alert message if update fails
        echo "<script>alert('Training course could not be updated'); window.location.href = '../edittraining.php?result=fail';</script>";
        exit(); // Ensure script execution stops here
    }
}
?>
