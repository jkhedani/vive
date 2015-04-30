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
		<main id="main" class="site-main" role="main">

			<!-- Featured Image -->
			<div class="hero">
				<?php the_post_thumbnail(); ?>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="black-bar fat">
					<h1>The <span class="orange"><?php echo get_the_title(); ?></span></h1>
					<div class="content"><?php echo get_the_content(); ?></div>
				</div>
			<?php endwhile; ?>

			<?php if ( get_field('secondary_featured_image') ) : ?>
				<div class="hero">
					<?php $secondary_featured_img_object = get_field('secondary_featured_image');?>
					<img src="<?php echo $secondary_featured_img_object['url']; ?>" alt="<?php echo $secondary_featured_img_object['alt']; ?>" />
				</div>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
