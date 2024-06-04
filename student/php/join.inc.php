<?php
    session_start();
    include_once '../includes/db.inc.php';
    if (isset($_POST['joinnow'])) {
        $course = $_POST['course'];
        $username = $_SESSION['username'];

        // Fetch USN based on the username
        $sql_usn = "SELECT usn FROM studentlogin WHERE fname = '$username'";
        $result_usn = mysqli_query($conn, $sql_usn);

        if ($result_usn && mysqli_num_rows($result_usn) > 0) {
            $row = mysqli_fetch_assoc($result_usn);
            $usn = $row['usn'];

            // Insert into join_course table
            $sql_insert = "INSERT INTO join_course (course_name, student_name, usn) VALUES ('$course', '$username', '$usn')";
            mysqli_query($conn, $sql_insert);

            echo "Successfully joined the course!";
        } else {
            echo "Error fetching USN.";
        }
    }
?>
