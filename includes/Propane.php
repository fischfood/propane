<?php
/**
 * Propane
 *
 * @author  Brian Fischer
 * @package Propane
 */

/**
 * Class Propane
 */
class Propane {

	/**
	 * Apple favicon sizes.
	 *
	 * @var array
	 */
	public $apple_favicon_sizes = array(
		57,
		60,
		72,
		76,
		114,
		120,
		144,
		152,
		180,
	);

	/**
	 * Generic favicon sizes.
	 *
	 * @var array
	 */
	public $favicon_sizes = array(
		16,
		32,
		96,
		192,
	);

	/**
	 * __construct function.
	 */
	public function __construct() {

		$foundation = new \Foundation\Foundation();
		$truss      = new \Truss\Core();

		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
		add_filter( 'site_icon_image_sizes', array( $this, 'site_icon_image_sizes' ) );
		add_filter( 'site_icon_meta_tags', array( $this, 'site_icon_meta_tags' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_styles' ) );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'after_setup_theme', array( $this, 'add_editor_styles' ) );

		add_filter( 'gform_init_scripts_footer', '__return_true' );

		// Jetpack //
		add_action( 'loop_start', array( $this, 'remove_jp_social' ) );
		add_filter( 'wp', array( $this, 'remove_jp_related' ), 20 );
		add_filter( 'jetpack_relatedposts_filter_options', array( $this, 'jetpackme_no_related_posts' ) );

		// Jetpack Scrolling
		add_action( 'after_setup_theme', array( $this, 'jetpack_scroll_settings' ) );
		add_filter( 'infinite_scroll_js_settings', array( $this, 'jetpack_scroll_button' ) );

		// Gravity Forms //
		// add_filter( 'gform_init_scripts_footer', '__return_true' );
		// add_filter( 'gform_replace_merge_tags', array( $this, 'embed_url_no_query_string' ), 10, 7 );

		// Gated Resources
		// add_action( 'init',            array( $this, 'add_rewrite_rules' ) );
		// add_filter( 'query_vars',      array( $this, 'register_query_vars' ) );

		add_shortcode( 'media_dates', array( $this, 'media_dates' ) );
		add_shortcode( 'media_locations', array( $this, 'media_locations' ) );
	}

	/**
	 * Registers the menu in the WordPress admin menu editor.
	 *
	 * @since 1.0
	 */
	public function init() {
		register_nav_menus(
			array(
				'top-bar'           => esc_html__( 'Top Bar', 'propane' ),
				'footer'            => esc_html__( 'Footer', 'propane' ),
				'copyright'         => esc_html__( 'Copyright', 'propane' ),
				'mobile-off-canvas' => esc_html__( 'Mobile (Off Canvas)', 'propane' ),
				'social'            => esc_html__( 'Social Links', 'propane' ),
				'utility'           => esc_html__( 'Utility', 'propane' ),
			)
		);
	}

	/**
	 * Add in the theme author info, truss info and be sure to keep love for WordPress
	 *
	 * @todo needs sanitization
	 *
	 * @since 1.0
	 */
	public function admin_footer_text() {
		echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Created by <a href="https://linchpin.com/?utm_source=truss&utm_medium=truss_footer&utm_campaign=truss_notice" target="_blank">Linchpin</a> and <a href="http://github.com/linchpin/truss/?utm_source=truss&utm_medium=truss_footer&utm_campaign=truss_notice" target="_blank">Truss</a> on top';
	}

	/**
	 * Save custom favicon sizes from customizer upload.
	 *
	 * @param array $sizes Array of image sizes to save.
	 *
	 * @return array $sizes Array Merged array containing custom favicon sizes.
	 * @since 1.0
	 *
	 */
	public function site_icon_image_sizes( $sizes = array() ) {
		foreach ( $this->apple_favicon_sizes as $apple_favicon_size ) {
			$sizes[] = $apple_favicon_size;
		}

		foreach ( $this->favicon_sizes as $favicon_size ) {
			$sizes[] = $apple_favicon_size;
		}

		return $sizes;
	}

	/**
	 * Insert favicon meta tags to the head of the site.
	 *
	 * @param array $meta_tags Array of meta tags returned to output.
	 *
	 * @return array
	 */
	public function site_icon_meta_tags( $meta_tags = array() ) {
		foreach ( $this->apple_favicon_sizes as $apple_favicon_size ) {
			$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="%s" href="%s" />', $apple_favicon_size . 'x' . $apple_favicon_size, esc_url( get_site_icon_url( $apple_favicon_size ) ) );
		}

		foreach ( $this->favicon_sizes as $favicon_size ) {
			$meta_tags[] = sprintf( '<link rel="icon" type="image/png" sizes="%s" href="%s" />', $favicon_size . 'x' . $favicon_size, esc_url( get_site_icon_url( $favicon_size ) ) );
		}

		return $meta_tags;
	}

	/**
	 * We have found that these are pretty much 3 areas that clients request
	 * for easier customizations.
	 *
	 * Registers our 3 base sidebars
	 * Home Widgets
	 * Page Widgets
	 * Footer Widgets
	 *
	 * @access public
	 * @return void
	 */
	public
	function widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Home Widgets', 'propane' ),
			'id'            => 'home-widgets',
			'description'   => esc_html__( 'Widgets that are displayed on the home page.', 'propane' ),
			'class'         => 'home-widgets',
			'before_widget' => '<div id="%1$s" class="widget small-4 cell %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Page Widgets', 'propane' ),
			'id'            => 'page-widgets',
			'description'   => esc_html__( 'Widgets that are displayed on interior pages.', 'propane' ),
			'class'         => 'page-widgets',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets', 'propane' ),
			'id'            => 'footer-widgets',
			'description'   => esc_html__( 'Widgets that are displayed in the footer.', 'propane' ),
			'class'         => 'footer-widgets',
			'before_widget' => '<div id="%1$s" class="right %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widgettitle">',
			'after_title'   => '</h5>',
		) );
	}

	/**
	 * print_jquery_in_footer function.
	 * Removes the jquery library from the header and prints it in the footer
	 *
	 * @access public
	 *
	 * @param array &$scripts
	 *
	 * @return void
	 */
	public function print_jquery_in_footer( &$scripts ) {
		if ( ! is_admin() ) {
			$scripts->add_data( 'jquery', 'group', 1 );
		}
	}

	/**
	 * Hook into after_setup_theme
	 *
	 * @access public
	 * @return void
	 */
	public function after_setup_theme() {
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		update_option( 'image_default_link_type', 'none' );

		add_image_size( 'loop_medium', 768 );  // was small
	}

	/**
	 * Add wp_enqueue_scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function wp_enqueue_scripts() {
		if ( ! is_admin() ) {
			wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/lib/slick/slick.js', array( 'jquery' ), '1.8.0', true );

			wp_enqueue_script( 'propane-js', get_stylesheet_directory_uri() . '/js/propane.js', array(
				'jquery',
				'slick-js'
			), PROPANE_VERSION, true );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Enqueue our theme styles.
	 *
	 * @access public
	 * @return void
	 */
	public function wp_enqueue_styles() {
		if ( ! is_admin() ) {
			wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/lib/slick/slick.css', array(), PROPANE_VERSION );

			wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/lib/slick/slick-theme.css', array(), PROPANE_VERSION );

			wp_enqueue_style( 'propane-css', get_stylesheet_directory_uri() . '/css/propane.css', array(), PROPANE_VERSION );
		}
	}

	/*
	 * Customize_register function.
	 *
	 * Allows header logo to be set-up from
	 * the customize panel under Appearance within the WordPress Admin
	 *
	 * Also allow for the .svg extension within logo uploading
	 *
	 * @since 1.0
	 *
	 * @param $wp_customize
	 */
	public function customize_register( $wp_customize ) {

		$wp_customize->add_section(
			'propane_logo', array(
				'title'    => esc_html__( 'Site Logo', 'propane' ),
				'priority' => 80,
			)
		);

		$wp_customize->add_setting(
			'propane_theme_options[logo_upload]', array(
				'default'    => get_stylesheet_directory_uri() . '/assets/images/linchpin-icon-white.svg',
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
				'label'      => esc_html__( 'Site Logo', 'propane' ),
				'section'    => 'propane_logo',
				'settings'   => 'propane_theme_options[logo_upload]',
				'extensions' => array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);

		$wp_customize->add_setting(
			'propane_theme_options[alternate_logo_upload]', array(
				'default'    => get_stylesheet_directory_uri() . '/assets/images/linchpin-icon-white.svg',
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'alternate_logo_upload', array(
				'label'      => esc_html__( 'Alternate Site Logo', 'propane' ),
				'section'    => 'propane_logo',
				'settings'   => 'propane_theme_options[alternate_logo_upload]',
				'extensions' => array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);

		$wp_customize->add_section(
			'menu_options', array(
				'title'    => __( 'Primary Menu Options', 'propane' ),
				'priority' => 80,
			)
		);

		$wp_customize->add_setting(
			'propane_theme_options[menu_type]', array(
				'default'    => 'traditional',
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'menu_type', array(
				'label'    => __( 'Menu Navigation Style', 'propane' ),
				'section'  => 'menu_options',
				'settings' => 'propane_theme_options[menu_type]',
				'type'     => 'select',
				'choices'  => array(
					'traditional' => __( 'Hover (Default)', 'propane' ),
					'mega'        => __( 'Click (Mega Menu)', 'propane' ),
				),
			) )
		);

		$wp_customize->add_setting(
			'propane_theme_options[header_position]', array(
				'default'    => 'static',
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'header_position', array(
				'label'    => __( 'Menu Positioning', 'propane' ),
				'section'  => 'menu_options',
				'settings' => 'propane_theme_options[header_position]',
				'type'     => 'select',
				'choices'  => array(
					'static' => __( 'Static', 'propane' ),
					'fixed'  => __( 'Fixed', 'propane' ),
				),
			) )
		);

		$wp_customize->add_setting(
			'propane_theme_options[utility_menu_position]', array(
				'default'    => 'with',
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'utility_menu_position', array(
				'label'    => __( 'Utility Menu Positioning', 'propane' ),
				'section'  => 'menu_options',
				'settings' => 'propane_theme_options[utility_menu_position]',
				'type'     => 'select',
				'choices'  => array(
					'with'   => __( 'Scrolls with menu', 'propane' ),
					'click'  => __( 'Stays at top, menu clicks in place', 'propane' ),
					'scroll' => __( 'Scroll Down remove, scroll up show', 'propane' ),
				),
			) )
		);
	}

	/**
	 * linchpin_upload_mimes function.
	 *
	 * @access public
	 *
	 * @param array $mimes (default: array())
	 *
	 * @return array
	 */
	public function upload_mimes( $mimes = array() ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Add customized styles to the WordPress admin to match frontend editing.
	 */
	public function add_editor_styles() {
		$admin_style = get_stylesheet_directory_uri() . '/css/admin-editor.css';

		add_editor_style( $admin_style );
	}


	// Jetpack //

	/**
	 * Remove Jetpack Sharing icons and Related Posts from displaying by default
	 */
	function remove_jp_social() {
		if ( function_exists( 'sharing_display' ) ) {
			remove_filter( 'the_content', 'sharing_display', 19 );
			remove_filter( 'the_excerpt', 'sharing_display', 19 );
		}
	}

	function remove_jp_related() {
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp     = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}

	function jetpackme_no_related_posts( $options ) {
		if ( ! is_admin() ) {
			$options['enabled'] = false;
		}

		return $options;
	}

	/**
	 *
	 * Jetpack Infinite Scrolling and Buttons
	 */

	public function jetpack_scroll_settings() {
		add_theme_support( 'infinite-scroll', array(
			'container'      => 'infinite',
			'type'           => 'click',
			'footer'         => false,
			'render'         => 'infinite_post_render',
			'posts_per_page' => get_option( 'posts_per_page' ),
			'wrapper'        => false,
		) );
	}

	public function jetpack_scroll_button( $settings ) {
		$settings['text'] = __( 'Load More', 'propane' );

		return $settings;
	}

	// Gravity Forms

	function embed_url_no_query_string( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {

		$custom_merge_tag = '{embed_url_no_queryparams}';

		if ( strpos( $text, $custom_merge_tag ) === false ) {
			return $text;
		}

		//embed url
		$current_page_url = empty( $entry ) ? RGFormsModel::get_current_page_url() : rgar( $entry, 'source_url' );

		if ( $esc_html ) {
			$current_page_url = esc_html( $current_page_url );
		}

		if ( $url_encode ) {
			$current_page_url = rawurlencode( $current_page_url );
		}

		$current_page_parsed = wp_parse_url( $current_page_url );
		$current_page_url    = $current_page_parsed['scheme'] . '://' . $current_page_parsed['host'] . $current_page_parsed['path'];

		$text = str_replace( $custom_merge_tag, $current_page_url, $text );

		return $text;
	}

	function media_dates( $atts = '', $content = null ) {
		$atts = shortcode_atts( array(
			'' => ''
		), $atts, 'media-dates' );

		$date_tax = 'attachment_tag';

		$date_terms = get_terms( $date_tax, array(
			'hide_empty' => true,
			'orderby'    => 'slug',
			'order'      => 'ASC',
		) );


		ob_start(); ?>

		<div class="row">
			<div class="grid-container">
				<div class="small-12 medium-8 columns" role="main">

					<div class="grid-x">
					<?php foreach ( $date_terms as $term ): ?>

						<?php $term_link = get_term_link( $term ); ?>
						<?php $date = date("M jS, Y", strtotime( $term->name ) ); ?>

						<div class="small-6 medium-4 cell text-center padding-vertical padding-horizontal-small">
							<a href="<?php echo esc_url( $term_link ); ?>">
								<span class="equalize-span"><?php echo $date; ?></span>
							</a>
						</div>

					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	function media_locations( $atts = '', $content = null ) {
		$atts = shortcode_atts( array(
			'' => ''
		), $atts, 'media-dates' );

		$loc_tax = 'attachment_category';

		$loc_terms = get_terms( $loc_tax, array(
			'hide_empty' => true,
			'orderby'    => 'slug',
			'order'      => 'ASC',
		) );

		ob_start(); ?>

		<ul>

			<?php foreach( $loc_terms as $term ): ?>

				<?php $term_link = get_term_link( $term ); ?>

				<li class="small-6 medium-4 large-3 columns">
					<a href="<?php echo esc_url( $term_link ); ?>">
						<span class="equalize-span"><?php _e( $term->name, 'propane' ); ?></span>
					</a>
				</li>

			<?php endforeach; ?>

		</ul>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}

function get_loop_block( $name, $small = '', $medium = '', $large = '', $classes = '' ) {

	if ( '' == $name ) {
		return false;
	}

	$template = "partials/loop-{$name}.php";

	$grid_small  = '';
	$grid_medium = '';
	$grid_large  = '';
	$check       = false;

	/**
	 * $grid_set gets passed through to locate_template
	 * Within loop-###.php, set defaults for if $grid_set is not set
	 */
	$grid_set = '';


	if ( '' !== $small ) {
		$grid_small = 'small-' . $small;
		$check      = true;
	}

	if ( '' !== $medium ) {
		$grid_medium = 'medium-' . $medium;
		$check       = true;
	}

	if ( '' !== $large ) {
		$grid_large = 'large-' . $large;
		$check      = true;
	}

	if ( $check ) {
		$grid_set = 'cell ' . $grid_small . ' ' . $grid_medium . ' ' . $grid_large;
	}

	/**
	 * $loop_block_classes gets passed through to locate_template
	 * Within loop-###.php, $loop_block_classes are set on the outer most container (traditionally) to add extra classes (primarily for shortcode usage)
	 */
	$loop_block_classes = $classes;

	include( locate_template( $template, false, false ) );

}


/**
 * For use with Yoast's primary Taxonomies
 */
if ( ! function_exists( 'get_primary_taxonomy_id' ) ) {
	function get_primary_taxonomy_id( $post_id, $taxonomy = 'category' ) {
		$prm_term = '';
		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
			$prm_term           = $wpseo_primary_term->get_primary_term();
		}
		if ( ! is_object( $wpseo_primary_term ) || empty( $prm_term ) ) {
			$term = wp_get_post_terms( $post_id, $taxonomy );
			if ( isset( $term ) && ! empty( $term ) ) {
				return $term[0]->term_id;
			} else {
				return '';
			}
		}

		return $wpseo_primary_term->get_primary_term();
	}
}

