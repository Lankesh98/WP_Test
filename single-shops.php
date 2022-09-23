<?php
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
	<header class="entry-header">
		<!-- <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> -->
	</header><!-- .entry-header -->

	<?php //my_custom_theme_post_thumbnail(); ?>

	<div class="entry-content">
    <div class="container">

        <div class="row">
            <div class="col-lg-8">
            <div class="details-block">
							<!--Render Content-->
							<div class="details-block-title">								
									<h1><?php echo get_the_title(); ?></h1>
							</div>
							<div class="details-block-body">
                                <?php the_field('content'); ?>
							</div>
			</div>
                <?php
                   // the_content();
                ?>
            </div>
            <div class="col-lg-4">
            <div class="sidebar-block">
						<div class="location_sidebar_1 section">
                            <div class="sidebar-section">
                                <h4>Location</h4>
                                <?php the_field('location'); ?>
                        
                            </div>
                        </div>
                        <div class="sidebar_general_content_1 section">
                            <div class="sidebar-section">
                                <div class="sidebar-section">
                                    <h4>
                                        Operating Hours
                                    </h4>
                                        <?php the_field('operating_hours'); ?>
                                </div>
                            </div>
                        </div>

					</div>
                <?php
                    //the_content();
                ?>
            </div>
        </div>

        <div class="col-12 mt-5">
        <div class="details-block-title">								
			<h1>Gallery</h1>
		</div>
        <?php
    //Get the images ids from the post_metadata
    $images = acf_photo_gallery('gallery', $post->ID);
    //Check if return array has anything in it
    if( count($images) ):
        //Cool, we got some data so now let's loop over it
        foreach($images as $image):
            $full_image_url= $image['full_image_url']; //Full size image url
            $full_image_urll = acf_photo_gallery_resize_image($full_image_url, 262, 160); //Resized size to 262px width by 160px height image url
            $thumbnail_image_url= $image['thumbnail_image_url']; //Get the thumbnail size image url 150px by 150px
        
?>
<!-- <div class="col-xs-6 col-md-3">
    <div class="thumbnail">
        <?php if( !empty($url) ){ ?><a href="https://wordpress.org/plugins/navz-photo-gallery/<?php echo $url; ?>" <?php echo ($target == 'true' )? 'target="_blank"': ''; ?>><?php } ?>
            <img src="https://wordpress.org/plugins/navz-photo-gallery/<?php echo $full_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
        <?php if( !empty($url) ){ ?></a><?php } ?>
    </div>
</div> -->

<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="<?php echo $full_image_url; ?>" />
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <div thumbsSlider="" class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="<?php echo $thumbnail_image_url; ?>" />
        </div>
      </div>
    </div>
<?php endforeach; endif; ?>
       
        </div>
    
        </div>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'my-custom-theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php
//get_sidebar();
get_footer();
