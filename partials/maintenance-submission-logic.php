<?php

date_default_timezone_set( 'America/New_York' );

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && $_POST['action'] == "maintenance-submission" ) {

	$post_type        = 'maintenance';
	$mileage          = $_POST['mileage'];
	$notes            = $_POST['notes'];
	$maintenance_type = $_POST['maintenance_type_field'];
	$vehicle          = $_POST['maintenance_vehicle'];
	$input_date       = $_POST['maintenance-date'];

	if ( empty( $notes ) ) {
		$notes = ' ';
	}

	$new_post = array(
		'post_title'   => $vehicle . ' - ' . $maintenance_type . ' - ' . $input_date,
		'post_content' => $notes,
		'post_status'  => 'publish',
		'post_type'    => $post_type,
		'post_date'    => $input_date . ' ' . date( 'H:i:s' ),
		'tax_input'    => array(
			'maintenance_type' => array( $maintenance_type ),
			'vehicle'          => array( $vehicle ),
		),
		'meta_input'   => array(
			'_vehicle_mileage' => $mileage,
		)
	);

	$post_id = wp_insert_post( $new_post );
	wp_set_object_terms( $post_id, $maintenance_type, 'maintenance_type' );
	wp_set_object_terms( $post_id, $vehicle, 'vehicle' );

	wp_safe_redirect( get_the_permalink( $post_id ) );

}
