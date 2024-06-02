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

    $sql1 = "INSERT INTO `company` (`name`, `type`, `address`, `number`, `website`, `status`, `minperc`) VALUES ('$cname', '$ctype', '$address', '$phone', '$website', '$status', '$minperc');";
    $res1 = mysqli_query($conn, $sql1);

    if (!$res1) {
        echo "<script>alert('Company could not be added'); window.location.replace('../addcompanies.php?result=fail');</script>";
    } else {
        echo "<script>alert('Company has been added successfully'); window.location.replace('../viewcompanies.php?result=success');</script>";
    }
}

if (isset($_POST['update'])) {
    $cname = $_POST['cname'];
    $website = $_POST['website'];
    $ctype = $_POST['ctype'];
    $status = $_POST['status'];
    $address = $_POST['address'];
    $phone = $_POST['telephone'];
    $minperc = $_POST['minperc'];

    $sql = "UPDATE `company` SET `name`='$cname', `website`='$website', `address`='$address', `type`='$ctype', `status`='$status', `number`='$phone', `minperc`='$minperc' WHERE `name`='$cname';";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "<script>alert('Company could not be updated'); window.location.replace('../editcomp.php?result=fail');</script>";
    } else {
        echo "<script>alert('Company has been updated'); window.location.replace('../viewcompanies.php?result=success');</script>";
    }
}
?>
