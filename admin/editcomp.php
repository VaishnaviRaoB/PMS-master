<!doctype html>
<html lang="en">
  <head>
    <?php include_once 'includes/head.php'; ?>
    <?php include_once 'includes/footer.php'; ?> 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/addcomp.css">
    <title>Edit Company</title>
  </head>
  <body>
    <div>
      <img id="img2" src="../images/walk.png" width="550px" style="position: absolute; position: fixed; z-index: 1; margin-left: 60%; margin-top: 50vh;">
    </div>
    <img src="../images/add.png" id="img1" style="position: fixed;">
    <?php include_once 'includes/nav.php'; ?>
    <div class="content">
      <h1 align="center" style="margin-left: 50px;">Update Company Details</h1><br>
      <div class="row justify-content-center">
        <form action="php/addcomp.inc.php" method="POST">
          <?php
          include_once '../includes/db.inc.php';

          if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $sql = "SELECT * FROM company WHERE id = ?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
              mysqli_stmt_bind_param($stmt, "i", $id);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              if ($row = mysqli_fetch_assoc($result)) {
          ?>

          <div class="center">
            <div class="form-group">
              <label>Company ID</label>
              <input type="text" class="form-control" id="id" name="cid" value="<?php echo $row['id']; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Company Name</label>
              <input type="text" class="form-control" id="cname" name="cname" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="custom-select" name="ctype" required>
                <option value="<?php echo $row['type']; ?>" selected><?php echo $row['type']; ?></option>
                <option value="IT">IT</option>
                <option value="BPO">BPO</option>
                <option value="Software">Software</option>
                <option value="Consulting">Consulting</option>
                <option value="Manufacturing">Manufacturing</option>
              </select>
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="tel" pattern="^\d{10}$" class="form-control" id="telephone" name="telephone" value="<?php echo $row['number']; ?>" required>
            </div>
            <div class="form-group">
              <label>Website</label>
              <input type="url" class="form-control" id="website" name="website" value="<?php echo $row['website']; ?>" required>
            </div>
            <div class="form-group">
              <label>Minimum Percentage</label>
              <input type="number" min="0" max="100" class="form-control" id="minperc" name="minperc" value="<?php echo $row['minperc']; ?>" required>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="custom-select" name="status" required>
                <option value="<?php echo $row['status']; ?>" selected><?php echo $row['status']; ?></option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" id="address" name="address" required><?php echo $row['address']; ?></textarea>
            </div>
            <button type="submit" class="btn" name="update" style="width: 250px; color: white; font-weight: bold; background: linear-gradient(to left, #4B83EA, #504EC2);">Update Company Details</button>
          </div><br><br><br>
          <?php
              }
              mysqli_stmt_close($stmt);
            }
          }
          mysqli_close($conn);
          ?>
        </form>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $("#add").removeClass("active");
        $("#cat").addClass("active");
      });
    </script>
  </body>
</html>
