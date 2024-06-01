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
    </style>
</head>
<body>
    <?php include_once 'includes/nav.php' ?>
    <div class="container" style="z-index: 2;">
        <h1 class="form-row justify-content-center">View Trainings</h1>
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
                    // Include your database connection file
                    include_once 'includes/db.inc.php';

                    // Check if search query is set
                    if (isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                        $sql = "SELECT * FROM training WHERE course LIKE '%$search%';";
                    } else {
                        $sql = "SELECT * FROM training;";
                    }

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
