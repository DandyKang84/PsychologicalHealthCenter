<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>상담예약 및 절차</title>
    <link rel="stylesheet" type="text/css" href="../maincss/header.css?after">
    <link rel="stylesheet" type="text/css" href="../maincss/footer.css?after">
    <link rel="stylesheet" type="text/css" href="./css/counseling.css?after">
</head>
<body>
<header>
<?php 
        include "../main/header_top.php";
        include "../main/header.php";
?>
    </header> 
    <div class="header_down_img">
    <img src="../img/header_regist.png" alt="">
    </div> 

    <div class="program_regist">
        <h2>상담예약 안내</h2>
        <ul class="program_regist_info">
        <img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/program1.png">
        
            <li>마음소리 모든 프로그램은<br>전면 예약제로 진행 됩니다.</li>
            <li>전화 및 홈페이지를 통한<br>예약이 가능합니다.</li>
            <li>예약시간을 조율한 후 1회분<br>상담료를 납부할 시 예약이<br>확정됩니다.</li>
            <li>예약일 하루 전 오후 6시까지<br>취소/변경 통보 시 상담료<br>전액을 환불해드리며,<br>그 이후에는 환불이 불가 합니다.</li>
        </ul>
    </div>
     <div class="program_regist">
        <h2>상담 절차</h2>
        <ul class="program_regist_info2">
        <img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/program2.png">
            <div class="program_regist_info3">
            <li class="program_regist_info3_child">02-1588-1533</li>
            <li>■ 예약관련안내문자<br>
                ■ 상담료 입금<br>
                ■ 예약확정<br>
                ■ 예약일 하루 전 안내문자<br>
            </li>
            <li>■ 예약시간 10분 전 내소<br>
                ■ 면담지 작성<br>
                ■ 문제 이해, 목표 설정<br>
                ■ 상담 오리엔테이션<br>
                ■ 심리검사 안내 (필요시)<br>
            </li>
             <li>[선택사항]<br>
                ■ 종합심리검사<br>
                ■ 정서검사<br>
                ■ 진로검사<br>
                ■ 지능검사<br>
                ■ 성격검사<br>
            </li>
             <li>■ 상담 마무리<br>
                ■ 치료적 제언<br>
                ■ 재발방지를 위한 개입<br>
            </li>
            <li>■ 재발방지 위한 간헐적상담<br>
                ■ 상담성과를 삶속에 정착함<br>
            </li>
            </div>
        </ul>
    </div>
</body>
    <footer>
<?php 
        include "../main/footer.php"; 
?>
    </footer>
</html>