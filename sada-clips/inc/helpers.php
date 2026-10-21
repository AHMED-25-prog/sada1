<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function sada_icon( $name = 'star' ) {
    $paths = array(
        'star' => '<path d="m12 2 3 5 5-1-1 6 3 3-6 1-3 6-3-5-6 1 1-6-3-3 6-1Z"/>',
        'book' => '<path d="M12 6C8 3 4 4 2 5v14c4-2 7-1 10 1 3-2 6-3 10-1V5c-2-1-6-2-10 1Zm0 0v14M5 8l4 1M15 9l4-1"/>',
        'crescent' => '<path d="M20 15A9 9 0 0 1 9 3a9 9 0 1 0 11 12Z"/>',
        'pen' => '<path d="m4 20 2-7L17 2l5 5L11 18l-7 2Zm2-7 5 5M14 5l5 5"/>',
        'lamp' => '<path d="M8 17c0-4-3-4-3-8a7 7 0 0 1 14 0c0 4-3 4-3 8ZM8 20h8M10 23h4"/>',
        'lantern' => '<path d="M9 4a3 3 0 0 1 6 0M7 6h10l2 14H5L7 6Zm0 3h10M12 9v8M9 23h6"/>',
        'play' => '<circle cx="12" cy="12" r="9"/><path d="m10 8 6 4-6 4Z"/>',
        'search' => '<circle cx="10" cy="10" r="7"/><path d="m15 15 6 6"/>',
        'share' => '<circle cx="5" cy="12" r="3"/><circle cx="19" cy="5" r="3"/><circle cx="19" cy="19" r="3"/><path d="m8 11 8-5M8 13l8 5"/>',
        'wall' => '<path d="M3 4h18v13H9l-6 5V4Z"/>',
    );
    return '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ( $paths[ $name ] ?? $paths['star'] ) . '</svg>';
}
function sada_brand() {
    if ( has_custom_logo() ) { the_custom_logo(); return; }
    echo '<a class="brand" href="' . esc_url( home_url( '/' ) ) . '">' . sada_icon( 'star' ) . '<span>' . esc_html__( 'صدى كليبز', 'sada-clips' ) . '</span></a>';
}
function sada_fallback_menu() {
    echo '<ul class="menu">' . sada_client_navigation() . '</ul>';
}
function sada_sections() {
    return array(
        'quran' => array( 'title' => __( 'مركزية القرآن', 'sada-clips' ), 'type' => 'post', 'category' => 'quran', 'card' => 'article', 'icon' => 'book' ),
        'readings' => array( 'title' => __( 'قرآنيات', 'sada-clips' ), 'type' => 'post', 'category' => 'readings', 'card' => 'article', 'icon' => 'star', 'image' => true ),
        'wall' => array( 'title' => __( 'حائط', 'sada-clips' ), 'type' => 'post', 'category' => 'wall', 'card' => 'wall', 'icon' => 'wall' ),
        'reflections' => array( 'title' => __( 'تأملات', 'sada-clips' ), 'type' => 'reflection', 'card' => 'reflection', 'icon' => 'lamp' ),
        'books' => array( 'title' => __( 'الكتب', 'sada-clips' ), 'type' => 'post', 'category' => 'books', 'card' => 'book', 'icon' => 'pen' ),
        'programs' => array( 'title' => __( 'البرامج', 'sada-clips' ), 'type' => 'program', 'card' => 'program', 'icon' => 'play' ),
    );
}

function sada_section_url( $section ) {
    if ( isset( $section['category'] ) ) {
        $term = get_category_by_slug( $section['category'] );
        if ( $term ) { return get_category_link( $term ); }
        return add_query_arg( 'category_name', $section['category'], home_url( '/' ) );
    }
    return get_post_type_archive_link( $section['type'] ) ?: home_url( '/' );
}
function sada_share() {
    echo '<button class="icon-button share-button" data-url="' . esc_url( get_permalink() ) . '" data-title="' . esc_attr( get_the_title() ) . '" aria-label="' . esc_attr( sprintf( __( 'مشاركة: %s', 'sada-clips' ), get_the_title() ) ) . '">' . sada_icon( 'share' ) . '</button>';
}
function sada_thumbnail( $kind = 'reflection' ) {
    if ( has_post_thumbnail() ) {
        the_post_thumbnail( $kind === 'book' ? 'large' : 'medium_large', array( 'class' => 'card-image', 'loading' => 'lazy', 'alt' => get_the_title() ) );
    } else {
        $images = array( 'article' => 'crescent', 'reflection' => 'dunes', 'book' => 'book-cover', 'program' => 'dome', 'clip' => 'lantern' );
        $image = $images[ $kind ] ?? 'dunes';
        $custom = get_post_meta( get_the_ID(), '_sada_illustration', true );
        if ( in_array( $custom, array( 'dunes', 'dome', 'lantern', 'crescent', 'palm', 'book', 'arch', 'book-cover' ), true ) ) { $image = $custom; }
        echo '<img class="card-image" src="' . esc_url( get_theme_file_uri( '/assets/img/' . $image . '.svg' ) ) . '" alt="" aria-hidden="true" loading="lazy" width="640" height="' . ( $kind === 'book' ? '800' : '360' ) . '">';
    }
}
function sada_card_kind() {
    $type = get_post_type();
    if ( in_array( $type, array( 'clip', 'program' ), true ) ) { return 'program'; }
    if ( $type === 'reflection' ) { return 'reflection'; }
    if ( has_category( 'books' ) ) { return 'book'; }
    if ( has_category( 'wall' ) ) { return 'wall'; }
    return 'article';
}
function sada_excerpt() { echo esc_html( wp_trim_words( get_the_excerpt(), 24, '…' ) ); }

add_filter( 'get_the_archive_title', function ( $title ) {
    if ( is_category() || is_tag() || is_tax() ) { return single_term_title( '', false ); }
    if ( is_post_type_archive() ) { return post_type_archive_title( '', false ); }
    return $title;
} );
