<?php
    include("../dbconnector/db_connect.php");
	date_default_timezone_set('Asia/Seoul');
    session_start();
	$userid = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
	$username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
	if (!$userid ){
		alert_back('board_modify error:08 로그인 후 이용해 주세요!');
		exit();
	}

	$userid = $username =  $num = $page =  $subject = $content = $user_info ="";
    $num = $_POST["num"];
    $page = $_POST["page"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];  

    if(isset($_POST["subject"]) && isset($_POST["content"])){
        // htmlspecialchars 이 함수는 문자열에서 특정한 특수 문자를 HTML 엔티티로 변환한다. 이함수를 사용하면 악성 사용자로 부터 XSS 공격을 방지 할 수 있다
        $subject = htmlspecialchars($subject, ENT_QUOTES);
        $content = htmlspecialchars($content, ENT_QUOTES);

        $sql = "select * from members where id = '$userid'";
        $select_result = mysqli_query($con, $sql);

        if(mysqli_num_rows($select_result) !== 0){
            header("location: board_list.php?error=board_modify error:27 첨부파일 저장 실패..");
            exit(); 
        }else{
            $regist_day = date("Y-m-d (H:i)");  
            $upload_dir = '../database/';

            if(!isset($_FILES["upfile"]["name"]) && isset($_FILES["upfile"]["error"])){
                $upfile_name = "";
                $upfile_type = "";
                $copied_file_name = "";
            }
            //1. 파일배열에서 5개 항목을 받는다.
            $upfile_name = $_FILES["upfile"]["name"];
            $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
            $upfile_type = $_FILES["upfile"]["type"];
            //2. 안되면 php ini에서 최대 크기 수정!
            $upfile_size = $_FILES["upfile"]["size"];
            $upfile_error = $_FILES["upfile"]["error"];
            //2. 파일을 파일명과 확장자를 분리시킨다.(memo.sql) => ['memo','sql']
            $file = explode(".", $upfile_name);
            $file_name = $file[0];
            $file_ext  = $file[1];
            //3. 서버에 저장할 파일명을 중복되지 않기 하기위해서 날짜명_시간_파일명.확장자 만든다.
            $copied_file_name = date("Y_m_d_H_i_s").$upfile_name; 
            // ./data/2023_01_11_11_11_11_memo.sql 다 합친것  
            $uploaded_file = $upload_dir.$copied_file_name;
            move_uploaded_file($upfile_tmp_name, $uploaded_file);
            if ($upfile_size > 100000000) {
                header("location: board_list.php?error=board_modify error:55 첨부파일 100MB 이상 안됩니다.");
                exit(); 
                }
                //삭제 체크 체크박스가 선택이 되었다면 기존의 파일을 삭제한다.
            if($_POST['file_check'] == 'on'){
                $file_name = $_POST["file_name"];
                $copied_name= $_POST['file_copied'];

                if($copied_name){
                    $file_path = $_SERVER['DOCUMENT_ROOT'].'/myhomepage/database/'.$copied_name;
                    unlink($file_path); 
                }                
            }
            $sql = "update board set id='$userid', subject='$subject', content='$content', regist_day='$regist_day',file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' ";
            $sql .= " where num=$num";

            mysqli_query($con, $sql);        
        }
    } 
    mysqli_close($con);     
    echo "
        <script>
            location.href = 'board_list.php?page=$page';
        </script>
    ";
?>

   
