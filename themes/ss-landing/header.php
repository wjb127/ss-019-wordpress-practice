<?php
/**
 * 헤더 템플릿
 *
 * @package SS_Landing
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
			<?php bloginfo( 'name' ); ?>
		</a>

		<nav class="site-nav" aria-label="메인 내비게이션">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 1,
				) );
			} else {
				?>
				<ul>
					<li><a href="#features">기능</a></li>
					<li><a href="#curriculum">커리큘럼</a></li>
					<li><a href="#apply">신청</a></li>
				</ul>
				<?php
			}
			?>
		</nav>

		<!-- Polylang 언어 전환 (플러그인 활성화 시 표시) -->
		<?php if ( function_exists( 'ss_landing_language_switcher' ) ) ss_landing_language_switcher(); ?>
	</div>
</header>

<main id="main" class="site-main">
