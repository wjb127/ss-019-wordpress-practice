<?php
/**
 * SS Landing 테마 함수
 *
 * @package SS_Landing
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SS_LANDING_VERSION', '0.2.0' );

/* ============================================================
   테마 기본 설정
============================================================ */
function ss_landing_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'align-wide' );

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
}
add_action( 'wp_enqueue_scripts', 'ss_landing_enqueue_assets' );

// 불필요한 wp_head 정리
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/* ============================================================
   ACF — 랜딩 페이지 커스텀 필드 등록

   ACF 플러그인 없으면 조건부로 건너뜀.
   front-page.php의 ss_field() 헬퍼가 폴백값 처리함.
============================================================ */
function ss_landing_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

	acf_add_local_field_group( array(
		'key'      => 'group_ss_landing_hero',
		'title'    => '히어로 섹션',
		'fields'   => array(
			array(
				'key'           => 'field_hero_eyebrow',
				'label'         => '아이브로우 텍스트',
				'name'          => 'hero_eyebrow',
				'type'          => 'text',
				'default_value' => 'AI + WordPress 실전 강의',
				'instructions'  => '히어로 타이틀 위 작은 태그 문구',
			),
			array(
				'key'           => 'field_hero_title',
				'label'         => '메인 타이틀',
				'name'          => 'hero_title',
				'type'          => 'text',
				'default_value' => 'Claude랑 바이브 코딩으로',
			),
			array(
				'key'           => 'field_hero_title_accent',
				'label'         => '메인 타이틀 (강조, 파란색)',
				'name'          => 'hero_title_accent',
				'type'          => 'text',
				'default_value' => 'WordPress 개발 마스터하기',
			),
			array(
				'key'           => 'field_hero_subtitle',
				'label'         => '서브타이틀',
				'name'          => 'hero_subtitle',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => '커스텀 테마 개발부터 카페24 실제 배포까지 — 설정 말고 코딩으로 배우는 WordPress.',
			),
			array(
				'key'           => 'field_hero_cta_primary',
				'label'         => 'CTA 버튼 (메인)',
				'name'          => 'hero_cta_primary',
				'type'          => 'text',
				'default_value' => '강의 신청하기',
			),
			array(
				'key'           => 'field_hero_cta_secondary',
				'label'         => 'CTA 버튼 (서브)',
				'name'          => 'hero_cta_secondary',
				'type'          => 'text',
				'default_value' => '커리큘럼 보기',
			),
			array(
				'key'           => 'field_hero_note',
				'label'         => '하단 주석',
				'name'          => 'hero_note',
				'type'          => 'text',
				'default_value' => '* PHP 몰라도 됩니다. Claude가 다 짜줍니다.',
			),
		),
		'location' => array( array( array(
			'param'    => 'page_template',
			'operator' => '==',
			'value'    => 'front-page.php',
		) ) ),
	) );

	acf_add_local_field_group( array(
		'key'    => 'group_ss_landing_why',
		'title'  => '섹션 타이틀 (강의 특징 / 커리큘럼 / 신청)',
		'fields' => array(
			array(
				'key'           => 'field_why_title',
				'label'         => '강의 특징 타이틀',
				'name'          => 'why_title',
				'type'          => 'text',
				'default_value' => '다른 강의와 다른 점',
			),
			array(
				'key'           => 'field_why_lead',
				'label'         => '강의 특징 리드',
				'name'          => 'why_lead',
				'type'          => 'text',
				'default_value' => '설정 클릭이 아니라 코드를 짜는 개발자가 됩니다.',
			),
			array(
				'key'           => 'field_curriculum_title',
				'label'         => '커리큘럼 타이틀',
				'name'          => 'curriculum_title',
				'type'          => 'text',
				'default_value' => '5단계 커리큘럼',
			),
			array(
				'key'           => 'field_curriculum_lead',
				'label'         => '커리큘럼 리드',
				'name'          => 'curriculum_lead',
				'type'          => 'text',
				'default_value' => '순서대로 따라하면 실제 납품 가능한 WordPress 사이트를 만들 수 있습니다.',
			),
			array(
				'key'           => 'field_apply_title',
				'label'         => '신청 섹션 타이틀',
				'name'          => 'apply_title',
				'type'          => 'text',
				'default_value' => '강의 신청하기',
			),
			array(
				'key'           => 'field_apply_lead',
				'label'         => '신청 섹션 리드',
				'name'          => 'apply_lead',
				'type'          => 'text',
				'default_value' => '아래 폼 작성하면 24시간 내 연락드립니다.',
			),
			array(
				'key'           => 'field_cf7_form_id',
				'label'         => 'Contact Form 7 폼 ID',
				'name'          => 'cf7_form_id',
				'type'          => 'text',
				'default_value' => 'contact-form-1',
				'instructions'  => 'wp-admin > 문의에서 폼 ID 확인 후 입력 (예: contact-form-1)',
			),
		),
		'location' => array( array( array(
			'param'    => 'page_template',
			'operator' => '==',
			'value'    => 'front-page.php',
		) ) ),
	) );
}
add_action( 'acf/init', 'ss_landing_register_acf_fields' );
