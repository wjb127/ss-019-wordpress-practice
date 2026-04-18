#!/usr/bin/env bash
# ============================================================
# 카페24 FTP 배포 스크립트 — ss-landing 테마
#
# 사용 전 .env.deploy 파일에 아래 항목 입력:
#   FTP_HOST=ftp.yourdomain.com
#   FTP_USER=yourftpuser
#   FTP_PASS=yourftppassword
#   FTP_REMOTE_PATH=/html/wp-content/themes
# ============================================================

set -e

# .env.deploy 로드
ENV_FILE="$(dirname "$0")/.env.deploy"
if [ ! -f "$ENV_FILE" ]; then
  echo "❌ .env.deploy 파일이 없습니다."
  echo "   .env.deploy.example을 복사해서 계정 정보를 입력하세요."
  exit 1
fi
source "$ENV_FILE"

THEME_DIR="$(dirname "$0")/themes/ss-landing"
REMOTE_THEME_PATH="${FTP_REMOTE_PATH}/ss-landing"

echo "=============================="
echo " SS Landing 테마 배포 시작"
echo " 호스트: $FTP_HOST"
echo " 원격 경로: $REMOTE_THEME_PATH"
echo "=============================="

# lftp로 FTP 업로드 (lftp 없으면 brew install lftp)
if ! command -v lftp &> /dev/null; then
  echo "❌ lftp가 설치되어 있지 않습니다."
  echo "   brew install lftp"
  exit 1
fi

lftp -c "
open -u ${FTP_USER},${FTP_PASS} ${FTP_HOST}
mirror --reverse --delete --verbose \
  --exclude='.DS_Store' \
  --exclude='.git/' \
  --exclude='node_modules/' \
  ${THEME_DIR}/ ${REMOTE_THEME_PATH}/
bye
"

echo ""
echo "✅ 배포 완료!"
echo "   wp-admin > 외모 > 테마에서 'SS Landing' 활성화하세요."
