<?php
session_start(); // Start the session

include_once 'includes/head.php';
include_once 'includes/nav.php';

include_once 'includes/db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['company'])) {
    // Get the form data
    $userName = $_SESSION['user_name']; // Retrieve user's name from session
    $userUSN = $_SESSION['user_usn']; // Retrieve user's USN from session
    $companyName = $_POST['company'];

    // Insert the application into the database
    $sql = "INSERT INTO applied (company, student_name, usn) VALUES ('$companyName', '$userName', '$userUSN')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to the same page with a success message
        header("Location: ".$_SERVER['PHP_SELF']."?success=true&company=" . urlencode($companyName));
        exit();
    } else {
        // If there's an error, display the error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Check if the success parameter is set in the URL
$successMessage = '';
if (isset($_GET['success']) && $_GET['success'] == 'true' && isset($_GET['company'])) {
    $companyName = urldecode($_GET['company']);
    $successMessage = "Applied to " . htmlspecialchars($companyName) . " successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apply to Company</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            margin-left: 50px;
            margin-top: 30px;
            font-weight: 550;
    
        }

        .search-container {
            text-align: center;
            margin-bottom: 20px;
            margin-left: 570px;
        }

        .search-container input[type=text] {
            padding: 10px;
            width: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
        }

        .company-table {
            width: 100%;
            border-collapse: collapse;
        }

        .company-table th, .company-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .company-table th {
            background-color: #f2f2f2;
        }

        .company-table tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .apply-btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .apply-btn:hover {
            background-color: #0056b3;
        }

        .success-message {
            text-align: center;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
   
        <h1 >Apply to Company</h1>
        <div class="search-container">
            <input type="text" class="form-control" id="searchInput" placeholder="Search for a company">
        </div>
        <div class="company-table-container">
        <div class="container">
            <form method="POST" id="applyForm">
                <table class="company-table">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="companyTableBody">
                        <?php
                        $sql = "SELECT * FROM `company`";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.$row['type'].'</td>';
                                echo '<td><button type="button" class="apply-btn" data-company="'.$row['name'].'">Apply</button></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3" class="text-center">No companies found.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <input type="hidden" id="selectedCompany" name="company">
            </form>
        </div>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    </div>

    <script>
        document.querySelectorAll('.apply-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var companyName = this.getAttribute('data-company');
                document.getElementById('selectedCompany').value = companyName;
                document.getElementById('applyForm').submit();
            });
        });

        document.getElementById('searchInput').addEventListener('input', function() {
            var filter = this.value.toLowerCase();
            var rows = document.querySelectorAll('#companyTableBody tr');
            rows.forEach(function(row) {
                var companyName = row.querySelector('td').textContent.toLowerCase();
                if (companyName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

    <div style="margin-bottom: 50px;"></div>
</body>
</html>
