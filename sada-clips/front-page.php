<?php get_header(); ?>
<main id="main">
<section class="hero" aria-labelledby="hero-title"><div class="hero-art" aria-hidden="true"></div><div class="container hero-content">
<p class="eyebrow"><?php esc_html_e( 'معرفة تُنير القلب', 'sada-clips' ); ?></p>
<h1 id="hero-title"><?php echo esc_html( get_theme_mod( 'sada_hero_title', __( 'صدى كليبز', 'sada-clips' ) ) ); ?></h1>
<p class="hero-tagline"><?php echo esc_html( get_theme_mod( 'sada_tagline', __( 'من لحظة تأمّل، يبدأ أثرٌ يبقى.', 'sada-clips' ) ) ); ?></p>
</div></section>
<div class="container"><aside class="intro-card" id="intro" aria-labelledby="intro-title"><div class="intro-mark" aria-hidden="true"><?php echo sada_icon( 'book' ); ?></div><div><p class="eyebrow"><?php esc_html_e( 'أهلًا بك في مساحة المعنى', 'sada-clips' ); ?></p><h2 id="intro-title"><?php esc_html_e( 'خطوة هادئة نحو معرفة أعمق', 'sada-clips' ); ?></h2><p><?php echo esc_html( get_theme_mod( 'sada_intro', __( 'مقاطع قصيرة، وقراءات وتأملات تجمع نور المعرفة وجمال السؤال، في مساحة عربية قريبة منك.', 'sada-clips' ) ) ); ?></p></div><a class="button button-outline" href="<?php echo esc_url( get_theme_mod( 'sada_intro_url', home_url( '/#quran' ) ) ); ?>"><?php esc_html_e( 'اكتشف المنصة', 'sada-clips' ); ?><span aria-hidden="true">←</span></a></aside></div>
<?php foreach ( sada_sections() as $key => $section ) :
    $query_args = array( 'post_type' => $section['type'], 'posts_per_page' => 4, 'post_status' => 'publish', 'no_found_rows' => true, 'ignore_sticky_posts' => true );
    if ( isset( $section['category'] ) ) { $query_args['category_name'] = $section['category']; }
    $items = new WP_Query( $query_args ); ?>
<section class="content-section section-<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" aria-labelledby="title-<?php echo esc_attr( $key ); ?>"><div class="container">
<div class="section-heading"><div class="section-title"><span class="section-icon"><?php echo sada_icon( $section['icon'] ); ?></span><h2 id="title-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $section['title'] ); ?></h2></div><a class="button button-outline view-all" href="<?php echo esc_url( sada_section_url( $section ) ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'عرض الكل: %s', 'sada-clips' ), $section['title'] ) ); ?>"><?php esc_html_e( 'عرض الكل', 'sada-clips' ); ?><span aria-hidden="true">←</span></a></div>
<?php if ( $items->have_posts() ) : ?><div class="card-grid"><?php while ( $items->have_posts() ) : $items->the_post(); get_template_part( 'template-parts/card', $section['card'], $section ); endwhile; ?></div>
<?php else : ?><div class="empty-state"><p><?php esc_html_e( 'هنا تبدأ مساحة جديدة للمعرفة. سيظهر المحتوى عند نشره.', 'sada-clips' ); ?></p><?php if ( current_user_can( 'manage_options' ) ) : ?><a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=sada-samples' ) ); ?>"><?php esc_html_e( 'إضافة المحتوى التجريبي', 'sada-clips' ); ?></a><?php endif; ?></div><?php endif; wp_reset_postdata(); ?>
</div></section><?php endforeach; ?>
</main><?php get_footer(); ?>
