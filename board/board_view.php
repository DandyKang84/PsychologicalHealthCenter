<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>게시판</title>
	<link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<link rel="stylesheet" type="text/css" href="./css/ripple.css">
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
		<div class="board_box">
			<h3 class="board_title">게시판 > 내용보기</h3>
<?php
			include("../dbconnector/db_connect.php");
			if (isset($_SESSION["id"]) && isset($_SESSION["name"])){
				$userid = $_SESSION["id"];
				$username = $_SESSION["name"];
			}else {
				alert_back('board_view error:30 회원전용 게시판입니다.');
                exit();
			}
			$num  = $_GET["num"];
			$page  = $_GET["page"];

			$sql = "select * from board where num=$num";
			$result = mysqli_query($con, $sql);

			$row = mysqli_fetch_array($result);
			$userid = $row["id"];
			$username = $row["name"];
			$regist_day = $row["regist_day"];
			$subject = $row["subject"];
			$content = $row["content"];

			$file_name = $row["file_name"];
			$file_type = $row["file_type"];
			$file_copied_name = $row["file_copied"];
			$hit = $row["hit"];
			// str_replace (변경대상 문자, 변경하려는 문자, 변수or바꾸고자하는 문자열(변수 수))
			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			$new_hit = $hit + 1;
			$sql = "update board set hit=$new_hit where num=$num";   
			mysqli_query($con, $sql);
?>		
	    <ul class="view_content">
			<li>
				<span class="column1"><b>제목 :</b> <?=$subject?></span>
				<span class="column2"><?=$username?> | <?=$regist_day?></span>
			</li>
			<li>
<?php
				if($file_name) {
					// $file_copied_name = 2023_01_10_08_10_20_flower.png
					$real_name = $file_copied_name;
					$file_path = "../database/".$real_name;
					// 파일사이즈를 구해주는 함수 filesize
					$file_size = filesize($file_path);
					// board_download.php, primarykey num, 2023_01_10_08_10_20_flower.png, flower, png
					echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
					<a href='board_download.php?&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[첨부파일 저장]</a><br><br>";
					}
?>
				<?=$content?>
			</li>		
	    </ul>
		<div class="ripple">
          <div class="ripple1">댓글</div>
          <div class="ripple2">
<?php
          $sql = "select * from `image_board_ripple` where parent='$num' ";
          $ripple_result = mysqli_query($con, $sql);
          while ($ripple_row = mysqli_fetch_array($ripple_result)) {
              $ripple_num = $ripple_row['num'];
              $ripple_id = $ripple_row['id'];
              $ripple_nick = $ripple_row['nick'];
              $ripple_date = $ripple_row['regist_day'];
              $ripple_content = $ripple_row['content'];
              $ripple_content = str_replace("\n", "<br>", $ripple_content);
              $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
?>
            <div class="ripple_title">
              <ul>
                <li><?= $ripple_id . "&nbsp;&nbsp;" . $ripple_date ?></li>
                <li class="mdi_del">
<?php
				// 관리자모드이거나, 보모글을 쓴 유저라면 삭제기능 부여
                if ($_SESSION["id"] === "admin" || $_SESSION["id"] === $ripple_id) {			
                    echo '
                  <form style="display:inline" action="board_ripple.php" method="post">
                    <input type="hidden" name="page" value="'.$page.'">
                    <input type="hidden" name="hit" value="' . $hit . '">
                    <input type="hidden" name="mode" value="delete_ripple">
                    <input type="hidden" name="num" value="' . $ripple_num . '">
                    <input type="hidden" name="parent" value="' . $num . '">
                    <span>' . $ripple_content . '</span>
                    <input type="submit" value="삭제">
                  </form>';
                }else{
                  echo '
                    <span>' . $ripple_content . '</span>';
                }
?>
                </li>
              </ul>
            </div>
<?php
           }
           mysqli_close($con);
?>
            <form name="ripple_form" action="board_ripple.php" method="post">
				<input type="hidden" name="mode" value="insert_ripple">
				<input type="hidden" name="parent" value="<?= $num ?>">
				<input type="hidden" name="hit" value="<?= $hit ?>">
				<input type="hidden" name="page" value="<?= $page ?>">
				<div class="ripple_insert">
					<div class="ripple_textarea"><textarea name="ripple_content" rows="3" cols="110" style="border: none"></textarea>
					</div>
					<div ><button class="ripple_button">입력</button>
					</div>
				</div>
            </form>
          </div>
        </div>
	    <ul class="buttons">
			<li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>
			<li><button onclick="location.href='board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
			<li><button onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
			<li><button onclick="location.href='board_form.php'">글쓰기</button></li>
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
