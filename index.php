<?php
include_once $_SERVER['DOCUMENT_ROOT']."/myhomepage/dbconnector/create_statement.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statement</title>
    <script src="https://kit.fontawesome.com/1288cb9c39.js" defer crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/maincss/body.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/maincss/main.css?after">
    <script src="./mainjs/body_slide.js"></script>
</head>
<body onload = "slide_func()">
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT']."/myhomepage/main/header_top.php";?>
    </header>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT']."/myhomepage/main/header.php";?>
    </header>
    <section>
        <?php include $_SERVER['DOCUMENT_ROOT']."/myhomepage/main/body.php";?>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT']."/myhomepage/main/footer.php";?>
    </footer>
    
</body>
</html>