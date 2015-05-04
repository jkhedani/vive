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

		<!-- Home Gallery -->
		<div id="galleryjs-home" class="hero row galleryjs">
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
						<li class="animated slideInLeft <?php if ( !$i++ ) { echo 'active'; } ?>" data-slide="<?php echo $i; ?>">
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
							<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" href="#gallery-home" data-go-to-slide="<?php echo $i - 1; ?>"><?php echo $i - 1; ?></li>
						<?php endwhile; ?>
					</ul>
				<?php } ?>
		</div>

		<!-- Home Content -->
		<main id="main" class="site-main row" role="main">

			<!-- The Living Room -->
			<div class="the-living-room column col-sm-5">
				<div class="column-container">
					<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Living Room' ) ) ); ?>" title="Link To Living Room">
						<?php $living_room_image_object = get_field('home_page_image', get_ID_by_slug('living-room')); ?>
						<img src="<?php echo $living_room_image_object[sizes][large]; ?>" alt="<?php echo $living_room_image_object[alt]; ?>" />
						<div class="hover-overlay"><span class="black">The</span> Living Room</div>
					</a>
				</div>
			</div>

			<!-- Accommodations -->
			<div id="galleryjs-accommodations-home" class="accommodations column col-sm-7 galleryjs">
				<div class="column-container">
					<?php
						$accommodations = new WP_Query( array(
							'post_type'	 => 'accommodations',
							'post_count' => 3
						));
					?>
					<h2>Accommodations</h2>
					<ul class="gallery">
						<?php $i = 0; ?>
						<?php while( $accommodations->have_posts() ) : $accommodations->the_post(); ?>
							<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" data-slide="<?php echo $i; ?>">
								<h3><?php the_title(); ?></h3>
								<?php the_post_thumbnail(); ?>
							</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</ul>
					<?php $i = 0; ?>
					<ul class="gallery-breadcrumbs">
						<?php while( $accommodations->have_posts() ) : $accommodations->the_post(); ?>
							<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" href="#galleryjs-accommodations" data-go-to-slide="<?php echo $i; ?>"><?php echo $i; ?></li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</ul>
					<a href="#" class="slide-left"><i class="fa fa-angle-left"></i></a>
					<a href="#" class="slide-right"><i class="fa fa-angle-right"></i></a>
				</div>
			</div>

			<!-- Features -->
			<div class="features sidekick column col-sm-12">
				<div class="column-container">
					<?php $features_image_object = get_field('home_page_image', get_ID_by_slug('features')); ?>
					<div class="column-text">
						<h2>Vive <span class="orange">Features</span></h2>
						<p>Hawaii's only boutique hotel with 24/7 concierge.</p>
						<a href="#" class="cta orange-bg">Features</a>
					</div>
					<img src="<?php echo $features_image_object[url]; ?>" alt="<?php echo $features_image_object[alt]; ?>" />
				</div>
			</div>

			<!-- Specials -->
			<div class="specials-container sidekick column col-sm-12">

				<div class="specials-banner row">
					<div class="container">
						<div class="specials-banner-text col-sm-4">
							<h2>Vive <span class="orange">Specials</span></h2>
							<p>Only available on our website.</p>
						</div>
						<div class="image-mask col-sm-8">
							<?php $specials_image_object = get_field('home_page_image', get_ID_by_slug('specials')); ?>
						  <img src="<?php echo $specials_image_object[url]; ?>" alt="<?php echo $specials_image_object[alt]; ?>" />
						</div>
					</div>
				</div>

				<?php
					$specials = new WP_Query( array(
						'post_type' 	=> 'specials',
						'post_count'	=> 3,
						'order'				=> 'ASC'
					));
				?>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<ul class="specials">
						<?php while( $specials->have_posts() ) : $specials->the_post(); ?>
							<li>
								<h3><?php the_title(); ?></h3>
								<p><?php the_excerpt(); ?></p>
							</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
						</ul>
						<a href="#" class="specials-view-all">View All</a>
					</div>
				</div><!-- .row -->
			</div><!-- .specials-container -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
