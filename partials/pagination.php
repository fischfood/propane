<?php
/**
 * Pagination Partial
 *
 * Display navigation to next/previous pages when applicable.
 *
 * @since      1.0.0
 *
 * @package    Propane
 * @subpackage TemplateParts
 */

?>

<?php do_action( 'truss_pagination_before' ); ?>

<div itemprop="pagination">
	<?php
	if ( function_exists( 'truss_pagination' ) ) :
		truss_pagination( '&laquo;', '&raquo;' );
	elseif ( is_paged() ) :
	?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'propane' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'propane' ) ); ?></div>
		</nav>
	<?php endif; ?>
</div>

<?php do_action( 'truss_pagination_after' );
