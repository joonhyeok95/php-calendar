<script>
$(document).ready(function() {
  // 1. 요소 선택 및 스타일 변경
  $("h1").css("color", "blue");
  $(".highlight").css("background-color", "yellow");
  $("li").css("font-weight", "bold");

  // 2. 클릭 이벤트 처리
  $("#btnAlert").click(function() {
    alert("버튼이 클릭되었습니다!");
  });

  // 3. 텍스트 내용 변경 (Setter)
  $("#btnChangeText").click(function() {
    $("#textPara").text("텍스트가 변경되었습니다.");
  });

  // 4. 텍스트 내용 가져오기 (Getter) 및 출력
  $("#btnShowText").click(function() {
    var txt = $("#textPara").text();
    alert("현재 텍스트는: " + txt);
  });

  // 5. 숨기기, 보이기 효과
  $("#btnToggle").click(function() {
    $("#toggleDiv").toggle();
  });

  // 6. AJAX 예제 (GET)
  $("#btnAjax").click(function() {
    $.ajax({
      url: "/api/sample/list",
      method: "GET",
      success: function(data) {
        $("#ajaxResult").text(JSON.stringify(data));
      },
      error: function() {
        $("#ajaxResult").text("AJAX 요청 실패");
      }
    });
  });
});
</script>
<h1>jQuery 기초 학습</h1>
<p class="highlight" id="textPara">이것은 예제 문장입니다.</p>

<ul>
  <li>첫번째 아이템</li>
  <li>두번째 아이템</li>
  <li>세번째 아이템</li>
</ul>

<button id="btnAlert">알림창 띄우기</button>
<button id="btnChangeText">텍스트 변경</button>
<button id="btnShowText">텍스트 보여주기</button>
<button id="btnToggle">숨기기/보이기</button>
<button id="btnAjax">AJAX 호출</button>

<div id="toggleDiv" style="margin-top:10px; padding:10px; border:1px solid black;">
  이 영역은 숨기기/보이기 효과 테스트용입니다.
</div>

<div id="ajaxResult" style="margin-top:10px; color:green; font-weight:bold;"></div>