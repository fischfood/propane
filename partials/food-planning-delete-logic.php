<?php

$secret = 'false';

if ( array_key_exists( 'secret', $_POST ) ) {
	error_log( 'secret' );
	if ( md5( strtolower( $_POST['secret'] ) )  === 'affd951c2a8753bb1da25e8e08e138c6' || md5( strtolower( $_POST['secret'] ) ) === '73d94ca09de7d23b853273b035cbc752' || md5( strtolower( $_POST['secret'] ) ) === '78d6810e1299959f3a8db157045aa926' ) {
		$secret = 'true';
	}

	if ( 'POST' === $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && $_POST['action'] === "food-planning-delete" && $secret === 'true' ) {

		$post_id = $_POST['food-planning-delete-id'];

		error_log( $post_id );

		wp_delete_post( $post_id );

	}

	if ( ! empty( $_POST['secret'] ) ) {
		wp_safe_redirect( site_url('/food-planning' ) );
	}
}