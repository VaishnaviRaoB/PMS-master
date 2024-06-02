<?php
include_once '../includes/db.inc.php';

if (isset($_GET['delete'])) {
    $name = urldecode($_GET['delete']);
    $sql = "DELETE FROM company WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    
    header("Location: ../viewcompanies.php");
    exit();
} else {
    header("Location: ../viewcompanies.php");
    exit();
}


if (isset($_GET['delete1'])) {
    $course = $_GET['delete1'];
    $sql = "DELETE FROM training WHERE course='$course';"; // Use uppercase SQL keywords
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        ?>
        <script>
            alert("Course could not be deleted");
            window.location.replace("../viewtraining.php?result=fail");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Course has been deleted");
            window.location.replace("../viewtraining.php?result=success");
        </script>
        <?php
    }
}
?>
