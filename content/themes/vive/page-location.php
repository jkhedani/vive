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

	<div id="primary" class="content-area">
		<main id="main" class="container-fluid site-main" role="main">

			<!-- Location Gallery -->
			<div id="galleryjs-location" class="hero row galleryjs">
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
								<div class="black-gradient right">
							</li>
						<?php endwhile; ?>
						</ul>
						<?php $i = 0; ?>
						<ul class="gallery-breadcrumbs">
							<?php while ( have_rows('gallery_images', $gallery->ID ) ) : the_row(); ?>
								<li class="<?php if ( !$i++ ) { echo 'active'; } ?>" href="#gallery-home" data-go-to-slide="<?php echo $i; ?>"><?php echo $i; ?></li>
							<?php endwhile; ?>
						</ul>
					<?php } ?>
			</div>

			<!-- Google Maps & Contact Form -->
			<div class="row location-lower">
				<div class="location-lower-wrapper col-sm-12">
					<div class="row">
						<!-- Google Map -->
						<div class="col-sm-6">
							<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Vive%20Hotel%20Waikiki%2C%20Kuhio%20Avenue%2C%20Honolulu%2C%20HI%2C%20United%20States&key=AIzaSyBqk7HNxiZdVed-H0J4reY5ml2TNaOhbZE"></iframe>
						</div>
						<!-- Contact Form -->
						<div class="col-sm-6">

							<form id="location-contact-form" type="POST" action="#">
								<h2>Get in touch</h2>
								<div class="input-group">
									<label for="name">Name:</label>
									<input id="name" class="form-control" type="text" placeholder="Enter your name" />
								</div>
								<div class="input-group">
									<label for="email">Email Address:</label>
									<input id="email" class="form-control" type="text" placeholder="Enter your email address" />
								</div>
								<input type="submit" class="btn btn-primary" name="Submit" />

							</form
						</div>
					</div>
				</div><!-- .location-lower-wrapper -->
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
