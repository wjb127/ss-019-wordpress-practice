<?php
/**
 * SS Landing 테마 함수
 *
 * @package SS_Landing
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SS_LANDING_VERSION', '0.3.0' );

/* ============================================================
   테마 기본 설정
============================================================ */
function ss_landing_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'align-wide' );

	// WooCommerce 지원
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array(
		'primary' => __( '상단 메뉴', 'ss-landing' ),
		'footer'  => __( '하단 메뉴', 'ss-landing' ),
	) );
}
add_action( 'after_setup_theme', 'ss_landing_setup' );

/* ============================================================
   스타일/스크립트
============================================================ */
function ss_landing_enqueue_assets() {
	wp_enqueue_style( 'ss-landing-style', get_stylesheet_uri(), array(), SS_LANDING_VERSION );

	// GSAP (애니메이션)
	wp_enqueue_script(
		'gsap',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
		array(),
		'3.12.5',
		true
	);
	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.5',
		true
	);
	wp_enqueue_script(
		'ss-landing-animations',
		get_template_directory_uri() . '/js/animations.js',
		array( 'gsap', 'gsap-scrolltrigger' ),
		SS_LANDING_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ss_landing_enqueue_assets' );

// 불필요한 wp_head 정리
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/* ============================================================
   WooCommerce — 커스텀 훅
============================================================ */

// WooCommerce 기본 래퍼를 테마 컨테이너로 교체
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', function() {
	echo '<div class="section"><div class="container woo-wrap">';
}, 10 );

add_action( 'woocommerce_after_main_content', function() {
	echo '</div></div>';
}, 10 );

// 장바구니 아이콘을 헤더 메뉴에 추가
function ss_landing_cart_icon( $items, $args ) {
	if ( ! function_exists( 'WC' ) ) return $items;
	if ( 'primary' !== $args->theme_location ) return $items;

	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	$items .= '<li class="nav-cart"><a href="' . esc_url( wc_get_cart_url() ) . '">
		🛒 <span class="cart-count">' . esc_html( $count ) . '</span>
	</a></li>';
	return $items;
}
add_filter( 'wp_nav_menu_items', 'ss_landing_cart_icon', 10, 2 );

/* ============================================================
   멤버십 — 로그인 제한 페이지

   사용법:
   1. wp-admin > 페이지 > 새 페이지 > 페이지 속성에서
      "Members Only" 템플릿 선택
   2. 비로그인 사용자는 로그인 페이지로 자동 리다이렉트
============================================================ */
function ss_landing_members_only_redirect() {
	// members-only.php 템플릿이 적용된 페이지만 체크
	if ( is_page_template( 'members-only.php' ) && ! is_user_logged_in() ) {
		$redirect = add_query_arg( 'redirect_to', get_permalink(), wp_login_url() );
		wp_safe_redirect( $redirect );
		exit;
	}
}
add_action( 'template_redirect', 'ss_landing_members_only_redirect' );

// 로그인 후 redirect_to 파라미터로 원래 페이지 복귀
function ss_landing_login_redirect( $redirect_to, $request, $user ) {
	if ( isset( $_GET['redirect_to'] ) ) {
		return esc_url_raw( $_GET['redirect_to'] );
	}
	return $redirect_to;
}
add_filter( 'login_redirect', 'ss_landing_login_redirect', 10, 3 );

/* ============================================================
   Polylang — 다국어 헬퍼

   Polylang 플러그인 없으면 조건부 건너뜀.
   WPML 유료 대신 무료 Polylang 사용.
   WPML 원하면 플러그인만 교체하면 동일 구조로 동작.
============================================================ */
function ss_landing_language_switcher() {
	if ( ! function_exists( 'pll_the_languages' ) ) return;

	echo '<ul class="lang-switcher">';
	pll_the_languages( array(
		'show_flags'  => 0,
		'show_names'  => 1,
		'hide_if_one' => 1,
	) );
	echo '</ul>';
}

/* ============================================================
   ACF — 랜딩 페이지 커스텀 필드
============================================================ */
function ss_landing_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

	acf_add_local_field_group( array(
		'key'    => 'group_ss_landing_hero',
		'title'  => '히어로 섹션',
		'fields' => array(
			array( 'key' => 'field_hero_eyebrow',       'label' => '아이브로우',         'name' => 'hero_eyebrow',       'type' => 'text',     'default_value' => 'AI + WordPress 실전 강의' ),
			array( 'key' => 'field_hero_title',         'label' => '메인 타이틀',        'name' => 'hero_title',         'type' => 'text',     'default_value' => 'Claude랑 바이브 코딩으로' ),
			array( 'key' => 'field_hero_title_accent',  'label' => '타이틀 강조',        'name' => 'hero_title_accent',  'type' => 'text',     'default_value' => 'WordPress 개발 마스터하기' ),
			array( 'key' => 'field_hero_subtitle',      'label' => '서브타이틀',         'name' => 'hero_subtitle',      'type' => 'textarea', 'default_value' => '커스텀 테마 개발부터 카페24 실제 배포까지.' ),
			array( 'key' => 'field_hero_cta_primary',   'label' => 'CTA 버튼 (메인)',   'name' => 'hero_cta_primary',   'type' => 'text',     'default_value' => '강의 신청하기' ),
			array( 'key' => 'field_hero_cta_secondary', 'label' => 'CTA 버튼 (서브)',   'name' => 'hero_cta_secondary', 'type' => 'text',     'default_value' => '커리큘럼 보기' ),
			array( 'key' => 'field_hero_note',          'label' => '하단 주석',          'name' => 'hero_note',          'type' => 'text',     'default_value' => '* PHP 몰라도 됩니다. Claude가 다 짜줍니다.' ),
		),
		'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'front-page.php' ) ) ),
	) );

	acf_add_local_field_group( array(
		'key'    => 'group_ss_landing_sections',
		'title'  => '섹션 타이틀',
		'fields' => array(
			array( 'key' => 'field_why_title',         'label' => '강의 특징 타이틀',  'name' => 'why_title',         'type' => 'text', 'default_value' => '다른 강의와 다른 점' ),
			array( 'key' => 'field_why_lead',          'label' => '강의 특징 리드',    'name' => 'why_lead',          'type' => 'text', 'default_value' => '설정 클릭이 아니라 코드를 짜는 개발자가 됩니다.' ),
			array( 'key' => 'field_curriculum_title',  'label' => '커리큘럼 타이틀',   'name' => 'curriculum_title',  'type' => 'text', 'default_value' => '5단계 커리큘럼' ),
			array( 'key' => 'field_curriculum_lead',   'label' => '커리큘럼 리드',     'name' => 'curriculum_lead',   'type' => 'text', 'default_value' => '순서대로 따라하면 실제 납품 가능한 사이트를 만들 수 있습니다.' ),
			array( 'key' => 'field_apply_title',       'label' => '신청 섹션 타이틀',  'name' => 'apply_title',       'type' => 'text', 'default_value' => '강의 신청하기' ),
			array( 'key' => 'field_apply_lead',        'label' => '신청 섹션 리드',    'name' => 'apply_lead',        'type' => 'text', 'default_value' => '아래 폼 작성하면 24시간 내 연락드립니다.' ),
			array( 'key' => 'field_cf7_form_id',       'label' => 'CF7 폼 ID',        'name' => 'cf7_form_id',       'type' => 'text', 'default_value' => 'contact-form-1', 'instructions' => 'wp-admin > 문의에서 폼 ID 확인' ),
		),
		'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'front-page.php' ) ) ),
	) );
}
add_action( 'acf/init', 'ss_landing_register_acf_fields' );
