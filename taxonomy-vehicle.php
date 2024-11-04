<?php
/**
 * Archive Template
 *
 * Template for display all default archive pages.
 *
 * @since      1.0.0
 *
 * @package    Propane
 * @subpackage Templates
 */

global $wp_the_query;
$queried_object = $wp_the_query->get_queried_object();
?>

<?php get_header(); ?>

	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 cell" role="main">

				<h1 class="text-center padding-vertical-large"><?php echo $queried_object->name; ?> Records</h1>
				<div class="small-12 cell padding-all maintenance-list-container">

					<?php
					$vehicle_slug = $queried_object->slug;
					$vehicle_args = array(
						'post_type'      => 'maintenance',
						'posts_per_page' => 1000,
						'order'          => 'ASC',
						'orderby'        => 'date',
						'tax_query'      => array(
							array(
								'taxonomy' => 'vehicle',
								'field'    => 'slug',
								'terms'    => array( $vehicle_slug ),
							),
						),
					);

					$vehicle_query = new WP_Query( $vehicle_args );
					?>

					<?php if ( $vehicle_query->have_posts() ): ?>

					<div class="maintenance-list">
						<div class="grid-x">
							<div class="small-4 cell">Date</div>
							<div class="small-4 cell">Type</div>
							<div class="small-4 cell">Mileage</div>
						</div>

						<?php while ( $vehicle_query->have_posts() ): $vehicle_query->the_post(); ?>

							<div class="maintenance-record grid-x">
								<span class="small-4 cell date"><?php echo get_the_date( 'm-d-y', get_the_ID() ); ?></span>
								<span class="small-4 cell type">
									<?php $type = get_the_terms( get_the_ID(), 'maintenance_type' ); ?>
									<?php echo $type[0]->name; ?>
								</span>
								<span class="small-4 cell mileage">
								<?php if ( get_post_meta( get_the_ID(), '_vehicle_mileage', true ) ): ?>
									<?php echo get_post_meta( get_the_ID(), '_vehicle_mileage', true ); ?>
								<?php endif; ?>
								</span>
								<?php if ( get_the_content() !== ' ' ): ?>
									<span class="small-12 cell notes"><?php echo get_the_content(); ?></span>
								<?php endif; ?>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>

					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer();
