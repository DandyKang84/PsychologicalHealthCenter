<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/myhomepage/main/body_slide.php"; 
    include_once "dbconnector/db_connect.php";
?>

<div id="body_main">

    <div class="body_left">
        <div class="body_posting_1">
            <div class="latest">
                <ul>
                    <a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/board/board_list.php">
                        <h4 class="text">인기 게시글</h4>
                    </a>
<?php
                        $sql = "select * from board order by hit desc limit 10";
                        $result = mysqli_query($con, $sql);

                        if (!$result)
                            echo "<li><span>아직 게시글이 없습니다!</span></li>";
                        else {
                            while ($row = mysqli_fetch_array($result)) {
                                $regist_day = substr($row["regist_day"], 0, 10);
?>
                                <li class="main_span">
                                    <span class="main_span1_child"><?=$row["subject"]?></span>
                                    <span class="main_span1_child2"><?= $row["name"] ?></span>
                                    <span><?= $regist_day ?></span>
                                </li>
<?php
                            }
                        }
?>
                    
                </ul>
            </div>
        
            <div class="latest">
                <ul>
                <a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/board/board_list.php">
                    <h4 class="text">최근 게시글</h4></a>
<?php
                        $sql = "select * from board order by num desc limit 10";
                        $result = mysqli_query($con, $sql);

                        if (!$result)
                            echo "<li><span>아직 게시글이 없습니다!</span></li>";
                        else {
                            while ($row = mysqli_fetch_array($result)) {
                                $regist_day = substr($row["regist_day"], 0, 10);
?>
                                <li class="main_span">
                                    <span class="main_span1_child"><?= $row["subject"] ?></span>
                                    <span class="main_span1_child2"><?= $row["name"] ?></span>
                                    <span><?= $regist_day ?></span>
                                </li>
<?php
                            }
                        }
?>
                </ul>
            </div>
        </div>
        </div>
        <div class="body_center_main">
        <div class="body_center">
        <div class="main_posting_2">
            <div class="latest">
                <ul>
                <a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/board_img/imageboard_list.php">
                <h4 class="text">이미지 게시글</h4></a>
<?php
                        $sql = "select * from image_board order by num desc limit 10";
                        $result = mysqli_query($con, $sql);

                        if (!$result)
                            echo "<li><span>아직 게시글이 없습니다!</span></li>";
                        else {
                            while ($row = mysqli_fetch_array($result)) {
                                $regist_day = substr($row["regist_day"], 0, 10);
?>
                                <li class="main_span">
                                    <span class="main_span1_child"><?= $row["subject"] ?></span>
                                    <span class="main_span1_child2"><?= $row["name"] ?></span>
                                    <span><?= $regist_day ?></span>
<?php
                            }
                        }
?>
                </ul>
            </div>
            <div class="latest">
                <ul>
                    <h4 class="text">회원 포인트</h4>
<?php
                        $rank = 1;
                        $sql = "select * from members order by point desc limit 10";
                        $result = mysqli_query($con, $sql);

                        if (!$result)
                            echo "<li>아직 가입된 회원이 없습니다!</li>";
                        else {
                            while ($row = mysqli_fetch_array($result)) {
                                $name = $row["name"];
                                $id = $row["id"];
                                $point = $row["point"];
                                // mb_substr 문자열의 일부를 반환합니다.
                                // ( 문자열, 시작 숫자, 길이, 인코딩 = mb_internal_encoding())
                                $name = mb_substr($name, 0, 1) . " * " . mb_substr($name, 2, 1);
?>
                                <li class="main_span">
                                    <span class="main_span2_child1"><?= $rank ?></span>
                                    <span class="main_span2_child2"><?= $name ?></span>
                                    <span class="main_span2_child2"><?= $id ?></span>
                                    <span class="main_span2_child3"><?= $point ?></span>
                                </li>
<?php
                                $rank++;
                            }
                        }
                        mysqli_close($con);
?>
                </ul>
            </div>
        </div>
    </div>
<div class="latest_center">
<iframe class="youtube" src="https://www.youtube.com/embed/Pdeo2raoF2k?autoplay=1&mute=1&loop=1" title="[#오은영리포트 결혼지옥] 남편을 경찰에 신고한 아내, 간절히 바라는 남편의 변화 #엠뚜루마뚜루 #볼꼬양 MBC221219방송" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
</div>   
    <div class="body_right">
        <ul>
            <h4 class="text">인지행동치료 전문과정 수강생 모집</h4>
            <li class="main_span2">
            <a href="https://www.on-maum.com/%ec%9d%b8%ec%a7%80%ed%96%89%eb%8f%99%ec%b9%98%eb%a3%8c-%ec%a0%84%eb%ac%b8%ea%b3%bc%ec%a0%95-%ec%88%98%ea%b0%95%ec%83%9d-%eb%aa%a8%ec%a7%91/">
            <img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/body_main1.png"></a>
            <span class="main_span2_child">인지행동치료 전문과정 (총8주)</span>
            <span>1. 인지행동치료의 이해</span>
            <span>2. 치료적 관계와 사례개념화</span>
            <span>3. 인지행동치료의 구조화</span>
            <span>4. 자동적 사고 찾기</span>
            <span>5. 자동적 사고 수정하기</span>
            <span>6. 스키마 찾기</span>
            <span>7. 스키마 수정하기</span>
            <span>8. 행동기법</span>
 
            </li>   

        </ul>
    </div>

</div>
<div class="specialist_box">
<div class="latest_specialist">
    <a href="https://blog.naver.com/nowbe3/221671630861"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist1.png" alt=""></a>
    <a href="https://blog.naver.com/nowbe3/221708849497"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist2.png" alt=""></a>
    <a href="https://blog.naver.com/nowbe3/221736247747"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist3.png" alt=""></a>
    <a href="https://blog.naver.com/nowbe3/222777014032"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist4.png" alt=""></a>

</div>
<div class="latest_specialist">
    <a href="https://blog.naver.com/nowbe3/222033452260"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist5.png" alt=""></a>
    <a href="http://maumsory.com/25"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist6.png" alt=""></a>
    <a href="https://blog.naver.com/nowbe3/222597307853"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist7.png" alt=""></a>
    <a href="https://blog.naver.com/nowbe3/221650644159"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/specialist8.png" alt=""></a>
</div>
</div>
<div class="latest_end1">
    <img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/end1.png" usemap="#image-map">
    <map name="image-map" >
      <area target="_blank" alt="이용안내" title="프로그램" href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/program/counseling.php" coords="385,280,362,269,357,254,362,238,372,227,387,218,538,218,556,232,558,255,550,272,533,284,399,284" shape="poly">      
      </map>
</div>
<div class="latest_end2">
    <a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/program/program.php">
    <img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/end2.png"></a>
</div>
<div class="zindex">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/myhomepage/program/counseling.php">
<img src="http://<?=$_SERVER['HTTP_HOST']?>/myhomepage/img/top.png" alt=""></a>
</div>
