<?php

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && $_POST['action'] == "pinball-submission" ) {

	$post_type    = 'pinball';
	$score        = $_POST['score'];
	$machine_name = $_POST['pinball_machine'];
	$player_name  = $_POST['pinball_player'];
	$current_date = date( "m-d-y" );

	$player_id = wp_insert_term( $player_name, 'player' );

	$new_post = array(
		'post_title'   => $score . ' - ' . $player_name . ' - ' . $machine_name,
		'post_content' => $score,
		'post_status'  => 'publish',
		'post_type'    => $post_type,
		'menu_order'   => $score,
		'tax_input'    => array(
			'machine' => array( $machine_name ),
			'player'  => array( $player_name ),
		),
	);

	$post_id = wp_insert_post( $new_post );
	wp_set_object_terms( $post_id, $machine_name, 'machine' );
	wp_set_object_terms( $post_id, $player_name, 'player' );

	wp_safe_redirect( get_the_permalink( $post_id ) );

}
