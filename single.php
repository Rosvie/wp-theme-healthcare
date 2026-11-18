<?php
/**
 * Single post template.
 *
 * @package Northfield_Home_Health
 */

get_header();
get_template_part( 'template-parts/page-banner' );
?>
<div id="main_area" class="inner-main">
	<div class="wrapper">
		<?php nhh_breadcrumbs(); ?>
		<main class="inner_content">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
					<div class="entry-content">
						<?php
						the_content();
						wp_link_pages();
						?>
					</div>
				</article>
				<?php
				the_post_navigation();
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>
		</main>
	</div>
</div>
<?php
get_footer();
