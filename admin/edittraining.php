<?php
include_once 'includes/db.inc.php';

if (isset($_POST['update'])) {
    $course = $_POST['course'];
    $lecturer = $_POST['lecturer'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $duration = $_POST['duration'];

    $sql = "UPDATE training SET lecturer=?, description=?, start_date=?, end_date=?, duration=? WHERE course=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssds", $lecturer, $description, $start_date, $end_date, $duration, $course);
    $update_result = $stmt->execute();

    if ($update_result) {
        ?>
        <script>
            alert("Training course updated successfully!");
            window.location.href = "viewtraining.php";
        </script>
        <?php
        exit(); // Ensure script execution stops here to prevent further processing
    } else {
        ?>
        <script>
            alert("Training course could not be updated");
            window.location.href = "edittraining.php?edit=<?php echo urlencode($course); ?>";
        </script>
        <?php
        exit(); // Ensure script execution stops here to prevent further processing
    }
}

if (isset($_GET['edit'])) {
    $course = $_GET['edit'];
    $sql = "SELECT * FROM training WHERE course=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Training Course</title>
    <link rel="stylesheet" type="text/css" href="css/addcomp.css">
    <?php include_once 'includes/head.php'; ?>
    <style>
        /* Styles for this page */
        .content {
            margin-top: 140px;
            margin-left: -10px;
        }
        h1 {
            margin-left: 100px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .center {
            text-align: center;
        }
        .btn {
            width: 150px;
            color: white;
            font-weight: bold;
            background: linear-gradient(to left, #6C63FF, #3F3D56);
        }
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php'; ?>
    <div class="content">
        <h1>Edit Training Course</h1> <br>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="row justify-content-center align-items-baseline">
                <div class="center one">
                    <div class="form-group col-md-12">
                        <label for="course">Course Name</label>
                        <input type="text" class="form-control" id="course" name="course" style="width: 270px;" value="<?php echo htmlspecialchars($row['course']); ?>" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="lecturer">Lecturer Name</label>
                        <input type="text" class="form-control" id="lecturer" name="lecturer" value="<?php echo htmlspecialchars($row['lecturer']); ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Course Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($row['description']); ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo htmlspecialchars($row['start_date']); ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo htmlspecialchars($row['end_date']); ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="duration">Duration (in days)</label>
                        <input type="number" class="form-control" id="duration" name="duration" placeholder="Duration in days" value="<?php echo htmlspecialchars($row['duration']); ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn" name="update">Update Course</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
