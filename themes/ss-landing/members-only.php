<?php
/**
 * Template Name: Members Only
 * Template Post Type: page
 *
 * 로그인한 사용자만 접근 가능한 페이지.
 * 비로그인 접근 시 functions.php의 ss_landing_members_only_redirect()가 로그인 페이지로 보냄.
 *
 * @package SS_Landing
 */

get_header();
?>

<section class="section members-area">
	<div class="container" style="max-width:720px;">

		<div class="members-header">
			<span class="members-badge">멤버 전용</span>
			<h1 class="section__title" style="text-align:left; margin-top:16px;">
				<?php the_title(); ?>
			</h1>
			<p style="color:#666; font-size:14px;">
				안녕하세요, <strong><?php echo esc_html( wp_get_current_user()->display_name ); ?></strong>님.
			</p>
		</div>

		<div class="members-content entry-content">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>

		<div class="members-footer">
			<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="btn btn--ghost" style="font-size:13px;">
				로그아웃
			</a>
		</div>

	</div>
</section>

<?php
get_footer();
