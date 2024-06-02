<?php 
    include_once '../../includes/db.inc.php';

    if (isset($_POST['signup'])) {
        $uname = mysqli_real_escape_string($conn, $_POST['username']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
        $pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
        $secque = mysqli_real_escape_string($conn, $_POST['secque']);
        $secans = mysqli_real_escape_string($conn, $_POST['secans']);

        // Check if passwords match
        if ($pwd1 != $pwd2) {
            header("Location: ../register.php?result=passwords_mismatch");
            exit();
        }

        // Hash the password before storing in the database
        $hashedPwd = password_hash($pwd1, PASSWORD_DEFAULT);

        $sql = "INSERT INTO studentlogin (uname, fname, lname, email, phone, pwd, secque, secans) VALUES ('$uname', '$fname', '$lname', '$email', '$phone', '$hashedPwd','$secque', '$secans')";
        $res = mysqli_query($conn, $sql);

        if (!$res) {
            header("Location: ../register.php?result=registration_failed");
            exit();
        } else {
            header("Location: ../login.php?result=registration_success");
            exit();
        }
    }
?>

    	</div>
		<form action="register.inc.php" autocomplete="off" method="POST">
			<input type="text" style="display: none;" autocomplete="false">
			<input type="password" style="display: none;" autocomplete="false">
			<input type="email" style="display: none;" autocomplete="false">
		    <div class="row justify-content-center align-items-baseline">
		      <div class="center one">
		        <div class="form-row">
		        	
			        <div class="form-group col-md-5">
			          <label for="cname">Username</label>
			          <input type="text" class="form-control" id="cname" name="username" placeholder="Username">
			        </div>
		        </div>
		        <div class="form-row">
		        	<div class="form-group col-md-5">
			          <label for="cname">First Name</label>
			          <input type="text" class="form-control" id="cid" name="fname" placeholder="First Name">
			        </div>
			        <div class="form-group col-md-5">
			          <label for="cname">Last Name</label>
			          <input type="text" class="form-control" id="cname" name="lname" placeholder="Last Name">
			        </div>
		        </div>
		        <div class="form-row">
		        	<div class="form-group col-md-5">
			          <label for="cid">Mail-ID</label>
			          <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" class="form-control" id="cid" name="email" placeholder="Mail-ID" autocomplete="off" required>
			        </div>
			        <div class="form-group col-md-5">
			          <label for="cname">Phone</label>
			          <input type="text" pattern="^(?!0+$)\d{10}$" class="form-control" id="cname" name="phone" placeholder="Phone">
			        </div>
		        </div>
		        <div class="form-row">
		        	<div class="form-group col-md-5">
			          <label for="cid">Password</label>
			          <input type="password" class="form-control" id="cid" name="pwd1" placeholder="Password">
			        </div>
			        <div class="form-group col-md-5">
			          <label for="cname">Confirm Password</label>
			          <input type="password" class="form-control" id="cname" name="pwd2" placeholder="Confirm Password">
			        </div>
		        </div>
		        <div class="form-row">
			        <div class="form-group col-md-5">
			          <label for="exampleInputEmail1">Security Question</label>
			          <select class="form-control" name="secque">
			          	<option>Which is Favourite Food?</option>
			          	<option>Which is your First Phone?</option>
			          	<option>Which is your Favourite Mobile Company?</option>
			          </select>
			        </div>
		        	<div class="form-group col-md-5">
			          <label for="telephone">Answer</label>
			          <input type="text" class="form-control" id="telephone" name="secans" placeholder="Answer">
			        </div>
		        </div>
		        <div class="form-row justify-content-center">
		        	<button type="submit" class="btn btn-dark col-md-5" name="signup" style="margin-left: -120px;">SIGN UP</button>
		        </div>
		      </div>
		    </div>
		  </form> 
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>