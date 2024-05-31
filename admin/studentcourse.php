<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include CSS or Bootstrap links if needed -->
    <?php include_once 'includes/head.php'; ?>
</head>
<body>
    <?php include_once 'includes/nav.php'; ?>
    <div class="container">
        <h1 class="form-row justify-content-center" style="margin-left: 100px;">Students Registered for Courses</h1> <br>
        <div class="table-responsive">
            <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Enrollment Date</th>
                        <th scope="col">Student Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include your database connection file
                    include_once 'includes/db.inc.php';

                    $sql = "SELECT * FROM join_course;";
                    $res = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['course_name'] . '</td>';
                        echo '<td>' . $row['enrollment_date'] . '</td>';
                        echo '<td>' . $row['student_name'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
