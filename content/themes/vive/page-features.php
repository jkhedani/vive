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
			<div class="features-banner row">
				<div class="youtube-container">
					<iframe width="500" height="315" src="https://www.youtube.com/embed/a5B6ja2u3-g" frameborder=0 allowfullscreen></iframe>
				</div>
				<div class="image-mask">
					<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
				</div>
			</div>

			<!-- Features -->
			<?php if ( have_rows('features', $post->ID ) ) { ?>
				<?php $i = 0; ?>
				<ul class="features row">
				<?php while ( have_rows('features', $post->ID ) ) : the_row();
					$feature_image_url 		= get_sub_field('feature_image');
					$feature_title  = get_sub_field('feature_title');
					$feature_text 	= get_sub_field('feature_text');
					$feature_title_colorization = get_sub_field('colorize_words_in_title');
					$feature_title_array = str_word_count($feature_title,1);
					foreach( $feature_title_colorization as $word_selection ) {
						// Skip word colorization if we run into 'none'
						if ( $word_selection !== 'none' ) {
							// Find the appropriate key in the title to colorize
							// $word_selection int Should match the key index in the gallery image title array
							$feature_title_array[$word_selection] = '<span class="orange">' . $feature_title_array[$word_selection] . '</span>';
						}
					}
					$feature_title = implode(' ', $feature_title_array);
				?>
					<li class="<?php if ( !$i++ ) { echo 'active'; } ?> col-sm-4" data-slide="<?php echo $i; ?>">
						<div class="features-image-wrapper">
							<img src="<?php echo $feature_image_url['sizes']['large']; ?>" alt="" />
						</div>
						<?php if ( $feature_title && $feature_text ) : ?>
							<div class="features-text-wrapper">
								<h2 class="features-title"><?php echo $feature_title; ?></h2>
								<p class="features-text"><?php echo $feature_text; ?></p>
							</div>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
