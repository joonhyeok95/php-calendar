<button onclick="load();">/api/sample/list 데이터를 로딩하기[javascript]</button>
<div id="txt1"></div>
<script>
    function load() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/api/sample/list', true);  // API 주소
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) { // 요청 완료
                if (xhr.status === 200) { // 성공
                    document.getElementById('txt1').innerText = xhr.responseText;
                } else {
                    document.getElementById('txt1').innerText = 'Error: ' + xhr.status;
                }
            }
        };
        xhr.send();
    }
</script>

<button id="btnSend">/api/sample/list 데이터를 로딩하기[Jquery]</button>
<div id="txt2"></div>
<script>
    $(document).ready(function() {
        $('#btnSend').click(function() {
            $.ajax({
            url: '/api/sample/list',
            method: 'GET',
            success: function(data) {
                // JSON 객체일 경우 문자열화 필요할 수 있음
                if (typeof data === 'object') {
                $('#txt2').text(JSON.stringify(data));
                } else {
                $('#txt2').text(data);
                }
            },
            error: function(xhr, status, error) {
                $('#txt2').text('Error: ' + xhr.status + ' ' + error);
            }
            });
        });
    });
</script>