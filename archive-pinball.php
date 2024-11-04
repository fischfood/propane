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

get_template_part( 'partials/pinball-submission-logic' );

?>

<?php get_header(); ?>

	<div class="full-grid-container">
		<div class="grid-x">
			<div class="small-12 cell padding-all text-center" role="main">
				<h1>Pinball Top 10</h1>
				<p><button class="button" data-open="pinballSubmit">Submit Score</button></p>
			</div>
			<div class="small-12 cell" role="main">
				<div class="grid-x">
					<?php $machines = get_terms( array(
						'taxonomy'   => 'machine',
						'hide_empty' => false,
					) ); ?>

					<?php foreach ( $machines as $machine ): ?>

						<?php
							$image = get_term_meta( $machine->term_id, '_pinball_machine_image', true );
							$bg    = get_term_meta( $machine->term_id, '_pinball_machine_bg_color', true );
							$color = get_term_meta( $machine->term_id, '_pinball_machine_font_color', true );
						?>
						<div class="small-12 medium-6 cell padding-all pinball-scores-container text-center" style="background-color:<?php echo esc_html($bg); ?>;color:<?php echo esc_html($color); ?>;">

							<?php
							$machine_slug = $machine->slug;
							$machine_args = array(
								'post_type' => 'pinball',
								'posts_per_page' => 10,
								'order'     => 'DESC',
								'orderby'   => 'menu_order',
								'tax_query' => array(
									array(
										'taxonomy' => 'machine',
										'field'    => 'slug',
										'terms'    => array( $machine_slug ),
									),
								),
							);

							$machine_query = new WP_Query( $machine_args );
							?>

							<?php if ( !empty( $image ) ): ?>
								<img src="<?php echo esc_url( $image ); ?>" />
							<?php endif; ?>

							<?php if ( $machine_query->have_posts() ): ?>

								<?php while ( $machine_query->have_posts() ): $machine_query->the_post(); ?>

									<div class="pinball-score text-center">
										<span class="score"><?php echo number_format(get_the_content()); ?></span>
										<span class="player">
											<?php $players = get_the_terms( get_the_ID(), 'player' ); ?>
											<?php echo strtoupper( $players[0]->name ); ?>
										</span>
									</div>
								<?php endwhile; wp_reset_postdata(); ?>
							<?php else: ?>

								<div class="pinball-score text-center">
									<span class="score">1,000</span>
									<span class="player">AAA</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">900</span>
									<span class="player">BBB</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">800</span>
									<span class="player">CCC</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">700</span>
									<span class="player">DDD</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">600</span>
									<span class="player">EEE</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">500</span>
									<span class="player">FFF</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">400</span>
									<span class="player">GGG</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">300</span>
									<span class="player">HHH</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">222</span>
									<span class="player">MLP</span>
								</div>
								<div class="pinball-score text-center">
									<span class="score">59</span>
									<span class="player">DEW</span>
								</div>

							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="reveal" id="pinballSubmit" data-reveal>
					<?php get_template_part( 'partials/pinball-submission' ); ?>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer();
