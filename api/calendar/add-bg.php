<?php
$uploadDir = $_SERVER['DOCUMENT_ROOT']. '/uploads/'; // 저장할 서버 경로
if (!is_dir($uploadDir)) {
  mkdir($uploadDir, 0755, true);
}

$year = intval($_POST['year'] ?? 0);
$month = intval($_POST['month'] ?? 0);
$image_url = $_POST['image_url'] ?? '';
if (!$image_url && !empty($_POST['image_url'])) {
  $image_url = $_POST['image_url'];
}
$opacity = floatval($_POST['opacity'] ?? 0.3);

// 이미지 업로드
if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
  $fileTmpPath = $_FILES['image_file']['tmp_name'];
  $fileName = basename($_FILES['image_file']['name']);
  $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
  if (!in_array($fileExt, $allowedExts)) {
    echo json_encode(['status' => 'error', 'message' => '허용되지 않는 파일 형식입니다.'], JSON_UNESCAPED_UNICODE);
    exit;
  }
  // 고유 파일명 생성
  $newFileName = uniqid('bg_', true) . '.' . $fileExt;
  $destPath = $uploadDir . $newFileName;

  if (move_uploaded_file($fileTmpPath, $destPath)) {
    // 웹에서 접근 가능한 경로로 변경 필요
    $image_url = "http://localhost/uploads/". $newFileName;
  } else {
    echo json_encode(['status' => 'error', 'message' => '파일 업로드 중 오류 발생'], JSON_UNESCAPED_UNICODE);
    exit;
  }
}

// 값체크
if (!$year || !$month || !$image_url) {
    echo json_encode(['status' => 'error', 'message' => '필수 항목이 누락되었습니다'], JSON_UNESCAPED_UNICODE);
    exit;
}


// 중복 체크 후 INSERT 또는 UPDATE
$sql_check = "SELECT id FROM calendar_background WHERE year=? AND month=?";
$stmt_check = $mysqli->prepare($sql_check);
$stmt_check->bind_param("ii", $year, $month);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    // 업데이트
    $row = $result->fetch_assoc();
    $id = $row['id'];

    $sql_update = "UPDATE calendar_background SET image_url=?, opacity=? WHERE id=?";
    $stmt_update = $mysqli->prepare($sql_update);
    $stmt_update->bind_param("sdi", $image_url, $opacity, $id);
    $success = $stmt_update->execute();
    $stmt_update->close();
} else {
    // 신규 등록
    $sql_insert = "INSERT INTO calendar_background (year, month, image_url, opacity) VALUES (?, ?, ?, ?)";
    $stmt_insert = $mysqli->prepare($sql_insert);
    $stmt_insert->bind_param("iisd", $year, $month, $image_url, $opacity);
    $success = $stmt_insert->execute();
    $stmt_insert->close();
}

$stmt_check->close();

if ($success) {
    echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['status' => 'error', 'message' => $mysqli->error], JSON_UNESCAPED_UNICODE);
}
?>
