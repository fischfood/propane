<?php
/**
 * Single Post Template
 *
 * Default template utilized for single posts
 *
 * @since      1.0.0
 *
 * @package    Propane
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

<div class="grid-container">
    <div class="grid-x container">
		<div class="small-12 medium-8 cell" role="main">

			<?php do_action( 'truss_content_before' ); ?>

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<?php get_template_part( 'partials/content', 'post' ); ?>

			<?php endwhile; ?>

			<?php do_action( 'truss_after_content' ); ?>

		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
