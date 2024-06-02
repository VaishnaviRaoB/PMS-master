
<?php
include_once 'includes/head.php';
include_once 'includes/nav.php';

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applied Companies</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Your custom CSS styles */
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
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 50px;
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
            border-bottom: 1px solid #dee2e6; }
    </style>
</head>
<body>

<div class="container" style="z-index: 2;">
    <h1 class="form-row justify-content-center mt-4">Applied Companies</h1>
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
                        <th scope="col">Company Name</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../includes/db.inc.php'; // Adjust the path as per your directory structure
                    $user = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                    if (!empty($user)) {
                        $sql = "SELECT * FROM applied WHERE student_name='$user';";
                        $res = mysqli_query($conn, $sql);
                        if ($res && mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo '<tr>';
                                echo '<td>' . $row['company'] . '</td>';
                                echo '<td>' . $row['student_name'] . '</td>'; // Modified to display student name
                                echo '<td>' . $row['status'] . '</td>';
                                if ($row['status'] == 'Selected') {
                                    echo '<td>Selected</td>'; // Display Selected if already selected
                                } else {
                                    echo '<td><a href="delete_application.php?company=' . urlencode($row['company']) . '">Delete</a></td>'; // Link to delete application if not selected
                                }
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No records found</td></tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">Session data not available</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#home").removeClass("active");
        $("#view").addClass("active");
    });
</script>
</body>
</html>
