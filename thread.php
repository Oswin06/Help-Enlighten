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
  <title>ANSWERS</title>

    <style>

.post {
  border: 1px solid gray;
  padding: 10px;
  margin-bottom: 10px;
}

.like-dislike {
  display: flex;
  justify-content: space-between;
}

.like, .dislike {
  padding: 5px 10px;
  border: 1px solid gray;
  border-radius: 5px;
  cursor: pointer;
}

.count {
  padding: 5px 10px;
  border: 1px solid gray;
  border-radius: 5px;
  margin-left: 10px;
}



         .box{
       margin-bottom:15px;
        padding-top:50px;
        padding-left:30px;
        border-radius:4px solid #15f4ee;
        background-color:black;
        color: #15f4ee;
        



    }
    .button2{
    position: relative;
    text-align: center;
    width: 90px;
    padding: 6px;
    margin: 3px;
    font-size: 10px;
    color: #15f4ee;
    font-family: poppins;
    /* font-weight: 100; */
    border: 3px solid #15f4ee;
     text-transform: uppercase;
    /*letter-spacing: 5px; */
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
.cont{
    border:2px solid white;
}
    </style>
</head>
<body>
<body>
    <!--header-->
    <?php
    require("shorts/header.php");
    include("shorts/db_connect.php");
    ?>
    <?php
   
    $id= $_GET['E_id'];

    $sql = "SELECT * FROM `explore` WHERE E_id = $id";
    $result = mysqli_query($conn, $sql);
  
     
     
      while($row = mysqli_fetch_assoc($result)){
   
      $t_name=$row['e_name'];
      $t_desc=$row['e_descrip'];
   
      
      }
    
    ?>


<div class="container my-4 box">
  <div class="jumbotron " id="first">
    <h1><?php echo $t_name ?>?</h1>      
    <p><?php echo $t_desc ?></p>
    <hr class="my-4">
<p><b>Posted by <?php echo generateRandomName(); ?> </b></p>

    </div>
    </div>
<?php
  // Function to generate a random name
  function generateRandomName() {
    // Array of names
    $names = array("Seon", "Oswin", "Sennett", "Shaun", "Rex", "Asher");

    // Generate a random index
    $randomIndex = rand(0, count($names) - 1);

    // Retrieve a random name
    $randomName = $names[$randomIndex];

    // Return the random name
    return $randomName;
  }

  function generateRandom() {
    // Array of names
    $names = array("Jace Tuscano", "Leroy Machado", "Oswin123", "Seon Tuscano", "Suzan", "Martina","Alton","Saikiran","Wesley","Mathew","John","Rudolf","Alson","Cheryl","Larry","Ruben","Keith","Nathan Lopes","Hudah");

    // Generate a random index
    $randomIndex = rand(0, count($names) - 1);

    // Retrieve a random name
    $randomName = $names[$randomIndex];

    // Return the random name
    return $randomName;
  }
  ?>
<?php

require("Algorithms/SpellChecker.php");

    if($_SERVER['REQUEST_METHOD']=='POST'){
  $id=$_GET['E_id'];
  $answer = $_POST['answer'];

  $spellChecker = new SpellChecker();
  $correctedAnswer = $spellChecker->spellCheck($answer);


 $sql="INSERT INTO `answers` ( `answer`, `e_id`) VALUES ('$correctedAnswer','$id')";


$result = mysqli_query($conn,$sql);
if($result){
    echo '<script>alert("Answer posted")</script>';
   
}else{
    echo '<script>alert("error ")</script>'.mysqli_error($conn);
}
}


?>




<div class="cont">
    <div class="container" id="box1">
  <h2 >Add Answers</h2>     
</div>
<div class="container">

<form action="<?php echo $_SERVER['REQUEST_URI']?>" method='post'>
  <div class="form-group">
   <B> <label for="comment" id="box1"> ANSWER:</label></B>
    <textarea name="answer" id="title" cols="30" rows="2" class="form-control"placeholder="Enter Answer" required></textarea>
  </div>

 
  <button type="submit" class="button2">POST</button>
</form>

</div>
</div>
<h2 class="text-center" id="box1">Discussions</h2>

<?php
 $id= $_GET['E_id'];
$sql = "SELECT * FROM `answers` WHERE e_id = $id";
    $result = mysqli_query($conn, $sql);
  
     
     $no_result = true;
      while($row = mysqli_fetch_assoc($result)){
      $no_result = false;
    
      $answer=$row['answer'];
        $answer = str_replace("<", "&lt;", $answer);
        $answer = str_replace(">", "&gt;", $answer); 
      $time = $row['posted_at'];
      
    echo'  <div class="container  " id="box1">
      <div class="media border p-3 post ">
        <img src="https://png.pngtree.com/png-clipart/20210915/ourmid/pngtree-user-avatar-placeholder-black-png-image_3918427.jpg" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:20px;">
        <p>'.generateRandom().'</p>
        <div class="media-body  like-dislike">
        <p>Posted at: '.$time.'</p>
          <h5>  <small><i>  '. $answer .'.</i></small></a></h5>
          </div>
          <button class="like button2" onclick="like(this)">Like</button>
          <button class="dislike  button2" onclick="dislike(this)">Dislike</button>
          <span class="count">0</span>
      </div>
      </div>'
      
//       <div class="post">
//   <p>This is a sample post.</p>
//   <div class="like-dislike">
//     <button class="like" onclick="like(this)">Like</button>
//     <button class="dislike" onclick="dislike(this)">Dislike</button>
//     <span class="count">0</span>
//   </div>
// </div>

      
      
      
         ;


      }
if($no_result){

  echo' <div class="container" id="box1">
  <div class="jumbotron">
  <h1>NO COMMENTS FOUND!!</h1>
  <p>BE THE FIRST PERSON TO ADD THE COMMENT</p>
</div>
</div>
  ';
}

?>

    <?php

require("shorts/footer.php");

?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
 
<script>
  function like(element) {
  // Get the count element
  var count = element.parentNode.querySelector(".count");
  
  // Increment the count
  count.textContent = parseInt(count.textContent) + 1;
}

function dislike(element) {
  // Get the count element
  var count = element.parentNode.querySelector(".count");
  
  // Decrement the count
  count.textContent = parseInt(count.textContent) - 1;
}

</script>

</body>
</html>