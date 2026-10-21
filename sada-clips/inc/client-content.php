<?php
/** Client homepage copy. Verbatim client copy, editable without changing the design. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function sada_client_fields() {
    $fields = array(
        'hero_title' => array( 'label' => __( 'عنوان المقدمة', 'sada-clips' ), 'default' => __( 'مركز متخصص في إعداد وإدارة المحتوى الديني والخيري والفكري', 'sada-clips' ), 'group' => 'intro' ),
        'intro' => array( 'label' => __( 'النص الكامل للبطاقة التعريفية', 'sada-clips' ), 'default' => __( 'نُحوّل أرشيفكم العلمي، ودروسكم ومحاضراتكم إلى "كبسولات قيمية" يهتدي بها الناس، كما نعزز حضور المراكز العلمية والدعوية في الساحة الإعلامية وتسييل أرشيفها المقروءة والمرئية إلى مواد إعلامية تواكب خوارزميات الإعلام الحديث وتملأ هواتف أبنائنا نوراً وحكمة.', 'sada-clips' ), 'group' => 'intro', 'type' => 'textarea' ),
        'why_title' => array( 'label' => __( 'عنوان لماذا مركزنا', 'sada-clips' ), 'default' => __( 'لماذا مركزنا؟', 'sada-clips' ), 'group' => 'why' ),
        'services_title' => array( 'label' => __( 'عنوان الخدمات', 'sada-clips' ), 'default' => __( 'حزمة الخدمات', 'sada-clips' ), 'group' => 'services' ),
        'benefits_title' => array( 'label' => __( 'عنوان العوائد', 'sada-clips' ), 'default' => __( 'العوائد المتوقعة', 'sada-clips' ), 'group' => 'benefits' ),
        'partnership_title' => array( 'label' => __( 'عنوان الشراكة', 'sada-clips' ), 'default' => __( 'شراكة في الأجر والأثر', 'sada-clips' ), 'group' => 'partnership' ),
        'partnership_subline' => array( 'label' => __( 'العبارة أسفل عنوان الشراكة', 'sada-clips' ), 'default' => __( 'ونكتب ما قدّموا وآثارهم..', 'sada-clips' ), 'group' => 'partnership' ),
        'closing' => array( 'label' => __( 'نص بطاقة التواصل الختامية', 'sada-clips' ), 'default' => __( 'لا يلزم أن تكون عالِماً أو صاحب مركز تعليمي لتنشر الخير، بل يكفيك أن تتبنّى منصة أحد العلماء أو المراكز العلمية وسنقوم بكل ما يلزم وموافاتك بالتقارير الشهرية', 'sada-clips' ), 'group' => 'contact', 'type' => 'textarea' ),
        'footer' => array( 'label' => __( 'وصف التذييل', 'sada-clips' ), 'default' => __( 'مركز متخصص في إعداد وإدارة المحتوى الديني والخيري والفكري', 'sada-clips' ), 'group' => 'contact', 'type' => 'textarea' ),
    );
    foreach ( array( 'problem' => __( 'المشكلة', 'sada-clips' ), 'hope' => __( 'الأمل', 'sada-clips' ), 'solution' => __( 'الحل', 'sada-clips' ) ) as $key => $label ) {
        $fields[ $key . '_label' ] = array( 'label' => sprintf( __( 'اسم المجموعة: %s', 'sada-clips' ), $label ), 'default' => $label, 'group' => 'why' );
        for ( $i = 1; $i <= 2; $i++ ) {
            $fields[ $key . '_' . $i . '_title' ] = array( 'label' => sprintf( __( '%1$s — عنوان البطاقة %2$d', 'sada-clips' ), $label, $i ), 'default' => '', 'group' => 'why' );
            $fields[ $key . '_' . $i . '_text' ] = array( 'label' => sprintf( __( '%1$s — نص البطاقة %2$d', 'sada-clips' ), $label, $i ), 'default' => '', 'group' => 'why', 'type' => 'textarea' );
        }
    }
    $services = array( __( 'البحث والاستخلاص', 'sada-clips' ), __( 'المونتاج الحديث', 'sada-clips' ), __( 'نصوص تفاعلية', 'sada-clips' ), __( 'إدارة المنصات', 'sada-clips' ), __( 'تحليل التفاعلات', 'sada-clips' ) );
    foreach ( $services as $i => $label ) {
        $key = 'service_' . ( $i + 1 );
        $fields[ $key . '_title' ] = array( 'label' => sprintf( __( 'عنوان الخدمة %d', 'sada-clips' ), $i + 1 ), 'default' => $label, 'group' => 'services' );
        $fields[ $key . '_text' ] = array( 'label' => sprintf( __( 'وصف الخدمة: %s', 'sada-clips' ), $label ), 'default' => '', 'group' => 'services', 'type' => 'textarea' );
    }
    $benefits = array( __( 'حماية عقول الناشئة', 'sada-clips' ), __( 'صناعة القدوة', 'sada-clips' ), __( 'تدعيم الخطاب المحلي', 'sada-clips' ), __( 'جيل يعتز بمرجعيته', 'sada-clips' ) );
    foreach ( $benefits as $i => $label ) {
        $key = 'benefit_' . ( $i + 1 );
        $fields[ $key . '_title' ] = array( 'label' => sprintf( __( 'عنوان العائد %d', 'sada-clips' ), $i + 1 ), 'default' => $label, 'group' => 'benefits' );
        $fields[ $key . '_text' ] = array( 'label' => sprintf( __( 'وصف العائد: %s', 'sada-clips' ), $label ), 'default' => '', 'group' => 'benefits', 'type' => 'textarea' );
    }
    for ( $i = 1; $i <= 3; $i++ ) {
        $fields[ 'partnership_' . $i ] = array( 'label' => sprintf( __( 'عبارة الشراكة %d', 'sada-clips' ), $i ), 'default' => '', 'group' => 'partnership', 'type' => 'textarea' );
    }
    foreach ( array( 'home' => __( 'الرئيسية', 'sada-clips' ), 'why' => __( 'لماذا مركزنا', 'sada-clips' ), 'services' => __( 'الخدمات', 'sada-clips' ), 'benefits' => __( 'العوائد', 'sada-clips' ), 'partnership' => __( 'الشراكة', 'sada-clips' ), 'contact' => __( 'تواصل معنا', 'sada-clips' ) ) as $key => $label ) {
        $fields[ 'nav_' . $key ] = array( 'label' => sprintf( __( 'رابط القائمة: %s', 'sada-clips' ), $label ), 'default' => $label, 'group' => 'navigation' );
    }
    $copy = array(
        'problem_1_text' => __( 'يعيش أبناؤنا يومياً وسط سيل من المقاطع المقتضبة التافهة التي تنخر المفاهيم والسلوك', 'sada-clips' ),
        'problem_2_text' => __( 'مراكز علمية لها عطاء مشكور لكن لديها ضعف في الساحة الإعلامية ومزاحمة الضخ الهابط في السوشيال ميديا', 'sada-clips' ),
        'hope_1_text' => __( 'حضور رقمي فاعل ومؤثر للعلماء الراسخين، يقود وعي الجيل الجديد ويحميه من المحتوى التافه', 'sada-clips' ),
        'hope_2_text' => __( 'أن تتصدر المراكز العلمية والفكرية منصات الإعلام الحديث بقوة وتوصل الخير والهُدى والحكمة إلى هواتف الناشئة', 'sada-clips' ),
        'solution_1_text' => __( 'استخلاص "زبدة أفكاركم" وعصارة تجاربكم وتقديمها في قوالب عصرية مركزة تملأ هواتف الشباب نوراً وحكمة', 'sada-clips' ),
        'solution_2_text' => __( 'إنتاج إعلامي مدروس ومكثف يستخرج مكامن الحكمة من المواعظ والدروس العلمية في كبسولات مفاهيمية قصيرة', 'sada-clips' ),
        'service_1_text' => __( 'مراجعة دروسكم ومحاضراتكم المسجلة لاستخراج أقوى "الكبسولات القيمية" (30 - 90 ثانية)', 'sada-clips' ),
        'service_2_text' => __( 'قص المقاطع بأسلوب احترافي يركز على الفكرة الجوهرية ولغة الجسد', 'sada-clips' ),
        'service_3_text' => __( 'إضافة العناوين والنصوص المكتوبة على الفيديو لضمان وضوح الفكرة ومتابعة المشاهد (خاصة في وضع الصامت)', 'sada-clips' ),
        'service_4_text' => __( 'نشر المقاطع على جميع حساباتكم في وسائل التواصل لضمان أعلى معدل انتشار', 'sada-clips' ),
        'service_5_text' => __( 'نقوم بقياس تفاعل الجمهور مع الأطروحات العلمية والفكرية لضمان عمق الأثر، مع ضبط الإعدادات التقنية للحسابات لتتوافق مع خوارزميات المنصات، مستخلصين الملحوظات من سلوك المتابعين لتوجيه المحتوى القادم وتوسيع نطاق التأثير المعرفي', 'sada-clips' ),
        'benefit_1_text' => __( 'التصدي الاستباقي للظواهر السلبية والأفكار المنحرفة عبر رسائل محكمة', 'sada-clips' ),
        'benefit_2_text' => __( 'ربط الجيل الناشئ برموزهم الوطنية الراسخة بدلاً من التبعية لـ "العولمة الرقمية"', 'sada-clips' ),
        'benefit_3_text' => __( 'تقديم خطابكم المتزن كبديل للخطابات الواردة المتطرفة أو المتساهلة', 'sada-clips' ),
        'benefit_4_text' => __( 'بناء صورة ذهنية بأن علماء البلد لديهم بصمتهم الخاصة في حراسة القيم وتوجيه الناشئة', 'sada-clips' ),
        'partnership_1' => __( 'معاً نُحوّل الخير الحبيس إلى هداية بارزة، وآثار مُستدامة تُدر الأجور على أصحابها', 'sada-clips' ),
        'partnership_2' => __( 'استدامة النشر حتى بعد الوفاة، نسأل الله طول العمر وحسن العمل', 'sada-clips' ),
        'partnership_3' => __( 'كل ذلك مقابل مبلغ رمزي (يتم الاتفاق عليه بحسب باقات الإنتاج) لتغطية التكاليف التشغيلية، لنضمن لكم حضوراً رقمياً يليق بمكانتكم', 'sada-clips' ),
    );
    foreach ( $copy as $key => $text ) { $fields[ $key ]['default'] = $text; }
    return $fields;
}
function sada_client_text( $key ) {
    $fields = sada_client_fields();
    if ( ! isset( $fields[ $key ] ) ) { return ''; }
    return get_theme_mod( 'sada_client_' . $key, $fields[ $key ]['default'] );
}
add_action( 'customize_register', function ( $customizer ) {
    $customizer->add_panel( 'sada_client', array( 'title' => __( 'محتوى المركز', 'sada-clips' ), 'priority' => 25, 'description' => __( 'عدّل نصوص المركز هنا. عناوين بطاقات المشكلة والأمل والحل اختيارية؛ النصوص الأصلية تظهر دون إعادة صياغة.', 'sada-clips' ) ) );
    foreach ( array( 'intro' => __( 'المقدمة والبطاقة التعريفية', 'sada-clips' ), 'why' => __( 'لماذا مركزنا', 'sada-clips' ), 'services' => __( 'حزمة الخدمات', 'sada-clips' ), 'benefits' => __( 'العوائد المتوقعة', 'sada-clips' ), 'partnership' => __( 'شراكة في الأجر والأثر', 'sada-clips' ), 'contact' => __( 'الختام والتذييل', 'sada-clips' ), 'navigation' => __( 'تسميات التنقل', 'sada-clips' ) ) as $key => $label ) {
        $customizer->add_section( 'sada_client_' . $key, array( 'title' => $label, 'panel' => 'sada_client' ) );
    }
    foreach ( sada_client_fields() as $key => $field ) {
        $id = 'sada_client_' . $key;
        $type = $field['type'] ?? 'text';
        $customizer->add_setting( $id, array( 'default' => $field['default'], 'sanitize_callback' => $type === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field', 'transport' => 'refresh' ) );
        $customizer->add_control( $id, array( 'label' => $field['label'], 'section' => 'sada_client_' . $field['group'], 'type' => $type ) );
    }
    // Retain social/link controls; superseded sample copy must not override client copy.
    foreach ( array( 'sada_hero_title', 'sada_tagline', 'sada_intro', 'sada_intro_url', 'sada_footer' ) as $id ) { $customizer->remove_control( $id ); }
}, 20 );
function sada_client_navigation() {
    $items = '';
    foreach ( array( 'home' => 'main', 'why' => 'why', 'services' => 'services', 'benefits' => 'benefits', 'partnership' => 'partnership', 'contact' => 'contact' ) as $key => $anchor ) {
        $items .= '<li><a href="' . esc_url( home_url( '/#' . $anchor ) ) . '">' . esc_html( sada_client_text( 'nav_' . $key ) ) . '</a></li>';
    }
    return $items;
}
// Preserve existing menu records while displaying the required client anchor navigation.
add_filter( 'wp_nav_menu_items', function ( $items, $args ) {
    return in_array( $args->theme_location ?? '', array( 'primary', 'footer' ), true ) ? sada_client_navigation() : $items;
}, 10, 2 );
function sada_client_heading( $key, $icon ) {
    echo '<div class="section-heading"><div class="section-title"><span class="section-icon">' . sada_client_icon( $icon ) . '</span><h2 id="title-' . esc_attr( $key ) . '">' . esc_html( sada_client_text( $key . '_title' ) ) . '</h2></div></div>';
}
