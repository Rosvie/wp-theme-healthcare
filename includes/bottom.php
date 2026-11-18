<?php
/**
 * Homepage mission and contact sections.
 *
 * @package Northfield_Home_Health
 */
?>
<section id="bottom1" aria-labelledby="mission-heading">
	<div class="wrapper">
		<div class="btm1_con">
			<div class="btm1_info reveal reveal--right">
				<div class="btm1_cont">
					<h2 id="mission-heading" class="heading1"><small class="heading2"><?php esc_html_e( 'Our Commitment', 'northfield-home-health' ); ?></small> <?php esc_html_e( 'Mission', 'northfield-home-health' ); ?> <span><?php esc_html_e( 'Statement', 'northfield-home-health' ); ?></span></h2>
					<p><?php esc_html_e( "We are dedicated to delivering exceptional, cost-effective, and family-focused healthcare to individuals in the community. We prioritize quality and comprehensive care, respecting patients' dignity and cultural sensitivity. Our positive environment ensures employee satisfaction and professional growth, while community awareness initiatives promote health-related education.", 'northfield-home-health' ); ?></p>
				</div>
				<a class="btn1" href="<?php echo esc_url( nhh_page_url( 'home-health-care-about-us/mission-statement' ) ); ?>"><?php esc_html_e( 'About Us', 'northfield-home-health' ); ?> <?php nhh_the_icon( 'arrow' ); ?></a>
			</div>
			<div class="btm1_dashed"></div>
			<div class="btm1_boxes">
				<a class="btm1_box reveal reveal--zoom" href="<?php echo esc_url( nhh_page_url( 'home-health-care-set-an-appointment' ) ); ?>">
					<?php nhh_the_icon( 'calendar' ); ?>
					<span class="sub_heading"><span><?php esc_html_e( 'Set an Appointment', 'northfield-home-health' ); ?></span> <?php esc_html_e( 'To Meet With Us', 'northfield-home-health' ); ?></span>
				</a>
				<a class="btm1_box reveal reveal--zoom" href="<?php echo esc_url( nhh_page_url( 'home-health-care-send-your-referrals' ) ); ?>" style="--delay: 400ms">
					<?php nhh_the_icon( 'hands' ); ?>
					<span class="sub_heading"><span><?php esc_html_e( 'Send Referrals For', 'northfield-home-health' ); ?></span> <?php esc_html_e( 'Providers and Organizations', 'northfield-home-health' ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>

<section id="bottom2" aria-labelledby="contact-heading">
	<div class="wrapper" id="contact">
		<div class="btm2_con">
			<div class="btm2_info">
				<h2 id="contact-heading" class="heading1"><small class="heading2"><?php esc_html_e( 'Reach Out to Us', 'northfield-home-health' ); ?></small> <?php esc_html_e( 'Send Us a', 'northfield-home-health' ); ?> <span><?php esc_html_e( 'Message', 'northfield-home-health' ); ?></span></h2>
				<p><?php esc_html_e( "Got something to say? Reach out and send us a message. We're here and ready to respond to your needs.", 'northfield-home-health' ); ?></p>
			</div>
			<?php echo nhh_contact_form(); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside. ?>
		</div>
	</div>
	<?php if ( nhh_option( 'map_embed' ) ) : ?>
		<div class="footer_map">
			<iframe src="<?php echo esc_url( nhh_option( 'map_embed' ) ); ?>" title="<?php esc_attr_e( 'Map to our office', 'northfield-home-health' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
		</div>
	<?php endif; ?>
</section>
