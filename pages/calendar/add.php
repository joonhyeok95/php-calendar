<style>
  .event-page {
    min-height: 100vh;
    padding: 18px 16px 40px;
    background: #f5f7fb;
  }

  .event-container {
    width: 100%;
    max-width: 560px;
    margin: 0 auto;
  }

  /* 홈으로 */
  .home-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 18px;
    padding: 6px 2px;
    color: #6b7280;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: color .2s;
  }

  .home-link:hover {
    color: #4f46e5;
  }

  .home-arrow {
    font-size: 22px;
    line-height: 14px;
  }

  .event-header {
    margin-bottom: 20px;
  }

  .event-header h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
  }

  .event-header p {
    margin: 6px 0 0;
    font-size: 14px;
    color: #6b7280;
  }

  .event-card {
    background: #fff;
    border-radius: 20px;
    padding: 22px 18px;
    box-shadow:
      0 4px 12px rgba(15, 23, 42, 0.05),
      0 1px 3px rgba(15, 23, 42, 0.04);
  }

  .form-group {
    margin-bottom: 22px;
  }

  .form-label-custom {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
  }

  .form-control-custom {
    width: 100%;
    height: 52px;
    padding: 0 14px;
    border: 1px solid #dfe3e8;
    border-radius: 12px;
    background: #fff;
    font-size: 16px;
    color: #111827;
    box-sizing: border-box;
    transition: border-color .2s, box-shadow .2s;
  }

  .form-control-custom:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
  }

  .date-wrapper {
    position: relative;
  }

  .date-wrapper::before {
    content: "📅";
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 18px;
    pointer-events: none;
  }

  .date-wrapper input {
    padding-left: 46px;
  }

  .repeat-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 56px;
    padding: 0 14px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    cursor: pointer;
  }

  .repeat-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .repeat-title {
    font-size: 15px;
    font-weight: 600;
    color: #374151;
  }

  .repeat-description {
    font-size: 12px;
    color: #9ca3af;
  }

  .toggle {
    position: relative;
    width: 48px;
    height: 28px;
    flex-shrink: 0;
  }

  .toggle input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .toggle-slider {
    position: absolute;
    inset: 0;
    border-radius: 999px;
    background: #d1d5db;
    transition: .2s;
    cursor: pointer;
  }

  .toggle-slider::before {
    content: "";
    position: absolute;
    width: 22px;
    height: 22px;
    left: 3px;
    top: 3px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 1px 3px rgba(0,0,0,.2);
    transition: .2s;
  }

  .toggle input:checked + .toggle-slider {
    background: #6366f1;
  }

  .toggle input:checked + .toggle-slider::before {
    transform: translateX(20px);
  }

  .color-selector {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    min-height: 52px;
    box-sizing: border-box;
  }

  .color-selector input[type="color"] {
    width: 34px;
    height: 34px;
    padding: 0;
    border: 0;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    background: transparent;
  }

  .color-selector input[type="color"]::-webkit-color-swatch-wrapper {
    padding: 0;
  }

  .color-selector input[type="color"]::-webkit-color-swatch {
    border: 0;
    border-radius: 50%;
  }

  .color-value {
    font-size: 14px;
    color: #6b7280;
  }

  .save-button {
    width: 100%;
    height: 54px;
    margin-top: 4px;
    border: 0;
    border-radius: 14px;
    background: #4f46e5;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: transform .1s, background .2s;
  }

  .save-button:hover {
    background: #4338ca;
  }

  .save-button:active {
    transform: scale(.98);
  }

  .save-button:disabled {
    background: #a5b4fc;
    cursor: not-allowed;
  }

  .event-toast {
    position: fixed;
    left: 50%;
    bottom: 24px;
    z-index: 9999;
    min-width: 260px;
    max-width: calc(100% - 32px);
    padding: 13px 16px;
    border-radius: 12px;
    color: #fff;
    font-size: 14px;
    text-align: center;
    transform: translate(-50%, 20px);
    opacity: 0;
    pointer-events: none;
    transition: all .25s ease;
    box-sizing: border-box;
  }

  .event-toast.show {
    transform: translate(-50%, 0);
    opacity: 1;
  }

  .event-toast.success {
    background: #16a34a;
  }

  .event-toast.error {
    background: #dc2626;
  }

  @media (max-width: 480px) {
    .event-page {
      padding: 14px 12px 32px;
    }

    .home-link {
      margin-bottom: 14px;
    }

    .event-card {
      padding: 20px 16px;
      border-radius: 18px;
    }

    .event-header h3 {
      font-size: 22px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-control-custom {
      height: 54px;
    }

    .save-button {
      height: 56px;
      font-size: 17px;
    }
  }
</style>


<div class="event-page">

  <div class="event-container">

    <!-- 홈으로 -->
    <a href="/" class="home-link">
      <span class="home-arrow">‹</span>
      <span>달력</span>
    </a>


    <div class="event-header">
      <h3>이벤트 등록</h3>
      <p>캘린더에 새로운 일정을 추가해보세요.</p>
    </div>


    <form id="eventForm" class="event-card">

      <div class="form-group">
        <label for="title" class="form-label-custom">
          이벤트 제목
        </label>

        <input
          type="text"
          name="title"
          id="title"
          class="form-control-custom"
          placeholder="예: 부모님 결혼기념일"
          autocomplete="off"
          required
        />
      </div>


      <div class="form-group">
        <label for="event_date" class="form-label-custom">
          날짜
        </label>

        <div class="date-wrapper">
          <input
            type="date"
            name="event_date"
            id="event_date"
            class="form-control-custom"
            required
          />
        </div>
      </div>


      <div class="form-group">
        <label class="form-label-custom">
          반복 설정
        </label>

        <label class="repeat-option">

          <div class="repeat-info">
            <span class="repeat-title">매년 반복</span>
            <span class="repeat-description">
              매년 같은 날짜에 자동으로 표시됩니다.
            </span>
          </div>

          <div class="toggle">
            <input
              type="checkbox"
              name="repeat_annually"
              id="repeat_annually"
              value="1"
            />
            <span class="toggle-slider"></span>
          </div>

        </label>
      </div>


      <div class="form-group">
        <label for="color" class="form-label-custom">
          캘린더 색상
        </label>

        <div class="color-selector">

          <input
            type="color"
            name="color"
            id="color"
            value="#4f46e5"
          />

          <span id="colorValue" class="color-value">
            #4F46E5
          </span>

        </div>
      </div>


      <button
        type="submit"
        id="saveButton"
        class="save-button"
      >
        저장하기
      </button>

    </form>

  </div>

</div>


<div id="eventToast" class="event-toast"></div>


<script>

  let toastTimer = null;

  function showToast(message, type) {

    const toast = $('#eventToast');

    clearTimeout(toastTimer);

    toast
      .removeClass('success error')
      .addClass(type)
      .text(message)
      .addClass('show');

    toastTimer = setTimeout(function() {
      toast.removeClass('show');
    }, 2500);
  }


  $('#color').on('input', function() {
    $('#colorValue').text(
      $(this).val().toUpperCase()
    );
  });


  $('#eventForm input').on(
    'input change',
    function() {
      $('#eventToast').removeClass('show');
    }
  );


  $('#eventForm').on('submit', function(e) {

    e.preventDefault();

    const form = $(this);
    const button = $('#saveButton');

    button
      .prop('disabled', true)
      .text('저장 중...');


    $.ajax({

      url: '/api/calendar/add',

      type: 'POST',

      data: form.serialize(),

      dataType: 'json',

      success: function(res) {

        if (res.status === 'success') {

          showToast(
            '✓ 이벤트가 저장되었습니다.',
            'success'
          );

          $('#title').val('');

        } else {

          showToast(
            res.message || '이벤트 저장에 실패했습니다.',
            'error'
          );

        }

      },

      error: function() {

        showToast(
          '서버 통신 중 오류가 발생했습니다.',
          'error'
        );

      },

      complete: function() {

        button
          .prop('disabled', false)
          .text('저장하기');

      }

    });

  });


  $(function() {

    const today = new Date();

    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');

    $('#event_date').val(
      `${yyyy}-${mm}-${dd}`
    );

  });

</script>