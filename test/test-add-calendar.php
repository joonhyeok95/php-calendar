<?php
require_once __DIR__ . '/../includes/header.php';
?>
  <h3>이벤트 등록 테스트</h3>

<form id="eventForm" class="p-3">
  <div class="mb-3">
    <label for="title" class="form-label">제목</label>
    <input type="text" name="title" id="title" class="form-control" required />
  </div>
  <div class="mb-3">
    <label for="event_date" class="form-label">날짜</label>
    <input type="date" name="event_date" id="event_date" class="form-control" required />
  </div>
  <div class="form-check mb-3">
    <input type="checkbox" name="repeat_annually" id="repeat_annually" class="form-check-input" />
    <label for="repeat_annually" class="form-check-label">매년 반복</label>
  </div>
  <div class="mb-3">
    <label for="color" class="form-label">색상</label>
    <input type="color" name="color" id="color" class="form-control form-control-color" value="#0000ff" />
  </div>
  <button type="submit" class="btn btn-primary">저장</button>
</form>

  <div id="result"></div>

  <script>
    $('#eventForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: '/pages/add-calendar.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
          if(res.status === 'success') {
            $('#result').text('이벤트가 저장되었습니다.');
          } else {
            $('#result').text('오류: ' + res.message);
          }
        },
        error: function() {
          $('#result').text('서버 통신 오류 발생');
        }
      });
    });
    $('input[name="title"]').on('keydown keyup change input', function() {
      $('#result').text('');
    });
  </script>
<?php
require_once __DIR__ . '/../includes/footer.php';
?>