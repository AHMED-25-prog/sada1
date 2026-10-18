<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class( 'sada-rtl' ); ?>><?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'انتقل إلى المحتوى', 'sada-clips' ); ?></a>
<header class="site-header" id="site-header"><div class="container header-inner">
<?php sada_brand(); ?>
<button class="icon-button menu-toggle" aria-controls="primary-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'فتح القائمة', 'sada-clips' ); ?>"><span aria-hidden="true">☰</span></button>
<nav id="primary-nav" aria-label="<?php esc_attr_e( 'التنقل الرئيسي', 'sada-clips' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'sada_fallback_menu', 'depth' => 2 ) ); ?></nav>
<button class="icon-button search-toggle" aria-haspopup="dialog" aria-controls="search-dialog" aria-label="<?php esc_attr_e( 'فتح البحث', 'sada-clips' ); ?>"><?php echo sada_icon( 'search' ); ?></button>
</div></header>
<dialog id="search-dialog" aria-labelledby="search-title"><button class="icon-button dialog-close" aria-label="<?php esc_attr_e( 'إغلاق البحث', 'sada-clips' ); ?>">×</button><h2 id="search-title"><?php esc_html_e( 'عمّ تبحث؟', 'sada-clips' ); ?></h2><?php get_search_form(); ?></dialog>
<div class="toast" role="status" aria-live="polite"></div>
