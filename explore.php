<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="shorts/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  
  <title> QUESTION</title>
  <style>
    .box{
       margin-bottom:15px;
        padding-top:30px;
        padding-left:30px;
        border-radius:4px solid #15f4ee;
        background-color:black;
        color: #15f4ee;

    }
    .button2{
    position: relative;
    text-align: center;
    width: 90px;
    padding: 3px;
    margin: 3px;
    font-size: 10px;
    color: #15f4ee;
    font-family: poppins;
 
    border: 3px solid #15f4ee;
     text-transform: uppercase;
 
    background-color:black;
    cursor: pointer;
    border-radius: 15px;
    transition: 1s;
    text-decoration: none;
}
.button2:hover{ color: #15f4ee;
    box-shadow: 0 1px 10px 0 #15f4ee inset, 0 1px 10px 0 #15f4ee,
                0 1px 10px 0 #15f4ee inset, 0 1px 10px 0 #15f4ee;
                
            }

#box1{
  color: #15f4ee;
 text-decoration: none;
 padding-top:10px;
}
  </style>
</head>
<body>
<?php
    require("shorts/header.php");
    include("shorts/db_connect.php");
    ?>



<?php

    $id= $_GET['sub_id'];
   
    $sql = "SELECT * FROM `subject` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
  
     
      while($row = mysqli_fetch_assoc($result)){
     
      
      $name=$row['name'];
      $desc=$row['description'];
    
         
       
      }
    
    ?>
   <div class="container my-5 box "  >
   <div class="jumbotron  text-center " >
   <h1 class="display-4">WELCOME TO Help Enlighten</h1>
  <h1 class="display-4">Language:<?php echo"$name"?></h1>
  <p class="lead"><?php echo"$desc"?></p>
  <button type="submit" class="button2">Know more</button>
</div>
</div>
<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
  $id=$_GET['sub_id'];
  $title = $_POST['e_name'];
  $title = str_replace("<", "&lt;", $title);
  $title = str_replace(">", "&gt;", $title); 
  $desc = $_POST['e_descrip'];
  $desc = str_replace("<", "&lt;", $desc);
  $desc= str_replace(">", "&gt;", $desc);
   
  
  require("Algorithms/SpellChecker.php");


#==========Using SpellChecker library to check for errorwords and to correct them=======

  $spellChecker = new SpellChecker();
  $correctedTitle = $spellChecker->spellCheck($title);
  $correctedDesc = $spellChecker->spellCheck($desc);
 

  $sql=" INSERT INTO `explore` ( `e_name`, `e_descrip`, `id`) VALUES ( '$correctedTitle', '$correctedDesc', '$id')";

  


$result = mysqli_query($conn,$sql);
if($result){
    echo '<script> alert("question submitted")</script>'.$sql;
   
}else{
    echo  '<script> alert("question not submitted")</script>'.mysqli_error($conn);
}
}


?>



<DIV class="container" >

<div class="jumbotron" id="box1">
<form action="<?php echo $_SERVER['REQUEST_URI']?>" method ="post">
  <div class="form-group">
    <h2>Ask a Question</h2>
    <label for="title">Question Title:</label>
    <input type="text" class="form-control" placeholder="Enter title" id="name" name="e_name" required>
  </div>
  <div class="form-group">
    <label for="desc">Description:</label>
    <textarea type="text" class="form-control" placeholder="Enter description" id="desc" name="e_descrip" required></textarea>
  </div>
  <div class="form-group form-check">
  
  </div>
  <button type="submit" class="button2" >Submit</button>
</form>
    </div>
</DIV>








<h2 class="text-center" id="box1">Browse questions</h2>




<?php
 $id= $_GET['sub_id'];
$sql = "SELECT * FROM `explore` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
  

     $no_result = true;
      while($row = mysqli_fetch_assoc($result)){
      $no_result = false;
  
      $question=$row['e_name'];
      $thread_desc=$row['e_descrip'];

     $time=$row['created_at'];
  
    echo'  <div class="container  " id="box1">
      <div class="media border p-3 ">
        <img src="https://png.pngtree.com/png-clipart/20210915/ourmid/pngtree-user-avatar-placeholder-black-png-image_3918427.jpg" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:20px;">
        <div class="media-body">
          <h5> <a href="thread.php?E_id='.$row['e_id'].' " class="" id="box1"> <small><i>  '. $question .'?</i></small></a></h5>
      
          <p>'. $thread_desc .'.</p>
        </div>
      </div>
      </div>';
    

      }
if($no_result){

  echo' <div class="container" id="box1">
  <div class="jumbotron">
  <h1>NO RESULT FOUND!!</h1>
  <p>BE THE FIRST PERSON TO ASK THE QUESTION</p>
</div>
</div>
  ';
}

?>



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