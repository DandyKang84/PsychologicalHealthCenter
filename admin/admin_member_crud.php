<?php
  include("../dbconnector/db_connect.php");
  session_start();
  $level = isset($_SESSION['level']) ? $_SESSION['level'] : "";

  $mode = $_GET['mode'];

  switch ($mode) {
    case "update":
      $num = $_POST['num'];
      $level = $_POST['level'];
      $point = $_POST['point'];

      $sql_update = "update members set level = $level, point = $point where num = $num";
      $result = mysqli_query($con, $sql_update);
      mysqli_close($con);

      if ($result)
        alert_back('회원정보 수정 완료');
      else
        alert_back('admin_member_curd error:21 회원정보 수정 실패');

      header("location: http://{$_SERVER['HTTP_HOST']}/myhomepage/admin/admin_form.php");
      break;

    case "delete":
      $num = $_GET['num'];
      $sql_delete = "delete from members where num = $num";
      $result = mysqli_query($con, $sql_delete);
      mysqli_close($con);

      if ($result)
        alert_back('삭제할 게시글을 선택해 주세요');
      else
        alert_back('admin_member_curd error:35 회원정보 삭제 실패');

      header("location: http://{$_SERVER['HTTP_HOST']}/myhomepage/admin/admin_form.php");
      break;

    case "board_delete":
      $num_item = 0;

      if (isset($_POST['item']))
        $num_item = count($_POST['item']);
      else
        alert_back('삭제할 게시글을 선택해 주세요');

      $result = null;

      for ($i = 0; $i < $num_item; $i++) {
        $num = $_POST['item'][$i];

        $sql_select = "select * from board where num = $num";
        $result_set = mysqli_query($con, $sql_select);
        $row = mysqli_fetch_array($result_set);

        // 게시판글을 지우면 그안에있는 첨부파일도 삭제해라
        $copied_name = $row['file_copied'];
        if ($copied_name) {
          $file_path = $_SERVER['DOCUMENT_ROOT'] . "/myhomepage/database/" . $copied_name;
          unlink($file_path);
        }
        $sql_delete = "delete from board where num = $num";
        $result = mysqli_query($con, $sql_delete);
      }

      if ($result)
        alert_back('게시글을 삭제하였습니다');
      else
        alert_back('admin_member_curd error:70 게시글 삭제 실패');

      header("location: http://{$_SERVER['HTTP_HOST']}/myhomepage/admin/admin_form.php");
      break;
  }

  mysqli_close($con);
?>