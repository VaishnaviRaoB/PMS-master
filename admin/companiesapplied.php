<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Companies Applied</title>
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
            border-right: 1px solid #dee2e6 ; /* Remove vertical line after the last column */
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
        }
        .no-trainings {
            text-align: center;
            color: #777;
        }
        .group-header {
            font-weight: bold;
            margin-bottom: 2px !important;
            border-top: 2px solid #dee2e6;
            border-bottom: 2px solid #dee2e6;
            border-left: 2px solid #dee2e6;
            border-right: 2px solid #dee2e6;
            border-color: black;
            
        }
        .group-total {
            background-color: #f1f3f5;
            font-weight: bold;
            border-top: 2px solid #dee2e6;
            border-bottom: 2px solid #dee2e6;
            border-left: 2px solid #dee2e6;
            border-right: 2px solid #dee2e6;
            border-color: black;
        }
        .selected {
            background-color: #45a049 !important; /* Green color for selected */
        }
        .attended {
            background-color: yellow !important; /* Yellow color for attended */
        }
        .applied {
            background-color: lightblue !important; /* Red color for applied */
        }
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php' ?>
    <div class="container" style="z-index: 2;">
        <h1 class="form-row justify-content-center mt-4">Companies Applied</h1>
        <div class="search-container mt-4">
            <form method="GET">
                <input type="text" name="search" placeholder="Search Company by Name">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Company Name</th>
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
                            $sql = "SELECT * FROM applied WHERE company LIKE '%$search%' ORDER BY 
                                    CASE
                                        WHEN status = 'selected' THEN 1
                                        WHEN status = 'attended' THEN 2
                                        ELSE 3
                                    END, id;";
                        } else {
                            $sql = "SELECT * FROM applied ORDER BY 
                                    CASE
                                        WHEN status = 'selected' THEN 1
                                        WHEN status = 'attended' THEN 2
                                        ELSE 3
                                    END, id;";
                        }

                        $res = mysqli_query($conn, $sql);
                        $rescheck = mysqli_num_rows($res);

                        $current_status = "";
                        $status_count = 0;

                        if ($rescheck > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                if ($row['status'] !== $current_status) {
                                    if ($current_status !== "") {
                                        // Print the total count for the previous group
                                        echo '<tr class="group-total"><td colspan="4">Total: ' . $status_count . '</td></tr>';
                                        echo '<tr><td colspan="3">&nbsp;</td></tr>';
                                    }
                                    // Print the new group header
                                    $current_status = $row['status'];
                                    $status_count = 0;
                                    echo '<tr class="group-header ' . strtolower($current_status) . '"><td colspan="4">Status: ' . ucfirst($current_status) . '</td></tr>';
                                }
                                $status_count++;
                                echo '<tr>';
                                    echo '<td>'.$row['id'].'</td>';
                                    echo '<td>'.$row['company'].'</td>';
                                    echo '<td>'.$row['name'].'</td>';
                                echo '</tr>';
                            }
                            // Print the total count for the last group
                            echo '<tr class="group-total"><td colspan="4">Total: ' . $status_count . '</td></tr>';
                            
                        } else {
                            echo '<tr><td colspan="4">No companies found.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>
