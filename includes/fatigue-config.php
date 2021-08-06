<?php
/**
 * The base configuration file for the application
 */

$environment_config = array();

switch ( $_SERVER['SERVER_NAME'] )
{
	// Local.
	case 'localhost':
	case 'testyourtiredself-dev':
    case 'testyourtiredself.loc':
	case 'tfnsw0159.loc':
		$environment_config = require 'includes/fatigue-config-local.php';
		break;

	// Staging.
	case 'testyourtiredself-uat.vmlaustralia.com':
	case 'testyourtiredself-dev.vmlaustralia.com':
	case 'tfnsw0159stage.vmlaustralia.com':
		$environment_config = require 'includes/fatigue-config-staging.php';
		break;

	// Production.
	case 'testyourtiredself.com.au':
		$environment_config = require 'includes/fatigue-config-production.php';
		break;

	default:
		die('Undefined environment: Please check the main config file and its ' . $_SERVER['SERVER_NAME']);

}


/**
 * Define all the defaults for all the constants that are about
 * to get defined and allow the environment configuration items
 * to overwrite these values.
 *
 * Do not modify these values from here. Use the environment-specific
 * config files - unless it's a global change for all environments.
 */
$config_defaults = array(

	'SITE_URL'  => 'http://' . $_SERVER['HTTP_HOST'],

	'IS_IPAD'   => (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad')


);


// Merge the environment config items with the defaults.
$config = array_merge( $config_defaults , $environment_config );


// Define all the configuration constants.
foreach ( $config as $config_setting => $config_value )
{
	define( $config_setting, $config_value );
}
