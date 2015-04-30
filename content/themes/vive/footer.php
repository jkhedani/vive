<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Vive
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container-fluid" role="contentinfo">
		<div class="row black-bar">
			<span class="orange"><?php bloginfo('name'); ?> <?php bloginfo('description'); ?></span> &copy; <?php echo date('Y'); ?> - <a href="<?php echo esc_url( home_url( '/' ) ); ?>/about">About</a> - <a href="<?php echo esc_url( home_url( '/' ) ); ?>/privacy-policy">Privacy Policy</a>
		</div>
		<div class="row">

			<div class="footer-container site-info">
				<div class="footer-column column-small">
					<h3 class="orange"><?php bloginfo('name'); ?> <?php bloginfo('description'); ?></h3>
					<address><?php echo get_field('vive_address', 'option'); ?></address>
					<p>Phone: <?php echo get_field('vive_phone_contact', 'option'); ?></p>
				</div><!-- .site-info -->
				<div class="footer-column column-large">
					<div class="complimentary-services-text"><?php echo get_field('complimentary_services_and_amenities_text', 'option'); ?></div>
				</div>
				<div class="footer-column column-medium">
					<ul class="social-links">
						<li><a href="<?php echo get_field('vive_instagram'); ?>" title="Instagram" class="instagram">Instagram</a></li>
						<li><a href="<?php echo get_field('vive_facebook'); ?>" title="Facebook" class="facebook">Facebook</a></li>
						<li><a href="<?php echo get_field('vive_twitter'); ?>" title="Twitter" class="twitter">Twitter</a></li>
						<li><a href="<?php echo get_field('vive_trip_advisor'); ?>" title="Trip Advisor" class="trip-advisor">Trip Advisor</a></li>
					</ul>
				</div>
			</div><!-- .footer-container -->

		</div><!-- .row -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
