<?php
/**
 * Pagination Partial
 *
 * Display navigation to next/previous pages when applicable.
 *
 * @since 0.1.0
 *
 * @package 
 * @subpackage Partials
 */

?>

<?php do_action( 'hatch_pagination_before' ); ?>

<?php if ( function_exists( 'hatch_pagination' ) ) :
	hatch_pagination( '&laquo;', '&raquo;' );
elseif ( is_paged() ) : ?>
	<nav id="post-nav">
		<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'propane' ) ); ?></div>
		<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'propane' ) ); ?></div>
	</nav>
<?php endif; ?>

<?php do_action( 'hatch_pagination_after' );
