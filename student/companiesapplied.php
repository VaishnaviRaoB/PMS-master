<?php
include_once 'includes/head.php';
include_once 'includes/nav.php';

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once '../includes/db.inc.php'; // Adjust the path as per your directory structure

// Function to update status
function update_status($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
        $usn = $_POST['usn'];
        $company = $_POST['company'];
        $status = $_POST['status'];

        $sql = "UPDATE applied SET status=? WHERE usn=? AND company=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $status, $usn, $company);

        if (mysqli_stmt_execute($stmt)) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

// Function to delete application
function delete_application($conn) {
    if (isset($_GET['delete_company'])) {
        $company = mysqli_real_escape_string($conn, $_GET['delete_company']);
        $user = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        if (!empty($user)) {
            $sql = "DELETE FROM applied WHERE company=? AND student_name=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $company, $user);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: view_applications.php?success=Application deleted successfully");
                exit();
            } else {
                header("Location: view_applications.php?error=Failed to delete application");
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            header("Location: view_applications.php?error=Session data not available");
            exit();
        }
    }
}

// Call functions to handle status update or application deletion
update_status($conn);
delete_application($conn);
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
            border-bottom: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }
        .table thead th:first-child {
            border-left: 1px solid #dee2e6;
        }
        .table thead th:last-child {
            border-right: 1px solid #dee2e6;
        }
        .table td, .table th {
            vertical-align: middle;
            border-right: 1px solid #dee2e6;
        }
        .table td:last-child, .table th:last-child {
            border-right: 1px solid #dee2e6;
        }
        .table td:first-child, .table th:first-child {
            border-left: 1px solid #dee2e6;
        }
        .table td {
            padding: 10px 10px;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<body>

<div class="container" style="z-index: 2;">
    <h1 class="form-row justify-content-center mt-4">Applied Companies</h1>
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
                        <th scope="col">Status</th>
                        <th scope="col">Change Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                    $search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';

                    if (!empty($user)) {
                        $sql = "SELECT * FROM applied WHERE student_name=? AND company LIKE ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'ss', $user, $search);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['company']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                                echo '<td>';
                                echo '<form method="POST" action="view_applications.php">';
                                echo '<input type="hidden" name="usn" value="' . htmlspecialchars($row['usn']) . '">';
                                echo '<input type="hidden" name="company" value="' . htmlspecialchars($row['company']) . '">';
                                echo '<select name="status" onchange="this.form.submit()">';
                                echo '<option value="Applied"' . ($row['status'] == 'Applied' ? ' selected' : '') . '>Applied</option>';
                                echo '<option value="Attended"' . ($row['status'] == 'Attended' ? ' selected' : '') . '>Attended</option>';
                                echo '<option value="Selected"' . ($row['status'] == 'Selected' ? ' selected' : '') . '>Selected</option>';
                                echo '<option value="Rejected"' . ($row['status'] == 'Rejected' ? ' selected' : '') . '>Rejected</option>';
                                echo '</select>';
                                echo '<input type="hidden" name="update_status" value="1">';
                                echo '</form>';
                                echo '</td>';
                                if ($row['status'] == 'Selected') {
                                    echo '<td>Selected</td>';
                                } else {
                                    echo '<td><a href="view_applications.php?delete_company=' . urlencode($row['company']) . '">Delete</a></td>';
                                }
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No records found</td></tr>';
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo '<tr><td colspan="4">Session data not available</td></tr>';
                    }
                    mysqli_close($conn);
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
