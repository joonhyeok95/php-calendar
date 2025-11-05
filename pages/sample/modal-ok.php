modal-ok.php
<?php
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    echo json_encode(['id' => $id, 'custom'=>"커스텀메시지"], JSON_UNESCAPED_UNICODE);
?>