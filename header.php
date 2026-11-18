<?php
/**
 * Site header.
 *
 * @package Northfield_Home_Health
 */

$nhh_phone = nhh_option( 'phone' );
$nhh_email = nhh_option( 'email' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'northfield-home-health' ); ?></a>

<div class="site">
	<div class="header_holder">
		<div id="nav_area">
			<nav class="page_nav" aria-label="<?php esc_attr_e( 'Primary', 'northfield-home-health' ); ?>">
				<div class="wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => 'div',
							'container_class' => 'nav-menu',
							'fallback_cb'    => function () {
								echo '<div class="nav-menu">';
								nhh_primary_menu_fallback();
								echo '</div>';
							},
						)
					);
					?>
				</div>
			</nav>
		</div>

		<header class="site-header">
			<div class="wrapper">
				<div class="header_con">
					<div class="main_logo"><?php nhh_logo(); ?></div>

					<button class="nav-toggle" type="button" aria-controls="primary-menu" aria-expanded="false">
						<span class="nav-toggle__box"><span class="nav-toggle__inner"></span></span>
						<span class="nav-toggle__label"><?php esc_html_e( 'Menu', 'northfield-home-health' ); ?></span>
					</button>

					<div class="head_info">
						<div class="header_info">
							<?php nhh_the_icon( 'envelope', 'header_info__icon' ); ?>
							<p>
								<?php if ( $nhh_phone ) : ?>
									<span><?php esc_html_e( 'Phone:', 'northfield-home-health' ); ?> <a href="<?php echo esc_url( nhh_tel( $nhh_phone ) ); ?>"><?php echo esc_html( $nhh_phone ); ?></a></span>
								<?php endif; ?>
								<?php if ( $nhh_email ) : ?>
									<span><?php esc_html_e( 'Email:', 'northfield-home-health' ); ?> <a href="<?php echo esc_url( 'mailto:' . $nhh_email ); ?>"><?php echo esc_html( $nhh_email ); ?></a></span>
								<?php endif; ?>
							</p>
						</div>
						<div class="social_media">
							<?php if ( nhh_option( 'facebook' ) ) : ?>
								<a class="social social--fb" href="<?php echo esc_url( nhh_option( 'facebook' ) ); ?>" target="_blank" rel="noopener"><?php nhh_the_icon( 'facebook' ); ?><span class="screen-reader-text">Facebook</span></a>
							<?php endif; ?>
							<?php if ( nhh_option( 'linkedin' ) ) : ?>
								<a class="social social--in" href="<?php echo esc_url( nhh_option( 'linkedin' ) ); ?>" target="_blank" rel="noopener"><?php nhh_the_icon( 'linkedin' ); ?><span class="screen-reader-text">LinkedIn</span></a>
							<?php endif; ?>
							<?php if ( nhh_option( 'referral_label' ) ) : ?>
								<a class="btn1 btn-referral" href="<?php echo esc_url( nhh_option( 'referral_url' ), array( 'http', 'https', 'mailto', 'tel' ) ); ?>"><?php echo esc_html( nhh_option( 'referral_label' ) ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header>
	</div>

	<div id="content" class="site-content">
