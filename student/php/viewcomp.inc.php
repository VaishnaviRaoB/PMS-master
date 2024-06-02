<?php
    include_once '../includes/db.inc.php';
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $company = $_POST['company'];
        $status = $_POST['status'];
        
        $sql = "UPDATE applied SET status='$status' WHERE usn='$usn'";
        $res = mysqli_query($conn, $sql);
        
        if (!$res) {
            ?>
            <script>
                alert("Details couldn't be edited!");
                window.location.replace("../viewapply.php");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Details have been edited successfully");
                window.location.replace("../viewapply.php");
            </script>
            <?php
        }
    }
?>
