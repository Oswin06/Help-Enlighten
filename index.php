<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] ==!true)
{
   header("location: index.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" type="text/css" href="shorts/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>Home</title>
</head>
<body>
    <?php
    require("shorts/header.php");
    include("shorts/db_connect.php");
    ?>


    <div class="container my-5" >
    
        <video width="720" height="300"  autoplay loop muted plays-inline id="video" >
            <source src="media/forums.mp4" type="video/mp4">
        </div>
        
        <div class="row my-5 " >
<?php
 $sql = "SELECT * FROM `subject`";
 $result = mysqli_query($conn, $sql);

  
  
   while($row = mysqli_fetch_assoc($result)){

       $desc= $row["description"];


     echo'
     <div class="col-sm-4 mb-5">
     <div class="card glow" >
       <img src='.$row["img"].' class="card-img-top" alt="..." height="250px">
       <div class="card-body">
         <h5 class="card-title">'.$row["name"].'</h5>
         <p class="card-text">'.substr($desc,0,75).'....</p>
         <a href="explore.php?sub_id='.$row["id"].'" class="button">Know more</a>
       </div>
     </div>
   </div>
     ';
   }
?>

  </div>

    



      <?php

      require("shorts/footer.php");
      
      ?>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
-->
</body>
</html>







