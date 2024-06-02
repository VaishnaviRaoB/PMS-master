<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Training Course</title>
    <link rel="stylesheet" type="text/css" href="css/addcomp.css">
    <?php include_once 'includes/head.php' ?>
</head>
<body>
    <div>
        <img id="img2" src="../images/trainingicon.png" width="600px" style="position: absolute; position: fixed; z-index: 1; margin-left: 55%; margin-top: 20vh;">
    </div>
    <img src="../images/training.png" id="img1">
    <?php include_once 'includes/nav.php' ?>
    <div class="content" style="margin-top: 140px; margin-left: -10px;">
        <h1 class="form-row justify-content-center" style="margin-left: 100px;">Edit Training Course</h1> <br>
        <form action="php/edittraining.inc.php" method="POST">
            <div class="row justify-content-center align-items-baseline">
                <div class="center one">
                    <?php
                    include_once '../includes/db.inc.php';

                    if (isset($_GET['edit'])) {
                        $course = $_GET['edit'];
                        $sql = "SELECT * FROM training WHERE course='$course'";
                        $res = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($res) > 0) {
                            $row = mysqli_fetch_assoc($res);
                    ?>
                                <div class="form-group col-md-12">
                                    <label for="course">Course Name</label>
                                    <input type="text" class="form-control" id="course" name="course" style="width: 270px;" value="<?php echo $row['course'] ?>" readonly>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="lecturer">Lecturer Name</label>
                                    <input type="text" class="form-control" id="lecturer" name="lecturer" value="<?php echo $row['lecturer'] ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Course Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $row['description'] ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $row['start_date'] ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $row['end_date'] ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="duration">Duration (in days)</label>
                                    <input type="number" class="form-control" id="duration" name="duration" placeholder="Duration in days" value="<?php echo $row['duration'] ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn" name="update" style="width: 150px; color: white; font-weight: bold; background: linear-gradient(to left, #6C63FF, #3F3D56);">Update Course</button>
                                </div>
                    <?php
                        } else {
                            echo "No course found with that name.";
                        }
                    } else {
                        echo "No course name specified for editing.";
                    }
                    ?>
                </div>
            </div>
        </form> 
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>
