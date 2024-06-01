<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include CSS or Bootstrap links if needed -->
    <?php include_once 'includes/head.php'; ?>
    <style>
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search-container input[type=text] {
            padding: 10px;
            width: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
        }
        .search-container button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }
        .search-container button:hover {
            background-color: #45a049;
        }
        .course-group {
            background-color: #f9f9f9;
        }
        .total-students-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php'; ?>
    <div class="container">
        <h1 class="form-row justify-content-center" style="margin-left: 100px;">Students Registered for Courses</h1> <br>
        <div class="search-container">
            <form method="GET">
                <input type="text" name="search" placeholder="Search Course by Name">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">Course Name</th>
                        <th scope="col">Enrollment Date</th>
                        <th scope="col">Student Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include your database connection file
                    include_once 'includes/db.inc.php';

                    // Check if search query is set
                    if (isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                        $sql = "SELECT * FROM join_course WHERE course_name LIKE '%$search%' ORDER BY course_name;";
                    } else {
                        $sql = "SELECT * FROM join_course ORDER BY course_name;";
                    }

                    $res = mysqli_query($conn, $sql);

                    // Variables to keep track of the current course group and the student count
                    $currentCourse = '';
                    $studentCount = 0;

                    while ($row = mysqli_fetch_assoc($res)) {
                        // Check if the course name has changed
                        if ($row['course_name'] != $currentCourse) {
                            // If there was a previous course group, display the student count
                            if ($currentCourse != '') {
                                echo '<tr><td colspan="3" class="total-students-right"><strong>Total Students in ' . $currentCourse . ': ' . $studentCount . '</strong></td></tr>';
                            }
                            $currentCourse = $row['course_name'];
                            $studentCount = 0;
                            echo '<tr class="course-group"><td colspan="3"><strong>' . $currentCourse . '</strong></td></tr>';
                        }
                        $studentCount++;
                        echo '<tr>';
                        echo '<td>' . $row['course_name'] . '</td>';
                        echo '<td>' . $row['enrollment_date'] . '</td>';
                        echo '<td>' . $row['student_name'] . '</td>';
                        echo '</tr>';
                    }

                    // Display the student count for the last course group
                    if ($currentCourse != '') {
                        echo '<tr><td colspan="3" class="total-students-right"><strong>Total Students in ' . $currentCourse . ': ' . $studentCount . '</strong></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
