<?php
$year = intval($_GET['year'] ?? 0);
$month = intval($_GET['month'] ?? 0);

$stmt = $mysqli->prepare("SELECT image_url, opacity FROM calendar_background WHERE year=? AND month=?");
$stmt->bind_param("ii", $year, $month);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

echo json_encode($row ?: new stdClass());
$stmt->close();
?>
