<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<footer class="site-footer"><div class="container footer-grid"><div><?php sada_brand(); ?><p><?php echo esc_html( get_theme_mod( 'sada_footer', __( 'مساحة عربية للمعرفة والتأمل، نقترب فيها من المعنى بخطوات هادئة.', 'sada-clips' ) ) ); ?></p>
<div class="social-links"><?php foreach ( array( 'youtube' => __( 'يوتيوب', 'sada-clips' ), 'telegram' => __( 'تلغرام', 'sada-clips' ), 'instagram' => __( 'إنستغرام', 'sada-clips' ) ) as $network => $label ) { $url = get_theme_mod( 'sada_social_' . $network ); if ( $url ) { echo '<a href="' . esc_url( $url ) . '" rel="me">' . esc_html( $label ) . '</a>'; } } ?></div></div>
<div><h2><?php esc_html_e( 'روابط سريعة', 'sada-clips' ); ?></h2><nav aria-label="<?php esc_attr_e( 'روابط التذييل', 'sada-clips' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => 'sada_fallback_menu', 'depth' => 1 ) ); ?></nav></div>
<div><h2><?php esc_html_e( 'البحث', 'sada-clips' ); ?></h2><?php get_search_form(); ?></div></div>
<div class="container copyright"><?php echo esc_html( wp_date( 'Y' ) ); ?> · <?php esc_html_e( 'صدى كليبز — مساحة للمعنى', 'sada-clips' ); ?></div></footer>
<?php wp_footer(); ?></body></html>
