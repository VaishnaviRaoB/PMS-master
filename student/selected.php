<?php 
include_once 'includes/head.php';
include_once 'includes/nav.php';

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'includes/db.inc.php'; // Make sure this file includes your database connection code
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selected Companies</title>
    <link rel="stylesheet" type="text/css" href="css/reg.css"> <!-- Adjust the CSS link accordingly -->
    <!-- Include any additional styles or scripts here -->
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
            border-right: 1px solid #dee2e6; /* Remove vertical line after the last column */
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

<div class="container" style="z-index: 2;">
    <h1 class="form-row justify-content-center mt-4">Selected Companies</h1>
    <div class="search-container mt-4">
        <form method="GET">
            <input type="text" name="search" placeholder="Search Here" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">Company Name</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['username'])) {
                        $user = $_SESSION['username'];
                        $search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';
                        $sql = "SELECT applied.company, company.address 
                                FROM applied 
                                JOIN company ON applied.company = company.name 
                                WHERE applied.student_name=? AND applied.status='Selected' AND applied.company LIKE ?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, "ss", $user, $search);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if (!$result) {
                                echo '<tr><td colspan="2" class="no-trainings">Error in fetching results: ' . mysqli_error($conn) . '</td></tr>';
                            } else {
                                $rowCount = mysqli_num_rows($result);
                                if ($rowCount > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['company']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="2" class="no-trainings">No matching companies found</td></tr>';
                                }
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            echo '<tr><td colspan="2" class="no-trainings">Error in preparing statement: ' . mysqli_error($conn) . '</td></tr>';
                        }
                    } else {
                        echo '<tr><td colspan="2" class="no-trainings">Please log in to view your selected companies</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once 'includes/footer.php'; ?>

<!-- Include any additional scripts here -->
</body>
</html>
