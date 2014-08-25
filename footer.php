<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WOWtheme
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class = "widget-wrap">
			<?php if ( is_active_sidebar( 'footer-left' ) && is_active_sidebar( 'footer-center' ) && is_active_sidebar( 'footer-right' ) ): ?>
				<?php dynamic_sidebar( 'footer-left' ); ?>
				<?php dynamic_sidebar( 'footer-center' ); ?>
				<?php dynamic_sidebar( 'footer-right' ); ?>
			<?php endif; ?>
		</div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'wow-theme' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'wow-theme' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'wow-theme' ), 'WOWtheme', '<a href="http://mainstreetcreativeco.com" rel="designer">Colin Williams</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
