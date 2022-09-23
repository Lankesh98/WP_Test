<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Custom_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
		<div class="above-footer">
			<div class="row">
				 <?php //get_breadcrumb(); 
				// my_wp_custom_breadcrumbs(); ?>
			</div>
			<div class="row">
				<div class="col-12 col-sm-6 col-md-4">
					<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
				</div>
			</div>
		</div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'my-custom-theme' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'my-custom-theme' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'my-custom-theme' ), 'my-custom-theme', '<a href="http://underscores.me/">LANKESH</a>' );
				?>
		</div><!-- .site-info -->
</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

