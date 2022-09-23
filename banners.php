<?php
	$id =get_the_ID();
	$banner = get_field('banners',$id);
	 if  ($banner):
		$desktop_banner = $banner['desktop_banner'];
		$mobile_banner = $banner['mobile_banner'];
		$banner_title = $banner['banner_tittle'];
		

	 if ($desktop_banner != "" || $mobile_banner != "" || $banner_title != ""):
	 ?>
	 <div class="par parsys">
	<section class="banner section">
		<div class="banner ">
			<div class="banner-image parallax-container" style="padding-bottom: 30.5883%;">
				<img src="<?php echo $mobile_banner; ?>" class="d-lg-none" width="600" height="400" alt="Shoppes">
				<img src="<?php echo $desktop_banner; ?>" class="d-none d-lg-block" width="1366" height="600" alt="Shoppes">
			</div>
			<div class="banner-content">
				<div class="container">
					<h1 style="color: #FFFFFF">
						<?php echo $banner_title; ?>
					</h1>
					
				</div>
			</div>
		</div>
	</section>
	 </div>
	<?php
	endif;
	endif;
	?>