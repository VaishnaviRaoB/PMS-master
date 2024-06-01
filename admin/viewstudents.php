<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        <h1 class="form-row justify-content-center">View Students</h1> <br>
        <div class="search-container">
            <form method="GET">
                <input type="text" name="search" placeholder="Search Student by Name">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-borderless table-light">
                <thead>
                    <tr>
                        <th scope="col">Student Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['search'])) {
                            $search = mysqli_real_escape_string($conn, $_GET['search']);
                            $sql = "SELECT * FROM studentlogin WHERE fname LIKE '%$search%';";
                        } else {
                            $sql = "SELECT * FROM studentlogin;";
                        }
                        $res = mysqli_query($conn, $sql);
                        $rescheck = mysqli_num_rows($res);
                        if($rescheck > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo '<tr>';
                                    echo '<td>'.$row['fname'].'</td>';
                                    echo '<td>'.$row['phone'].'</td>';
                                    $gmailUrl = "https://mail.google.com/mail/?view=cm&fs=1&to=" . urlencode($row['email']);
                                    echo '<td><a href="'.$gmailUrl.'" target="_blank">'.$row['email'].'</a></td>';
                                    echo '<td>'.$row['uname'].'</td>';
                                    echo '<td>'.$row['course'].'</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No students found.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>
