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
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="container site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
			<?php bloginfo( 'name' ); ?>
		</a>

		<nav class="site-nav" aria-label="<?php esc_attr_e( '메인 내비게이션', 'ss-landing' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'depth'          => 1,
					)
				);
			} else {
				?>
				<ul>
					<li><a href="#features"><?php esc_html_e( '기능', 'ss-landing' ); ?></a></li>
					<li><a href="#cta"><?php esc_html_e( '문의', 'ss-landing' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
