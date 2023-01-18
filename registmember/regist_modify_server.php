<?php
    include("../dbconnector/db_connect.php");

    $userid = $pass1 = $pass2 = $username = $email = $user_info ="";
    date_default_timezone_set('Asia/Seoul');
    $resgist_day = date("Y-m-d (H:i)");


if(isset($_POST['id']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['name']) && isset($_POST['email'])){
    // mysql injection 함수 사용 php에서 제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다
		// 우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
		// 이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
    $userid = mysqli_real_escape_string($con, $_POST['id']);  
    $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    $username = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $user_info = "id={$userid}&pass1={$pass1}&pass2={$pass2}&name={$username}&email={$email}";

    if(empty($pass1)){
        header("location: regist_modify_form.php?error=비밀번호를 작성해 주세요&$user_info");
        exit();
      }else if(empty($pass2)){
        header("location: regist_modify_form.php?error=다시한번 작성 부탁드립니다&$user_info");
        exit();
      }else if(empty($username)){
        header("location: regist_modify_form.php?error=이름을 작성 부탁드립니다&$user_info");
        exit();
      }else if($pass1 !== $pass2){
        header("location: regist_modify_form.php?error=비밀번호가 일치 하지 않습니다&$user_info");
        exit();
      }else{
         // 반드시 패스워드 영역으로 설정된 필드는 varchar(255)로 해야됨. 
        $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
        $slq_same ="select * from members where id = '$userid'";
        $record_set = mysqli_query($con, $slq_same);
        
        // DB에 저장된 row데이터 개수를 알기 위한 방법으로 
        // select문으로 조건에 맞는 데이터를 조회한 후 해당하는 row데이터의 총 개수를 숫자로 반환
        if(!mysqli_num_rows($record_set) == 1){
          header("location: regist_modify_form.php?error 존재하지 않는 아이디 입니다");
          exit();
        }else{
          if(!empty($_POST['email'])){
            $sql_update = "update members set pass='$pass1', name='$username', email='{$_POST['email']}' where id='$userid'";
            $result = mysqli_query($con, $sql_update);
          }else{
            $sql_update = "update members set pass='$pass1', name='$username' where id='$userid'";
            $result = mysqli_query($con, $sql_update);
          }
          
          if($result){
            header("location: ../index.php?success= 성공적으로 회원수정이 완료 되었습니다&$user_info");
            exit();
          }else{
            header("location: regist_modify_form.php?error=regist_modify_server error:57 회원 수정이 실패 하였습니다&$user_info");
            exit();
          }
        }
      }
    }else{
      header("location: regist_modify_form.php?error=regist_modify_server error:63 알수 없는 오류 입니다&$user_info");
      exit();
    }
    mysqli_close($con)
?>

   
