<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMC | Welcome </title>
    <!-- <link rel="stylesheet" type="text/css" href="css/font.css"> -->
    <link rel="stylesheet" type="text/css" href="css/reg.css">
    <?php include_once 'includes/head.php' ?>
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
        }
    </style>
</head>
<body>
    <img src="images/homeback1.png" id="img1">
    <div style="position: absolute; margin-left:56%; margin-top:175px;">
        <img src="images/task.svg" width="430px" style="z-index: 1;">
    </div>
    <?php include_once 'includes/nav.php' ?>
    <div class="content" style="margin-top: 160px; margin-left: 10px;">
        <h1 style="margin-left: 30px; font-size: 64px;"><b> </b><br> PLACEMENTs <br><b> MANAGEMENT </b><br> SYSTEM</h1> <br>
    </div>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  data-interval="2000" style="z-index:2; position:relative;top:50rem;">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-50" src="./images/placement.png" alt="First slide" style=" position:relative;left:23rem;height:30rem;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-50" src="./images/Placement2.jpg" alt="Second slide" style="height:30rem; position:relative;left:20rem;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-50" src="./images/Placement3.jpg" alt="Third slide" style="height:30rem; position:relative;left:20rem;">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>
