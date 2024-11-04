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

get_template_part( 'partials/food-planning-submission-logic' );
get_template_part( 'partials/food-planning-delete-logic' );

?>

<?php get_header(); ?>

	<div class="full-grid-container">
		<div class="grid-x">
			<div class="small-12 cell padding-all text-center" role="main">
				<h1>Holiday and Occasion Food Planning</h1>
				<p>
					<button class="button" data-open="foodPlanningSubmit">Submit Food</button>
				</p>
			</div>
			<div class="small-12 cell" role="main">
				<div class="grid-x">
					<?php $occasions = get_terms( array(
						'taxonomy'   => 'occasion',
						'hide_empty' => false,
					) ); ?>

					<div class="small-12 cell padding-all text-center grid-x align-center">
						<div class="small-12 medium-7 cell">
							<?php foreach ( $occasions as $occasion ): ?>
								<a class="button margin-all-small" href="#<?php echo $occasion->slug; ?>"><?php echo $occasion->name; ?></a>
							<?php endforeach; ?>
						</div>
					</div>

					<?php foreach ( $occasions as $occasion ): ?>

						<div class="small-12 cell padding-all maintenance-scores-container text-center grid-x align-center">
							<div class="small-12 medium-7 cell">

								<?php
								$occasion_slug = $occasion->slug;
								$occasion_args = array(
									'post_type'      => 'food_planning',
									'posts_per_page' => 1000,
									'order'          => 'DESC',
									'orderby'        => 'date',
									'tax_query'      => array(
										array(
											'taxonomy' => 'occasion',
											'field'    => 'slug',
											'terms'    => array( $occasion_slug ),
										),
									),
								);

								$occasion_query = new WP_Query( $occasion_args );
								?>

								<span class="anchor" id="<?php echo $occasion->slug;?>"></span>
								<h2 class="text-center margin-top-large"><?php echo $occasion->name; ?></h2>
								<p><?php echo $occasion->description; ?></p>

								<?php if ( $occasion_query->have_posts() ): ?>

									<div class="maintenance-list">
										<div class="grid-x maintenance-header">
											<div class="small-4 cell">Food</div>
											<div class="small-2 cell">Prep Time</div>
											<div class="small-2 cell">Time/Temp</div>
											<div class="small-4 cell">Person</div>
										</div>
									
										<?php while ( $occasion_query->have_posts() ): $occasion_query->the_post(); ?>

											<div class="maintenance-record grid-x">
												<span class="small-4 cell food-name">
													<?php if ( ! empty( get_post_meta( get_the_ID(), '_food_planning_website' ) ) ): ?>
														<a href="<?php echo esc_url( get_post_meta( get_the_ID(), '_food_planning_website', true ) ); ?>" target="_blank"><?php the_title(); ?></a>
													<?php else: ?>
														<?php the_title(); ?>
													<?php endif; ?>
												</span>
												<span class="small-2 cell prep-time" style="border-left: 1px solid gray">
													<?php echo get_post_meta( get_the_ID(), '_food_planning_prep_time', true ); ?>
												</span>
												<span class="small-2 cell time-temp" style="border-left: 1px solid gray">
													<?php echo get_post_meta( get_the_ID(), '_food_planning_time_temp', true ); ?>
												</span>
												<span class="small-4 cell person" style="border-left: 1px solid gray">
													<?php echo get_post_meta( get_the_ID(), '_food_planning_person_making', true ); ?>
												</span>
												<?php if ( get_the_content() !== ' ' ): ?>
													<span class="small-12 cell notes"><?php echo get_the_content(); ?></span>
												<?php endif; ?>

												<?php /*
												<div class="delete-record">
													<a class="delete-button maintenance-delete" data-open="foodPlanningDelete" data-delete-id="<?php echo get_the_ID(); ?>">Delete</a>
												</div>
												*/ ?>
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

				<div class="reveal" id="foodPlanningSubmit" data-reveal>
					<?php get_template_part( 'partials/food-planning-submission' ); ?>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="reveal" id="foodPlanningDelete" data-reveal>
					Delete
					<?php get_template_part( 'partials/food-planning-delete' ); ?>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			</div>
		</div>
	</div>

<?php get_footer();
