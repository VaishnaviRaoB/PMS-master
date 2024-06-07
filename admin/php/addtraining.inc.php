<?php
include_once '../../includes/db.inc.php'; // Include your database connection file

if (isset($_POST['add'])) {
    $course = $_POST['course'];
    $lecturer = $_POST['lecturer'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // Calculate duration
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    $duration = $interval->format('%a'); // Format the duration as days

    $sql = "INSERT INTO `training` (`course`, `lecturer`, `description`, `start_date`, `end_date`, `duration`) 
            VALUES ('$course', '$lecturer', '$description', '$start_date', '$end_date', '$duration')";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        ?>
        <script>
            alert("Training could not be added");
            window.location.replace("../viewtraining.php?");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Training has been added successfully");
            window.location.replace("../viewtraining.php");
        </script>
        <?php
    }
}

if (isset($_POST['update'])) {
    $course = $_POST['course'];
    $lecturer = $_POST['lecturer'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // Calculate duration
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    $duration = $interval->format('%a'); // Format the duration as days

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
