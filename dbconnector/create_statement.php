<?php
include_once $_SERVER['DOCUMENT_ROOT']."/myhomepage/dbconnector/db_connect.php";
include_once $_SERVER['DOCUMENT_ROOT']."/myhomepage/dbconnector/create_table.php";
include_once $_SERVER['DOCUMENT_ROOT']."/myhomepage/dbconnector/create_procedure.php";

// 테이블
create_table($con, "board");
create_table($con, "members");
create_table($con, "message");
create_table($con, "image_board");
create_table($con, "image_board_ripple");

// 인덱스

// 프로시저
create_procedure($con, 'members_procedure');
create_procedure($con, 'board_procedure');
create_procedure($con, 'image_board_procedure');
// 트리거

// 함수

?>