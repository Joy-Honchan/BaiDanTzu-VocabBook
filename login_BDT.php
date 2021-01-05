<?php

//以下這句可以不顯示notice
error_reporting(E_ERROR | E_WARNING | E_PARSE);

    require("_require/dbconnection_BDT.php");

if(isset($_POST["enterregister"])){    
// if(@require("_require/dbconnection_BDT.php")){
//     echo "OK";
// } 
//確認有連上資料庫
    $sql="insert into memberlist (username, loguserEmail, logpassWord) values ('{$_POST["reguserName"]}', '{$_POST["reguserEmail"]}', '{$_POST["regpassWord"]}')"			
    // var_dump($sql);
    mysqli_query($link, $sql);
    $sUseremail = $_POST["reguserEmail"];
    $tok= strtok($sUseremail, "@");
    $sqlliketable="create table $tok (vocabNO int(3) AUTO_INCREMENT KEY, likedvocab varchar(30) not null)";
    mysqli_query($link, $sqlliketable);
    $message = "註冊成功!請重新登入";
    echo "<script type='text/javascript'>alert('$message');</script>";
    mysqli_close($link);
    //註冊後會新增資料到memberlist 還會建立一個table名字是信箱的strtok
}
if (isset($_POST["entermember"]))
{
    // require("_require/dbconnection_BDT.php");
        $sUseremail = $_POST["loguserEmail"];
        $sUserPass=$_POST["logpassWord"];
        // echo $sUserName;
$sqlcheck="select username loguserEmail, logpassWord from memberlist where loguserEmail='$sUseremail'";
$result = mysqli_query( $link, $sqlcheck );
$row = mysqli_fetch_assoc ( $result );
// var_dump($result);

if($sUserPass!=$row["logpassWord"]){
    mysqli_close($link);
    $errormessage = "密碼錯誤";
    echo "<script type='text/javascript'>alert('$errormessage');</script>";
} else{
            setcookie("userEmail", $sUseremail);
            header("Location: index_BDT.php");
            mysqli_close($link);
            exit();
}
    }
    if (isset($_GET["logout"]))
{
	setcookie("userEmail", "Guest", time() - 3600);
	header("Location: index_BDT.php");
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入/註冊備單字</title>
    <link rel="stylesheet" href="_css/login_BDT.css">
    <script src="_js/login_BDT.js"></script>

</head>

<body>
    <div class="workframe">
        <div class="leftframe"></div>
        <div class="rightframe">
            <div class="loginslogon">
                背單字，沒那麼難
            </div>
            <div class="loginframe">
                <form action="" method="POST" >
                    <span style="font-size: 40px;">登入</span><br><br>
                    <label for="loguserEmail"><span>信箱:</span></label>
                    <input type="text" class="inputs" id="loguserEmail" name="loguserEmail" required onkeypress="checkInput(event)"><br><br>
                    <label for="logpassWord"><span>密碼:</span></label>
                    <input type="password" class="inputs" id="logpassWord" name="logpassWord" required>
                    <br><br>
                    <a href="index_BDT.php"><button type="button" id="gobackindex">回首頁</button></a>&nbsp;&nbsp;
                    <button type="button" id="goregister" onclick="gotoreg()">還沒加入會員?點我註冊</button>&nbsp;&nbsp;
                    <button name="entermember" id="entermember" type="submit">確認</button>

                </form>
            </div>
            <div class="registerframe">
                <form action="" method="POST">
                    <span style="font-size: 40px;">註冊</span><br><br>
                    <label for="reguserName"><span>姓名:</span></label>
                    <input type="text" class="inputs" id="reguserName" name="reguserName" required onkeypress="checkname(event)"><br><br>
                    <label for="reguserEmail"><span>信箱:</span></label>
                    <input type="text" class="inputs" id="reguserEmail" name="reguserEmail" required onkeypress="checkInput(event)"><br><br>
                    <label for="regpassWord"><span>密碼:</span></label>
                    <input type="password" class="inputs" id="regpassWord" name="regpassWord" required>
                    <br><br>
                    <a href="index_BDT.php"><button type="button" id="gobackindex">回首頁</button></a>&nbsp;&nbsp;
                    <button type="button" id="gobackmember" onclick="gotolog()">已經是會員?點我回登入頁</button>&nbsp;&nbsp;
                    <button name="enterregister" id="enterregister" type="submit" >送出</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>