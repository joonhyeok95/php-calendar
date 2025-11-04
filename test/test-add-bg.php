<?php
require_once __DIR__ . '/../includes/header.php';
?>
  <h3>배경 등록 테스트</h3>

<form id="backgroundForm" class="p-3" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="year" class="form-label">년도</label>
    <input type="number" class="form-control" id="year" name="year" min="2000" max="2100" value="2025" required>
  </div>

  <div class="mb-3">
    <label for="month" class="form-label">월</label>
    <select name="month" id="month" class="form-select" required>
      <option value="">선택</option>
      <option value="1">1월</option>
      <option value="2">2월</option>
      <option value="3">3월</option>
      <option value="4">4월</option>
      <option value="5">5월</option>
      <option value="6">6월</option>
      <option value="7">7월</option>
      <option value="8">8월</option>
      <option value="9">9월</option>
      <option value="10">10월</option>
      <option value="11">11월</option>
      <option value="12">12월</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="image_url" class="form-label">배경 이미지 URL</label>
    <input type="url" class="form-control" id="image_url" name="image_url" placeholder="https://example.com/image.jpg">
    <div class="form-text">이미지 URL 또는 아래 파일 업로드 사용</div>
  </div>

  <div class="mb-3">
    <label for="image_file" class="form-label">배경 이미지 파일 업로드</label>
    <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
  </div>

  <div class="mb-3">
    <label for="opacity" class="form-label">투명도 (0.0 ~ 1.0)</label>
    <input type="number" step="0.1" min="0" max="1" class="form-control" id="opacity" name="opacity" value="0.3" required>
  </div>

  <button type="submit" class="btn btn-primary">배경 등록</button>
</form>

<div id="bgResult" class="mt-3"></div>

<script>
  $('#backgroundForm').on('submit', function(e){
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: '/pages/add-bg.php',  // 서버 저장 처리 스크립트 경로
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(res){
        if(res.status === 'success') {
          $('#bgResult').text('배경 이미지가 저장되었습니다.');
        } else {
          $('#bgResult').text('오류: ' + res.message);
        }
      },
      error: function(){
        $('#bgResult').text('서버 통신 오류가 발생했습니다.');
      }
    });
  });
</script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>