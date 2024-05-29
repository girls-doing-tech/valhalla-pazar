<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prolancer
 */

if ( ! is_active_sidebar( 'sidebar_widgets' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar_widgets' ); ?>
</aside><!-- #secondary -->
