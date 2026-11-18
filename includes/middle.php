<?php
/**
 * Homepage services, careers and welcome sections.
 *
 * @package Northfield_Home_Health
 */

$nhh_services = array(
	array(
		'small' => __( 'Medical', 'northfield-home-health' ),
		'title' => __( 'Services', 'northfield-home-health' ),
		'text'  => __( 'Skilled Nursing excellence is delivered with precision, care, and compassion.', 'northfield-home-health' ),
		'url'   => nhh_page_url( 'home-health-care-services/medical-services' ),
		'img'   => 'service-medical.jpg',
		'alt'   => __( 'nurse in a white uniform with a stethoscope', 'northfield-home-health' ),
	),
	array(
		'small' => __( 'Non-Medical', 'northfield-home-health' ),
		'title' => __( 'Services', 'northfield-home-health' ),
		'text'  => __( 'Enhancing well-being through personalized home care services just for you.', 'northfield-home-health' ),
		'url'   => nhh_page_url( 'home-health-care-services/non-medical-services' ),
		'img'   => 'service-non-medical.jpg',
		'alt'   => __( 'caregiver holding hands with an elderly woman using a walker', 'northfield-home-health' ),
	),
	array(
		'small' => __( 'Specialty', 'northfield-home-health' ),
		'title' => __( 'Program', 'northfield-home-health' ),
		'text'  => __( 'Expand your choices with our diverse range of personalized services.', 'northfield-home-health' ),
		'url'   => nhh_page_url( 'home-health-care-services/specialty-programs' ),
		'img'   => 'service-specialty.jpg',
		'alt'   => __( 'caregiver helping two elderly women with knitting', 'northfield-home-health' ),
	),
);
?>
<section id="middle" aria-label="<?php esc_attr_e( 'Our Services', 'northfield-home-health' ); ?>">
	<div class="wrapper">
		<div class="mid_boxes">
			<?php foreach ( $nhh_services as $nhh_i => $nhh_service ) : ?>
				<article class="mid_item reveal reveal--up" style="--delay: <?php echo esc_attr( $nhh_i * 250 ); ?>ms">
					<div class="mid_box">
						<h2 class="sub_heading"><span><?php echo esc_html( $nhh_service['small'] ); ?></span> <?php echo esc_html( $nhh_service['title'] ); ?></h2>
						<p><?php echo esc_html( $nhh_service['text'] ); ?></p>
						<a class="btn1" href="<?php echo esc_url( $nhh_service['url'] ); ?>"><?php esc_html_e( 'Click Here', 'northfield-home-health' ); ?> <?php nhh_the_icon( 'arrow' ); ?><span class="screen-reader-text"> – <?php echo esc_html( $nhh_service['small'] . ' ' . $nhh_service['title'] ); ?></span></a>
					</div>
					<figure><img src="<?php echo esc_url( nhh_img( $nhh_service['img'] ) ); ?>" width="301" height="237" alt="<?php echo esc_attr( $nhh_service['alt'] ); ?>" loading="lazy"></figure>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="middle2 reveal reveal--up" aria-labelledby="careers-heading">
	<figure><img src="<?php echo esc_url( nhh_img( 'careers.jpg' ) ); ?>" width="301" height="350" alt="<?php esc_attr_e( 'smiling nurse', 'northfield-home-health' ); ?>" loading="lazy"></figure>
	<div class="main_section">
		<h2 id="careers-heading"><?php esc_html_e( 'Apply for an Opportunity in Our Company', 'northfield-home-health' ); ?></h2>
		<div class="main_content">
			<p><?php esc_html_e( 'Unlock your full potential at Northfield Home Health Services, Inc., where innovation thrives and collaboration sparks brilliance. Join us in shaping the future of healthcare, as we invite passionate individuals to contribute their unique talents and be a pivotal force in our journey to success.', 'northfield-home-health' ); ?></p>
			<a class="btn1 btn1--white" href="<?php echo esc_url( nhh_page_url( 'home-health-care-careers' ) ); ?>"><?php esc_html_e( 'Click Here', 'northfield-home-health' ); ?> <?php nhh_the_icon( 'arrow' ); ?><span class="screen-reader-text"> – <?php esc_html_e( 'Careers', 'northfield-home-health' ); ?></span></a>
		</div>
	</div>
</section>

<section id="main_area" aria-labelledby="welcome-heading">
	<div class="wrapper">
		<div class="main_con">
			<div class="welcome reveal reveal--left">
				<h1 id="welcome-heading" class="h1_title heading1">
					<small class="heading2"><?php esc_html_e( 'Experience Skilled Care and Compassion at', 'northfield-home-health' ); ?></small>
					<?php esc_html_e( 'Northfield Home Health', 'northfield-home-health' ); ?> <span><?php esc_html_e( 'Services', 'northfield-home-health' ); ?></span>
				</h1>
				<div class="entry-content">
					<?php
					$nhh_has_content = false;
					if ( is_page() && have_posts() ) {
						the_post();
						if ( '' !== trim( get_the_content() ) ) {
							$nhh_has_content = true;
							the_content();
						}
					}
					if ( ! $nhh_has_content ) :
						?>
						<p><?php
						printf(
							/* translators: %s: company name */
							esc_html__( 'Welcome to %s, where compassionate care meets the comfort of home. As a leading home healthcare provider, we are dedicated to enhancing the well-being of our clients with personalized and professional services. Our team of skilled professionals is committed to delivering quality healthcare in the familiar and comforting surroundings of your home. At %s, we prioritize your health, comfort, and peace of mind, ensuring a seamless and supportive experience for you and your loved ones.', 'northfield-home-health' ),
							'<mark class="comp">Northfield Home Health Services</mark>',
							'<mark class="comp">Northfield Home Health Services</mark>'
						);
						?></p>
					<?php endif; ?>
				</div>
			</div>

			<aside class="sidebar" style="background-image:url('<?php echo esc_url( nhh_img( 'main-img.jpg' ) ); ?>')">
				<a class="side_box_white reveal reveal--rotate" href="<?php echo esc_url( nhh_page_url( 'home-health-care-meet-our-staff' ) ); ?>" style="--delay: 600ms">
					<span class="side_box_blue">
						<span class="side_box">
							<?php nhh_the_icon( 'users' ); ?>
							<span class="side_box__title"><small><?php esc_html_e( 'Meet', 'northfield-home-health' ); ?></small> <?php esc_html_e( 'Our Staff', 'northfield-home-health' ); ?></span>
						</span>
					</span>
				</a>
			</aside>
		</div>
	</div>
</section>
