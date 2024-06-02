<?php
include_once '../../includes/db.inc.php';

if (isset($_POST['add'])) {
    $cname = $_POST['cname'];
    $website = $_POST['website'];
    $ctype = $_POST['ctype'];
    $status = $_POST['status'];
    $address = $_POST['address'];
    $phone = $_POST['telephone'];
    $minperc = $_POST['minperc'];

    $sql1 = "INSERT INTO `company` (`name`, `type`, `address`, `number`, `website`, `status`, `minperc`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt1, "sssssss", $cname, $ctype, $address, $phone, $website, $status, $minperc);

    if (!mysqli_stmt_execute($stmt1)) {
        ?>
        <script>
            alert("Company could not be added");
            window.location.replace("../addcompanies.php?result=fail");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Company has been added successfully");
            window.location.replace("../viewcompanies.php?result=success");
        </script>
        <?php
    }
    mysqli_stmt_close($stmt1);
}

if (isset($_POST['update'])) {
    $cid = $_POST['cid']; // Assuming `cid` is passed in the form for identifying the company to be updated
    $cname = $_POST['cname'];
    $website = $_POST['website'];
    $ctype = $_POST['ctype'];
    $status = $_POST['status'];
    $address = $_POST['address'];
    $phone = $_POST['telephone'];
    $minperc = $_POST['minperc'];

    $sql2 = "UPDATE `company` SET `name`=?, `website`=?, `address`=?, `type`=?, `status`=?, `number`=?, `minperc`=? WHERE `name`=?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ssssssss", $cname, $website, $address, $ctype, $status, $phone, $minperc, $cid);

    if (!mysqli_stmt_execute($stmt2)) {
        ?>
        <script>
            alert("Company could not be updated");
            window.location.replace("../editcomp.php?result=fail");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Company has been updated successfully");
            window.location.replace("../viewcompanies.php?result=success");
        </script>
        <?php
    }
    mysqli_stmt_close($stmt2);
}

mysqli_close($conn);
?>
