<?php
//裡面就是各種檢查跟放行何種資料儲存
if(isset($_POST['givepic'])) {

   $gotfile=$_FILES['profilepic'];
   //$_FILES 紀錄從input得到的file的基本資料:name type tmp_name(暫存地點) error size
   //$_FILES['input名字'] 是一個array
   $filename=$gotfile['name'];
//    echo $filename;
    $fileTEP=$gotfile['tmp_name'];
    $fileerror=$gotfile['error'];
    $filesize=$gotfile['size'];
    
    // 取得上傳檔案的檔名
    $filetypepre=explode('.', $filename);
    //explode(用來分割的字串, 主字串)=array[分割後字串前半, 分割後字串後半]
    $filetype=strtolower(end($filetypepre));
    //end取arrray最後的值  strtolower把字串都改成小寫 因為有的檔名是jpg JPG
    $checkarray=array("jpg", "jpeg", "png");

    //in_array(要找的字串, 在哪個array裡找)
    if(in_array($filetype, $checkarray)){
        if($fileerror==0){
            if($filesize<1000000){
                    move_uploaded_file($fileTEP, "selficupload/$filename");

                    require("_require/dbconnection_BDT.php");
                    // echo $_COOKIE["userEmail"];
                    $cookiEmail=$_COOKIE["userEmail"];
                    $sqlgivepic="update memberlist set profilepic='$filename' where loguserEmail='$cookiEmail'";
                    mysqli_query($link, $sqlgivepic);

                    $messagesuc = "YA!頭貼上傳成功";
                    echo "<script type='text/javascript'>alert('$messagesuc');document.location='memberpage_BDT.php'</script>";        
                }else{
                $message1 = "上傳的檔案太大";
                echo "<script type='text/javascript'>alert('$message1');document.location='memberpage_BDT.php'</script>";        
            }

        }else{
            $message2 = "上傳的檔案有誤";
            echo "<script type='text/javascript'>alert('$message2');document.location='memberpage_BDT.php'</script>";    
        }


    } else{
        $message3 = "請上傳jpg/jpeg/png";
        echo "<script type='text/javascript'>alert('$message3');document.location='memberpage_BDT.php'</script>";

    }
}

?>