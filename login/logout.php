<?php
  session_start();
  if(!isset($_SESSION["id"]) || empty($_SESSION["id"])){
    echo("
    <script>
      alert('비 정상적인 작동이 감지되었습니다')
       location.href = 'http://{$_SERVER['HTTP_HOST']}/myhomepage/index.php';
    </script>
    ");
    exit();
  }
  unset($_SESSION["id"]);
  unset($_SESSION["pass"]);
  unset($_SESSION["name"]);
  unset($_SESSION["level"]);
  unset($_SESSION["point"]);

  header("location: http://{$_SERVER['HTTP_HOST']}/myhomepage/index.php");
  exit();
?>
