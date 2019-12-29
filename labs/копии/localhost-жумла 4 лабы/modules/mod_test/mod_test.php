<?php

// No direct access
defined( '_JEXEC' ) or die;

require_once( dirname( __FILE__ ) . '/helper.php' );
$data = modTestHelper::getData( $params );
$moduleclass_sfx = htmlspecialchars( $params->get( 'moduleclass_sfx' ) );
require( JModuleHelper::getLayoutPath( 'mod_test', $params->get( 'layout', 'default' ) ) );