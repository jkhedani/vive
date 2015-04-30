<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Vive
 */

get_header(); ?>

	<div id="primary" class="content-area container-fluid">
		<main id="main" class="site-main row" role="main">

			<!-- Accommodations Gallery -->
			<div class="hero col-sm-12">
				<div id="galleryjs-<?php echo $post->post_name; ?>" class="hero row galleryjs">
					<?php
						$gallery = get_field('related_gallery', $post->ID);
						if ( have_rows('gallery_images', $gallery->ID ) ) { ?>
							<?php $i = 0; ?>
							<ul class="gallery">
							<?php while ( have_rows('gallery_images', $gallery->ID ) ) : the_row();
								$gallery_image_url 		= get_sub_field('gallery_image');
								$gallery_image_title  = get_sub_field('gallery_image_title');
								$gallery_image_text 	= get_sub_field('gallery_image_text');
								$gallery_image_title_colorization = get_sub_field('colorize_words_in_title');
								$gallery_image_title_array = str_word_count($gallery_image_title,1);
								foreach( $gallery_image_title_colorization as $word_selection ) {
									// Skip word colorization if we run into 'none'
									if ( $word_selection !== 'none' ) {
										// Find the appropriate key in the title to colorize
										// $word_selection int Should match the key index in the gallery image title array
										$gallery_image_title_array[$word_selection] = '<span class="orange">' . $gallery_image_title_array[$word_selection] . '</span>';
									}
								}
								$gallery_image_title = implode(' ', $gallery_image_title_array);
							?>
								<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" data-slide="<?php echo $i; ?>">
									<?php if ( $gallery_image_title && $gallery_image_text ) : ?>
										<div class="gallery-text-wrapper">
											<h2 class="gallery-title"><?php echo $gallery_image_title; ?></h2>
											<p class="gallery-text"><?php echo $gallery_image_text; ?></p>
										</div>
									<?php endif; ?>
									<img src="<?php echo $gallery_image_url; ?>" alt="" />
									<div class="black-gradient left"></div>
									<div class="black-gradient right"></div>
								</li>
							<?php endwhile; ?>
							</ul>
							<?php $i = 0; ?>
							<ul class="gallery-breadcrumbs">
								<?php while ( have_rows('gallery_images', $gallery->ID ) ) : the_row(); ?>
									<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" href="#galleryjs-<?php echo $post->slug; ?>" data-go-to-slide="<?php echo $i; ?>"><?php echo $i; ?></li>
								<?php endwhile; ?>
							</ul>
							<!--<a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
							<a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a> -->
						<?php } ?>
				</div>
			</div>

			<!-- Content -->
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="clear-bar fat">
					<h1>Sweeping Accomodations</h1>
					<div class="content"><?php echo get_the_content(); ?></div>
					<div class="select-room-dropdown-container dropdown">
						<a class="select-room dropdown-toggle" data-toggle="dropdown">Select room <i class="fa fa-chevron-down"></i></a>
						<ul class="dropdown-menu">
							<li><a href="#cosmopolitan-room" data-scroll data-options='{ "offset": 60 }'>Cosmopolitan Room</a></li>
							<li><a href="#junior-lifestyle-suite" data-scroll data-options='{ "offset": 60 }'>Junior Lifestyle Suite</a></li>
							<li><a href="#penthouse" data-scroll data-options='{ "offset": 60 }'>Ultimate Penthouse Suite</a></li>
						</ul>
					</div>

				</div>
			<?php endwhile; ?>

			<!-- Specials -->
			<?php
				$accommodations = new WP_Query( array(
					'post_type' 	=> 'accommodations',
					'post_count'	=> -1,
					'order'				=> ASC
				));
			?>
			<ul class="accommodations">
			<?php while( $accommodations->have_posts() ) : $accommodations->the_post(); ?>
				<?php
					$title = get_the_title();
					$title_colorization = get_field('colorize_words_in_title');
					$title_array = str_word_count($title,1);
					foreach( $title_colorization as $word_selection ) {
						// Skip word colorization if we run into 'none'
						if ( $word_selection !== 'none' ) {
							// Find the appropriate key in the title to colorize
							// $word_selection int Should match the key index in the gallery image title array
							$title_array[$word_selection] = '<span class="orange">' . $title_array[$word_selection] . '</span>';
						}
					}
					$title = implode(' ', $title_array);
				?>
				<li id="<?php echo $post->post_name; ?>"class="accommodation">
					<h3><?php echo $title; ?></h3>
					<!-- Accommodations Galleries -->
					<div id="galleryjs-<?php echo $post->post_name; ?>" class="galleryjs">
						<?php
							$gallery = get_field('related_gallery', $post->ID);
							if ( have_rows('gallery_images', $gallery->ID ) ) { ?>
								<?php $i = 0; ?>
								<ul class="gallery">
								<?php while ( have_rows('gallery_images', $gallery->ID ) ) : the_row();
									$gallery_image_url = get_sub_field('gallery_image'); ?>
									<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" data-slide="<?php echo $i; ?>">
										<img src="<?php echo $gallery_image_url; ?>" alt="" />
									</li>
								<?php endwhile; ?>
								</ul>
								<?php $i = 0; ?>
								<ul class="gallery-breadcrumbs">
									<?php while ( have_rows('gallery_images', $gallery->ID ) ) : the_row(); ?>
										<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" href="#galleryjs-<?php echo $post->slug; ?>" data-go-to-slide="<?php echo $i; ?>"><?php echo $i; ?></li>
									<?php endwhile; ?>
								</ul>
							<?php } ?>
					</div>

					<div class="container-fluid">
					<div class="row">
						<div class="amenities-tabs col-sm-8 col-sm-offset-2" role="tabpanel">
						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#<?php echo $post->post_name; ?>-overview" aria-controls="home" role="tab" data-toggle="tab">Overview</a></li>
						    <li role="presentation"><a href="#<?php echo $post->post_name; ?>-amenities" aria-controls="profile" role="tab" data-toggle="tab">Amenities</a></li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="<?php echo $post->post_name; ?>-overview"><?php echo get_the_content(); ?></div>
						    <div role="tabpanel" class="tab-pane" id="<?php echo $post->post_name; ?>-amenities">
									<ul class="amenities">
									<?php while ( have_rows('amenities', $post->ID ) ) : the_row(); ?>
										<li class="amenity"><?php echo get_sub_field('amenity'); ?></li>
									<?php endwhile; ?>
									</ul>
								</div>
						  </div>

							<!-- Availability link -->
							<a href="#" class="btn btn-primary">Availability</a>
						</div><!-- .amenities-tabs -->
					</div><!-- .row -->
					</div>

				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			</ul>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
