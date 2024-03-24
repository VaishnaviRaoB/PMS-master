<?php 
	include_once '../../includes/db.inc.php';
	if (isset($_POST['add'])) {
		$course = $_POST['course'];
		$lecturer = $_POST['lecturer'];
		$description = $_POST['description'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$duration = $_POST['duration'];

		$sql = "INSERT INTO `training` (`id`, `course`, `lecturer`, `description`, `start_date`, `end_date`, `duration`) 
		VALUES (NULL, '$course', '$lecturer', '$description', '$start_date', '$end_date', '$duration');";
		$res = mysqli_query($conn, $sql);
		if (!$res) {
			?>
			<script>
				alert("Training course could not be added");
				window.location.replace("../addtraining.php?result=fail");
			</script>
			<?php
		} else {
			?>
			<script>
				alert("Training course has been added successfully");
				window.location.replace("../viewtraining.php?result=success");
			</script>
			<?php
		}
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$course = $_POST['course'];
		$lecturer = $_POST['lecturer'];
		$description = $_POST['description'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$duration = $_POST['duration'];

		$sql = "UPDATE `training` SET `course`='$course', `lecturer`='$lecturer', `description`='$description', 
		`start_date`='$start_date', `end_date`='$end_date', `duration`='$duration' WHERE `id`='$id';";
		$res = mysqli_query($conn, $sql);
		if (!$res) {
			?>
			<script>
				alert("Training course could not be updated");
				window.location.replace("../edittraining.php?result=fail");
			</script>
			<?php
		} else {
			?>
			<script>
				alert("Training course has been updated");
				window.location.replace("../viewtraining.php?result=success");
			</script>
			<?php
		}
	}
?>
