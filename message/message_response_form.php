<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>쪽지보내기</title>
	<link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
  <link rel="stylesheet" type="text/css" href="./css/message.css">
<script src="./js/message.js"></script>
</head>
<body>
<header>
<?php 
        include "../main/header_top.php";
        include "../main/header.php";
?>
    </header>
<section>
<div class="header_down_img">
    <img src="../img/counseling8.jpg" alt="">
  </div>
  <<div class = "message_box">
    <h3 class = "write_title">답변 쪽지 보내기</h3>
<?php
      $num = $_GET["num"];

      include("../dbconnector/db_connect.php"); 
      $sql = "select * from message where num = $num";
      $result = mysqli_query($con, $sql);
      // select쿼리의 결과값을 한번에 한개의 데이터 행을 배열의 형태로 가져옴
      $row = mysqli_fetch_array($result);
      $send_id = $row["send_id"];
      $rv_id = $row["rv_id"];
      $subject = $row["subject"];
      $content = $row["content"];

      $subject = "RE : ".$subject;

      $contnet = "> ".$content;
      // str_replace (변경대상 문자, 변경하려는 문자, 변수or바꾸고자하는 문자열(변수 수))
      $content = str_replace("\n","\n>",$content);
      $content = "\n\n\n-------------------------------------------\n".$content;

      $result2 = mysqli_query($con, "select name from members where id='$send_id'");
      // select쿼리의 결과값을 한번에 한개의 데이터 행을 배열의 형태로 가져옴
      $record = mysqli_fetch_array($result2);
      $send_name = $record["name"];
?>
    <form action="message_insert.php" name = "message_form" method = "post">
      <input type="hidden" name = "rv_id" value="<?=$send_id?>">
      <input type="hidden" name = "send_id" value="<?=$userid?>">
      <div id="write_msg">
        <ul>
          <li>
            <span class = "column1">보내는 사람 : </span>
            <span class = "column2"><?=$userid?> </span>
          </li>
          <li>
            <span class = "column1">수신 아이디 : </span>
            <span class = "column2"><?=$send_name?>(<?=$send_id?>)</span>
          </li>
          <li>
            <span class = "column1">제목 :</span>
            <span class = "column2"><input type="text" name="subject" value="<?=$subject?>"></span>
          </li>
          <li id="text_area">
            <span class="column1">글 내용 :</span>
            <span class="column2"><textarea name="content"><?=$content?></textarea></span>
          </li>
        </ul>
        <button type="button" onclick="check_input_response()">보내기</button>
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