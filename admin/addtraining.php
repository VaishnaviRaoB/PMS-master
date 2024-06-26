<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Training Courses</title>
    <link rel="stylesheet" type="text/css" href="css/addcomp.css">
    <?php include_once 'includes/head.php' ?>
</head>
<body>
    <div>
        <img id="img2" src="../images/trainingicon.png" width="600px" style="position: absolute; position: fixed; z-index: 1; margin-left: 55%; margin-top: 20vh;">
    </div>
    <img src="../images/training.png" id="img1">
    <?php include_once 'includes/nav.php' ?>
    <div class="content" style="margin-top: 140px; margin-left: -10px;">
        <h1 class="form-row justify-content-center" style="margin-left: 100px;">Add Training Courses</h1> <br>
        <form action="php/addtraining.inc.php" method="POST">
            <div class="row justify-content-center align-items-baseline">
                <div class="center one">
                    <div class="form-group col-md-12">
                        <label for="cid">Course Name</label>
                        <input type="text" class="form-control" id="cid" name="course" style="width: 270px;" placeholder="Course Name">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="cname">Lecturer Name</label>
                        <input type="text" class="form-control" id="cname" name="lecturer" placeholder="Lecturer Name">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="cdescription">Course Description</label>
                        <textarea class="form-control" id="cdescription" name="description" rows="3" placeholder="Course Description"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" onchange="calculateDuration()">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="duration">Duration (in days)</label>
                        <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration in days" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn" name="add" style="width: 150px; color: white; font-weight: bold; background: linear-gradient(to left, #6C63FF, #3F3D56);">Add Course</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include_once 'includes/footer.php' ?>
    <script>
        function calculateDuration() {
            var startDate = new Date(document.getElementById("start_date").value);
            var endDate = new Date(document.getElementById("end_date").value);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var duration = Math.ceil(timeDiff / (1000 * 3600 * 24));
            document.getElementById("duration").value = duration;
        }
    </script>
</body>
</html>
