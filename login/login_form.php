

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>로그인</title>
    <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="../registmember/css/registmember.css?after">
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
    <!-- 로그인 폼 -->
    <form name="member_form" action="./login_server.php" method="post">
    <h2>로그인</h2>
    <!-- 에러메세지를 출력 -->
<?php
      if(isset($_GET['error'])){
        echo "<p class='error'> {$_GET['error']} </p>";
      }

      if(isset($_GET['success'])){
        echo "<p class='success'> {$_GET['success']} </p>";
      }
?>
    <label for="">아이디</label>
    <input type='text' placeholder ='아이디' name = 'id'>
    
    <label for="">비밀번호</label>
  <input type='password' placeholder ='비밀번호' name = 'pass1'>

    <!-- 데이타를 보내는방법은 두가지 있다 input submit와 button  -->
    <input type="submit" class="btn_register1" value="로그인">  

    <a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/registmember/regist_form.php" class="save">회원가입하러가기(회원가입)</a>
  </form>
    <footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>