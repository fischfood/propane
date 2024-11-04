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
	<div class="grid-container">
		<div class="small-12 medium-8 columns" role="main">

			<?php
			$query_images_args = array(
			    'post_type'      => 'attachment',
			    'post_mime_type' => 'image',
			    'post_status'    => 'inherit',
			    'posts_per_page' => - 1,
			    'tax_query' => array (
			        array (
			            'taxonomy' => 'attachment_tag',
			            'field'    => 'slug',
			            'terms'    => $queried_object->slug,
		            )
		        )
			);

			$query_images = new WP_Query( $query_images_args );

			$images = array();
			?>

			<h1 class="text-center padding-vertical">
				<?php echo date("F jS, Y", strtotime( $queried_object->name ) ); ?>
			</h1>
			<div class="grid-x photo-grid">
			<?php foreach ( $query_images->posts as $image ): ?>

				<?php $image_url = wp_get_attachment_image_src( $image->ID, 'medium' ); ?>
				<div class="small-6 medium-4 large-3 cell padding-all-small">
					<div class="photo-block" style="background-image: url(<?php echo $image_url[0]; ?>);">
			            <img src="<?php echo $image_url[0]; ?>" />
					</div>
				</div>

			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer();
