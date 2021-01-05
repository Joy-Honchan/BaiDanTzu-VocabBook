<?php 

if (isset($_COOKIE["userEmail"])){
  $sUserEmail = $_COOKIE["userEmail"];

  require("_require/dbconnection_BDT.php");
//   $sUserName = $_POST["loguserEmail"];
//   $sUserPass=$_POST["logpassWord"];
//   // echo $sUserName;
$sqlname="select username from memberlist where loguserEmail='$sUserEmail'";
$result = mysqli_query( $link, $sqlname );
// var_dump($result);
$row = mysqli_fetch_assoc ( $result );
mysqli_close($link);}
else{
    $sUserEmail = "Guest";
}

if (isset($_GET["levelsdropdown"]) && isset($_GET["topicdropdown"])){
    $level=$_GET["levelsdropdown"];
    $topic=$_GET["topicdropdown"];
    header("location:search_BDT.php?levelsdropdown=$level&topicdropdown=$topic");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>備單字-你的線上單字本</title>
    <link rel="stylesheet" href="_css/index_BDT.css">
    <script src="_js/index_BDT.js"></script>
</head>

<body>
    <div class="navbar">
        <div class=" keynavbar">
            <form class="topicselect" method="get" action="search_BDT.php?<?php "levelsdropdown=".$level."&topicdropdown=".$topic ?>">
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

    <div class="heroimg">
    </div>
</body>

</html>