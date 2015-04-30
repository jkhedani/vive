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
		<main id="main" class="site-main container-fluid" role="main">

			<!-- Specials -->
			<div class="specials-banner row">
				<div class="container">
					<div class="specials-banner-text col-sm-4">
						<h2>Vive <span class="orange">Specials</span></h2>
						<p>Only available on our website.</p>
					</div>
					<div class="image-mask col-sm-8">
						<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
					</div>
				</div>
			</div>

			<!-- Specials -->
			<?php
				$specials = new WP_Query( array(
					'post_type' 	=> 'specials',
					'post_count'	=> -1
				));
			?>
			<div class="row">
				<ul class="specials col-sm-10 col-sm-offset-1">
				<?php while( $specials->have_posts() ) : $specials->the_post(); ?>
					<li>
						<div class="col-sm-4 specials-image-wrapper-container">
						<div class="specials-image-wrapper">
							<?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
						</div>
						</div>
						<div class="specials-text-wrapper col-sm-8">
							<h3><?php the_title(); ?></h3>
							<p><?php the_excerpt(); ?></p>
							<span class="specials-restrictions orange"><?php echo get_field('specials_restrictions'); ?></span>
							<a href="#" class="btn btn-primary book-now">Book Now</a>
						</div>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				</ul>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
