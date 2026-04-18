<?php
/**
 * WooCommerce 상품 목록 페이지
 *
 * @package SS_Landing
 */

get_header();
?>

<section class="section shop-archive">
	<div class="container">
		<h1 class="section__title">
			<?php woocommerce_page_title(); ?>
		</h1>

		<?php if ( have_posts() ) : ?>
			<?php woocommerce_product_loop_start(); ?>
				<?php woocommerce_product_subcategories(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; ?>
			<?php woocommerce_product_loop_end(); ?>
			<?php woocommerce_pagination(); ?>
		<?php else : ?>
			<?php wc_get_template( 'loop/no-products-found.php' ); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
