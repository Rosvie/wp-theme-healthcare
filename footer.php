<?php
/**
 * Site footer.
 *
 * @package Northfield_Home_Health
 */

$nhh_phone = nhh_option( 'phone' );
$nhh_fax   = nhh_option( 'fax' );
$nhh_email = nhh_option( 'email' );
$nhh_start = 2023;
$nhh_year  = (int) wp_date( 'Y' );
?>
	</div><!-- #content -->

	<footer class="site-footer">
		<div class="footer_top">
			<div class="wrapper">
				<div class="footer_top_con">
					<div class="footer_info">
						<h2 class="sub_heading"><span><?php esc_html_e( 'Get in Touch', 'northfield-home-health' ); ?></span> <?php esc_html_e( 'Contact Details', 'northfield-home-health' ); ?></h2>
						<p><?php esc_html_e( 'Need assistance? Here’s how:', 'northfield-home-health' ); ?></p>
						<ul class="contact_list">
							<li>
								<?php nhh_the_icon( 'envelope', 'contact_list__icon' ); ?>
								<q><?php esc_html_e( 'Call or Message Us at:', 'northfield-home-health' ); ?></q>
								<?php if ( $nhh_phone ) : ?>
									<?php esc_html_e( 'Phone:', 'northfield-home-health' ); ?> <a href="<?php echo esc_url( nhh_tel( $nhh_phone ) ); ?>"><?php echo esc_html( $nhh_phone ); ?></a><br>
								<?php endif; ?>
								<?php if ( $nhh_fax ) : ?>
									<?php esc_html_e( 'Fax:', 'northfield-home-health' ); ?> <?php echo esc_html( $nhh_fax ); ?><br>
								<?php endif; ?>
								<?php if ( $nhh_email ) : ?>
									<a href="<?php echo esc_url( 'mailto:' . $nhh_email ); ?>"><?php echo esc_html( $nhh_email ); ?></a>
								<?php endif; ?>
							</li>
							<li>
								<?php nhh_the_icon( 'map', 'contact_list__icon' ); ?>
								<q><?php esc_html_e( 'Visit Us at:', 'northfield-home-health' ); ?></q>
								<address><?php echo esc_html( nhh_option( 'address_1' ) ); ?><br><?php echo esc_html( nhh_option( 'address_2' ) ); ?></address>
							</li>
						</ul>
					</div>

					<div class="footer_nav">
						<h2 class="sub_heading"><span><?php esc_html_e( 'Quick Links', 'northfield-home-health' ); ?></span> <?php esc_html_e( 'Site Navigation', 'northfield-home-health' ); ?></h2>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'depth'          => 1,
								'fallback_cb'    => 'nhh_footer_menu_fallback',
							)
						);
						?>
					</div>

					<div class="ftr_logo_holder">
						<div class="accreditation">
							<img src="<?php echo esc_url( nhh_img( 'newchap-logo.png' ) ); ?>" width="244" height="172" alt="<?php esc_attr_e( 'CHAP Standards of Excellence', 'northfield-home-health' ); ?>" loading="lazy">
							<img src="<?php echo esc_url( nhh_img( 'cms-logo.png' ) ); ?>" width="303" height="127" alt="<?php esc_attr_e( 'CMS – Centers for Medicare & Medicaid Services', 'northfield-home-health' ); ?>" loading="lazy">
						</div>
						<div class="footer_logo">
							<?php nhh_logo_markup( 'footer' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer_btm">
			<div class="wrapper">
				<p class="copyright">
					&copy; <?php esc_html_e( 'Copyright', 'northfield-home-health' ); ?>
					<?php echo esc_html( $nhh_year > $nhh_start ? $nhh_start . ' - ' . $nhh_year : $nhh_year ); ?>
					<?php
					$nhh_privacy = get_privacy_policy_url();
					if ( ! $nhh_privacy ) {
						$nhh_privacy = nhh_page_url( 'privacy-policy' );
					}
					?>
					<span class="footer_policy">| <a href="<?php echo esc_url( $nhh_privacy ); ?>"><?php esc_html_e( 'Privacy Policy', 'northfield-home-health' ); ?></a></span>
				</p>
			</div>
		</div>
	</footer>

	<a href="#top" class="back_top" aria-label="<?php esc_attr_e( 'Back to top', 'northfield-home-health' ); ?>"><?php nhh_the_icon( 'chevron' ); ?></a>
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
