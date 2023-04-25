<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
 
    <title>Document</title>
</head>
<body>


<nav class="navbar navbar-dark  fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Help Enlighten</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Help Enlighten</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
            <a href="index.php"><button class="button2">Home</button></a> 
     
            </li>
            <li class="nav-item">
           
         <a href="register.php"> <button class="button2">register</button></a>  <br>
          <a href="login.php"> <button class="button2">login</button></a> <br>
          <a href="logout.php"> <button class="button2">logout</button></a> 
        
        </li>
            <li class="nav-item">
        
            <a href="index.php"> <button class="button2"> <?php echo " ". $_SESSION['username']?></button></a>  <br>
          <a href="contactus.php"> <button class="button2">contact us</button></a> 
            </li>
          </ul>
          <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
        <button class="button2" type="submit" >Search</button>
      </form>
        </div>
      </div>
    </div>
  </nav>


</body>
</html>
<!-- <a href="register.php"> <button class="button2">register</button></a>  -->


