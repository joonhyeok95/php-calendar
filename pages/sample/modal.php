<!-- 버튼: 모달 창을 띄우는 트리거 -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  모달 열기
</button>

<form method="post" action="/sample/modal-ok">
<!-- 모달 구조 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">로그인</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="닫기"></button>
      </div>
      <div class="modal-body">
            아이디<input type="text" name="id" required/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <input type="submit" value="로그인" class="btn btn-primary" />
      </div>
    </div>
  </div>
</div>
</form>
