<?php
/**
 * Footer Template
 *
 * All stuff that should typically be in the footer.
 *
 * @since 0.1.0
 *
 * @package 
 * @subpackage Templates
 */

?>
				</section>

				<?php
				/** This action is documented in includes/Linchpin/hatch-hooks.php */
				do_action( 'hatch_footer_before' ); ?>

				<footer class="row">

					<?php
					/** This action is documented in includes/Linchpin/hatch-hooks.php */
					do_action( 'hatch_footer_inner_before' ); ?>

					<?php dynamic_sidebar( 'footer-widgets' ); ?>

					<?php
					/** This action is documented in includes/Linchpin/hatch-hooks.php */
					do_action( 'hatch_footer_inner_after' ); ?>

					<nav id="footer-navigation">
						<?php
						wp_nav_menu( array(
							'container'       => false,
							'container_class' => '',
							'menu'            => '',
							'menu_class'      => 'footer-menu',
							'theme_location'  => 'footer',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'depth'           => 5,
							'fallback_cb'     => false,
							'walker'          => new Foundation_Walker_Nav_Menu(),
						) );
						?>
					</nav>

				</footer>

				<?php
				/** This action is documented in includes/Linchpin/hatch-hooks.php */
				do_action( 'hatch_footer_after' ); ?>

				<a class="exit-off-canvas"></a>

				<?php
				/** This action is documented in includes/Linchpin/hatch-hooks.php */
				do_action( 'hatch_layout_end' ); ?>

			</div>
		</div>

		<?php wp_footer(); ?>

		<?php
		/**
		 * Additional Footer Scripts is attached to this action
		 * If this action is removed from your Additional Footer Scripts
		 * area within the Theme Settings will no longer print to the
		 * front end of your theme
		 *
		 *
		 */
		/** This action is documented in includes/Linchpin/hatch-hooks.php */
		do_action( 'hatch_body_before_close' ); ?>
	</body>
</html>
