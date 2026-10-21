<?php
/** WhatsApp settings and links shared by the homepage, footer, and floating action. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function sada_whatsapp_defaults() {
    return array(
        'number'  => '905550561083',
        'message' => __( 'السلام عليكم، أرغب في الاستفسار عن خدمات صدى كليبز', 'sada-clips' ),
    );
}

/** wa.me requires an international number containing digits only. */
function sada_sanitize_whatsapp_number( $value ) {
    return preg_replace( '/[^0-9]/', '', is_scalar( $value ) ? (string) $value : '' );
}

function sada_validate_whatsapp_number( $validity, $value ) {
    $number = sada_sanitize_whatsapp_number( $value );
    if ( ! preg_match( '/^[1-9][0-9]{6,14}$/', $number ) ) {
        $validity->add( 'sada_whatsapp_number', __( 'أدخل رقمًا دوليًا صحيحًا من 7 إلى 15 رقمًا، متضمنًا رمز الدولة.', 'sada-clips' ) );
    }
    return $validity;
}

add_action( 'customize_register', function ( $wp_customize ) {
    $defaults = sada_whatsapp_defaults();
    $wp_customize->add_section( 'sada_contact', array(
        'title'    => __( 'التواصل عبر واتساب', 'sada-clips' ),
        'priority' => 32,
    ) );
    $wp_customize->add_setting( 'sada_whatsapp_number', array(
        'default'           => $defaults['number'],
        'sanitize_callback' => 'sada_sanitize_whatsapp_number',
        'validate_callback' => 'sada_validate_whatsapp_number',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'sada_whatsapp_number', array(
        'section'     => 'sada_contact',
        'label'       => __( 'رقم واتساب الدولي', 'sada-clips' ),
        'description' => __( 'أدخل الرقم مع رمز الدولة. تُحذف علامة + والمسافات تلقائيًا.', 'sada-clips' ),
        'type'        => 'tel',
    ) );
    $wp_customize->add_setting( 'sada_whatsapp_message', array(
        'default'           => $defaults['message'],
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'sada_whatsapp_message', array(
        'section' => 'sada_contact',
        'label'   => __( 'رسالة واتساب الافتراضية', 'sada-clips' ),
        'type'    => 'textarea',
    ) );
} );

function sada_whatsapp_url() {
    $defaults = sada_whatsapp_defaults();
    $number = sada_sanitize_whatsapp_number( get_theme_mod( 'sada_whatsapp_number', $defaults['number'] ) );
    if ( ! preg_match( '/^[1-9][0-9]{6,14}$/', $number ) ) {
        $number = $defaults['number'];
    }
    $message = sanitize_textarea_field( get_theme_mod( 'sada_whatsapp_message', $defaults['message'] ) );
    return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

/** Original outline chat-and-handset icon, matching the theme's existing icon stroke. */
function sada_whatsapp_icon() {
    return '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M20.5 11.6a8.5 8.5 0 0 1-12.8 7.3L3 20.5l1.5-4.7a8.5 8.5 0 1 1 16-4.2Z"/><path d="m8.2 7.1 1.4 2.5-1.1 1.2a9.1 9.1 0 0 0 4.6 4.3l1.1-1.2 2.6 1.3c-.3 1.9-1.8 2.3-3.5 1.7-3.6-1.2-6-3.6-7-6.9-.5-1.5.2-2.6 1.9-2.9Z"/></svg>';
}

function sada_whatsapp_button( $floating = false ) {
    $label = __( 'تواصل معنا عبر واتساب', 'sada-clips' );
    $classes = $floating ? 'sada-whatsapp sada-whatsapp-floating' : 'button sada-whatsapp sada-whatsapp-inline';
    echo '<a class="' . esc_attr( $classes ) . '" href="' . esc_url( sada_whatsapp_url() ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $label ) . '">';
    echo sada_whatsapp_icon();
    if ( $floating ) {
        echo '<span class="sada-whatsapp-tooltip" aria-hidden="true">' . esc_html( $label ) . '</span>';
    } else {
        echo '<span>' . esc_html( $label ) . '</span>';
    }
    echo '</a>';
}

add_action( 'wp_footer', function () {
    if ( ! is_admin() ) { sada_whatsapp_button( true ); }
}, 5 );
