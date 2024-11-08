<?php
/**
 * Output Post/Entry Meta
 *
 * This is pretty much used in blog posts
 *
 * @since      1.0.0
 *
 * @package    Propane
 * @subpackage TemplateParts
 */
?>
<time class="updated" itemprop="datePublished" datetime="<?php echo get_the_time( 'c' ); ?>" pubdate>
	<?php
	printf(
		wp_kses(
		// translators: 1. date of post 2. time of post
			__( 'Posted on <span itemprop="datePublished">%1$s</span> at %2$s.', 'propane' ),
			array(
				'span' => array(
					'itemprop' => array(),
				),
			)
		),
		get_the_time( 'l, F jS, Y' ),
		get_the_time()
	);
	?>
</time>
<p class="byline author">
	<?php esc_html_e( 'Written by ', 'propane' ); ?>
	<a href="<?php echo esc_attr( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="fn">
		<span itemprop="author"><?php echo get_the_author(); ?></span>
	</a>
</p>
