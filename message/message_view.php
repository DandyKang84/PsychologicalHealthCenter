<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>쪽지보내기</title>
	<link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
  <link rel="stylesheet" type="text/css" href="./css/message.css">
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
  <div id = "message_box">
    <h3 class="title">
<?php
    $mode = $_GET["mode"];
    $num = $_GET["num"];
    
    include("../dbconnector/db_connect.php");  
    $sql = "select * from message where num = $num";
    $result = mysqli_query($con, $sql);
    // select쿼리의 결과값을 한번에 한개의 데이터 행을 배열의 형태로 가져옴
    $row = mysqli_fetch_array($result);
    $send_id = $row["send_id"];
    $rv_id = $row["rv_id"];
    $regist_day = $row["regist_day"];
    $subject = $row["subject"];
    $content = $row["content"];
    // str_replace (변경대상 문자, 변경하려는 문자, 변수or바꾸고자하는 문자열(변수 수))
    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    if($mode == "send"){
      $result2 = mysqli_query($con, "select name from members where id='$rv_id'");
    }else{
      $result2 = mysqli_query($con, "select name from members where id
      ='$send_id'");
    }
    // select쿼리의 결과값을 한번에 한개의 데이터 행을 배열의 형태로 가져옴
    $record = mysqli_fetch_array($result2);
    $msg_name = $record["name"];

    if($mode == "send"){
      echo "송신 쪽지함 > 내용보기";
    }else{
      echo "수신 쪽지함 > 내용보기";
    }
    mysqli_close($con);
?>      
    </h3>
    <ul class = "view_content">
      <li>
        <span class = "column1"><b>제목 :</b><?=$subject?></span>
        <span class = "column2"><?=$msg_name?> | <?=$regist_day?></span>
      </li>
      <li>
        <?=$content?>
      </li>
    </ul>
    <ul class = "buttons">
      <li><button onclick = "location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
      <li><button onclick = "location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
<?php
    if($mode != "send"){
      echo "<li><button onclick = 'location.href='message_response_form.php?num=$num''>답변 쪽지</button></li>";
    }
?>
      <li><button onclick = "location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li>
    </ul>
  </div>
</section>
<footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>