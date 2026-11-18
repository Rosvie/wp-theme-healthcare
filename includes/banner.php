<?php
/**
 * Homepage hero banner.
 *
 * @package Northfield_Home_Health
 */

$nhh_hero_url = nhh_option( 'hero_btn_url' ) ? nhh_option( 'hero_btn_url' ) : nhh_page_url( 'home-health-care-about-us' );
?>
<section id="banner" aria-label="<?php esc_attr_e( 'Welcome', 'northfield-home-health' ); ?>">
	<div class="hero-slider" data-interval="6000">
		<?php foreach ( nhh_hero_slides() as $nhh_i => $nhh_slide ) : ?>
			<img class="hero-slide<?php echo 0 === $nhh_i ? ' is-active' : ''; ?>" src="<?php echo esc_url( $nhh_slide['src'] ); ?>" alt="<?php echo esc_attr( $nhh_slide['alt'] ); ?>" width="1920" height="1080" <?php echo 0 === $nhh_i ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
		<?php endforeach; ?>
	</div>

	<div class="wrapper bnr_wrap">
		<div class="bnr_box reveal reveal--rotate" aria-hidden="true"></div>
		<div class="bnr_holder reveal reveal--zoom">
			<div class="bnr_info">
				<p class="bnr_kicker"><?php nhh_the_icon( 'heart' ); ?><?php echo esc_html( nhh_option( 'hero_kicker' ) ); ?><?php nhh_the_icon( 'heart' ); ?></p>
				<h2><?php echo esc_html( nhh_option( 'hero_heading' ) ); ?></h2>
				<p><?php echo esc_html( nhh_option( 'hero_text' ) ); ?></p>
				<?php if ( nhh_option( 'hero_btn_label' ) ) : ?>
					<a class="btn1" href="<?php echo esc_url( $nhh_hero_url ); ?>"><?php echo esc_html( nhh_option( 'hero_btn_label' ) ); ?> <?php nhh_the_icon( 'arrow' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
