<?php
    session_start();
    include_once '../includes/db.inc.php';
    if (isset($_POST['joinnow'])) {
        $course = $_POST['course'];
        $user = $_SESSION['student'];
        $sql = "insert into join_course(course_name,student_namecd) values('$course', '$user');";
        mysqli_query($conn, $sql);
    }
?>