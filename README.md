# SS-019 WordPress Practice

워드프레스 + 카페24 호스팅으로 랜딩페이지 만드는 연습 저장소.

## 목표

- 워드프레스 커스텀 테마 개발 숙련
- 카페24 호스팅 환경에 배포하는 워크플로우 체득
- 실무에서 쓸 수 있는 랜딩페이지 스타터 확보

## 요구 환경

- Node.js 18+
- Docker Desktop (로컬 워드프레스 구동용)
- pnpm (권장) 또는 npm

## 프로젝트 구조

```
.
├── .wp-env.json           # wp-env 구성
├── package.json           # 스크립트 및 의존성
├── themes/
│   └── ss-landing/        # 커스텀 스타터 테마
│       ├── style.css
│       ├── functions.php
│       ├── header.php
│       ├── footer.php
│       ├── index.php
│       └── front-page.php
└── mu-plugins/            # must-use 플러그인 (선택)
```

## 로컬 개발 시작

```bash
# 1. 의존성 설치
pnpm install

# 2. 워드프레스 환경 기동 (Docker 필요)
pnpm start

# 3. 어드민 접속
# http://localhost:8888/wp-admin
# 초기 계정: admin / password
pnpm login
```

환경 정리

```bash
pnpm stop       # 컨테이너 중지
pnpm destroy    # 컨테이너 + 볼륨 완전 제거
pnpm clean      # DB 초기화
```

## 테마 활성화

1. `pnpm start` 로 워드프레스 기동
2. `/wp-admin` 접속 (admin / password)
3. 외모 > 테마 > **SS Landing** 활성화
4. 설정 > 리딩 > "정적 페이지"로 홈페이지 지정 시 `front-page.php` 가 우선 적용됨

## 카페24 배포 가이드

### 1. 호스팅 준비
- 카페24 매니지드 워드프레스 또는 10G 광호스팅 + 워드프레스 자동설치
- MySQL DB 정보 확보 (호스트/계정/비밀번호/DB명)
- FTP 계정 확인

### 2. 테마 업로드
```
ftp://your-cafe24-host
└── /html/ (또는 /www/)
    └── wp-content/
        └── themes/
            └── ss-landing/   ← 이 디렉토리 업로드
```

FileZilla 또는 아래 rsync 명령:

```bash
rsync -avz --exclude='.DS_Store' \
  themes/ss-landing/ \
  user@your-cafe24-host:/html/wp-content/themes/ss-landing/
```

### 3. 어드민에서 활성화
- `https://도메인/wp-admin` > 외모 > 테마 > SS Landing 활성화

### 4. 체크리스트
- [ ] 퍼머링크 설정 (설정 > 고유주소 > "글 이름")
- [ ] 사이트 제목/설명 변경
- [ ] 홈페이지를 "정적 페이지"로 지정
- [ ] HTTPS 강제 리다이렉트 확인
- [ ] 캐시 플러그인 설치 (WP Super Cache 등)

## 개발 규칙

- 테마 파일 수정 시 버전 상수 `SS_LANDING_VERSION` 올릴 것 (캐시 무효화)
- PHP 들여쓰기: 탭
- 모든 출력은 `esc_html() / esc_url() / esc_attr()` 로 이스케이프
- 국제화: `__()`, `_e()`, `esc_html__()` 사용 (text domain: `ss-landing`)

## 로드맵

- [x] 로컬 wp-env 세팅
- [x] 스타터 테마 뼈대
- [ ] ACF 기반 편집 가능한 섹션 구성
- [ ] Contact Form 7 리드폼 연동
- [ ] 카페24 실제 배포
- [ ] 블록 테마(FSE) 버전 분기
