<?php
/**
 * Hatch Action Hooks
 *
 * Just a bunch of utility methods associated with our hooks
 *
 * @package Hatch
 * @since 1.0.0
 */

?>

<?php

/**
 * Hatch hatch_comments_before hook.
 * Add extra content before the comments are started.
 *
 * @since 2.0.0
 */
function hatch_comments_before() {
	do_action( 'hatch_comments_before' );
}

/**
 * Hatch hatch_comments_after hook.
 * Add extra content after the comments are done.
 *
 * @since 2.0.0
 */
function hatch_comments_after() {
	do_action( 'hatch_comments_after' );
}

/**
 * Hatch hatch_head_scripts hook.
 * Allow for additional scripts be be hooked into.
 * We utilize this for additional_head_scripts.
 *
 * @since 2.0.0
 */
function hatch_head_scripts() {
	do_action( 'hatch_head_scripts' );
}

/**
 * Hatch hatch_header_before hook.
 * Ability to add stuff before our headers.
 *
 * @since 2.0.0
 */
function hatch_header_before() {
	do_action( 'hatch_header_before' );
}

/**
 * Hatch hatch_header_inner_before hook.
 * Add some content within our header but before the rest
 * of our navigation.
 *
 * @since 2.0.0
 */
function hatch_header_inner_before() {
	do_action( 'hatch_header_inner_before' );
}

/**
 * Hatch hatch_header_inner_after
 * Add some content within our header but before the rest
 * of our navigation.
 *
 * @since 2.0.0
 */
function hatch_header_inner_after() {
	do_action( 'hatch_header_inner_after' );
}

/**
 * Hatch header_after hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function hatch_header_after() {
	do_action( 'hatch_header_after' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function hatch_content_before() {
	do_action( 'hatch_content_before' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function hatch_content_after() {
	do_action( 'hatch_content_after' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_post_before() {
	do_action( 'hatch_post_before' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_post_after() {
	do_action( 'hatch_post_after' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_post_inside_before() {
	do_action( 'hatch_post_inside_before' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_post_inside_after() {
	do_action( 'hatch_post_inside_after' );
}

/**
 * Hatch hatch_loop_before hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_loop_before() {
	do_action( 'hatch_loop_before' );
}

/**
 * Hatch hatch_loop_after hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_loop_after() {
	do_action( 'hatch_loop_after' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_sidebar_before() {
	do_action( 'hatch_sidebar_before' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_sidebar_inner_before() {
	do_action( 'hatch_sidebar_inner_before' );
}

/**
 * Middleman hatch hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_sidebar_inner_after() {
	do_action( 'hatch_sidebar_inner_after' );
}

/**
 * Hatch hatch_sidebar_after hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_sidebar_after() {
	do_action( 'hatch_sidebar_after' );
}

/**
 * Hatch hatch_footer_before hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_footer_before() {
	do_action( 'hatch_footer_before' );
}

/**
 * Hatch hatch_footer_inner_before hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_footer_inner_before() {
	do_action( 'hatch_footer_inner_before' );
}

/**
 * Hatch hatch_footer_inner_after hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_footer_inner_after() {
	do_action( 'hatch_footer_inner_after' );
}

/**
 * Hatch hatch_footer_after hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_footer_after() {
	do_action( 'hatch_footer_after' );
}

/**
 * Hatch hatch_footer_scripts hook
 *
 * @package Hatch
 * @subpackage hooks
 *
 * @since 2.0
 */
function hatch_body_before_close() {
	do_action( 'hatch_body_before_close' );
}
