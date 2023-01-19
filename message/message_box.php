<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>쪽지보내기</title>
	  <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/message.css?after">
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
  <div class = "message_box">
    <h3>
<?php
			include("../dbconnector/db_connect.php");
      if(isset($_GET["page"]) || !empty($_GET["page"])){
        $page = $_GET["page"];
      }else{
        $page = 1;
      } 
      $scale = 5;
      $start =($page -1) * $scale;
      $mode = $_GET["mode"];

      if($mode == "send"){
        echo "송신 쪽지함 > 목록보기";
      }else{
        echo "수신 쪽지함 > 목록보기";
      }
?>      
    </h3>
      <div>
        <ul class = "message">
          <li>
            <span class = "column1">번호</span>
            <span class = "column2">제목</span>
            <span class = "column3">
<?php
              if($mode == "send"){
                echo "받은이";
              }else{
                echo "보낸이";
              }
?>
            </span>
            <span class = "column4">등록일</span>
          </li>
<?php
          // 전체 페이지를 구한다
          if($mode == "send"){
            $sql = "select count(*) from message where send_id='$userid' order by num desc ";
          }else {
            $sql = "select count(*) from message where rv_id='$userid' order by num desc ";
          }
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);
          $total_record=  $row['count(*)'];
          $total_page = ceil($total_record / $scale);
          // 페이지에 있는 시작위치와 끝위치 레코드 셋을 가져온다.
          if($mode == "send"){
            $sql = "select * from message where send_id='$userid' order by num desc limit $start , $scale";
          }else {
            $sql = "select * from message where rv_id='$userid' order by num desc limit $start , $scale";
          }

          $result = mysqli_query($con, $sql);
          // 보여줄 전체갯수가 34개고 2페이지(10)를 보여달라고 할때 34 - 10 = 24 보여줘야할 번호 순서를 정해준다
          $number = $total_record - $start;
          // 해당된 페이지 가져올 레코드 수를 출력해준다
          while( $row = mysqli_fetch_array($result)){
            $num = $row["num"]; 
            $subject = $row["subject"]; 
            $regist_day = $row["regist_day"]; 
          
            if($mode == "send"){
              $msg_id = $row["rv_id"];
            }else{
              $msg_id = $row["send_id"];
            }
            
            $result2 = mysqli_query($con, "select name from members where id='$msg_id'");
            $record = mysqli_fetch_array($result2);
            $msg_name = $record["name"];
?>          
          <li class="message_li">
            <span class = "column1"><?=$number?></span>
            <span class = "column2"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
            <span class = "column3"><?=$msg_name?>(<?=$msg_id?>)</span>
            <span class = "column4"><?=$regist_day?></span>
          </li>
<?php
            $number--;
          }
          mysqli_close($con); 
?>
        </ul>
        <ul class = "page_num">
<?php
          $url = 'message_box.php?mode='.$mode.'&page=';
          echo get_paging($scale, $page, $total_page, $url);     
?>          
        </ul>  
        <ul class = "buttons">
          <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
          <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
          <li><button onclick="location.href='message_form.php?mode=send'">쪽지보내기</button></li>
        </ul>     
      </div>
  </div>
</section>
<footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</body>
</html>