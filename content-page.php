<?php
/**
 * Content Template
 *
 * The default template for displaying content. Used within single and index/archive/search templates.
 *
 * @since 0.1.0
 *
 * @package 
 * @subpackage Templates
 */

?>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'hatch_post_before' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php hatch_entry_meta(); ?>
	</header>

	<?php
	/** This action is documented in includes/Linchpin/hatch-hooks.php */
	do_action( 'hatch_post_entry_content_before' ); ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading...', 'propane' ) ); ?>
	</div>

	<?php
	/** This action is documented in includes/Linchpin/hatch-hooks.php */
	do_action( 'hatch_post_entry_content_after' ); ?>

	<footer>
		<?php $tag = get_the_tags(); if ( $tag ) : ?><p><?php the_tags(); ?></p><?php endif; ?>
	</footer>

	<?php get_template_part( 'includes/partials/edit-controls' ); ?>

	<hr />
</article>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'hatch_post_after');
