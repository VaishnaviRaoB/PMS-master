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

                    // Check if search query is set
                    if (isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                        $sql = "SELECT * FROM join_course WHERE course_name LIKE '%$search%';";
                    } else {
                        $sql = "SELECT * FROM join_course;";
                    }

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
