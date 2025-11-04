<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "yehan";

$mysqli = new mysqli($host, $user, $pass, $dbname);
if ($mysqli->connect_errno) {
    echo json_encode(['status' => 'error', 'message' => 'DB 연결 실패']);
    exit;
}
// UTF-8 인코딩 설정 (한글 등 다국어 처리 용)
$mysqli->set_charset("utf8");
?>
