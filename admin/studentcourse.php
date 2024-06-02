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
        .search-container form {
            display: flex;
            align-items: center;
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
        .table-container {
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6; /* Add vertical line */
        }
        .table thead th:first-child {
            border-left: 1px solid #dee2e6; /* Add vertical line before the first column */
        }
        .table thead th:last-child {
            border-right:1px solid #dee2e6 ; /* Remove vertical line after the last column */
        }
        .table td, .table th {
            vertical-align: middle;
            border-right: 1px solid #dee2e6; /* Extend vertical line for entire column */
        }
        .table td:last-child, .table th:last-child {
            border-right: 1px solid #dee2e6; /* Remove vertical line for last column */
        }
        .table td:first-child, .table th:first-child {
            border-left: 1px solid #dee2e6; /* Add vertical line before the first column */
        }
        .table td {
            padding: 15px;
            border-top: 1px solid #dee2e6;
        }
        .table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .btn-sm {
            padding: 5px 10px;
            margin: 0 2px;
            font-size: 0.8rem;
        }
        .fas {
            font-size: 1em;
        }
        .no-trainings {
            text-align: center;
            color: #777;
        }
        .bold-row {
            border-top: 2px solid #dee2e6;
            border-bottom: 2px solid #dee2e6;
            border-left: 2px solid #dee2e6;
            border-right: 2px solid #dee2e6;
            border-color: black;
        }
        .course-name {
            font-weight: bold;
            background-color: lightgray;
            border: 2px solid black !important;
            margin-bottom: 2px !important;
        }
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php'; ?>
    <div class="container" style="z-index: 2;">
        <h1 class="form-row justify-content-center mt-4">Students Registered For Course</h1>
        <div class="search-container mt-4">
            <form method="GET">
                <input type="text" name="search" placeholder="Search Here">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-borderless table-light">
                    <tbody>
                    <thead>
                    <?php
                    // Include your database connection file
                    include_once 'includes/db.inc.php';

                    // Check if search query is set
                    if (isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                        $sql = "SELECT jc.course_name, jc.enrollment_date, sl.usn, sl.fname, sl.lname
                                FROM join_course jc
                                LEFT JOIN studentlogin sl ON jc.usn = sl.usn
                                WHERE jc.course_name LIKE '%$search%' OR sl.fname LIKE '%$search%' OR sl.lname LIKE '%$search%'
                                ORDER BY jc.course_name;";
                    } else {
                        $sql = "SELECT jc.course_name, jc.enrollment_date, sl.usn, sl.fname, sl.lname
                                FROM join_course jc
                                LEFT JOIN studentlogin sl ON jc.usn = sl.usn
                                ORDER BY jc.course_name;";
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
                                echo '<tr class="bold-row"><td colspan="4" class="total-students-right"><strong>Total Students: ' . $studentCount . '</strong></td></tr>';
                                echo '<tr><td colspan="4">&nbsp;</td></tr>';
                            }
                            $currentCourse = $row['course_name'];
                            $studentCount = 0;
                            echo '<tr><td colspan="4" class="course-name"><strong>Course Name: ' . $currentCourse . '</strong></td></tr>';
                            echo '<tr><th>USN</th><th>Student Name</th><th>Enrollment Date</th></tr>';
                        }
                
                        $studentCount++;
                        $studentName = $row['fname'] . ' ' . $row['lname'];
                        
                        echo '<tr>';
                        echo '<td>' . $row['usn'] . '</td>';
                        echo '<td>' . $studentName . '</td>';
                        echo '<td>' . $row['enrollment_date'] . '</td>';
                        echo '</tr>'; 
                    }
                

                    // Display the student count for the last course group
                    if ($currentCourse != '') {
                        echo '<tr class="bold-row"><td colspan="4" class="total-students-right"><strong>Total Students: ' . $studentCount . '</strong></td></tr>';
                    }
                    ?>
                    </thead>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>