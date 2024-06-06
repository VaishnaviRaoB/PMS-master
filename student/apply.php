<?php 
include_once 'includes/head.php';
include_once 'includes/nav.php';

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'includes/db.inc.php'; // Make sure this file includes your database connection code
?>


<?php
// db.php

$host = '127.0.0.1';
$db   = 'placementnew';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set and not empty
    if (isset($_POST['usn']) && isset($_POST['name']) && isset($_POST['company'])) {
        // Retrieve form data
        $usn = $_POST['usn'];
        $name = $_POST['name'];
        $company = $_POST['company'];
        
        // Prepare SQL statement to insert data into the applied table
        $stmt = $pdo->prepare("INSERT INTO applied (usn, student_name, company, status) VALUES (?, ?, ?, 'Applied')");
        
        // Bind parameters and execute the statement
        $stmt->execute([$usn, $name, $company]);
        
        // Redirect back to the same page or display a success message
        header("Location: apply.php?success=1"); // Redirect to the same page with success parameter
        exit(); // Ensure that no further code is executed after redirection
    } else {
        // Handle case when form fields are not set or empty
        echo "Please fill in all the required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Application</title>
    <link rel="stylesheet" type="text/css" href="css/addcomp.css">
    <!-- Include necessary scripts for Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Add your custom styles here */
        .container {
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container" style="z-index: 2;">
    <h1 class="form-row justify-content-center mt-4">Apply to Companies</h1>
    <form id="applicationForm" method="POST">
        <div class="form-group">
            <label for="usn">USN:</label>
            <input type="text" class="form-control" id="usn" name="usn" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="company">Company:</label>
            <select class="form-control" id="company" name="company" required>
                <option value="">Select Company</option>
                <?php
                // Retrieve company names from the database and populate the dropdown
                $stmt = $pdo->query('SELECT name FROM company');
                $companies = $stmt->fetchAll();
                foreach ($companies as $company) {
                    echo '<option value="' . htmlspecialchars($company['name']) . '">' . htmlspecialchars($company['name']) . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Apply</button>
    </form>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your application has been submitted successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Function to show success message modal
        function showSuccessMessage() {
            $('#successModal').modal('show');
        }

        // Check if the URL has a parameter indicating a successful submission
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            // Show the success message if the parameter is present
            showSuccessMessage();
        }
    });
</script>
</body>
</html>
