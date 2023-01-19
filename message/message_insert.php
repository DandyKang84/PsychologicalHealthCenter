<?php
			include("../dbconnector/db_connect.php");
$send_id = $_POST["send_id"];

$rv_id = $_POST['rv_id'];
$subject = $_POST['subject'];
$content = $_POST['content'];

//html tag 구조는 entity code 변환시켜줌 (htmlspecialchars) : trim, stripslashes는 기능을 빼버린것이 맞다.
$subject = htmlspecialchars($subject, ENT_QUOTES);
$content = htmlspecialchars($subject, ENT_QUOTES);
$regist_day = date("Y-m-d (H:i)"); 

$sql = "select * from members where id = '$rv_id'";
$result = mysqli_query($con,$sql);
// DB에 저장된 row데이터 개수를 알기 위한 방법으로 
// select문으로 조건에 맞는 데이터를 조회한 후 해당하는 row데이터의 총 개수를 숫자로 반환
$num_record = mysqli_num_rows($result);

if($num_record){
  $sql = "insert into message (send_id, rv_id, subject, content, regist_day)";
  $sql .= "values('$send_id','$rv_id','$subject','$content','$regist_day')";
  mysqli_query($con,$sql);
}else{
  alert_back('message_insert error:25 아이디를 찾을 수 없습니다.');
  exit();
}

mysqli_close($con);

echo "
  <script>
  location.href = 'message_box.php?mode=send';
  </script>
";
?>