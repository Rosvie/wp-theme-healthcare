<?php
/**
 * Default page template.
 *
 * @package Northfield_Home_Health
 */

get_header();
get_template_part( 'template-parts/page-banner' );
$nhh_sidebar = is_active_sidebar( 'sidebar-1' );
?>
<div id="main_area" class="inner-main">
	<div class="wrapper">
		<?php nhh_breadcrumbs(); ?>
		<div class="inner_con<?php echo $nhh_sidebar ? ' has-sidebar' : ''; ?>">
			<main class="inner_content">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php
							the_content();
							wp_link_pages();
							?>
						</div>
					</article>
					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
				?>
			</main>
			<?php if ( $nhh_sidebar ) : ?>
				<aside class="inner_sidebar"><?php dynamic_sidebar( 'sidebar-1' ); ?></aside>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();
