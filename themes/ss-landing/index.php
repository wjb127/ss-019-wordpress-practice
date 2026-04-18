<?php
/**
 * 기본 템플릿 (폴백)
 *
 * @package SS_Landing
 */

get_header();
?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h2 class="section__title"><?php the_title(); ?></h2>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			endwhile;
		else :
			?>
			<p><?php esc_html_e( '게시글이 없습니다.', 'ss-landing' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
