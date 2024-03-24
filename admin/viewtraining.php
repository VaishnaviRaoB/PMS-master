<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Trainings</title>
    <?php include_once 'includes/head.php' ?>
</head>
<body>
    <?php include_once 'includes/nav.php' ?>
    <div class="container" style="z-index: 2;">
        <h1 class="form-row justify-content-center">View Trainings</h1> <br>
        <div class="table-responsive">
            <table class="table table-hover table-borderless table-dark">
                <thead>
                    <tr>
                        <th scope="col">Course</th>
                        <th scope="col">Lecturer</th>
                        <th scope="col">Description</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Duration (days)</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM training;";
                        $res = mysqli_query($conn, $sql);
                        $rescheck = mysqli_num_rows($res);
                        if ($rescheck > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo '<tr>';
                                echo '<td>' . $row['course'] . '</td>';
                                echo '<td>' . $row['lecturer'] . '</td>';
                                echo '<td>' . $row['description'] . '</td>';
                                echo '<td>' . $row['start_date'] . '</td>';
                                echo '<td>' . $row['end_date'] . '</td>';
                                echo '<td>' . $row['duration'] . '</td>';
                    ?>
                                <td>
                                    <a href="edittraining.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm" name="edit"><i class="fas fa-pen" style="color: #3498DB;"></i></a>
                                    <a href="php/crud.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm" name="delete"><i class="fas fa-trash" style="color: red;"></i></a>
                                </td>
                    <?php
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7">No trainings found.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>
