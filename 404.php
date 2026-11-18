<?php
/**
 * 404 template.
 *
 * @package Northfield_Home_Health
 */

get_header();
get_template_part( 'template-parts/page-banner' );
?>
<div id="main_area" class="inner-main">
	<div class="wrapper">
		<main class="inner_content not-found">
			<h2 class="heading3"><?php esc_html_e( 'Sorry, we couldn’t find that page.', 'northfield-home-health' ); ?></h2>
			<p><?php esc_html_e( 'The page may have moved. Try the menu above, search below, or head back home.', 'northfield-home-health' ); ?></p>
			<?php get_search_form(); ?>
			<p><a class="btn1" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'northfield-home-health' ); ?> <?php nhh_the_icon( 'arrow' ); ?></a></p>
		</main>
	</div>
</div>
<?php
get_footer();
