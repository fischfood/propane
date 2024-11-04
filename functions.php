<?php
/**
 *
 * Include all of our needed Classes and scripts
 */

// Useful global constants
define( 'PROPANE_VERSION', '1.0.1' );
define( 'PROPANE_TYPEKIT', 'csi6jve' ); // Define if we are using typekit, this determines if typekit is used in the editor

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', true ); // Enable script debug by default. Should be disabled in production
}

require_once 'includes/Linchpin/utilities/utilities.php'; // Useful Functions
require_once 'includes/Linchpin/utilities/hooks.php';     // Custom Truss Hooks
require_once 'includes/Linchpin/class-truss.php';         // Truss Classes
require_once 'includes/Foundation/class-foundation.php';  // Foundation Classes
require_once 'includes/Propane.php';            // Theme Class

/**
 * Instantiate our classes, kick the theme in gear.
 */

$theme = new Propane();
