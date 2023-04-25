<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

<link rel="stylesheet" type="text/css" href="shorts/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>search</title>
  <style>
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
.first{
    border:2px solid white;
}
#box1{
  color: #15f4ee;
 text-decoration: none;
 padding-top:10px;
}
#box2{
  color: #15f4ee;
 text-decoration: none;
 padding-top:80px;
}
    </style>
</head>

<body>

<?php
   require("shorts/header.php");
    include("shorts/db_connect.php");
    ?>

<?php 
require("Algorithms/SpellChecker.php");
require("Algorithms/PorterStemmer.php");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
     
      $noresults = true;
        $query = $_GET["search"];

        // Pre-processing the query
        $query = preg_replace("/[^a-zA-Z0-9]+/", " ", $query);
        $query = trim($query);

        #==========Using SpellChecker library to check for errorwords and to correct them=======

        $spellChecker = new SpellChecker();
        $correctedQuery = $spellChecker->spellCheck($query);

        $stemmer = new PorterStemmer();
        $correctedQuery = $stemmer->stem($correctedQuery);

        
        //$sql = "SELECT * from explore where match(e_name,e_descrip) against ('%$query%')"; 
        $sql = "SELECT * FROM explore WHERE LOWER(e_name) LIKE LOWER('%$correctedQuery%') OR LOWER(e_descrip) LIKE LOWER('%$correctedQuery%')";


        $result = mysqli_query($conn, $sql);
        echo '<h4 id="box2">SEARCHING RESULT FOR : '.$correctedQuery.'</h4>';
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['e_name'];
            $desc = $row['e_descrip']; 
       
          $url = " thread.php?E_id=". $row['e_id'] ;
        
            $noresults = false;
           
            echo '<div class="jumbotron jumbotron-fluid box first" id="box1">
            <div class="result">
            <h3 id="box1"><a href="'. $url. '" id="box1" >'. $title. '</a> </h3>
                        <p >'. $desc .'</p>
                  </div>
                  </div>'; 
            }
        if ($noresults){
            echo '<div class="jumbotron " id="box1">
                    <div class="container">
                        <p class="display-4">No Results Found</p>
                        <p class="lead"> Suggestions: <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords. </li></ul>
                        </p>
                    </div>
                 </div>';
        }        
    ?>






<?php

require("shorts/footer.php");

?>
</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</html>
