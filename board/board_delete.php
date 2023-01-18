<?php
  session_start();
  $userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
  $username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
  if (!$userid ){
    alert_back('board_delete error:06 로그인 후 이용해 주세요!');
    exit();
  }
	include("../dbconnector/db_connect.php");

  $num = $_GET["num"];
  $page = $_GET["page"];
  $userid = $_GET["id"];

  $sql = "select * from board where num = $num";
  // 삭제하기전에 해당아이디가 맞는지 점검
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  //파일이 있으면 경로를 찾아서 삭제
  $copied_name = $row["file_copied"];

  if ($copied_name){
    $file_path = "../database/".$copied_name;
    unlink($file_path);
    }
  // 게시판에서 해당되는 글을 삭제
  $sql = "delete from board where num = $num";
  mysqli_query($con, $sql);
  mysqli_close($con);

  echo "
      <script>
          location.href = 'board_list.php?page=$page';
      </script>
    ";
?>

