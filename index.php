<?php
/**
 * Catch All Template
 *
 * Catch all template file within the Template Hierarchy.
 *
 * @since 1.0
 *
 * @package 
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<div class="row">
	<div class="small-12 large-8 columns" role="main">

		<?php
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'hatch_content_before' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'hatch_loop_before' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'hatch_loop_after' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif;?>

		<?php get_template_part( 'includes/partials/pagination' ); ?>

		<?php
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'hatch_content_after' ); ?>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
