<?php
/**
 * 프론트 페이지 (랜딩) 템플릿
 *
 * @package SS_Landing
 */

get_header();
?>

<section class="hero">
	<div class="container">
		<h1 class="hero__title">
			<?php esc_html_e( '랜딩페이지 헤드라인을 여기에', 'ss-landing' ); ?>
		</h1>
		<p class="hero__subtitle">
			<?php esc_html_e( '서비스/제품의 핵심 가치를 한 문장으로 전달하세요.', 'ss-landing' ); ?>
		</p>
		<a href="#cta" class="hero__cta">
			<?php esc_html_e( '지금 시작하기', 'ss-landing' ); ?>
		</a>
	</div>
</section>

<section id="features" class="section features">
	<div class="container">
		<h2 class="section__title"><?php esc_html_e( '핵심 기능', 'ss-landing' ); ?></h2>
		<p class="section__lead">
			<?php esc_html_e( '왜 이 서비스를 선택해야 하는지 3가지 이유로 설명하세요.', 'ss-landing' ); ?>
		</p>

		<div class="features__grid">
			<article class="feature-card">
				<div class="feature-card__icon">⚡</div>
				<h3 class="feature-card__title"><?php esc_html_e( '빠른 속도', 'ss-landing' ); ?></h3>
				<p class="feature-card__desc">
					<?php esc_html_e( '최적화된 구조로 빠르게 로드됩니다.', 'ss-landing' ); ?>
				</p>
			</article>

			<article class="feature-card">
				<div class="feature-card__icon">🎯</div>
				<h3 class="feature-card__title"><?php esc_html_e( '전환 최적화', 'ss-landing' ); ?></h3>
				<p class="feature-card__desc">
					<?php esc_html_e( 'CTA 중심 구성으로 전환율을 높입니다.', 'ss-landing' ); ?>
				</p>
			</article>

			<article class="feature-card">
				<div class="feature-card__icon">📱</div>
				<h3 class="feature-card__title"><?php esc_html_e( '모바일 퍼스트', 'ss-landing' ); ?></h3>
				<p class="feature-card__desc">
					<?php esc_html_e( '모바일 환경에서 완벽하게 동작합니다.', 'ss-landing' ); ?>
				</p>
			</article>
		</div>
	</div>
</section>

<section id="cta" class="section cta">
	<div class="container">
		<h2 class="section__title"><?php esc_html_e( '지금 바로 시작하세요', 'ss-landing' ); ?></h2>
		<p class="section__lead">
			<?php esc_html_e( '간단한 문의 한 번으로 시작할 수 있습니다.', 'ss-landing' ); ?>
		</p>
		<a href="mailto:contact@example.com" class="cta__button">
			<?php esc_html_e( '상담 신청하기', 'ss-landing' ); ?>
		</a>
	</div>
</section>

<?php
get_footer();
