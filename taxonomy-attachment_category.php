<?php
/**
 * Archive Template
 *
 * Template for display all default archive pages.
 *
 * @since 0.1.0
 *
 * @package
 * @subpackage Templates
 */

$queried_object     = get_queried_object();

?>

<?php get_header(); ?>

<div class="row">
	<div class="small-12 medium-8 columns" role="main">

		<?php
		$query_images_args = array(
		    'post_type'      => 'attachment',
		    'post_mime_type' => 'image',
		    'post_status'    => 'inherit',
		    'posts_per_page' => - 1,
		    'tax_query' => array (
		    	array (
		    		'taxonomy' => 'attachment_category',
		            'field'    => 'slug',
		            'terms'    => $queried_object->slug,
	    		)
	    	)
		);

		$query_images = new WP_Query( $query_images_args );

		$images = array();
		foreach ( $query_images->posts as $image ) {

		    $image_url = wp_get_attachment_url( $image->ID );
		    echo '<img src="' . $image_url . '" />';
		    echo $image->post_title;
		}
		?>

		<?php
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'hatch_content_before' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'hatch_loop_before' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'post' ); ?>

			<?php endwhile; ?>

			<?php
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'hatch_loop_after' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<?php
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'hatch_content_after' ); ?>

		<?php get_template_part( 'images/partials/pagination' ); ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
