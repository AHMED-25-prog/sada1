<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'customize_register', function ( $wp_customize ) {
    $wp_customize->add_section( 'sada_identity', array( 'title' => __( 'هوية صدى كليبز', 'sada-clips' ), 'priority' => 30 ) );
    $settings = array(
        'sada_hero_title' => array( __( 'عنوان المقدمة', 'sada-clips' ), __( 'صدى كليبز', 'sada-clips' ), 'text' ),
        'sada_tagline' => array( __( 'العبارة التعريفية', 'sada-clips' ), __( 'من لحظة تأمّل، يبدأ أثرٌ يبقى.', 'sada-clips' ), 'text' ),
        'sada_intro' => array( __( 'نص البطاقة التعريفية', 'sada-clips' ), __( 'مقاطع قصيرة، وقراءات وتأملات تجمع نور المعرفة وجمال السؤال، في مساحة عربية قريبة منك.', 'sada-clips' ), 'textarea' ),
        'sada_intro_url' => array( __( 'رابط زر البطاقة التعريفية', 'sada-clips' ), home_url( '/#quran' ), 'url' ),
        'sada_footer' => array( __( 'نص التذييل', 'sada-clips' ), __( 'مساحة عربية للمعرفة والتأمل، نقترب فيها من المعنى بخطوات هادئة.', 'sada-clips' ), 'textarea' ),
        'sada_social_youtube' => array( __( 'رابط يوتيوب', 'sada-clips' ), '', 'url' ),
        'sada_social_telegram' => array( __( 'رابط تلغرام', 'sada-clips' ), '', 'url' ),
        'sada_social_instagram' => array( __( 'رابط إنستغرام', 'sada-clips' ), '', 'url' ),
    );
    foreach ( $settings as $id => $setting ) {
        $wp_customize->add_setting( $id, array( 'default' => $setting[1], 'sanitize_callback' => $setting[2] === 'url' ? 'esc_url_raw' : 'sanitize_textarea_field', 'transport' => 'refresh' ) );
        $wp_customize->add_control( $id, array( 'section' => 'sada_identity', 'label' => $setting[0], 'type' => $setting[2] ) );
    }
} );
