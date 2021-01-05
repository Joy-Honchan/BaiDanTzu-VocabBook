<?php

    require("_require/dbconnection_BDT.php");

  if(isset($_COOKIE["userEmail"])){
    $cookietok= strtok($_COOKIE["userEmail"], "@");
    $sqlchecklike="select likedvocab from $cookietok where likedvocab='{$row['vocab']}'";
  //   echo $sqlchecklike;
  $havelikevocab = mysqli_query( $link, $sqlchecklike );
  $checkikeword= mysqli_fetch_assoc ($havelikevocab);
  // echo $checkikeword['likedvocab'];
  }  


?>