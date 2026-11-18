<?php
/**
 * Inner page banner: featured image with the page title on a blue strip.
 *
 * @package Northfield_Home_Health
 */

$nhh_title = is_singular() ? get_the_title( get_queried_object_id() ) : nhh_archive_title();
?>
<section class="page-banner">
	<img class="page-banner__img" src="<?php echo esc_url( nhh_banner_image() ); ?>" alt="" width="1920" height="600" fetchpriority="high">
	<div class="page_title">
		<h1 class="h1_title"><?php echo esc_html( $nhh_title ); ?></h1>
	</div>
</section>
