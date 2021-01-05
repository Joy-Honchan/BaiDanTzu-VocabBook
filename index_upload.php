<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       div#picture {
           background-color : red;
           width:300px;
           height:300px;
       }
    </style>
</head>
<body>
    <form action="uploadfile.php" method="post" enctype="multipart/form-data">
    <!-- enctype設定編碼方式 multipart/form-data可以選擇多種不同形式 不一定是圖片-->
    <input type="file" name="profilepic">
    <!-- type="file" 會呈現一個可從資料夾選擇東西的方式-->
    <button type="submit" name="givepic">上傳頭貼</button>
    </form>
</body>
</html>