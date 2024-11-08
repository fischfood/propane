<?php
/**
 * Default Header
 *
 * @since      1.0.0
 *
 * @package    Propane
 * @subpackage TemplateParts
 */
?>

<div class="full-page-header container">
	<div class="grid-x">
		<div class="small-12 cell">
			<?php
			the_title( '<h1>', '</h1>', true );

			if ( function_exists( 'the_simple_subtitle' ) ) {
				the_simple_subtitle();
			}
			?>
		</div>
	</div>
</div>
