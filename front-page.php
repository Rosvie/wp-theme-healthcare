<?php
/**
 * Homepage template.
 *
 * The "Welcome" block uses the static front page's own title/content when set
 * (Settings → Reading), otherwise the original site's copy.
 *
 * @package Northfield_Home_Health
 */

get_header();
get_template_part( 'includes/banner' );
get_template_part( 'includes/middle' );
get_template_part( 'includes/bottom' );
get_footer();
