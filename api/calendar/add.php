<?php
$title = $_POST['title'] ?? '';
$event_date = $_POST['event_date'] ?? '';
$repeat_annually = isset($_POST['repeat_annually']) ? 1 : 0;
$color = $_POST['color'] ?? '#0000ff';

if (!$title || !$event_date) {
    echo json_encode(['status' => 'error', 'message' => '필수항목 누락'], JSON_UNESCAPED_UNICODE);
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO calendar_event (title, event_date, repeat_annually, color) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $title, $event_date, $repeat_annually, $color);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error], JSON_UNESCAPED_UNICODE);
}
?>
