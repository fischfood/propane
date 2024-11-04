<?php

date_default_timezone_set( 'America/New_York' );

if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && $_POST['action'] == "food-planning-submission" ) {

	// '_food_planning_prep_time',
	// '_food_planning_oven_time_temp',
	// '_food_planning_person_making',
	// '_food_planning_person_requesting',
	// '_food_planning_ingredients',
	// '_food_planning_website',

	$post_type        	= 'food_planning';

	$food_name			= $_POST['food_name'];
	$prep_time			= $_POST['prep_time'];
	$cook_time_temp		= $_POST['time_temp'];
	$person_making		= $_POST['person_making'];
	//$ingredients		= $_POST['ingredients'];
	$website			= $_POST['url'];
	$notes            	= $_POST['notes'];

	$food_planning_type = $_POST['food_planning_type_field'];
	$occasion = $_POST['occasion_field'];

	if ( empty( $notes ) ) {
		$notes = ' ';
	}

	$new_post = array(
		'post_title'   => $food_name,
		'post_content' => $notes,
		'post_status'  => 'publish',
		'post_type'    => $post_type,
		'tax_input'    => array(
			//'food_planning_type' => array( $food_planning_type ),
			'occasion'         	 => array( $occasion ),
		),
		'meta_input'   => array(
			'_food_planning_prep_time' => $prep_time,
			'_food_planning_time_temp' => $cook_time_temp,
			'_food_planning_person_making' => $person_making,
			'_food_planning_website' => $website,
		)
	);

	$post_id = wp_insert_post( $new_post );
	wp_set_object_terms( $post_id, $food_planning_type, 'food_planning_type' );
	wp_set_object_terms( $post_id, $occasion, 'occasion' );

	wp_safe_redirect( get_the_permalink( $post_id ) );

}
