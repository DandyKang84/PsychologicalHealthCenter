<?php
$con = mysqli_connect("localhost", "root", "123456");
if(!$con){
    die("database connect fail". mysqli_connent_errno());
}

// 코드에서 데이타베이스를 만들기
// mycounselingdb 이라는 데이타베이스가 이미 만들어졌는지 확인
$database_flag = false;
$sql = "show databases";
$result = mysqli_query($con, $sql) or die ("database connect fail". mysqli_connent_error());
while($row = mysqli_fetch_array($result)){
    if($row[0] == "mycounselingdb"){
        $database_flag = true;
        break;
    }
}

// 데이타베이스가 없다면
if($database_flag == false){
    $sql = "create database mycounselingdb";
    $result = mysqli_query($con, $sql) or die("데이타베이스 생성 실패". mysqli_connent_error());
    if($result == true){
        echo "<script>alert('mycounselingdb 데이터베이스가 생성되었습니다.')</script>";
    }
}

// 데이터베이스 선택
$dbcon = mysqli_select_db($con, "mycounselingdb") or ("데이타베이스 선택 실패". mysqli_connent_error());
if($dbcon == false){
    echo "<script>alert('mycounselingdb 데이터베이스 선택이 실패되었습니다.')</script>";
}

// $write_pages = 10 :  보여주는 페이지 수 10페이지 보여줄 것
// $current_page : 현재 페이지
// $total_page : 전체 페이지
// $url : 'message_box.php?mode=$mode&page=$new_page'
function get_paging($write_pages, $current_page, $total_page, $url) { 

    // URL 변형
    // 예) 'message_box.php?mode=$mode&page=$new_page=123' → 'message_box.php?mode=$mode&page=$new_page='
    $url = preg_replace('/&page=[0-9]*/', '', $url) . '&amp;page=';

    // 0. 페이징 시작
    $str = '';

    // 1. 2페이지부터 '처음(<<)' 가기 표시
    ($current_page > 1) ? ($str .= '<a href="' . $url . '1" ><< </a>' . PHP_EOL) : ''; // 'PHP_EOL' = \n

    // 2.한화면에 보여질 시작 페이지와 끝 페이지를 정한다.(= 정하기만 한다.)
    $start_page = (((int)(($current_page - 1) / $write_pages)) * $write_pages) + 1;
    $end_page = $start_page + $write_pages - 1;
    // 마지막 페이지 설정
    if ($end_page >= $total_page) $end_page = $total_page;

    // 3. 11페이지부터 '이전(<)' 가기 표시
    if ($start_page > 1) $str .= '<a href="' . $url . ($start_page - 1) . '" >이전</a>' . PHP_EOL;

    // 4. (총 페이지가 2페이지 이상일 경우부터) 시작 페이지와 끝 페이지를 등록한다.(= 페이지를 만드는 구문에 직접 추가한다.)
    if ($total_page > 1) {
        for ($k = $start_page; $k <= $end_page; $k++) {
            if ($current_page != $k)
                $str .= '<a href="' . $url . $k . '" class="">' . $k . '</a>' . PHP_EOL;
            else
                $str .= '<span style="color:gray">' . $k . '</span>' . PHP_EOL;
        }
    }

    // 5. 총 페이지가 마지막 페이지보다 클 경우, '다음(>)' 가기 표시
    // 예) 20페이지에서 다음을 누르면 21페이지로 이동
    if ($total_page > $end_page){
        $str .= '<a href="' . $url . ($end_page + 1) . '">다음</a>' . PHP_EOL;
    } 

    // 6. 현재 페이지가 총 페이지보다 작을 경우, '마지막(>>)' 가기 표시
    if ($current_page < $total_page) {
        $str .= '<a href="' . $url . $total_page . '"> >></a>' . PHP_EOL;
    }

    // 7. 페이지 등록
    if ($str){
        echo "<li><span>{$str}</span></li>";
    }
    else{
        echo "";
    }
}

function get_paging2($write_pages, $current_page, $total_page, $url) { 

    // URL 변형
    // 예) 'message_box.php?mode=$mode&page=$new_page=123' → 'message_box.php?mode=$mode&page=$new_page='
    $url = preg_replace('/&page=[0-9]*/', '', $url) . 'page=';

    // 0. 페이징 시작
    $str = '';

    // 1. 2페이지부터 '처음(<<)' 가기 표시
    ($current_page > 1) ? ($str .= '<a href="' . $url . '1" >◀ </a>' . PHP_EOL) : '';

    // 2.한화면에 보여질 시작 페이지와 끝 페이지를 정한다.(= 정하기만 한다.)
    $start_page = (((int)(($current_page - 1) / $write_pages)) * $write_pages) + 1;
    $end_page = $start_page + $write_pages +1;

    // 마지막 페이지 설정
    if ($end_page >= $total_page){
        $end_page = $total_page;
    } 

    // 4. (총 페이지가 2페이지 이상일 경우부터) 시작 페이지와 끝 페이지를 등록한다.(= 페이지를 만드는 구문에 직접 추가한다.)
    if ($total_page > 1) {
        for ($i = $start_page; $i <= $end_page; $i++) {
                if ($current_page != $i) {
                    $str .= '<a href="'.$url.$i.'"> '.$i.'</a>' .PHP_EOL;
                } else {
                    $str .= '<a href="'.$url.$i.'"> '.$i.'</a>' .PHP_EOL;
                }
            }
        }

        // 6. 현재 페이지가 총 페이지보다 작을 경우, '마지막(>>)' 가기 표시
        if ($current_page <= $total_page) {
            $str .= '<a href ="'. $url .$total_page.'">  ▶ </a>' . PHP_EOL;
        }

        // 7. 페이지 등록
        if ($str){
            echo "<li><span>{$str}</span></li>";
        }
        else{
            echo "";
        }
}

function alert_back($message){
    echo("
        <script>
        alert('$message');
        history.go(-1)
        </script>
        ");
}

 //공백제거, 슬래쉬제거, 특수문자타입 변경하기
function input_set($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>