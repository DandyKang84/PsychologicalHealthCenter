<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>게시판</title>
	<link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
	<link rel="stylesheet" type="text/css" href="./css/board.css">
<script src="./js/board.js"></script>
</head>
<body> 
	<header>
<?php 
        include "../main/header_top.php";
        include "../main/header.php";
?>
    </header> 
	<div class="header_down_img">
        <img src="../img/sky.jpg" alt="">
    </div>
	<section>
   		<div class="board_box">
	    	<h3 class="board_title">게시판 > 글 쓰기</h3>
			<form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
				<ul class="board_form">
					<li>	
						<span class="column1">이름 : </span>
						<span class="column2"><?=$username?></span>
					</li>		
					<li>
						<span class="column1">제목 : </span>
						<span class="column2"><input name="subject" type="text"></span>
					</li>	    	
					<li class="text_area">	
						<span class="column1">내용 : </span>
						<span class="column2">
							<textarea name="content"></textarea>
						</span>
					</li>
					<li>
						<span class="column1"> 첨부 파일</span>
						<span class="column2"><input type="file" name="upfile"></span>
					</li>
				</ul>
				<ul class="buttons">
					<li><button type="button" onclick="check_inputboard()">저장</button></li>
					<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
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
