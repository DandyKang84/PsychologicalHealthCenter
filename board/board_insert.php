<meta charset="utf-8">
<?php
	include("../dbconnector/db_connect.php");
	date_default_timezone_set('Asia/Seoul');
	session_start();
	$userid = isset($_SESSION["id"]) ? $_SESSION['id'] : "";
	$username = isset($_SESSION["name"]) ? $_SESSION["name"] : "";

	if (!$userid ){
		alert_back('board_insert error:10 회원전용 게시판입니다.');
		exit();
	}
	$upfile_name = $upfile_type = $copied_file_name ="";
		// mysql injection 함수 사용 php에서 제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다
		// 우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
		// 이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
		$subject = mysqli_real_escape_string($con, $_POST["subject"]);
        $content = mysqli_real_escape_string($con, $_POST["content"]);

		if(isset($subject) && isset($subject)){
		// htmlspecialchars 이 함수는 문자열에서 특정한 특수 문자를 HTML 엔티티로 변환한다. 이함수를 사용하면 악성 사용자로 부터 XSS 공격을 방지 할 수 있다
		$subject = htmlspecialchars($subject, ENT_QUOTES);
		$content = htmlspecialchars($content, ENT_QUOTES);

		$sql = "select * from members where id = '$userid'";
		$select_result = mysqli_query($con, $sql);
	  if(empty($subject)){
      	header("location: board_form.php?error = board_insert error:28 제목을 입력 부탁드립니다");
      	exit();
    	}else if(empty($content)){
      	header("location: board_form.php?error = board_insert error:31 제목을 입력 부탁드립니다");
      	exit();
    	}else{
			$regist_day = date("Y-m-d (H:i)");  
			$upload_dir = '../database/';

			 // input type을 files 로 사용하는 순간 $_FILES로 넘어온다
			 $upfile_name      = $_FILES["upfile"]["name"];
			 $upfile_tmp_name  = $_FILES["upfile"]["tmp_name"];
			 $upfile_type      = $_FILES["upfile"]["type"];
			 $upfile_size      = $_FILES["upfile"]["size"];
			 // 에러가 없으면 0
			 $upfile_error     = $_FILES["upfile"]["error"];

			if($upfile_name && !$upfile_error){
				// 파일을 파일명과 확장자를 분리시킨다.(memo.sql) => ['memo','sql']
				$file = explode(".", $upfile_name);
				$file_name = $file[0];
				$file_ext  = $file[1];
				// 서버에 저장할 파일명을 중복되지 않기 하기위해서 날짜명_시간_파일명.확장자 만든다.
				$copied_file_name = date("Y_m_d_H_i_s").$upfile_name;   
				// ./data/2023_01_11_11_11_11_memo.sql 다 합친것
				$uploaded_file = $upload_dir.$copied_file_name;
				// php ini에서 최대 크기 수정해서 200M까지 올릴 수 있다.!
				if ($upfile_size > 100000000) {
                    header("location: board_insert.php?error=첨부파일 100MB 이상 안됩니다.");
                    exit(); 
                  }
				if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
					alert_back('board_insert error:60 첨부파일이 없습니다.');
					exit();
				}
			}
	
			$sql = "insert into board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
			$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
			$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";

			$insert_result = mysqli_query($con, $sql); 
			if(!$insert_result){
				header("location: board_form_insert.php?error=board_insert error:71 DB파일저장 실패.");
				exit(); 
			}

			$point_up = 100;
			$sql = "select point from members where id='$userid'";
			$row = mysqli_fetch_array($select_result);
			$new_point = $row["point"] + $point_up;

			$sql = "update members set point = $new_point where id='$userid'";
			$update_point_result = mysqli_query($con, $sql);
			mysqli_close($con);

			if($update_point_result){
				alert_back('포인트가 적립되었습니다.');
				header("location: board_list.php");
				exit();
			}else{
				alert_back('board_insert error:89 포인트 등록에 실패 하였습니다.');
				exit();
			}
		}
	}		
?>

  
