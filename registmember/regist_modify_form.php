<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>회원정보수정</title>
  <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/registmember.css?after">
    <script src="./js/registmember.js"></script>
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
<?php
    include("../dbconnector/db_connect.php");
    $sql = "select * from members where id ='$userid'";
    $result = mysqli_query($con,$sql);
    // select쿼리의 결과값을 한번에 한개의 데이터 행을 배열의 형태로 가져옴
    $row = mysqli_fetch_array($result);

    $pass = $row['pass'];
    $name = $row['name'];
    $email = $row['email'];

    mysqli_close($con);
?>
  <main>
  <form name= "regist_form" action="./regist_modify_server.php?id=<?=$userid?>" method ="post">
    <h2>회원정보수정</h2>
<?php
    if(isset($_GET['error'])){
      echo "<p class = 'error'>{$_GET['error']}</p>";
    }
    if(isset($_GET['success'])){
      echo "<p class = 'success'>{$_GET['success']}</p>";
    }
?>  
    <div class="form id">
            <div class="column1">아이디</div>
            <div class="column2">
        <input type="text" name="id" value="<?=$userid?>" readonly>
            </div>                 
          </div>
          <div class="clear"></div>

          <div class="form">
            <div class="column1">비밀번호</div>
            <div class="column2">
          <input type="password" name="pass1" value="">
            </div>                 
          </div>
          <div class="clear"></div>
          <div class="form">
            <div class="column1">비밀번호 확인</div>
            <div class="column2">
          <input type="password" name="pass2" value="">
            </div>                 
          </div>
          <div class="clear"></div>
          <div class="form">
            <div class="column1">이름</div>
            <div class="column2">
          <input type="text" name="name" value="<?=$name?>">
            </div>                 
          </div>
          <div class="clear"></div>
          <div class="form email">
            <div class="column1">이메일</div>
            <div class="column2">
          <input type="text" name="email" value="<?=$email?>">
            </div>                 
          </div>
          <div class="clear"></div>
          <div class="bottom_line"> </div>
          <div class="buttons">
          <input class="btn_register1" type="button" onclick="check_input()" value="저장"/>  
          <input class="btn_register2" type="reset" value="취소"/> 
        </div>
  </form>
  </main>
    <footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>