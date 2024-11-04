<?php
/**
 * Front Page Template
 *
 * Default template utilized when your theme has a define "Front Page"
 * within Setting->Reading within the WordPress admin
 *
 * @since      1.0.0
 *
 * @package    Propane
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="grid-container">
        	<div class="grid-x">
            	<div class="cell padding-vertical">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

<?php if ( function_exists( 'mesh_display_sections' ) ) {
	mesh_display_sections();
} ?>

<?php
get_footer();
