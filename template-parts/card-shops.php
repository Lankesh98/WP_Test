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
                                        <div class="row"><div class="col-1"><i class="fa fa-location-dot"></i></div><div class="col-11"><?php the_field('location_home'); ?></div></div>
                                        </p>
                                        <p class="card-text card-text-icon icon-operating-hr">
                                        <div class="row"><div class="col-1"><i class="fa-regular fa-clock"></i></div><div class="col-11"><?php the_field('operating_hours_home'); ?></div></div>
                                        </p>
                                    </div>
                                </a>
                            </div>