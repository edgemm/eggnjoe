<?php

require_once( locate_template( "inc/mobile_detect.php" ) );
$detect = new Mobile_Detect;

$mobile_class = ( $detect->isMobile() ) ? "isMobile" : "notMobile";

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--<meta name="description" content="<?php bloginfo('description'); ?>">-->

		<?php wp_head(); ?>
		<script type="text/javascript">
		// conditionizr.com
		// configure environment tests
		conditionizr.config({
		    assets: '<?php echo get_template_directory_uri(); ?>',
		    tests: {}
		});
		</script>

	</head>
	<body <?php body_class( $mobile_class ); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<header class="header clear" role="banner">
					
				<div class="container">

					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Top Kohlbush & Hoem Logo" class="logo-img">
						</a>
					</div>
					<!-- /logo -->

					<label for="nav-expand" class="nav-trigger"><i class="fa fa-bars"></i></label>
					<input type="radio" name="nav" id="nav-expand" class="nav-toggle" />
					<label for="nav-collapse" class="nav-collapse nav-toggle img-replace"></label>
					<input type="radio" name="nav" id="nav-collapse" class="nav-toggle" />


					<nav id="nav" class="nav" role="navigation">
						<?php add_navigation( "header" ); ?>
					</nav>
					<!-- /nav -->

					<div id="mc_embed_signup" class="eclub">
						<form action="//eatatelmers.us6.list-manage.com/subscribe/post?u=fd04b74d05&amp;id=c955a57df1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<fieldset class="eclub-fields">
								<legend class="eclub-legend">
									<span class="eclub-legend-content">JOIN OUR eCLUB</span>
								</legend>
								<div class="mc-field-group eclub-row">
									<label for="mce-FNAME" class="eclub-label">First Name</label>
									<span class="eclub-input-wrap">
										<input type="text" value="" name="FNAME" class="eclub-input required" id="mce-FNAME">
									</span>
								</div>
								<div class="mc-field-group eclub-row">
									<label for="mce-LNAME" class="eclub-label">Last Name</label>
									<span class="eclub-input-wrap">
										<input type="text" value="" name="LNAME" class="eclub-input" id="mce-LNAME">
									</span>
								</div>
								<div class="mc-field-group eclub-row">
									<label for="mce-EMAIL" class="eclub-label">Email</label>
									<span class="eclub-input-wrap">
										<input type="email" value="" name="EMAIL" class="required email eclub-input" id="mce-EMAIL">
									</span>
								</div>
								<div class="mc-field-group size1of2 eclub-row">
									<label for="mce-MMERGE3-month" class="eclub-label">Birthday</label>
									<div class="datefield eclub-input-wrap">
										<span class="subfield monthfield"><input class="eclub-input" type="text" pattern="[0-9]*" value="" placeholder="MM" size="2" maxlength="2" name="BDAY[month]" id="mce-BDAY-month"></span>
										<span class="subfield dayfield"><input class="eclub-input" type="text" pattern="[0-9]*" value="" placeholder="DD" size="2" maxlength="2" name="BDAY[day]" id="mce-BDAY-day"></span>
									<div class="fake-date"><input type="hidden" class=" date" id="MMERGE3-fake-date" value=""></div>
									</div>
								</div>
								<div id="mce-responses" class="clear eclub-row">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>
								<div style="position: absolute; left: -5000px;"><input type="text" name="b_fd04b74d05_c955a57df1" value=""></div>
								<div class="clear eclub-row eclub-row-submit">
									<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
								</div>
							</fieldset>
						</form>
					</div>

				</div>
				<!-- /.container -->

			</header>
			<!-- /header -->

			<main class="main container" role="main">
				
				<section id="content" class="clear">
