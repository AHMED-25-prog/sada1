<?php get_header(); ?>
<main id="main">
<section class="hero" aria-labelledby="hero-title"><div class="hero-art" aria-hidden="true"></div><div class="container hero-content">
<p class="eyebrow"><?php esc_html_e( 'معرفة تُنير القلب', 'sada-clips' ); ?></p>
<h1 id="hero-title"><?php echo esc_html( get_theme_mod( 'sada_hero_title', __( 'صدى كليبز', 'sada-clips' ) ) ); ?></h1>
<p class="hero-tagline"><?php echo esc_html( get_theme_mod( 'sada_tagline', __( 'من لحظة تأمّل، يبدأ أثرٌ يبقى.', 'sada-clips' ) ) ); ?></p>
</div></section>
<?php
// Keep this query local to the floating card; the section queries below are unchanged.
$sada_intro_args = array(
    'post_type'           => 'reflection',
    'post_status'         => 'publish',
    'posts_per_page'      => 5,
    'orderby'            => array( 'date' => 'DESC', 'ID' => 'DESC' ),
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
    'has_password'       => false,
);
$sada_intro_query = new WP_Query( $sada_intro_args );
if ( ! $sada_intro_query->have_posts() ) {
    $sada_intro_args['post_type'] = 'post';
    $sada_intro_query = new WP_Query( $sada_intro_args );
}
$sada_intro_slides = array();
while ( $sada_intro_query->have_posts() ) {
    $sada_intro_query->the_post();
    $sada_intro_slides[] = array(
        'subtitle' => __( 'أهلًا بك في مساحة المعنى', 'sada-clips' ),
        'title'    => get_the_title(),
        'text'     => wp_trim_words( wp_strip_all_tags( get_the_excerpt(), true ), 28, '…' ),
        'url'      => get_permalink(),
    );
}
wp_reset_postdata();
$sada_intro_has_posts = ! empty( $sada_intro_slides );
if ( ! $sada_intro_has_posts ) {
    $sada_intro_slides[] = array(
        'subtitle' => __( 'أهلًا بك في مساحة المعنى', 'sada-clips' ),
        'title'    => __( 'خطوة هادئة نحو معرفة أعمق', 'sada-clips' ),
        'text'     => get_theme_mod( 'sada_intro', __( 'مقاطع قصيرة، وقراءات وتأملات تجمع نور المعرفة وجمال السؤال، في مساحة عربية قريبة منك.', 'sada-clips' ) ),
        'url'      => get_theme_mod( 'sada_intro_url', home_url( '/#quran' ) ),
    );
}
?>
<div class="container">
<aside class="intro-card" id="intro" aria-labelledby="intro-title">
    <div class="intro-mark" aria-hidden="true"><?php echo sada_icon( 'book' ); ?></div>
    <div class="intro-carousel" aria-live="off">
        <?php foreach ( $sada_intro_slides as $sada_intro_index => $sada_intro_slide ) : ?>
        <div class="intro-slide<?php echo $sada_intro_index === 0 ? ' is-active' : ''; ?>" data-url="<?php echo esc_url( $sada_intro_slide['url'] ); ?>"<?php if ( $sada_intro_index !== 0 ) : ?> aria-hidden="true" inert<?php endif; ?>>
            <p class="eyebrow"><?php echo esc_html( $sada_intro_slide['subtitle'] ); ?></p>
            <h2<?php if ( $sada_intro_index === 0 ) : ?> id="intro-title"<?php endif; ?>><?php echo esc_html( $sada_intro_slide['title'] ); ?></h2>
            <p><?php echo esc_html( $sada_intro_slide['text'] ); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <a class="button button-outline" data-intro-link href="<?php echo esc_url( $sada_intro_slides[0]['url'] ); ?>"><?php $sada_intro_has_posts ? esc_html_e( 'قراءة المزيد', 'sada-clips' ) : esc_html_e( 'اكتشف المنصة', 'sada-clips' ); ?><span aria-hidden="true">←</span></a>
</aside>
<style>
/* Internal slides share one grid cell, reserving the tallest slide at every width.
   The existing .intro-card and .intro-mark rules remain untouched. */
#intro .intro-carousel {
    display: grid;
    min-inline-size: 0;
}
#intro .intro-slide {
    grid-area: 1 / 1;
    min-inline-size: 0;
    overflow-wrap: anywhere;
    visibility: hidden;
    opacity: 0;
    transition: opacity 400ms ease, visibility 0s 400ms;
}
#intro .intro-slide.is-active {
    visibility: visible;
    opacity: 1;
    transition-delay: 0s;
}
@media (prefers-reduced-motion: reduce) {
    #intro .intro-slide { transition: none; }
}
</style>
<script>
(() => {
    'use strict';
    const card = document.getElementById('intro');
    const slides = card ? [...card.querySelectorAll('.intro-slide')] : [];
    const link = card?.querySelector('[data-intro-link]');
    if (slides.length < 2 || !link) return;
    let index = 0;
    // Rotation intentionally continues on hover and focus. No motion for reduced-motion users.
    window.setInterval(() => {
        const previous = slides[index];
        previous.classList.remove('is-active');
        previous.setAttribute('aria-hidden', 'true');
        previous.inert = true;
        previous.querySelector('h2').removeAttribute('id');
        index = (index + 1) % slides.length;
        const next = slides[index];
        next.removeAttribute('aria-hidden');
        next.inert = false;
        next.querySelector('h2').id = 'intro-title';
        next.classList.add('is-active');
        link.href = next.dataset.url;
    }, 4500);
})();
</script>
</div>
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
