<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'admin_menu', function () {
    add_theme_page( __( 'المحتوى التجريبي', 'sada-clips' ), __( 'محتوى صدى التجريبي', 'sada-clips' ), 'manage_options', 'sada-samples', 'sada_samples_page' );
} );
function sada_samples_page() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }
    ?><div class="wrap" dir="rtl"><h1><?php esc_html_e( 'المحتوى التجريبي لصدى كليبز', 'sada-clips' ); ?></h1>
    <p><?php esc_html_e( 'يضيف هذا الزر مقالات وتأملات وكتبًا وبرامج ومقاطع تجريبية منشورة وصفحة تعريفية. لا يضيف فيديوهات أو أشخاصًا حقيقيين ولا يغيّر محتواك الموجود. يمكن تكراره دون إنشاء نسخ إضافية. لن يستبدل القوائم المعيّنة.', 'sada-clips' ); ?></p>
    <?php if ( isset( $_GET['sada_created'] ) ) : ?><div class="notice notice-success"><p><?php esc_html_e( 'اكتمل إنشاء المحتوى التجريبي. افتح الصفحة الرئيسية لمعاينته.', 'sada-clips' ); ?></p></div><?php endif; ?>
    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"><input type="hidden" name="action" value="sada_create_samples"><?php wp_nonce_field( 'sada_create_samples' ); submit_button( __( 'إنشاء المحتوى التجريبي', 'sada-clips' ) ); ?></form></div><?php
}
add_action( 'admin_post_sada_create_samples', function () {
    if ( ! current_user_can( 'manage_options' ) ) { wp_die( esc_html__( 'ليس لديك الإذن.', 'sada-clips' ) ); }
    check_admin_referer( 'sada_create_samples' );
    $result = sada_create_samples();
    if ( is_wp_error( $result ) ) { wp_die( esc_html( $result->get_error_message() ) ); }
    wp_safe_redirect( admin_url( 'themes.php?page=sada-samples&sada_created=1' ) ); exit;
} );
/** Only invoked explicitly by an administrator, WP-CLI, or a demo blueprint. */
function sada_create_samples() {
    $sections = sada_sections(); $categories = array();
    foreach ( $sections as $section ) {
        if ( empty( $section['category'] ) ) { continue; }
        $term = get_term_by( 'slug', $section['category'], 'category' );
        if ( ! $term ) {
            $created = wp_insert_term( $section['title'], 'category', array( 'slug' => $section['category'] ) );
            if ( is_wp_error( $created ) ) { return $created; }
            $categories[ $section['category'] ] = $created['term_id'];
        } else { $categories[ $section['category'] ] = $term->term_id; }
    }
    $titles = array(
        'quran' => array( __( 'حين تصبح القراءة صحبة', 'sada-clips' ), __( 'معنى نهتدي به في يومنا', 'sada-clips' ), __( 'مساحة للسؤال والتدبر', 'sada-clips' ), __( 'الإنصات قبل الجواب', 'sada-clips' ) ),
        'readings' => array( __( 'رحلة إلى المعنى', 'sada-clips' ), __( 'نور يتسع للجميع', 'sada-clips' ), __( 'على مهل مع الكلمات', 'sada-clips' ), __( 'بين القراءة والعمل', 'sada-clips' ) ),
        'wall' => array( __( 'فسحة هادئة', 'sada-clips' ), __( 'أثر كلمة طيبة', 'sada-clips' ), __( 'رفق في الطريق', 'sada-clips' ), __( 'لنترك باب السؤال مفتوحًا', 'sada-clips' ) ),
        'reflections' => array( __( 'ما الذي تعلّمنا إياه البدايات؟', 'sada-clips' ), __( 'امتنان للأشياء الصغيرة', 'sada-clips' ), __( 'نقرأ لنرى أبعد', 'sada-clips' ), __( 'السكينة في بساطة اليوم', 'sada-clips' ) ),
        'books' => array( __( 'دفتر التأمل', 'sada-clips' ), __( 'على ضفاف المعرفة', 'sada-clips' ), __( 'خطوات نحو المعنى', 'sada-clips' ), __( 'رسائل من القراءة', 'sada-clips' ) ),
        'programs' => array( __( 'نوافذ للتدبر', 'sada-clips' ), __( 'رحلة سؤال', 'sada-clips' ), __( 'معاني قريبة', 'sada-clips' ), __( 'مجالس القراءة', 'sada-clips' ) ),
    );
    $excerpts = array(
        __( 'تأمّل تجريبي: نمنح الكلمات وقتًا لتستقر في القلب، ثم نسأل كيف نحمل معناها إلى تفاصيل يومنا. ليست العجلة طريقًا للفهم؛ لكل فكرة مساحة تنمو فيها.', 'sada-clips' ),
        __( 'قراءة تجريبية: قد تفتح كلمة بسيطة نافذة جديدة. ننصت للمعنى برفق، ونتعلم أن نرى ما حولنا بعين أكثر انتباهًا ورحمة.', 'sada-clips' ),
        __( 'نص تجريبي: المعرفة صحبة تبدأ بسؤال صادق. ندوّن ما تعلمناه، ونترك مكانًا لما لم نفهمه بعد، ونعود إلى القراءة بقلب حاضر.', 'sada-clips' ),
        __( 'مادة تجريبية: في هدوء اليوم فرصة لنراجع علاقتنا بالوقت والكلمات. نقرأ قليلًا، ونتأمل بعمق، ونختار فعلًا طيبًا يحمل أثر ما قرأناه.', 'sada-clips' ),
    );
    $illustrations = array( 'dunes', 'book', 'arch', 'palm' ); $programs = array();
    foreach ( $titles as $key => $group ) {
        foreach ( $group as $i => $title ) {
            $slug = 'sada-demo-' . $key . '-' . $i;
            $existing = get_posts( array( 'post_type' => $sections[ $key ]['type'], 'post_status' => 'any', 'meta_key' => '_sada_sample_key', 'meta_value' => $slug, 'numberposts' => 1 ) );
            if ( $existing ) { if ( $key === 'programs' ) { $programs[] = $existing[0]->ID; } continue; }
            $content = '<p>' . esc_html( $excerpts[ $i ] ) . '</p><h2>' . esc_html__( 'مساحة للتأمل', 'sada-clips' ) . '</h2><p>' . esc_html__( 'هذه مادة تجريبية وليست كتابًا منشورًا أو درسًا منسوبًا إلى شخص. استبدلها بمحتواك من لوحة التحكم. يمكن أن تبدأ بسؤال، ثم تكتب فكرة واضحة وتختم بما تدعو القارئ إلى التفكير فيه.', 'sada-clips' ) . '</p><blockquote><p>' . esc_html__( 'ماذا يتغيّر في يومنا حين نصغي أكثر، ونتأنّى في أحكامنا؟', 'sada-clips' ) . '</p></blockquote>';
            $post = array( 'post_type' => $sections[ $key ]['type'], 'post_status' => 'publish', 'post_title' => $title . ' — ' . __( 'تجريبي', 'sada-clips' ), 'post_name' => $slug, 'post_content' => $content, 'post_excerpt' => $excerpts[ $i ], 'meta_input' => array( '_sada_sample' => '1', '_sada_sample_key' => $slug, '_sada_credit' => __( 'فريق صدى كليبز — تجريبي', 'sada-clips' ), '_sada_speaker' => __( 'فريق صدى كليبز — تجريبي', 'sada-clips' ), '_sada_illustration' => $key === 'books' ? 'book-cover' : ( $key === 'programs' ? array( 'dome', 'lantern', 'crescent', 'palm' )[ $i ] : $illustrations[ $i ] ) ) );
            if ( isset( $sections[ $key ]['category'] ) ) { $post['post_category'] = array( $categories[ $sections[ $key ]['category'] ] ); }
            $id = wp_insert_post( $post, true );
            if ( is_wp_error( $id ) ) { return $id; }
            if ( $key === 'programs' ) { $programs[] = $id; }
        }
    }
    foreach ( $programs as $i => $program_id ) {
        $slug = 'sada-demo-clip-' . $i;
        if ( get_posts( array( 'post_type' => 'clip', 'post_status' => 'any', 'meta_key' => '_sada_sample_key', 'meta_value' => $slug, 'numberposts' => 1 ) ) ) { continue; }
        $id = wp_insert_post( array( 'post_type' => 'clip', 'post_status' => 'publish', 'post_name' => $slug, 'post_title' => sprintf( __( 'وقفة مع المعنى — مقطع تجريبي %s', 'sada-clips' ), $i + 1 ), 'post_content' => '<p>' . esc_html__( 'مقطع تجريبي بلا ملف فيديو. أضف رابط فيديو تملكه من صندوق بيانات صدى كليبز. الرقم في العنوان لترتيب العينات فقط.', 'sada-clips' ) . '</p>', 'post_excerpt' => $excerpts[ $i ], 'meta_input' => array( '_sada_sample' => '1', '_sada_sample_key' => $slug, '_sada_speaker' => __( 'فريق صدى كليبز — تجريبي', 'sada-clips' ), '_sada_program_id' => $program_id, '_sada_illustration' => $illustrations[ $i ] ) ), true );
        if ( is_wp_error( $id ) ) { return $id; }
    }
    $about = get_page_by_path( 'about-sada' );
    if ( ! $about ) {
        $about_id = wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_name' => 'about-sada', 'post_title' => __( 'السيرة الذاتية', 'sada-clips' ), 'post_content' => '<h2>' . esc_html__( 'عن صدى كليبز — تعريف تجريبي', 'sada-clips' ) . '</h2><p>' . esc_html__( 'صدى كليبز مساحة عربية للمقاطع والتأملات والقراءة. هذه صفحة تعريفية بالمنصة وليست سيرة لشخص حقيقي. يمكنك تعديلها لتكتب قصة مشروعك وأهدافه.', 'sada-clips' ) . '</p>', 'meta_input' => array( '_sada_sample' => '1', '_sada_sample_key' => 'about' ) ), true );
        if ( is_wp_error( $about_id ) ) { return $about_id; }
    } else { $about_id = $about->ID; }
    $locations = get_theme_mod( 'nav_menu_locations', array() );
    foreach ( array( 'primary', 'footer' ) as $location ) {
        if ( ! empty( $locations[ $location ] ) ) { continue; }
        $name = $location === 'primary' ? __( 'صدى — قائمة تجريبية رئيسية', 'sada-clips' ) : __( 'صدى — قائمة تجريبية للتذييل', 'sada-clips' );
        $menu = wp_get_nav_menu_object( $name ); $menu_id = $menu ? $menu->term_id : wp_create_nav_menu( $name );
        if ( is_wp_error( $menu_id ) ) { return $menu_id; }
        if ( ! wp_get_nav_menu_items( $menu_id ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => __( 'الرئيسية', 'sada-clips' ), 'menu-item-url' => home_url( '/' ), 'menu-item-status' => 'publish' ) );
            wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => __( 'السيرة الذاتية', 'sada-clips' ), 'menu-item-object' => 'page', 'menu-item-object-id' => $about_id, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
            foreach ( $sections as $key => $section ) {
                wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => $section['title'], 'menu-item-url' => home_url( '/#' . $key ), 'menu-item-status' => 'publish' ) );
            }
        }
        $locations[ $location ] = $menu_id;
    }
    set_theme_mod( 'nav_menu_locations', $locations );
    return true;
}
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'sada sample', function () { $result = sada_create_samples(); if ( is_wp_error( $result ) ) { WP_CLI::error( $result->get_error_message() ); } WP_CLI::success( __( 'اكتمل إنشاء المحتوى التجريبي.', 'sada-clips' ) ); } );
}
