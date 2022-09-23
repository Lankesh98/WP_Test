<?php /* Template Name: Template Weather*/ 

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_Custom_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
	<?php require get_template_directory().'/banners.php'; ?>
		<?php
		while ( have_posts() ) :
			the_post();

			?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="container">

	<header class="entry-header">
		<!-- <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> -->
	</header><!-- .entry-header -->

	<?php //my_custom_theme_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();
        weather_report_func();
		?>
	</div><!-- .entry-content -->

</div>
</article>
<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php
//get_sidebar();
get_footer();




?>
