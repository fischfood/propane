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

get_template_part( 'partials/helpful_links-submission-logic' );

?>

<?php get_header(); ?>

	<div class="full-grid-container">
		<div class="grid-x">
			<div class="small-12 cell padding-all text-center" role="main">
				<h1>Helpful Links</h1>
				<p>
					<?php // <button class="button" data-open="helpful_linksSubmit">Submit Link</button> ?>
				</p>
			</div>
			<div class="small-12 cell" role="main">
				<div class="grid-x">
					<?php $link_groups = get_terms( array(
						'taxonomy'   => 'link_group',
						'hide_empty' => false,
					) ); ?>

					<?php /*
					<div class="small-12 cell padding-all text-center grid-x align-center">
						<div class="small-12 cell">
							<?php foreach ( $link_groups as $link_group ): ?>
								<a class="button margin-all-small" href="#<?php echo $link_group->slug; ?>"><?php echo $link_group->name; ?></a>
							<?php endforeach; ?>
						</div>
					</div>
                    */ ?>

					<?php foreach ( $link_groups as $link_group ): ?>

						<div class="small-12 cell padding-all helpful_links-scores-container grid-x align-center">
							<div class="small-12 cell">

								<?php
								$link_group_slug = $link_group->slug;
								$link_group_args = array(
									'post_type'      => 'helpful_links',
									'posts_per_page' => 1000,
									'order'          => 'ASC',
									'orderby'        => 'title',
									'tax_query'      => array(
										array(
											'taxonomy' => 'link_group',
											'field'    => 'slug',
											'terms'    => array( $link_group_slug ),
										),
									),
								);

								$link_group_query = new WP_Query( $link_group_args );
								?>

								<span class="anchor" id="<?php echo $link_group->slug;?>"></span>
								<h2 class="text-center margin-top-large"><?php echo $link_group->name; ?></h2>

								<div class="helpful_links-list">
									<div class="grid-x helpful_links-header">
										<div class="small-4 cell">Name</div>
										<div class="small-4 cell">Type</div>
										<div class="small-4 cell">Link</div>
									</div>
									<?php if ( $link_group_query->have_posts() ): ?>
										<?php while ( $link_group_query->have_posts() ): $link_group_query->the_post(); ?>

											<div class="helpful_links-record grid-x">
												<span class="small-4 cell name"><?php echo the_title(); ?></span>
												<span class="small-4 cell type">
													<?php if ( get_post_meta( get_the_ID(), '_link_type', true ) ): ?>
														<?php echo get_post_meta( get_the_ID(), '_link_type', true ); ?>
													<?php endif; ?>
												</span>
												<?php if ( get_the_content() !== ' ' ): ?>
													<span class="small-4 cell link"><?php echo get_the_content(); ?></span>
												<?php endif; ?>
											</div>

										<?php endwhile;
										wp_reset_postdata(); ?>
									<?php else: ?>

										<div class="helpful_links-record grid-x">
											<span class="small-12 cell notes" style="opacity: .2;">No Records Added</span>
										</div>

									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>

				<div class="reveal" id="helpful_linksSubmit" data-reveal>
					<?php get_template_part( 'partials/helpful_links-submission' ); ?>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer();
