<?php
/**
 * SS Landing 테마 함수
 *
 * @package SS_Landing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SS_LANDING_VERSION' ) ) {
	define( 'SS_LANDING_VERSION', '0.1.0' );
}

/**
 * 테마 기본 설정
 */
function ss_landing_setup() {
	// 타이틀 태그 자동 생성
	add_theme_support( 'title-tag' );

	// 글 썸네일 지원
	add_theme_support( 'post-thumbnails' );

	// HTML5 마크업 지원
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// 블록 에디터 와이드 정렬
	add_theme_support( 'align-wide' );

	// 메뉴 등록
	register_nav_menus(
		array(
			'primary' => __( '상단 메뉴', 'ss-landing' ),
			'footer'  => __( '하단 메뉴', 'ss-landing' ),
		)
	);
}
add_action( 'after_setup_theme', 'ss_landing_setup' );

/**
 * 스타일/스크립트 로드
 */
function ss_landing_enqueue_assets() {
	wp_enqueue_style(
		'ss-landing-style',
		get_stylesheet_uri(),
		array(),
		SS_LANDING_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'ss_landing_enqueue_assets' );

/**
 * 불필요한 wp_head 출력 정리
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
