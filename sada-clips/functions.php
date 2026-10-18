<?php
/** Theme bootstrap. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
foreach ( array( 'setup', 'helpers', 'content', 'customizer', 'sample-content' ) as $module ) {
    $file = get_template_directory() . '/inc/' . $module . '.php';
    if ( file_exists( $file ) ) { require_once $file; }
}
