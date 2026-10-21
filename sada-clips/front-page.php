<?php get_header(); ?>
<main id="main">
<section class="hero" aria-labelledby="hero-title"><div class="hero-art" aria-hidden="true"></div><div class="container hero-content">
<h1 id="hero-title"><?php echo esc_html( sada_client_text( 'hero_title' ) ); ?></h1>
</div></section>
<?php $sada_intro = sada_client_text( 'intro' ); if ( $sada_intro !== '' ) : ?>
<div class="container"><aside class="intro-card" id="intro" aria-label="<?php echo esc_attr( sada_client_text( 'hero_title' ) ); ?>"><div class="intro-mark" aria-hidden="true"><?php echo sada_icon( 'book' ); ?></div><div><p class="client-copy"><?php echo esc_html( $sada_intro ); ?></p></div><a class="button button-outline" href="#services"><?php echo esc_html( sada_client_text( 'nav_services' ) ); ?><span aria-hidden="true">←</span></a></aside></div>
<?php endif; ?>
<section class="content-section" id="why" aria-labelledby="title-why"><div class="container">
<?php sada_client_heading( 'why', 'question' ); ?>
<?php foreach ( array( 'problem' => 'warning', 'hope' => 'lamp', 'solution' => 'key' ) as $sada_group => $sada_icon ) : ?>
<div class="client-reason-group"><h3 class="client-pill"><?php echo sada_client_icon( $sada_icon ); ?><span><?php echo esc_html( sada_client_text( $sada_group . '_label' ) ); ?></span></h3><div class="card-grid client-pair">
<?php for ( $sada_i = 1; $sada_i <= 2; $sada_i++ ) { get_template_part( 'template-parts/card', 'client', array( 'title' => sada_client_text( $sada_group . '_' . $sada_i . '_title' ), 'text' => sada_client_text( $sada_group . '_' . $sada_i . '_text' ) ) ); } ?>
</div></div><?php endforeach; ?>
</div></section>
<section class="content-section" id="services" aria-labelledby="title-services"><div class="container">
<?php sada_client_heading( 'services', 'document-search' ); ?><div class="card-grid">
<?php foreach ( array( 'document-search', 'film', 'text-bubble', 'network', 'chart' ) as $sada_i => $sada_icon ) { $sada_key = 'service_' . ( $sada_i + 1 ); get_template_part( 'template-parts/card', 'client', array( 'title' => sada_client_text( $sada_key . '_title' ), 'text' => sada_client_text( $sada_key . '_text' ), 'number' => $sada_i + 1, 'icon' => $sada_icon, 'pill' => true ) ); } ?>
</div></div></section>
<section class="content-section" id="benefits" aria-labelledby="title-benefits"><div class="container">
<?php sada_client_heading( 'benefits', 'shield' ); ?><div class="client-benefits"><div class="card-grid">
<?php foreach ( array( 'shield', 'star', 'megaphone', 'book-crescent' ) as $sada_i => $sada_icon ) { $sada_key = 'benefit_' . ( $sada_i + 1 ); get_template_part( 'template-parts/card', 'client', array( 'title' => sada_client_text( $sada_key . '_title' ), 'text' => sada_client_text( $sada_key . '_text' ), 'icon' => $sada_icon ) ); } ?>
</div></div></div></section>
<section class="content-section client-partnership" id="partnership" aria-labelledby="title-partnership"><div class="container">
<?php sada_client_heading( 'partnership', 'heart-hands' ); ?><p class="eyebrow client-copy"><?php echo esc_html( sada_client_text( 'partnership_subline' ) ); ?></p>
<?php foreach ( array( 'heart-hands', 'infinity', 'coin' ) as $sada_i => $sada_icon ) : $sada_text = sada_client_text( 'partnership_' . ( $sada_i + 1 ) ); if ( $sada_text === '' ) { continue; } ?>
<p class="client-statement"><?php echo sada_client_icon( $sada_icon ); ?><span class="client-copy"><?php echo esc_html( $sada_text ); ?></span></p>
<?php endforeach; ?>
</div></section>
<section class="content-section" id="contact" aria-label="<?php echo esc_attr( sada_client_text( 'nav_contact' ) ); ?>"><div class="container">
<article class="card client-closing"><div class="card-body"><p class="client-copy"><?php echo esc_html( sada_client_text( 'closing' ) ); ?></p></div></article>
<div class="client-contact-action"><?php sada_whatsapp_button(); ?></div>
</div></section>
</main><?php get_footer(); ?>
