<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'sada-clips', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-logo', array( 'height' => 100, 'width' => 240, 'flex-width' => true, 'flex-height' => true ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'comment-list' ) );
    add_theme_support( 'editor-styles' );
    add_editor_style( array( 'assets/css/base.css', 'assets/css/components.css' ) );
    register_nav_menus( array( 'primary' => __( 'القائمة الرئيسية', 'sada-clips' ), 'footer' => __( 'روابط التذييل', 'sada-clips' ) ) );
} );
add_action( 'wp_enqueue_scripts', function () {
    foreach ( array( 'base', 'layout', 'components' ) as $name ) {
        wp_enqueue_style( 'sada-' . $name, get_theme_file_uri( '/assets/css/' . $name . '.css' ), array(), '1.0.0' );
    }
    wp_enqueue_script( 'sada-ui', get_theme_file_uri( '/assets/js/main.js' ), array(), '1.0.0', true );
    wp_localize_script( 'sada-ui', 'sadaMessages', array(
        'copied' => __( 'تم نسخ الرابط', 'sada-clips' ),
        'failed' => __( 'تعذر النسخ. انسخ الرابط من الحقل الظاهر.', 'sada-clips' ),
    ) );
} );
add_filter( 'language_attributes', function ( $attributes ) {
    return ( is_rtl() || get_locale() === 'en_US' ) ? 'lang="ar" dir="rtl"' : $attributes;
} );
add_action( 'after_switch_theme', function () { if ( function_exists( 'sada_register_content' ) ) { sada_register_content(); } flush_rewrite_rules(); } );
