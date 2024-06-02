<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once '../includes/db.inc.php';

    if (isset($_POST['joinnow'])) {
        $course = mysqli_real_escape_string($conn, $_POST['course']);
        $user = mysqli_real_escape_string($conn, $_SESSION['student']);

        $sql = "INSERT INTO join_course (course_name, student_name) VALUES ('$course', '$user')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            ?>
            <script>
                alert("You have successfully joined the course.");
                window.location.replace("../dashboard.php");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Error: Unable to join the course.");
                window.location.replace("../dashboard.php");
            </script>
            <?php
        }
    }
?>
