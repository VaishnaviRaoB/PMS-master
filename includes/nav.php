<?php
  session_start();
  session_destroy();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
  <a class="navbar-brand" href="#"><img src="images/smv.png" style="width: 60px; height: 50px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     
     
      <li class="nav-item" id="about">
        <a class="nav-link" href="about.php" style="font-size:large">About Us</a>
      </li>
     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a href="login.php" class="btn btn-outline-light my-2 my-sm-0" style="border-radius: 50px; border-width: 2px; font-weight: bold;" id="loginnav">LOGIN</a>
      <a href="register.php" class="btn btn-outline-light my-2 my-sm-0" style="border-radius: 50px; border-width: 2px; font-weight: bold;" id="registernav">SIGN IN</a>
    </form>
    
  </div>
</nav>