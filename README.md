# Digital Clock Project

## 프로젝트 구조

```
htdocs/
├── index.php              # 메인 페이지 (디지털 시계)
├── css/
│   └── style.css         # 메인 스타일시트
├── js/
│   ├── clock.js          # 시계 기능
│   └── theme.js          # 테마 관리
├── pages/
│   └── about.php         # About 페이지
├── lib/                  # 외부 라이브러리 (필요시)
└── includes/             # PHP 공통 파일 (필요시)
```

## 주요 기능

### 🕐 디지털 시계
- 실시간 시간 표시
- 12시간/24시간 형식 전환
- 초 단위 업데이트
- 애니메이션 효과

### 🎨 테마
- 다크 모드 (기본)
- 라이트 모드
- 로컬 스토리지에 설정 저장
- 부드러운 전환 효과

### 📱 모바일 최적화
- 반응형 디자인
- 터치 친화적 인터페이스
- 다양한 화면 크기 지원
- Bootstrap 5 그리드 시스템

### ⚡ 추가 기능
- 요일 및 날짜 표시
- 연중 일수 표시
- 주차 표시
- 타임존 정보
- 키보드 단축키 지원 (T: 테마, F: 형식)

## 기술 스택

- **Frontend:**
  - HTML5
  - CSS3 (Flexbox, Grid, Animations)
  - JavaScript (ES6+)
  - Bootstrap 5
  
- **Backend:**
  - PHP 7.4+
  
- **Libraries:**
  - Bootstrap 5.3.0
  - Font Awesome 6.4.0
  - Google Fonts (Orbitron, Rajdhani)

## 브라우저 지원

- Chrome (최신 버전)
- Firefox (최신 버전)
- Safari (최신 버전)
- Edge (최신 버전)
- 모바일 브라우저 (iOS Safari, Chrome Mobile)

## 설치 및 실행

1. XAMPP 설치
2. htdocs 폴더에 프로젝트 파일 배치
3. Apache 서버 시작
4. 브라우저에서 `http://localhost/` 접속

## 키보드 단축키

- `T` - 테마 전환 (다크/라이트)
- `F` - 시간 형식 전환 (12시간/24시간)

## 성능 최적화

- CSS 애니메이션 하드웨어 가속
- RequestAnimationFrame 사용
- 배터리 절약 모드 지원
- Wake Lock API 지원 (화면 켜짐 유지)
- 네트워크 상태 감지

## Best Practices

- ✅ 시맨틱 HTML 사용
- ✅ 모듈화된 JavaScript (클래스 기반)
- ✅ BEM 스타일 명명 규칙
- ✅ 접근성 고려 (ARIA 레이블)
- ✅ 성능 최적화
- ✅ 모바일 퍼스트 디자인
- ✅ 크로스 브라우저 호환성

## 향후 개발 계획

- [ ] 알람 기능 추가
- [ ] 타이머/스톱워치 기능
- [ ] 세계 시간대 표시
- [ ] 사용자 설정 저장 (데이터베이스)
- [ ] PWA (Progressive Web App) 지원
- [ ] 다국어 지원

## 라이선스

MIT License

## 문의

프로젝트에 대한 문의사항이 있으시면 이슈를 등록해주세요.
