<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WOWtheme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<section id="sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</section><!-- #secondary -->
