<?php
/**
 * 푸터 템플릿
 *
 * @package SS_Landing
 */
?>
</main>

<footer class="site-footer">
	<div class="container">
		<p>
			&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
			<?php bloginfo( 'name' ); ?>.
			<?php esc_html_e( 'All rights reserved.', 'ss-landing' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
