<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require("_require/dbconnection_BDT.php");

if (isset($_COOKIE["userEmail"])){
    //顯示會員資料
    $cookiEmail= $_COOKIE["userEmail"];
    // echo $cookiEmail;
    $sqlmemberlist="select * from memberlist where loguserEmail='$cookiEmail'";
    // echo $sqlmemberlist;
    $resultmberdata=mysqli_query($link, $sqlmemberlist);
    $memberdata=mysqli_fetch_assoc ( $resultmberdata );
    
    //顯示儲存字數
    $cookietok= strtok($cookiEmail, "@");
    // echo $cookietok;
    $sqlvocabcntlist="select count(*) FROM (select distinct likedvocab FROM $cookietok) as vcnt;";
    // echo $sqlvocablist;
    $resultvocabcntdata=mysqli_query($link, $sqlvocabcntlist);
    $vocabcntdata=mysqli_fetch_assoc($resultvocabcntdata);

    //顯示儲存圖片
    $sqllikepicdata="select picname from $cookietok as m Join vocabularies as v On m.likedvocab = v.vocab";
    // echo $sqllikepicdata;
    $resultlikepicdata=mysqli_query($link, $sqllikepicdata);
    //以下兩行是取資料的方法
    // $likepicdata=mysqli_fetch_assoc($resultlikepicdata);
    // echo $likepicdata['picname'];


    //顯示儲存單字
    $sqllikevocabdata="select m.likedvocab, chinese, definition from $cookietok as m Join vocabularies as v On m.likedvocab = v.vocab";
    // echo $sqllikevocabdata;
    $resultlikevocabdata=mysqli_query($link, $sqllikevocabdata);
    
    //以下兩行是取資料的方法
    // $likevocabdata=mysqli_fetch_assoc($resultlikevocabdata);
    // echo $likevocabdata['likedvocab'];

    }else{
    // header("Location:index_BDT.php");
    $messageeror = "ಠ益ಠ 偷偷摸摸想幹嘛?";
    echo "<script type='text/javascript'>alert('$messageeror');document.location='index_BDT.php'</script>";

    //沒登入會員就進不去
}

// if(isset($_POST['givepic'])){
//     $gotfile=$_FILES['profilepic'];
//     // echo $gotfile['name'];
//     $profilename=$gotfile['name'];
//     $sqlgivepic="update memberlist set profilepic='$profilename' where loguserEmail='$cookiEmail'";
//     // echo $sqlgivepic;
//     mysqli_query($link, $sqlgivepic);

// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
    <link rel="stylesheet" href="_css/memberpage_BDT.css">
</head>

<body>
    <div class="memberpart">
        <div class="leftinfopart">
            <div class="picpart">
                <div class="picframe">
                <label class="upfile" for="uppic">
                <?php if($memberdata["profilepic"]!=null) : ?>
                    <img title="點我選新頭貼" id=selfpic src="selficupload/<?php echo $memberdata["profilepic"] ?>">
                <?php else: ?>
                    <img title="點我選新頭貼" id=selfpic src="_image/no_image.png">
                <?php endif ?>
                </label>
                </div>
            </div>
            <div>
                <form action="uploadfile.php" method="post" enctype="multipart/form-data">
                    <!-- enctype設定編碼方式 multipart/form-data可以選擇多種不同形式 不一定是圖片-->
                   <p><input type="file" name="profilepic" class="putthings" id="uppic"></p> 
                    <!-- type="file" 會呈現一個可從資料夾選擇東西的方式-->
                   <p><button type="submit" name="givepic">上傳頭貼</button></p> 
                </form>

            </div>

            <div class="memberinfo">
                <h3 id="membername"><?php echo $memberdata["username"] ?></h3>
                <p>帳號:&nbsp<span id="memberNB"><?php echo $memberdata["loguserEmail"] ?></span></p>
                <!-- <p id="memberpassword">更改密碼</p> -->
                <p>儲存單字量:&nbsp<span><?php echo $vocabcntdata["count(*)"] ?></span></p>
                <!-- <p>遊戲最高分:<span>10</span></p> -->
                <a href="index_BDT.php">
                <button type="button" class="gosmpalce">回首頁</button>
                </a>

                <a href="login_BDT.php?logout=1">
                <button type="button" class="gosmpalce">登出</button>
                </a>
            </div>
        </div>
        <div class="rightvocabpart">
        <div class="container">
            <?php for($i=1; $i<=$vocabcntdata["count(*)"]; $i++) :?>
                <input class="gopage" type="checkbox" id="c<?php echo $i?>">
            <?php endfor ?>    
                <div id="cover">
                    <?php $likepicdata=mysqli_fetch_assoc($resultlikepicdata) ?>
                    <img class="likevoc" src="_image/_likedvocabpic/<?php echo $likepicdata['picname'] ?>_liked.jpg">
                </div>
                <div class="page_container">

                    <?php for($j=1; $j<=$vocabcntdata["count(*)"]-1; $j++) :?>

                        <div class="page" id="p<?php echo $j?>">
                            <div class="back">
                                <?php $likepicdata=mysqli_fetch_assoc($resultlikepicdata) ?>
                                <img class="likevoc" src="_image/_likedvocabpic/<?php echo $likepicdata['picname'] ?>_liked.jpg">
                                <label class="back_btn">Back</label>
                            </div>
                            <div class="front">
                                <?php $likevocabdata=mysqli_fetch_assoc($resultlikevocabdata) ?>
                                <h2><?php echo $likevocabdata['likedvocab'] ?></h2>
                                <h2><?php echo $likevocabdata['chinese'] ?></h2>
                                <p><?php echo $likevocabdata['definition'] ?></p>
                                <label class="next_btn" for="c<?php echo $j?>">Next</label>
                            </div>
                        </div>
                    <?php endfor ?>    

                    <div class="page" id="p<?php echo $vocabcntdata["count(*)"] ?>">
                        <div class="back end">
                            <h2>單字本結束 再多加一些單字吧</h2>
                            <label class="back_btn">Back</label>
                        </div>
                        <div class="front">
                            <?php $likevocabdata=mysqli_fetch_assoc($resultlikevocabdata) ?>
                            <h2><?php echo $likevocabdata['likedvocab'] ?></h2>
                            <h2><?php echo $likevocabdata['chinese'] ?></h2>
                            <p><?php echo $likevocabdata['definition'] ?></p>
                            <label class="next_btn" for="c<?php echo $vocabcntdata["count(*)"]?>">Next</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>