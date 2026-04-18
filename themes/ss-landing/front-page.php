<?php
/**
 * 프론트 페이지 — WordPress 개발 강의 랜딩
 *
 * ACF 필드가 있으면 어드민 값 사용, 없으면 기본값 폴백
 *
 * @package SS_Landing
 */

get_header();

// ACF 헬퍼: 필드 값 없으면 기본값 반환
function ss_field( $key, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $key );
		return $val ? $val : $default;
	}
	return $default;
}
?>

<!-- ============================================================
     HERO
============================================================ -->
<section class="hero" aria-label="히어로">
	<div class="container">
		<p class="hero__eyebrow">
			<?php echo esc_html( ss_field( 'hero_eyebrow', 'AI + WordPress 실전 강의' ) ); ?>
		</p>
		<h1 class="hero__title">
			<?php echo esc_html( ss_field( 'hero_title', 'Claude랑 바이브 코딩으로' ) ); ?><br>
			<span class="hero__title--accent">
				<?php echo esc_html( ss_field( 'hero_title_accent', 'WordPress 개발 마스터하기' ) ); ?>
			</span>
		</h1>
		<p class="hero__subtitle">
			<?php echo esc_html( ss_field( 'hero_subtitle', '커스텀 테마 개발부터 카페24 실제 배포까지 — 설정 말고 코딩으로 배우는 WordPress.' ) ); ?>
		</p>
		<div class="hero__actions">
			<a href="#apply" class="btn btn--primary">
				<?php echo esc_html( ss_field( 'hero_cta_primary', '강의 신청하기' ) ); ?>
			</a>
			<a href="#curriculum" class="btn btn--ghost">
				<?php echo esc_html( ss_field( 'hero_cta_secondary', '커리큘럼 보기' ) ); ?>
			</a>
		</div>
		<p class="hero__note">
			<?php echo esc_html( ss_field( 'hero_note', '* PHP 몰라도 됩니다. Claude가 다 짜줍니다.' ) ); ?>
		</p>
	</div>
</section>

<!-- ============================================================
     STATS — 왜 워드프레스인가
============================================================ -->
<section class="stats section" aria-label="왜 워드프레스인가">
	<div class="container">
		<div class="stats__grid">
			<div class="stat-item">
				<div class="stat-item__number">43%</div>
				<div class="stat-item__label">전 세계 웹사이트 점유율</div>
			</div>
			<div class="stat-item">
				<div class="stat-item__number">99%</div>
				<div class="stat-item__label">국내 중소기업 WordPress 의뢰 비율</div>
			</div>
			<div class="stat-item">
				<div class="stat-item__number">0원</div>
				<div class="stat-item__label">소프트웨어 라이선스 비용</div>
			</div>
		</div>
	</div>
</section>

<!-- ============================================================
     WHY — 이 강의를 들어야 하는 이유
============================================================ -->
<section class="why section" aria-label="강의 특징">
	<div class="container">
		<h2 class="section__title">
			<?php echo esc_html( ss_field( 'why_title', '다른 강의와 다른 점' ) ); ?>
		</h2>
		<p class="section__lead">
			<?php echo esc_html( ss_field( 'why_lead', '설정 클릭이 아니라 코드를 짜는 개발자가 됩니다.' ) ); ?>
		</p>

		<div class="why__grid">
			<div class="why-card">
				<div class="why-card__icon">🤖</div>
				<h3 class="why-card__title">Claude 바이브 코딩</h3>
				<p class="why-card__desc">PHP 몰라도 됩니다. Claude에게 원하는 기능을 말하면 코드를 짜줍니다. 그걸 이해하고 올리는 것만 배웁니다.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon">🏗️</div>
				<h3 class="why-card__title">처음부터 커스텀 테마</h3>
				<p class="why-card__desc">Elementor 드래그앤드롭 없이 PHP 파일 직접 만듭니다. 구조를 이해하면 어떤 사이트든 수정할 수 있습니다.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon">🚀</div>
				<h3 class="why-card__title">실제 배포까지</h3>
				<p class="why-card__desc">로컬 개발 → FTP 업로드 → 카페24 라이브 배포까지 실제 클라이언트 납품 워크플로우 그대로 실습합니다.</p>
			</div>
			<div class="why-card">
				<div class="why-card__icon">💼</div>
				<h3 class="why-card__title">클라이언트 대응법</h3>
				<p class="why-card__desc">WordPress.com vs .org 구분, 의뢰 수락/거절 판단 기준, 서버 정보 받는 방법까지. 실무 바로 적용 가능합니다.</p>
			</div>
		</div>
	</div>
</section>

<!-- ============================================================
     CURRICULUM
============================================================ -->
<section id="curriculum" class="curriculum section" aria-label="커리큘럼">
	<div class="container">
		<h2 class="section__title">
			<?php echo esc_html( ss_field( 'curriculum_title', '5단계 커리큘럼' ) ); ?>
		</h2>
		<p class="section__lead">
			<?php echo esc_html( ss_field( 'curriculum_lead', '순서대로 따라하면 실제 납품 가능한 WordPress 사이트를 만들 수 있습니다.' ) ); ?>
		</p>

		<div class="curriculum__list">
			<div class="curriculum-step">
				<div class="curriculum-step__num">01</div>
				<div class="curriculum-step__body">
					<h3 class="curriculum-step__title">로컬 개발 환경 세팅</h3>
					<p class="curriculum-step__desc">Docker + @wordpress/env 로 내 컴퓨터에 WordPress 환경 구축. wp-admin 접속, 테마 활성화, 파일 구조 파악.</p>
					<div class="curriculum-step__tags">
						<span class="tag">Docker</span>
						<span class="tag">wp-env</span>
						<span class="tag">파일 구조</span>
					</div>
				</div>
			</div>

			<div class="curriculum-step">
				<div class="curriculum-step__num">02</div>
				<div class="curriculum-step__body">
					<h3 class="curriculum-step__title">커스텀 테마 개발</h3>
					<p class="curriculum-step__desc">style.css 테마 헤더, functions.php, header/footer.php, front-page.php. 원페이지 랜딩 구조를 PHP로 직접 작성.</p>
					<div class="curriculum-step__tags">
						<span class="tag">PHP</span>
						<span class="tag">템플릿 계층</span>
						<span class="tag">CSS</span>
					</div>
				</div>
			</div>

			<div class="curriculum-step">
				<div class="curriculum-step__num">03</div>
				<div class="curriculum-step__body">
					<h3 class="curriculum-step__title">ACF로 어드민 편집 가능하게</h3>
					<p class="curriculum-step__desc">Advanced Custom Fields 설치 + 필드 등록. 코드 안 건드리고 wp-admin에서 텍스트/이미지 바꿀 수 있도록 구성.</p>
					<div class="curriculum-step__tags">
						<span class="tag">ACF</span>
						<span class="tag">get_field()</span>
						<span class="tag">커스텀 필드</span>
					</div>
				</div>
			</div>

			<div class="curriculum-step">
				<div class="curriculum-step__num">04</div>
				<div class="curriculum-step__body">
					<h3 class="curriculum-step__title">Contact Form 7 리드폼 연동</h3>
					<p class="curriculum-step__desc">CF7 설치 + 폼 shortcode 삽입. 이름/연락처/메시지 수집. 실제 이메일 수신까지 확인.</p>
					<div class="curriculum-step__tags">
						<span class="tag">Contact Form 7</span>
						<span class="tag">shortcode</span>
						<span class="tag">이메일 수신</span>
					</div>
				</div>
			</div>

			<div class="curriculum-step">
				<div class="curriculum-step__num">05</div>
				<div class="curriculum-step__body">
					<h3 class="curriculum-step__title">카페24 실제 배포</h3>
					<p class="curriculum-step__desc">FTP로 테마 업로드, phpMyAdmin DB 이전, wp-config.php 설정. 로컬 개발 사이트를 라이브 도메인으로 배포.</p>
					<div class="curriculum-step__tags">
						<span class="tag">FTP</span>
						<span class="tag">카페24</span>
						<span class="tag">wp-config</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ============================================================
     OUTCOMES — 수강 후 할 수 있는 것
============================================================ -->
<section class="outcomes section" aria-label="수강 후 할 수 있는 것">
	<div class="container">
		<h2 class="section__title">수강 후 할 수 있는 것</h2>
		<div class="outcomes__grid">
			<div class="outcome-item">
				<span class="outcome-item__check">✓</span>
				<span>클라이언트 WordPress 사이트 수정 의뢰 바로 수락</span>
			</div>
			<div class="outcome-item">
				<span class="outcome-item__check">✓</span>
				<span>랜딩페이지 처음부터 제작 → 카페24 배포까지</span>
			</div>
			<div class="outcome-item">
				<span class="outcome-item__check">✓</span>
				<span>WordPress.com vs .org 즉시 구분, 의뢰 대응</span>
			</div>
			<div class="outcome-item">
				<span class="outcome-item__check">✓</span>
				<span>Claude로 PHP 코드 생성 + 검토 + 배포 워크플로우</span>
			</div>
			<div class="outcome-item">
				<span class="outcome-item__check">✓</span>
				<span>ACF로 클라이언트가 직접 콘텐츠 편집 가능하게</span>
			</div>
			<div class="outcome-item">
				<span class="outcome-item__check">✓</span>
				<span>FTP + phpMyAdmin 없이 막히는 일 없음</span>
			</div>
		</div>
	</div>
</section>

<!-- ============================================================
     APPLY — 신청 폼 (Contact Form 7)
============================================================ -->
<section id="apply" class="apply section" aria-label="강의 신청">
	<div class="container">
		<h2 class="section__title">
			<?php echo esc_html( ss_field( 'apply_title', '강의 신청하기' ) ); ?>
		</h2>
		<p class="section__lead">
			<?php echo esc_html( ss_field( 'apply_lead', '아래 폼 작성하면 24시간 내 연락드립니다.' ) ); ?>
		</p>

		<div class="apply__form-wrap">
			<?php
			// Contact Form 7가 활성화되어 있으면 shortcode 출력
			// 활성화 전에는 안내 메시지 표시
			if ( function_exists( 'wpcf7' ) ) {
				// 폼 ID는 CF7 설치 후 wp-admin > 문의에서 확인
				echo do_shortcode( '[contact-form-7 id="' . esc_attr( ss_field( 'cf7_form_id', 'contact-form-1' ) ) . '" title="강의 신청"]' );
			} else {
				?>
				<div class="apply__fallback">
					<p class="apply__fallback-msg">Contact Form 7 플러그인을 설치하면 신청 폼이 여기에 표시됩니다.</p>
					<p><strong>wp-admin > 플러그인 > Contact Form 7 설치</strong></p>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>

<?php
get_footer();
