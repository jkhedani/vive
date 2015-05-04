<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Vive
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!--embed-responsive embed-responsive-4by3-->
<!--<div id="intro-video-container" class="vive-video-intro-container">
	<div class="vive-video-intro-text">
		<h1>Your Adventure Starts</h1>
		<a id="close-intro-video" href="#">Here</a>
	</div>
	<iframe class="embed-responsive-item" width="500" height="315" src="https://www.youtube.com/embed/rDCvY1UzxnQ?controls=0&autoplay=1&showinfo=0&modestbranding=0" frameborder=0 allowfullscreen></iframe>
</div>-->

<div id="page" class="hfeed site">
	<nav id="masthead" class="site-header navbar navbar-fixed-top" role="banner">
		<div class="container-fluid">

				<div class="navbar-header">
					<!-- "Three Bar" Mobile Menu Trigger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#site-navigation">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</a>
				</div><!-- .site-branding -->

				<!-- Navigation Menu -->
				<div id="site-navigation" class="main-navigation navbar-collapse collapse" role="navigation">

					<!-- Book Now -->
					<div class="book-now-dropdown-container">
						<a id="book-now" class="book-now">
					    Book Now
					    <i class="fa fa-chevron-down"></i>
					  </a>
					  <div id="book-now-content" class="book-now-content hide slideInUp animated">

							<div class="check-in-container form-group">
								<label for="check-in">Check <span class="orange">In</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input id="check-in" type="text" class="form-control"></input>
								</div>
							</div>

							<div class="check-out-container form-group">
								<label for="check-out">Check <span class="orange">Out</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input id="check-out" type="text" class="form-control"></input>
								</div>
							</div>

							<div class="adult-count-container form-group">
								<label for="adult-count">Adults</label>
								<select id="adult-count" type="select" class="form-control">
									<option>1</option>
									<option>2</option>
								</select>
							</div>

							<div class="special-select-container form-group">
								<label for="special-select">Promotional <span class="orange">Code</span></label>
								<input id="special-select" type="text" class="form-control"></input>
							</div>

							<a id="check-availability">Check Availability</a>
						</div>
					</div><!-- .dropdown -->

					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container'			 => false,
							'menu_id' => 'primary-menu',
							'menu_class' => 'nav navbar-nav'
						));
					?>
				</div><!-- #site-navigation -->

		</div>
	</nav><!-- #masthead -->



	<div id="content" class="site-content">
