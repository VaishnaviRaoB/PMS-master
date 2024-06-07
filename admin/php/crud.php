<?php
include_once '../includes/db.inc.php';

if (isset($_GET['delete'])) {
    $name = urldecode($_GET['delete']);
    $sql = "DELETE FROM company WHERE name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Company has been deleted'); window.location.replace('../viewcompanies.php?result=success');</script>";
    } else {
        echo "<script>alert('Company could not be deleted'); window.location.replace('../viewcompanies.php?result=fail');</script>";
    }
}

if (isset($_GET['delete1'])) {
    $course = urldecode($_GET['delete1']);
    $sql = "DELETE FROM training WHERE course=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Course has been deleted'); window.location.replace('../viewtraining.php?result=success');</script>";
    } else {
        echo "<script>alert('Course could not be deleted'); window.location.replace('../viewtraining.php?result=fail');</script>";
    }
}
?>
