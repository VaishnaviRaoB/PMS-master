<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/nav.php'; ?>
    <?php include_once 'includes/head.php'; ?>
    <?php include_once 'includes/footer.php'; ?> 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/change.css">

</head>
<body>
<div>
        <img id="img2" src="../images/editicon.png" width="650px" style="position: absolute; position: fixed; z-index: 1; 
        margin-left: 55%; margin-top: 13vh;">
    </div>
    
    <div class="content">
        <h1 align="center">Change Password</h1>
        <div class="row justify-content-center">
            <form action="php/changepass.inc.php" method="POST" onsubmit="return validateForm()">
                <div class="center">
                    <div class="form-group">
                        <label>Enter New Password</label>
                        <input type="password" class="form-control" name="pwd1" id="pwd1" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="pwd2" id="pwd2" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="change">Change Password</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        function validateForm() {
            var pwd1 = document.getElementById("pwd1").value;
            var pwd2 = document.getElementById("pwd2").value;
            if (pwd1 !== pwd2) {
                alert("Passwords do not match");
                return false;
            }
            // You can add more complex validation here if needed
            return true;
        }
    </script>
</body>
</html>
