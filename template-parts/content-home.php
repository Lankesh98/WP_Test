<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_Custom_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="container">

	<header class="entry-header">
		<!-- <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?> -->
	</header><!-- .entry-header -->

	<?php //my_custom_theme_post_thumbnail(); ?>

	<div class="entry-content">
    <?php
		the_content(); ?>

        <div class="row align-middle mb-3">
            <div class="col-6 d-flex justify-content-end">
                <div class="dropdown dropdown-menu-filter">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </button>
                    <div class="row dropdown-menu flex-row allow-focus">
                        <?php
                    $categories = get_categories();
    $uncategorized_id = get_cat_ID( 'Uncategorized' );
    $categories_list = '';

    foreach ( $categories as $category ) {
        if ( $category->category_parent == $uncategorized_id
                || $category->cat_ID == $uncategorized_id ) {
            continue;
        }
        ?>
        <div class="col-6" ng-repeat="option in shopFilter.options">
             <label class="checkbox">
                 <input type="checkbox" id="<?php echo $category->cat_ID; ?>" class="category-<?php echo $category->cat_ID; ?> shop_cat" name="shop_cat[]" value="<?php echo $category->cat_ID; ?>" onchange="fetch()">
                <span></span>
                   <?php echo $category->name; ?>
              </label>
         </div>
            <!-- <li><a class="dropdown-item" href="#" id="<?php echo $category->cat_ID; ?>"><?php echo $category->name; ?></a></li> -->
        <?php
        // $categories_list .=
        //     '<li><a href="' . get_category_link( $category->cat_ID ) . '">' .
        //     $category->name .
        //     '</a></li>';

    }
    ?>
                        <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
</div>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-start">
                <div class="search_bar">
                    <form action="/" method="get" autocomplete="off">
                        <input type="text" name="s" placeholder="Search Code..." id="keyword" class="input_search" onkeyup="fetch()">
                    </form>
                </div>
            </div>
        </div>
		
       
        <div class="row shop_archive mb-4">
        <?php

		 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;    
         $args = array(
          'post_type'      => 'shops',
          'order'          => 'ASC',
          'orderby'        => 'post_title',
          'posts_per_page'      => '8', //how many posts you need
          'paged'          => $paged //add the 'paged' parameter
          );
          $parent = new WP_Query( $args );
          if ( $parent->have_posts() ) : ?>
         
           <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>       
           
           <div class="col-md-6 col-lg-3 listing-content-item mb-4">
                                <a class="card card-box h-100" href="<?php the_permalink(); ?>">
                                    
                                    <div class="card-image">
                                        <img class="card-img-top lazyloaded" width="600" height="450" src="<?php the_field('shop_image'); ?>">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo get_the_title( get_the_ID() ); ?></h5>
                                    </div>
                                    <div class="card-footer" style="min-height: 210px;">
                                        <p class="card-text card-text-icon icon-location">
                                        <div class="row"><div class="col-1"><i class="fa fa-location-dot"></i></div><div class="col-11"><?php echo the_field('location_home'); ?></div></div>
                                        </p>
                                        <p class="card-text card-text-icon icon-operating-hr">
                                        <div class="row"><div class="col-1"><i class="fa-regular fa-clock"></i></div><div class="col-11"><?php echo the_field('operating_hours_home'); ?></div></div>
                                        </p>
                                    </div>
                                </a>
                            </div>
          
           <?php endwhile; ?>
          
          <?php endif; ?>
        <?php wp_reset_query(); ?>
          </div>
          <div id="row content_more"></div>
          <?php
          if ( $parent->max_num_pages > 1 ) :
	echo '<div class="row mb-4"><button id="loadmore" class="form-control mb-4">More posts</button></div>'; // you can use <a> as well

endif;
?>
	</div><!-- .entry-content -->

</div>
</article><!-- #post-<?php the_ID(); ?> -->
