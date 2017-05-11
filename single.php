<?php
/**
 * Single Post Template
 *
 * Default template utilized for single posts
 *
 * @since 0.1.0
 *
 * @package 
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

	<div class="row">
		<div class="small-12 medium-8 columns" role="main">

			<?php do_action( 'hatch_content_before' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content' ); ?>

			<?php endwhile; ?>

			<?php do_action( 'hatch_after_content' ); ?>

		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer();
