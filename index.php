<?php
/**
 * Catch All Template
 *
 * Catch all template file within the Template Hierarchy.
 *
 * @since      1.0.0
 *
 * @package    Propane
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<div class="grid-container infinite-container">
    <div class="grid-x">
        <div class="small-12 large-8 cell" role="main">

            <?php
            /** This action is documented in includes/Linchpin/truss-hooks.php */
            do_action( 'truss_content_before' );
            ?>

            <?php if ( have_posts() ) : ?>

                <?php
                /** This action is documented in includes/Linchpin/truss-hooks.php */
                do_action( 'truss_loop_before' );
                ?>

                <?php
                while ( have_posts() ) :
                    the_post();
                ?>
                    <?php get_template_part( 'partials/loop-post', get_post_type() ); ?>
                <?php endwhile; ?>

                <?php
                /** This action is documented in includes/Linchpin/truss-hooks.php */
                do_action( 'truss_loop_after' );
                ?>

            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>

            <?php get_template_part( 'partials/pagination' ); ?>

            <?php
            /** This action is documented in includes/Linchpin/truss-hooks.php */
            do_action( 'truss_content_after' );
            ?>

        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
