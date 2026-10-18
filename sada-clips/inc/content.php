<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function sada_register_content() {
    $types = array(
        'clip' => array( __( 'المقاطع', 'sada-clips' ), __( 'مقطع', 'sada-clips' ), 'dashicons-video-alt3' ),
        'program' => array( __( 'البرامج', 'sada-clips' ), __( 'برنامج', 'sada-clips' ), 'dashicons-playlist-video' ),
        'reflection' => array( __( 'التأملات', 'sada-clips' ), __( 'تأمل', 'sada-clips' ), 'dashicons-lightbulb' ),
    );
    foreach ( $types as $slug => $labels ) {
        register_post_type( $slug, array(
            'labels' => array( 'name' => $labels[0], 'singular_name' => $labels[1], 'add_new_item' => sprintf( __( 'إضافة %s', 'sada-clips' ), $labels[1] ), 'edit_item' => sprintf( __( 'تحرير %s', 'sada-clips' ), $labels[1] ) ),
            'public' => true, 'show_in_rest' => true, 'has_archive' => true,
            'rewrite' => array( 'slug' => $slug ), 'menu_icon' => $labels[2],
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
        ) );
    }
    register_taxonomy( 'clip_category', array( 'clip', 'program', 'reflection' ), array(
        'labels' => array( 'name' => __( 'تصنيفات المقاطع', 'sada-clips' ), 'singular_name' => __( 'تصنيف المقطع', 'sada-clips' ) ),
        'public' => true, 'hierarchical' => true, 'show_in_rest' => true, 'rewrite' => array( 'slug' => 'clip-category' ),
    ) );
    foreach ( array( 'clip', 'program', 'reflection', 'post' ) as $type ) {
        foreach ( array( '_sada_video' => 'esc_url_raw', '_sada_duration' => 'sanitize_text_field', '_sada_speaker' => 'sanitize_text_field', '_sada_credit' => 'sanitize_text_field' ) as $key => $sanitize ) {
            register_post_meta( $type, $key, array( 'type' => 'string', 'single' => true, 'show_in_rest' => true, 'sanitize_callback' => $sanitize, 'auth_callback' => function ( $allowed, $meta_key, $post_id ) { return current_user_can( 'edit_post', $post_id ); } ) );
        }
    }
}
add_action( 'init', 'sada_register_content' );
add_action( 'add_meta_boxes', function () {
    foreach ( array( 'clip', 'program', 'reflection', 'post' ) as $type ) {
        add_meta_box( 'sada-details', __( 'بيانات صدى كليبز', 'sada-clips' ), 'sada_meta_box', $type, 'normal' );
    }
} );
function sada_meta_box( $post ) {
    wp_nonce_field( 'sada_save_details', 'sada_details_nonce' );
    $fields = array( '_sada_credit' => __( 'اسم الجهة أو المؤلف', 'sada-clips' ) );
    if ( in_array( $post->post_type, array( 'clip', 'program' ), true ) ) {
        $fields += array( '_sada_video' => __( 'رابط الفيديو (YouTube أو Vimeo أو ملف فيديو)', 'sada-clips' ), '_sada_duration' => __( 'المدة (مثل 03:20؛ اختيارية)', 'sada-clips' ), '_sada_speaker' => __( 'اسم المتحدث أو الفريق', 'sada-clips' ) );
    }
    foreach ( $fields as $key => $label ) {
        echo '<p><label for="' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label><br><input class="widefat" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . ( $key === '_sada_video' ? 'url' : 'text' ) . '" value="' . esc_attr( get_post_meta( $post->ID, $key, true ) ) . '"></p>';
    }
    if ( $post->post_type === 'clip' ) {
        echo '<p><label for="sada-program">' . esc_html__( 'البرنامج المرتبط', 'sada-clips' ) . '</label><br><select id="sada-program" name="_sada_program_id"><option value="0">' . esc_html__( 'بدون برنامج', 'sada-clips' ) . '</option>';
        foreach ( get_posts( array( 'post_type' => 'program', 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC' ) ) as $program ) {
            echo '<option value="' . esc_attr( $program->ID ) . '" ' . selected( get_post_meta( $post->ID, '_sada_program_id', true ), $program->ID, false ) . '>' . esc_html( $program->post_title ) . '</option>';
        }
        echo '</select></p>';
    }
    echo '<p><label for="sada-illustration">'  . esc_html__( 'الرسم الافتراضي عند غياب الصورة البارزة', 'sada-clips' ) . '</label><br><select id="sada-illustration" name="_sada_illustration">';
    foreach ( array( '' => __( 'تلقائي', 'sada-clips' ), 'dunes' => __( 'كثبان', 'sada-clips' ), 'dome' => __( 'قبة ومئذنة', 'sada-clips' ), 'lantern' => __( 'فانوس', 'sada-clips' ), 'crescent' => __( 'هلال', 'sada-clips' ), 'palm' => __( 'نخلة', 'sada-clips' ), 'book' => __( 'كتاب ومصباح', 'sada-clips' ), 'arch' => __( 'نافذة', 'sada-clips' ), 'book-cover' => __( 'غلاف كتاب', 'sada-clips' ) ) as $value => $label ) {
        echo '<option value="' . esc_attr( $value ) . '" ' . selected( get_post_meta( $post->ID, '_sada_illustration', true ), $value, false ) . '>' . esc_html( $label ) . '</option>';
    }
    echo '</select></p>';
}
add_action( 'save_post', function ( $post_id ) {
    if ( ! isset( $_POST['sada_details_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sada_details_nonce'] ) ), 'sada_save_details' ) || ! current_user_can( 'edit_post', $post_id ) || wp_is_post_revision( $post_id ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) { return; }
    if ( get_post_type( $post_id ) === 'clip' && isset( $_POST['_sada_program_id'] ) && is_scalar( $_POST['_sada_program_id'] ) ) {
        $program_id = absint( $_POST['_sada_program_id'] );
        if ( ! $program_id || ( get_post_type( $program_id ) === 'program' && current_user_can( 'read_post', $program_id ) ) ) { update_post_meta( $post_id, '_sada_program_id', $program_id ); }
    }
    foreach ( array( '_sada_video', '_sada_duration' , '_sada_speaker', '_sada_credit', '_sada_illustration' ) as $key ) {
        if ( ! isset( $_POST[ $key ] ) || ! is_string( $_POST[ $key ] ) ) { continue; }
        $value = wp_unslash( $_POST[ $key ] );
        $value = $key === '_sada_video' ? esc_url_raw( $value, array( 'https', 'http' ) ) : sanitize_text_field( $value );
        if ( $key === '_sada_illustration' && ! in_array( $value, array( '', 'dunes', 'dome', 'lantern', 'crescent', 'palm', 'book', 'arch', 'book-cover' ), true ) ) { continue; }
        update_post_meta( $post_id, $key, $value );
    }
} );
/** Allow only explicit video providers; no arbitrary iframe HTML from stored input. */
function sada_video_embed( $url ) {
    if ( ! $url ) { return; }
    $parts = wp_parse_url( $url );
    if ( empty( $parts['scheme'] ) || ! in_array( strtolower( $parts['scheme'] ), array( 'https', 'http' ), true ) ) { return; }
    $host = strtolower( $parts['host'] ?? '' ); $path = $parts['path'] ?? ''; $src = '';
    if ( in_array( $host, array( 'youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtu.be' ), true ) ) {
        parse_str( $parts['query'] ?? '', $query );
        $id = $host === 'youtu.be' ? trim( $path, '/' ) : ( $query['v'] ?? '' );
        if ( preg_match( '~^/(?:shorts|embed)/([A-Za-z0-9_-]{11})~', $path, $match ) ) { $id = $match[1]; }
        if ( is_string( $id ) && preg_match( '/^[A-Za-z0-9_-]{11}$/', $id ) ) { $src = 'https://www.youtube-nocookie.com/embed/' . $id; }
    } elseif ( in_array( $host, array( 'vimeo.com', 'www.vimeo.com', 'player.vimeo.com' ), true ) && preg_match( '~/(?:video/)?([0-9]+)$~', $path, $match ) ) {
        $src = 'https://player.vimeo.com/video/' . $match[1];
    }
    if ( $src ) {
        echo '<div class="video-consent"><p>' . esc_html__( 'تشغيل الفيديو يفتح اتصالًا بخدمة الفيديو الخارجية.', 'sada-clips' ) . '</p><button class="button load-video" data-src="' . esc_url( $src ) . '" data-title="' . esc_attr( get_the_title() ) . '">' . esc_html__( 'تشغيل الفيديو', 'sada-clips' ) . '</button></div>';
    } elseif ( preg_match( '/\.(mp4|webm|ogv)$/i', $path ) ) {
        echo '<video controls preload="none" aria-label="' . esc_attr( get_the_title() ) . '"><source src="' . esc_url( $url ) . '"><a href="' . esc_url( $url ) . '">' . esc_html__( 'فتح ملف الفيديو', 'sada-clips' ) . '</a></video>';
    } else {
        echo '<a class="button button-outline" href="' . esc_url( $url ) . '" rel="noopener noreferrer">' . esc_html__( 'فتح رابط الفيديو', 'sada-clips' ) . '</a>';
    }
}
