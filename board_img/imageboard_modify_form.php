<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>이미지게시판</title>
    <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/form.css?after">
    <script src="./js/form.js"></script>
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
  <section>
    <div class="imgboard_box">
    <h3 class="imgboard_title">이미지게시판 > 수정하기</h3>
<?php
    include("../dbconnector/db_connect.php");
    if (!$userid) {
    alert_back('imageboard_modify_form error:28 로그인 후 이용해 주세요!');
    exit();
    }
 
  if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
      $num = $_POST["num"];
      $page = $_POST["page"];

      $sql = "select * from image_board where num=$num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      $writer = $row["id"];
      //세션값이 없거나 또는 사용자가 해당글의 사용자, 관리자가 아닐 때는 수정권한이 없다
      if (!isset($userid) || ($userid !== $writer && $level !== '1')) {
          alert_back('수정권한이 없습니다.');
          exit();
      }
      $name = $row["name"];
      $subject = $row["subject"];
      $content = $row["content"];
      $file_name = $row["file_name"];

      if (empty($file_name)) $file_name = "없음";
  }
?>
      <form name="imgboard_title" method="post" action="imageboard_dui.php" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="modify">
        <input type="hidden" name="num" value=<?= $num ?>>
        <input type="hidden" name="page" value=<?= $page ?>>
        <ul class="board_form">
          <li>
            <span class="column1">이름 : </span>
            <span class="column2"><?=$username?></span>
          </li>
          <li>
            <span class="column1">제목 : </span>
            <span class="column2"><input style="border: none" name="subject" type="text" value=<?= $subject ?>></span>
          </li>
          <li class="text_area">
            <span class="column1">내용 : </span>
            <span class="column2">
              <textarea name="content" style="border: none"><?= $content ?></textarea>
            </span>
          </li>
          <li>
            <span class="column1"> 첨부 파일</span>
            <span class="column2"><input type="file" name="upfile">
              <input class="file_input_modify" type="checkbox" value="yes" name="file_delete">&nbsp;파일 삭제하기
              <br>현재 파일 : <?= $file_name ?>
            </span>
          </li>
        </ul>
        <ul class="buttons">
          <li><button type="button" onclick="modifycheck_input()">수정완료</button></li>
          <li><button type="button" onclick="location.href='imageboard_list.php'">목록</button></li>
        </ul>
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