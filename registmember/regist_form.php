<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
    <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/registmember.css?after">
    <script src="./js/registmember.js"></script>
    
    <script>
    function check_id() {
    window.open("regist_check_id.php?id=" + document.regist_form.id.value,
   "IDcheck", "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes, status=no, titlebar=no, toolbar=no, location=no, menubar=no");
  }    
    </script>
</head>
<body>
    <header>
<?php 
        include "../main/header_top.php";
        include "../main/header.php";
?>
    </header>
    <div class="header_down_img">
            <img src="../img/counseling8.jpg" alt="">
    </div>
    <div id="regist">
    <form name="regist_form" action="./regist_insert_server.php" method="post">
        <h2>회원가입</h2>
        <!-- <p>에러메시지 자리</p> -->
<?php
    if(isset($_GET['error'])){
      echo "
      <p class='error'> {$_GET['error']} </p>
      ";
    }
    if(isset($_GET['success'])){
      echo "
      <p class='success'> {$_GET['success']} </p>
      ";
    }
?>
        <div id="regist_box">
        <label for="">아이디</label>
        <input class="btn_check_id" type="button" onclick="check_id()" value="ID중복확인"/>
<?php
        if(isset($_GET['id'])){
        $userid = $_GET['id'];
        echo "
        <input class='label_id' type='text' placeholder ='ID' name = 'id' value = '$userid'>
        ";
        }else{
        echo "
        <input class='label_id' type='text' placeholder ='ID' name = 'id'>
        ";
        }
?>
  
        <label for="">이름</label>
<?php
        if(isset($_GET['name'])){
        $username = $_GET['name'];
        echo "
        <input type='text' placeholder ='NAME' name = 'name' value = '$username'>
        ";
        }else{
        echo "
        <input type='text' placeholder ='NAME' name = 'name'>
        ";
        }
?>
  
        <label for="">비밀번호</label>
<?php
        if(isset($_GET['pass1'])){
        $pass = $_GET['pass1'];
        echo "
        <input type='password' placeholder ='PASSWORD' name = 'pass1' value = '$pass'>
        ";
        }else{
        echo "
        <input type='password' placeholder ='PASSWORD' name = 'pass1'>
        ";
        }
  ?>
        <label for="">비밀번호확인</label>
        <input type="password" placeholder ="PASSWORD_CHECK" name = "pass2">

        <label for="">이메일</label>
<?php
            if(isset($_GET['email'])){
            $email = $_GET['email'];
            echo "<input type='text' placeholder ='EMAIL' name = 'email' value = '$email'>";
            }else{
            echo "<input type='text' placeholder ='EMAIL' name = 'email'>";
            }
  ?>
        <input class="btn_register1" type="submit" onclick="check_input()" value="회원가입"/>  
        <input class="btn_register2" type="button" onclick="reset_form()" value="취소"/> 
        <a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/login/login_form.php" class="save">로그인 페이지</a>
        </form>
        </div>
        </div>
    <footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>