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
    <title>Companies Applied</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/index.css"> <!-- Adjust the CSS link accordingly -->
</head>
<body>
    <div>
    	<img id="img2" src="../images/applyicon.png" width="600px" style="position: absolute; position: fixed; z-index: 1; margin-left: 55%; margin-top: 10vh;">
    </div>
    <img src="../images/apply.png" id="img1">
    <?php include_once 'includes/nav.php' ?>
    <div class="container content" style="margin-top: 40px; margin-left: -30px;">
    	<div class="form-row">
    		<div class="form-text"><h1 style="margin-left: 100px;">Companies Applied</h1></div>
    		&nbsp;<div class="form-text"><a href="category.php" class="btn btn-sm btn-danger" style="position:relative ;top:10px ;left:15px">Apply Now</a></div>
    	</div>
    	<br>
    	<?php 
        $user = $_SESSION['username'];
        $sql = "SELECT * FROM `applied` WHERE student_name=? AND status NOT IN ('Selected', 'Rejected') AND company IN (SELECT name FROM company);";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
        ?>
                    <form>
                        <ul style="list-style: square;">
                            <li class="lead"><a href="viewcompanies.php?id=<?php echo $row['id']; ?>" class="text-dark"><?php echo $row['company']; ?></a></li>
                        </ul>
                    </form>
        <?php
                }
            } else {
        ?>
                <form>
                    <p class="lead">You haven't applied for any companies!</p>
                </form>
        <?php
            }
        }
        mysqli_stmt_close($stmt);
        ?> 
    </div>
    <?php include_once 'includes/footer.php' ?>
    <script>
      $(document).ready(function() {
         $("#home").removeClass("active");
        $("#apply").addClass("active");
      });
    </script>
</body>
</html>
