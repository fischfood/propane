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

get_template_part( 'partials/maintenance-submission-logic' );
get_template_part( 'partials/maintenance-delete-logic' );

?>

<?php get_header(); ?>

	<div class="full-grid-container">
		<div class="grid-x">
			<div class="small-12 cell padding-all text-center" role="main">
				<h1>Maintenance</h1>
				<p>
					<button class="button" data-open="maintenanceSubmit">Submit Maintenance</button>
				</p>
			</div>
			<div class="small-12 cell" role="main">
				<div class="grid-x">
					<?php $vehicles = get_terms( array(
						'taxonomy'   => 'vehicle',
						'hide_empty' => false,
					) ); ?>

					<div class="small-12 cell padding-all text-center grid-x align-center">
						<div class="small-12 medium-7 cell">
							<?php foreach ( $vehicles as $vehicle ): ?>
								<a class="button margin-all-small" href="#<?php echo $vehicle->slug; ?>"><?php echo $vehicle->name; ?></a>
							<?php endforeach; ?>
						</div>
					</div>

					<?php foreach ( $vehicles as $vehicle ): ?>

						<div class="small-12 cell padding-all maintenance-scores-container text-center grid-x align-center">
							<div class="small-12 medium-7 cell">

								<?php
								$vehicle_slug = $vehicle->slug;
								$vehicle_args = array(
									'post_type'      => 'maintenance',
									'posts_per_page' => 1000,
									'order'          => 'DESC',
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

								<span class="anchor" id="<?php echo $vehicle->slug;?>"></span>
								<h2 class="text-center margin-top-large"><?php echo $vehicle->name; ?></h2>
								<p><?php echo $vehicle->description; ?></p>

								<?php if ( $vehicle_query->have_posts() ): ?>

									<?php $mileage_hours = ( $vehicle->name === 'Lawn Mower' ) ? 'Hours' : 'Mileage'; ?>

									<div class="maintenance-list">
										<div class="grid-x maintenance-header">
											<div class="small-4 cell">Date</div>
											<div class="small-4 cell">Type</div>
											<div class="small-4 cell"><?php echo esc_html_e( $mileage_hours ); ?></div>
										</div>
									
										<?php while ( $vehicle_query->have_posts() ): $vehicle_query->the_post(); ?>

											<div class="maintenance-record grid-x">
												<span class="small-4 cell date"><?php echo get_the_date( 'm-d-y', get_the_ID() ); ?></span>
												<span class="small-4 cell type">
													<?php $type = get_the_terms( get_the_ID(), 'maintenance_type' ); ?>
													<?php if ( is_array( $type ) ): ?>
														<?php echo $type[0]->name; ?>
													<?php endif; ?>
												</span>
												<span class="small-4 cell mileage">
												<?php if ( get_post_meta( get_the_ID(), '_vehicle_mileage', true ) ): ?>
													<?php echo get_post_meta( get_the_ID(), '_vehicle_mileage', true ); ?>
												<?php endif; ?>
												</span>
												<?php if ( get_the_content() !== ' ' ): ?>
													<span class="small-12 cell notes"><?php echo get_the_content(); ?></span>
												<?php endif; ?>
												<div class="delete-record">
													<a class="delete-button maintenance-delete" data-open="maintenanceDelete" data-delete-id="<?php echo get_the_ID(); ?>">Delete</a>
												</div>
											</div>

										<?php endwhile;
										wp_reset_postdata(); ?>
									<?php else: ?>

										<div class="maintenance-record grid-x">
											<span class="small-12 cell notes" style="opacity: .2;">No Records Added</span>
										</div>

									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>

				<div class="reveal" id="maintenanceSubmit" data-reveal>
					<?php get_template_part( 'partials/maintenance-submission' ); ?>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="reveal" id="maintenanceDelete" data-reveal>
					Delete
					<?php get_template_part( 'partials/maintenance-delete' ); ?>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer();
