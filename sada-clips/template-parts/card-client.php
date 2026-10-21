<?php
/** Reuse the article-card structure for client copy; no share/read-more controls. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$title = $args['title'] ?? '';
$text = $args['text'] ?? '';
if ( $title === '' && $text === '' ) { return; }
?>
<article class="card article-card reveal"><div class="card-body">
<?php if ( ! empty( $args['number'] ) ) : ?><span class="client-service-number"><?php echo esc_html( $args['number'] ); ?></span><?php endif; ?>
<?php if ( ! empty( $args['icon'] ) ) : ?><span class="section-icon"><?php echo sada_client_icon( $args['icon'] ); ?></span><?php endif; ?>
<?php if ( $title !== '' ) : ?><h3<?php if ( ! empty( $args['pill'] ) ) : ?> class="client-pill"<?php endif; ?>><?php echo esc_html( $title ); ?></h3><?php endif; ?>
<div class="diamond-divider" aria-hidden="true"><span></span></div>
<?php if ( $text !== '' ) : ?><p class="excerpt client-copy"><?php echo esc_html( $text ); ?></p><?php endif; ?>
</div></article>
