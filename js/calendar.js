(function () {

  $(document).ready(function () {

    const calendarEl = document.getElementById('calendar');

    if (!calendarEl) {
      return;
    }


    /*
     * ================================
     * 모바일 여부
     * ================================
     */
    function isMobile() {
      return window.innerWidth <= 600;
    }


    /*
     * ================================
     * FullCalendar
     * ================================
     */
    const calendar = new FullCalendar.Calendar(calendarEl, {

      locale: 'ko',

      /*
       * 모바일에서는 화면 높이에 맞게 자동 조절
       */
      height: 'auto',

      expandRows: true,

      /*
       * 초기 화면
       */
      initialView: 'dayGridMonth',

      /*
       * 월간 달력의 불필요한 빈 주 제거
       */
      fixedWeekCount: false,

      /*
       * 이전/다음 달 날짜도 표시
       */
      showNonCurrentDates: true,

      /*
       * 오늘 날짜 강조
       */
      nowIndicator: true,

      /*
       * 날짜 클릭
       */
      navLinks: true,

      /*
       * 이벤트 드래그
       */
      editable: false,

      /*
       * 날짜 선택
       */
      selectable: true,

      /*
       * 한 날짜에 이벤트가 많을 경우
       */
      dayMaxEvents: 3,

      /*
       * 이벤트 표시 방식
       */
      eventDisplay: 'block',


      /*
       * ================================
       * Header
       * ================================
       *
       * 모바일:
       *   prev / today / next
       *   title
       *
       * PC:
       *   prev / today / next
       *   title
       *   month / week / day / list
       */
      headerToolbar: {
        left: 'prev,today,next',
        center: 'title',
        right: 'dayGridMonth,listMonth'
      },


      /*
       * ================================
       * 버튼 문구
       * ================================
       */
      buttonText: {
        today: '오늘',
        month: '월',
        week: '주',
        day: '일',
        list: '목록'
      },


      /*
       * ================================
       * 날짜 제목
       * ================================
       */
      titleFormat: {
        year: 'numeric',
        month: 'long'
      },


      /*
       * ================================
       * 이벤트
       * ================================
       */
      events: function (fetchInfo, successCallback, failureCallback) {

        $.ajax({

          url: '/api/calendar/list',

          type: 'GET',

          dataType: 'json',

          data: {
            start: fetchInfo.startStr,
            end: fetchInfo.endStr
          },

          success: function (response) {

            successCallback(response);

          },

          error: function () {

            failureCallback();

            showCalendarMessage(
              '일정을 불러오지 못했습니다.'
            );

          }

        });

      },


      /*
       * ================================
       * 이벤트 렌더링
       * ================================
       */
      eventDidMount: function (info) {

        /*
         * 이벤트 색상이 없을 경우 기본값
         */
        if (!info.event.backgroundColor) {

          info.el.style.backgroundColor = '#6366f1';

        }

        /*
         * 모바일에서 title만 깔끔하게 표시
         */
        info.el.setAttribute(
          'title',
          info.event.title
        );

      },


      /*
       * ================================
       * 이벤트 클릭
       * ================================
       */
      eventClick: function (info) {

        info.jsEvent.preventDefault();

        showEventDetail(info.event);

      },


      /*
       * ================================
       * 날짜 선택
       * ================================
       */
      dateClick: function (info) {

        /*
         * 모바일에서는 날짜를 누르면
         * 해당 날짜의 일정 화면으로 이동
         */
  calendar.unselect();
        // if (isMobile()) {

        //   calendar.changeView(
        //     'listDay',
        //     info.date
        //   );

        // }

      },


      /*
       * ================================
       * 화면 변경
       * ================================
       */
      datesSet: function (info) {

        /*
         * 기존 배경 이미지 기능을 사용하려면
         * 이 부분에 API 연결
         */
        /*
        const year = info.start.getFullYear();
        const month = info.start.getMonth() + 1;

        $.ajax({
          url: '/pages/calendar-bg.php',
          data: {
            year: year,
            month: month
          },
          dataType: 'json',

          success: function(data) {

            if (data.image_url) {

              $('#calendar-bg').css({
                'background-image':
                  `url(${data.image_url})`,
                'background-size': 'cover',
                'background-position': 'center',
                'opacity': data.opacity || 0.3
              });

            } else {

              $('#calendar-bg').css({
                'background-image': 'none',
                'opacity': 1
              });

            }

          }

        });
        */

      }

    });


    /*
     * ================================
     * Calendar render
     * ================================
     */
    calendar.render();


    /*
     * ================================
     * 모바일 화면에서
     * 불필요한 View 버튼 숨기기
     * ================================
     */
    function updateCalendarUI() {

      if (isMobile()) {

        /*
         * 모바일에서는 월간 달력만 사용
         */
        calendar.changeView('dayGridMonth');

        /*
         * view 버튼 숨김
         */
        $('.fc-header-toolbar .fc-right')
          .hide();

      } else {

        $('.fc-header-toolbar .fc-right')
          .show();

      }

    }


    /*
     * 최초 실행
     */
    updateCalendarUI();


    /*
     * 화면 크기 변경
     */
    let resizeTimer;

    $(window).on('resize', function () {

      clearTimeout(resizeTimer);

      resizeTimer = setTimeout(function () {

        updateCalendarUI();

      }, 200);

    });


    /*
     * ================================
     * 일정 상세
     * ================================
     */
    function showEventDetail(event) {

      const title =
        event.title || '제목 없음';

      const date =
        formatEventDate(event.start);

      const color =
        event.backgroundColor || '#6366f1';


      /*
       * 기존 상세창 제거
       */
      $('#calendarEventSheet').remove();


      const html = `

        <div id="calendarEventSheet"
             class="calendar-event-overlay">

          <div class="calendar-event-sheet">

            <div class="calendar-event-handle"></div>

            <div class="calendar-event-header">

              <div
                class="calendar-event-color"
                style="background:${color};">
              </div>

              <div class="calendar-event-title">
                ${escapeHtml(title)}
              </div>

              <button
                type="button"
                class="calendar-event-close"
                aria-label="닫기">
                ×
              </button>

            </div>

            <div class="calendar-event-body">

              <div class="calendar-event-row">

                <span class="calendar-event-icon">
                  📅
                </span>

                <span>
                  ${date}
                </span>

              </div>

            </div>

          </div>

        </div>

      `;


      $('body').append(html);


      /*
       * 애니메이션 시작
       */
      setTimeout(function () {

        $('#calendarEventSheet')
          .addClass('show');

      }, 10);


      /*
       * 닫기
       */
      $('#calendarEventSheet').on(
        'click',
        '.calendar-event-close',
        closeEventDetail
      );


      /*
       * 바깥 영역 클릭
       */
      $('#calendarEventSheet').on(
        'click',
        function (e) {

          if (e.target === this) {

            closeEventDetail();

          }

        }
      );

    }


    function closeEventDetail() {

      $('#calendarEventSheet')
        .removeClass('show');

      setTimeout(function () {

        $('#calendarEventSheet').remove();

      }, 250);

    }


    /*
     * ================================
     * 날짜 포맷
     * ================================
     */
    function formatEventDate(date) {

      if (!date) {
        return '';
      }

      const days = [
        '일',
        '월',
        '화',
        '수',
        '목',
        '금',
        '토'
      ];

      const year =
        date.getFullYear();

      const month =
        String(date.getMonth() + 1)
          .padStart(2, '0');

      const day =
        String(date.getDate())
          .padStart(2, '0');

      const weekday =
        days[date.getDay()];

      return `${year}.${month}.${day} (${weekday})`;

    }


    /*
     * ================================
     * XSS 방지
     * ================================
     */
    function escapeHtml(value) {

      return $('<div>')
        .text(value)
        .html();

    }


    /*
     * ================================
     * Calendar 메시지
     * ================================
     */
    function showCalendarMessage(message) {

      $('#calendarMessage').remove();

      $('body').append(`

        <div id="calendarMessage"
             class="calendar-message">

          ${escapeHtml(message)}

        </div>

      `);

      setTimeout(function () {

        $('#calendarMessage')
          .fadeOut(300, function () {
            $(this).remove();
          });

      }, 2500);

    }
    function updateCalendarUI() {

      if (isMobile()) {

        /*
        * 모바일에서도 월 / 주 / 일 / 목록 표시
        */
        $('.fc-header-toolbar .fc-right').show();

      } else {

        $('.fc-header-toolbar .fc-right').show();

      }

    }

    /*
     * ================================
     * 일정 추가 버튼
     * ================================
     *
     * 현재 이벤트 등록 페이지가 별도로 있으므로
     * 아래 URL만 실제 등록 페이지 주소로 변경하면 됨.
     */
    if ($('#calendarAddButton').length === 0) {

      const addButton = `

        <a
          id="calendarAddButton"
          class="calendar-add-button"
          href="/calendar/add"
          aria-label="일정 추가">

          <span class="calendar-add-icon">+</span>

          <span class="calendar-add-text">
            일정 추가
          </span>

        </a>

      `;

      $('#calendar-wrapper')
        .append(addButton);

    }

  });

})();
