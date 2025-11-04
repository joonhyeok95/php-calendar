  (function(){
    $(document).ready(function(){

      // calendar element 취득
      var calendarEl = $('#calendar')[0];
      // full-calendar 생성하기
      var calendar = new FullCalendar.Calendar(calendarEl, {
        height: '700px', // calendar 높이 설정
        expandRows: true, // 화면에 맞게 높이 재설정
        slotMinTime: '08:00', // Day 캘린더에서 시작 시간
        slotMaxTime: '20:00', // Day 캘린더에서 종료 시간
        customButtons: {
            addCalendar: {
                text:"일정추가",
                click: function(){
                    $("#exampleModal").modal("show");
                }
            },
            btnSave: {
                text: "저장"
            }
        },
        // 해더에 표시할 툴바
        headerToolbar: {
          left: 'prev,next today,addCalendar,btnSave',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth', // 초기 로드 될때 보이는 캘린더 화면(기본 설정: 달)
        //initialDate: '2021-07-15', // 초기 날짜 설정 (설정하지 않으면 오늘 날짜가 보인다.)
        navLinks: true, // 날짜를 선택하면 Day 캘린더나 Week 캘린더로 링크
        editable: true, // 수정 가능?
        selectable: true, // 달력 일자 드래그 설정가능
        nowIndicator: true, // 현재 시간 마크
        dayMaxEvents: true, // 이벤트가 오버되면 높이 제한 (+ 몇 개식으로 표현)
        locale: 'ko', // 한국어 설정
        eventAdd: function(obj) { // 이벤트가 추가되면 발생하는 이벤트
          console.log(obj);
        },
        eventChange: function(obj) { // 이벤트가 수정되면 발생하는 이벤트
          console.log(obj);
        },
        eventRemove: function(obj){ // 이벤트가 삭제되면 발생하는 이벤트
          console.log(obj);
        },
        select: function(arg) { // 캘린더에서 드래그로 이벤트를 생성할 수 있다.
          var title = prompt('Event Title:');
          if (title) {
            calendar.addEvent({
              title: title,
              start: arg.start,
              end: arg.end,
              allDay: arg.allDay
            })
          }
          calendar.unselect()
        },
        // 이벤트 
        events: [],

      });
    // DB연동
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'ko',
      height: '700px',
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      events: function(fetchInfo, successCallback, failureCallback) {
        $.ajax({
          url: '/pages/calendar.php',
          dataType: 'json',
          data: {
            start: fetchInfo.startStr,
            end: fetchInfo.endStr
          },
          success: function(response) {
            successCallback(response);
          },
          error: function() {
            failureCallback("이벤트를 불러오는 중 오류가 발생했습니다.");
          }
        });
      },
      editable: true,
      selectable: true,
    
      // 배경 넣기
    // datesSet: function(info) {
    //   var year = info.start.getFullYear();
    //   var month = info.start.getMonth() + 1;

    //   $.ajax({
    //     url: '/pages/calendar-bg.php',
    //     data: { year, month },
    //     dataType: 'json',
    //     success: function(data) {
    //       if(data.image_url) {
    //         $("#calendar-bg").css({
    //           'background-image': `url(${data.image_url})`,
    //           'background-size': 'cover',
    //           'background-position': 'center',
    //           'opacity': data.opacity || 0.3
    //         });
    //       } else {
    //         // 배경 이미지 제거 옵션
    //         $("#calendar-bg").css({
    //           'background-image': 'none',
    //           'opacity': 1
    //         });
    //       }
    //     }
    //   });
    // }
    });

    calendar.render();
    });
  })();

// $(function(){
//   var calendarEl = $('#calendar')[0];

//   // FullCalendar 생성
//   var calendar = new FullCalendar.Calendar(calendarEl, {
//     locale: 'ko',
//     height: '700px',
//     selectable: true,
//     headerToolbar: {
//       left: 'prev,next today',
//       center: 'title',
//       right: 'dayGridMonth,timeGridWeek,timeGridDay'
//     },
//     select: function(info) {
//       // 드래그한 날짜, 시간 range 저장
//     //   selectedRange = info;
//       // 클릭한 날짜를 시작, 종료(하루)로 설정
//       var startDate = info.startStr; // 클릭한 날짜
//       var endDate = info.endStr;   // 동일 날짜
//       var startDatetime = startDate + 'T00:00';
//       var endDatetime = endDate + 'T23:59';
//       // 모달창을 띄움
//       $('#title').val('');
//       $('#start').val(startDatetime.substring(0,16)); // input type="datetime-local" 포맷 맞춤
//       $('#end').val(endDatetime.substring(0,16));
//       $('#color').val('blue'); // 기본 색상 선택
      
//       var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
//       modal.show();
//     }
//   });
//   calendar.render();

//   // 추가 버튼 클릭시 일정 등록
//   $('#saveChanges').on('click', function() {
//     var title = $('#title').val();
//     var start = $('#start').val();
//     var end = $('#end').val();
//     var color = $('#color').val();

//     if(title) {
//       calendar.addEvent({
//         title: title,
//         start: start,
//         end: end,
//         backgroundColor: color,
//         borderColor: color
//       });
//       // 모달 닫기
//       var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
//       modal.hide();
//     } else {
//       alert("모든 항목을 입력하세요!");
//     }
//   });
//   $('.color-swatch').on('click', function() {
//     var color = $(this).data('color');
//     $('#color').val(color);
//   });
//   $('#color').on('change', function() {
//     var color = $(this).val();
//     $('#colorPreview').css('background-color', color);
//   });

//   $('#colorPreview').css('background-color', $('#color').val());


// });
