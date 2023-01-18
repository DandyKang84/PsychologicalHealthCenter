<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>쪽지보내기</title>
	<link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/message.css?after">
  <script src="./js/message.js"></script>
</head>
<body>
    <header>
<?php 
    include "../main/header_top.php";
    include "../main/header.php";
?>
    </header>
<?php
  if(!isset($userid) || empty($userid)){
    echo("
    <script>
      alert('로그인 후 이용해주세요');
      history.go(-1);
    </script>");
    exit();
  }
?>
	<div class="header_down_img">
    <img src="../img/backimg1.jpg" alt="">
  </div>
  <div class="message_box">
    <h3 class="write_title">쪽지보내기</h3>
    <ul class="top_buttons">
      <li><span><a href="message_box.php?mode=rv">수신함</a></span></li>
      <li><span><a href="message_box.php?mode=send">송신함</a></span></li>
    </ul>
    <form name="message_form" method = "post" action= "message_insert.php">
      <div class="write_msg">
        <ul>
          <li>
            <span class="column1">보내는 사람 :</span>
            <span class="column2"><input type="text" name ="send_id" value="<?=$userid?>" readonly></span>
          </li>
          <li>
            <span class="column1">받는 사람 :</span>
            <span class="column2"><input type="text" name="rv_id"></span>
          </li>
          <li>
            <span class="column1">제목 :</span>
            <span class="column2"><input type="text" name="subject"></span>
          </li>
          <li class="text_area">
            <span class="column1">내용 :</span>
            <span class="column2"><textarea class="area_box" name="content" rows="25%" cols="200px" ></textarea></span>
       
          </li>
        </ul>
       <button tyep = "button" onclick = "check_input()">보내기</button>
      </div>    
    </form>
  </div>
</section>
<footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>