<?php
//以下這句可以不顯示notice
error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require("_require/dbconnection_BDT.php");
    
if (isset($_COOKIE["userEmail"])){
    $sUserEmail = $_COOKIE["userEmail"];
  
  //   $sUserName = $_POST["loguserEmail"];
  //   $sUserPass=$_POST["logpassWord"];
  //   // echo $sUserName;
  $sqlname="select username from memberlist where loguserEmail='$sUserEmail'";
  $result = mysqli_query( $link, $sqlname );
  // var_dump($result);
  $row = mysqli_fetch_assoc ( $result );
//   mysqli_close($link);
}
  else{
      $sUserEmail = "Guest";
  }


if (isset($_GET["levelsdropdown"]) && isset($_GET["topicdropdown"])){
    // require("_require/dbconnection_BDT.php");
    $level = $_GET["levelsdropdown"];
    $topic = $_GET["topicdropdown"];
    // echo $level.$topic;
    $sqlgrabvocab= "select * FROM vocabularies WHERE vocablevel='$level' and vocabtopic='$topic'";
    $resultvocab = mysqli_query( $link, $sqlgrabvocab );
    // var_dump($resultvocab);
} else{
    // header("location: index_BDT.php");  
    $erroring = "請先登入會員";
    echo "<script type='text/javascript'>alert('$erroring');</script>";
 
}

if(isset($_POST["addlike"])){

    if(isset($_COOKIE["userEmail"])){
    // require("_require/dbconnection_BDT.php");
    $cookietok= strtok($_COOKIE["userEmail"], "@");
    $addvocab= $_POST["addlike"];
    //    echo $cookietok;
    // echo $addvocab;
    $sqladdlike="insert into $cookietok (likedvocab) VALUE ('$addvocab')";
    // echo $sqladdlike;
    mysqli_query($link, $sqladdlike);
    }else{
        $message = "請先登入會員";
        echo "<script type='text/javascript'>alert('$message');document.location='login_BDT.php'</script>";    
    }
}

if(isset($_POST["deltlike"])){

    if(isset($_COOKIE["userEmail"])){
    // require("_require/dbconnection_BDT.php");
    $cookietok= strtok($_COOKIE["userEmail"], "@");
    $deltvocab= $_POST["deltlike"];
    //    echo $cookietok;
    // echo $deltvocab;
    $sqldeltlike="delete from $cookietok where likedvocab='$deltvocab'";
    // echo $sqladdlike;
    mysqli_query($link, $sqldeltlike);
    }else{
        $message = "請先登入會員";
        echo "<script type='text/javascript'>alert('$message');</script>"; 
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜尋結果</title>
    <link rel="stylesheet" href="_css/search_BDT.css">
</head>

<body>
    <div class="navbar">
        <div class=" keynavbar">
            <form class="topicselect" method="get" action=" ">
                <select name="levelsdropdown" id="levelsdropdown" required>
                    <option value="" disabled selected hidden>難易度</option>
                    <option value="easy">幼幼班</option>
                    <option value="hard">大鞋森</option>
                </select>
                <select name="topicdropdown" id="topicdropdown" required>
                    <option value="" disabled selected hidden>主題</option>
                    <option value="animal">動物</option>
                    <option value="sports">運動</option>
                </select>
                <button type="submit" id="srtopic">Go</button>
            </form>
            <div>
                <a href="index_BDT.php"><img id="logo" src="_image/logo.png"></a>
            </div>
            <?php if ($sUserEmail == "Guest"): ?>            
                <a href="login_BDT.php">
                <div class="welcoming"><img id="loginpic" src="_image/loginpic.png" alt=""> Hi!
                    <span id="username">訪客</span>&nbsp快來註冊備單字</div>
                </a>
            <?php else: ?>
            <a href="memberpage_BDT.php">
                <div class="welcoming"><img id="loginpic" src="_image/loginpic.png" alt=""> Hi!
                    <span id="username"><?php echo $row['username'] ?> </span>&nbsp進入會員中心</div>
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="resultsection">
        <div id="searchresult">
            <div class="cardcase">

                <?php $row = mysqli_fetch_assoc ( $resultvocab ); ?>
<!-- 第一個card -->
                <div class="card">
                    <div class="imgbox">
                        <img class="cardimg" src="_image/_vacabpics/<?php echo $row['picname'] ?>.jpg" alt=" ">
                    </div>
                    <div class="contentbox">
                                    <form method="post" >
                                    <?php  
                                include("_require/wordchecking_BDT.php");
                                if($checkikeword['likedvocab']==$row['vocab']):?>
                                   <div class="likethevocab"> <button type="submit" name="deltlike" value="<?php echo $row['vocab'] ?>" class="unlike"><img class="heart_like" src="_image/heart_liked.png" alt=""></button><span>從單字本刪除</span> </div>
                                <?php else: ?>
                                <div class="likethevocab">  <button type="submit" name="addlike" value="<?php echo $row['vocab'] ?>" class="like"><img class="heart" src="_image/heart_unliked.png" alt=""></button><span>加入單字本</span> </div>
                                    <?php endif ?>
                                    </form>
                            <span class="aniname"><b><?php echo $row['vocab'] ?>&nbsp<?php echo $row['chinese'] ?></b></span>
                            <p><?php echo $row['definition'] ?></p>
                    </div>
                </div>

                <?php $row = mysqli_fetch_assoc ( $resultvocab ); ?>
<!-- 第二個card -->
                <div class="card">
                    <div class="imgbox">
                        <img class="cardimg" src="_image/_vacabpics/<?php echo $row['picname'] ?>.jpg" alt=" ">
                    </div>
                    <div class="contentbox">   
                        <form method="post" >
                        <?php  
                      include("_require/wordchecking_BDT.php");
                    if($checkikeword['likedvocab']==$row['vocab']):?>
                       <div class="likethevocab"> <button type="submit" name="deltlike" value="<?php echo $row['vocab'] ?>" class="unlike"><img class="heart_like" src="_image/heart_liked.png" alt=""></button><span>從單字本刪除</span> </div>
                    <?php else: ?>
                        <div class="likethevocab">  <button type="submit" name="addlike" value="<?php echo $row['vocab'] ?>" class="like"><img class="heart" src="_image/heart_unliked.png" alt=""></button><span>加入單字本</span> </div>
                        <?php endif ?>                        </form>
                            <span class="aniname"><b><?php echo $row['vocab'] ?>&nbsp<?php echo $row['chinese'] ?></b> </span>
                            <p><?php echo $row['definition'] ?></p>
                    </div>
                </div>
            </div>

            <div class="cardcase">

                <?php $row = mysqli_fetch_assoc ( $resultvocab ); ?>
<!-- 第三個card -->

                <div class="card">
                    <div class="imgbox">
                        <img class="cardimg" src="_image/_vacabpics/<?php echo $row['picname'] ?>.jpg" alt=" ">
                    </div>
                    <div class="contentbox">   
                        <form method="post" >
                        <?php  
                            include("_require/wordchecking_BDT.php");
                            if($checkikeword['likedvocab']==$row['vocab']):?>
                            <div class="likethevocab">    <button type="submit" name="deltlike" value="<?php echo $row['vocab'] ?>" class="unlike"><img class="heart_like" src="_image/heart_liked.png" alt=""></button><span>從單字本刪除</span> </div>
                            <?php else: ?>
                                <div class="likethevocab">    <button type="submit" name="addlike" value="<?php echo $row['vocab'] ?>" class="like"><img class="heart" src="_image/heart_unliked.png" alt=""></button><span>加入單字本</span> </div>
                            <?php endif ?>
                        </form>
                            <span class="aniname"><b><?php echo $row['vocab'] ?>&nbsp<?php echo $row['chinese'] ?> </b></span>
                            <p><?php echo $row['definition'] ?></p>
                    </div>
                </div>

                <?php $row = mysqli_fetch_assoc ( $resultvocab ); ?>
<!-- 第四個card -->

                <div class="card">
                    <div class="imgbox">
                        <img class="cardimg" src="_image/_vacabpics/<?php echo $row['picname'] ?>.jpg" alt=" ">
                    </div>
                    <div class="contentbox">   
                        <form method="post" >
                        <?php  
                    include("_require/wordchecking_BDT.php");
                    if($checkikeword['likedvocab']==$row['vocab']):?>
                     <div class="likethevocab">   <button type="submit" name="deltlike" value="<?php echo $row['vocab'] ?>" class="unlike"><img class="heart_like" src="_image/heart_liked.png" alt=""></button><span>從單字本刪除</span> </div>
                    <?php else: ?>
                        <div class="likethevocab">  <button type="submit" name="addlike" value="<?php echo $row['vocab'] ?>" class="like"><img class="heart" src="_image/heart_unliked.png" alt=""></button><span>加入單字本</span> </div>
                        <?php endif ?>                        </form>
                            <span class="aniname"><b><?php echo $row['vocab'] ?>&nbsp<?php echo $row['chinese'] ?></b> </span>
                            <p><?php echo $row['definition'] ?></p>
                    </div>
                </div>
            </div>

            <?php mysqli_close($link);?>

        </div>
    </div>
    <script src="_js/search_BDT.js"></script>
</body>

</html>