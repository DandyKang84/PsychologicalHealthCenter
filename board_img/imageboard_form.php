<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <img src="../img/counseling6.jpg" alt="">
    </div>
    <section>       
        <div class="imgboard_box">
            <h3 class="imgboard_title">이미지게시판 > 글쓰기</h3>
            <form name="imageboard_form" method="post" action="imageboard_dui.php" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="insert">
                <ul class="board_form">
                    <li>
                        <span class="column1">이름 : </span>
                        <span class="column2"><?=$username?></span>
                    </li>
                    <li>
                        <span class="column1">제목 : </span>
                        <span class="column2">
                            <input type="text" name="subject" style="border: none">
                        </span>
                    </li>
                    <li class="text_area">
                        <span class="column1">내용 : </span>
                        <span class="column2">
                            <textarea name="content" style="border: none"></textarea>
                        </span>
                    </li>
                    <li>
                        <span class="column1">첨부파일</span>
                        <span class="column2">
                        <input class="file_input" type="file" name="upfile" style="border: none">
                        </span>
                    </li>
                </ul>
                <ul class="buttons">
                    <li><button type="button" onclick="check_input()">저장</button></li>
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