<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Trainings</title>
    <?php include_once 'includes/head.php' ?>
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
        .table-container {
            margin-top: 50px;
            margin-right: -80px;
            margin-left: -80px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 10px;
            white-space: nowrap !important;
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
            padding: 10px 10px ;
            border-bottom: 1px solid #dee2e6;
            
        }
        .btn-sm {
            padding: 5px 5px;
            margin: 0 0px;
            font-size: 0.8rem;
            
        }
        .fas {
            font-size: 1em;
            ;
        }
        .no-trainings {
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php' ?>
    <div class="container" style="z-index: 2;">
        <h1 class="form-row justify-content-center mt-4">Students</h1>
        <div class="search-container mt-4">
            <form method="GET">
                <input type="text" name="search" placeholder="Search Here">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">USN</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Course</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">Year of Passing</th>
                        <th scope="col">SSLC %</th>
                        <th scope="col">PUC %</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       

                        if (isset($_GET['search'])) {
                            $search = mysqli_real_escape_string($conn, $_GET['search']);
                            $sql = "SELECT usn, CONCAT(fname, ' ', lname) AS student_name, phone, email, uname, course, branch, percentage, yop, sslc, puc FROM studentlogin WHERE fname LIKE '%$search%' OR lname LIKE '%$search%' OR usn LIKE '%$search%';";
                        } else {
                            $sql = "SELECT usn, CONCAT(fname, ' ', lname) AS student_name, phone, email, uname, course, branch, percentage, yop, sslc, puc FROM studentlogin;";
                        }
                        $res = mysqli_query($conn, $sql);
                        $rescheck = mysqli_num_rows($res);
                        if ($rescheck > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo '<tr>';
                                echo '<td>' . $row['usn'] . '</td>';
                                echo '<td>' . $row['student_name'] . '</td>';
                                echo '<td>' . $row['phone'] . '</td>';
                                $gmailUrl = "https://mail.google.com/mail/?view=cm&fs=1&to=" . urlencode($row['email']);
                                echo '<td><a href="' . $gmailUrl . '" target="_blank">' . $row['email'] . '</a></td>';
                                echo '<td>' . $row['uname'] . '</td>';
                                echo '<td>' . $row['course'] . '</td>';
                                echo '<td>' . $row['branch'] . '</td>';
                                echo '<td>' . $row['percentage'] . '</td>';
                                echo '<td>' . $row['yop'] . '</td>';
                                echo '<td>' . $row['sslc'] . '</td>';
                                echo '<td>' . $row['puc'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="11">No students found.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>