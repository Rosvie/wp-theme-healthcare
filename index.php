<?php
/**
 * Fallback template: blog index, archives, search.
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
			<?php if ( have_posts() ) : ?>
				<div class="post-list">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a class="post-card__thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
							<?php endif; ?>
							<h2 class="heading3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
							<?php the_excerpt(); ?>
							<a class="btn1" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'northfield-home-health' ); ?> <?php nhh_the_icon( 'arrow' ); ?></a>
						</article>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Nothing found here.', 'northfield-home-health' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</main>
	</div>
</div>
<?php
get_footer();
