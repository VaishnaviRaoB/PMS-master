<?php
include_once 'includes/db_connect.php';

if (isset($_GET['edit'])) {
    $name = urldecode($_GET['edit']);
    $sql = "SELECT * FROM company WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $company = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_name = htmlspecialchars($_POST['name']);
        $type = htmlspecialchars($_POST['type']);
        $website = htmlspecialchars($_POST['website']);
        $number = htmlspecialchars($_POST['number']);
        $status = htmlspecialchars($_POST['status']);

        $update_sql = "UPDATE company SET name=?, type=?, website=?, number=?, status=? WHERE name=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssss", $new_name, $type, $website, $number, $status, $name);
        $update_stmt->execute();

        header("Location: view_companies.php");
        exit();
    }
} else {
    header("Location: view_companies.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>
    <?php include_once 'includes/head.php'; ?>
</head>
<body>
    <?php include_once 'includes/nav.php'; ?>
    <div class="container" style="z-index: 2;">
        <h1 class="form-row justify-content-center mt-4">Edit Company</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($company['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type" value="<?php echo htmlspecialchars($company['type']); ?>" required>
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" class="form-control" id="website" name="website" value="<?php echo htmlspecialchars($company['website']); ?>" required>
            </div>
            <div class="form-group">
                <label for="number">Phone</label>
                <input type="text" class="form-control" id="number" name="number" value="<?php echo htmlspecialchars($company['number']); ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($company['status']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
