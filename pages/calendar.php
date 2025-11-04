<?php
require_once __DIR__ . '/../lib/db.php';
header('Content-Type: application/json');

$start = $_GET['start'] ?? null; // YYYY-MM-DD
$end = $_GET['end'] ?? null;

if (!$start || !$end) {
    echo json_encode(['error' => '기간 파라미터 누락']);
    exit;
}

$startDate = new DateTime($start);
$endDate = new DateTime($end);
$rangeYears = range((int)$startDate->format('Y'), (int)$endDate->format('Y'));

$events = [];
if ($startDate->format('Y') === $endDate->format('Y')) {
    // 같은 해 구간
    $events = queryEventsForRange($mysqli, $start, $end);
} else {
    // 연도 경계 넘는 구간 -> 두 구간 쪼개서 조회
    $yearEnd = $startDate->format('Y') . "-12-31";
    $yearStart = $endDate->format('Y') . "-01-01";
    
    $events1 = queryEventsForRange($mysqli, $start, $yearEnd);
    $events2 = queryEventsForRange($mysqli, $yearStart, $end);
    
    $events = array_merge($events1, $events2);
}

// 반복 이벤트, 기간 범위 쿼리 함수
function queryEventsForRange($mysqli, $start, $end) {
    $events = [];

    $sql = "
    SELECT id, title, color, repeat_annually, event_date 
    FROM calendar_event 
    WHERE 
      (repeat_annually = 0 AND event_date BETWEEN ? AND ?)
      OR (repeat_annually = 1 AND (
        DATE_FORMAT(event_date, '%m-%d') BETWEEN DATE_FORMAT(?, '%m-%d') AND DATE_FORMAT(?, '%m-%d')
      ))
    ";

    $stmt = $mysqli->prepare($sql);
    if(!$stmt){
        return [];
    }

    $stmt->bind_param("ssss", $start, $end, $start, $end);
    $stmt->execute();
    $result = $stmt->get_result();

    $startDate = new DateTime($start);
    $endDate = new DateTime($end);

    while ($row = $result->fetch_assoc()) {
        if ($row['repeat_annually'] == 1) {
            $yyyymmdd = $row['event_date'];
            // event_date 기준 월-일만 추출하고 년도만 현재 범위 기준으로 교체
            $monthDay = substr($yyyymmdd, 5);
            $year = $startDate->format('Y');
            $eventDate = DateTime::createFromFormat('Y-m-d', $year . '-' . $monthDay);

            // 재조정 필요 시, 범위 내 날짜인지 검사 (월일 쿼리 불완전 보완)
            if ($eventDate < $startDate) $eventDate->modify('+1 year');
        } else {
            $eventDate = new DateTime($row['event_date']);
        }

        if ($eventDate >= $startDate && $eventDate <= $endDate) {
            $events[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $eventDate->format('Y-m-d'),
                'color' => $row['color'],
            ];
        }
    }
    $stmt->close();

    return $events;
}
echo json_encode($events);
?>
