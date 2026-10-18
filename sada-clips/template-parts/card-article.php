<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<article <?php post_class( 'card article-card reveal' ); ?>>
<?php if ( ! empty( $args['image'] ) || has_category( 'readings' ) ) : ?><a class="card-media" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true"><?php sada_thumbnail( 'article' ); ?></a><?php endif; ?>
<div class="card-body"><span class="badge"><?php echo esc_html( $args['title'] ?? __( 'مقال', 'sada-clips' ) ); ?></span>
<div class="card-title-row"><h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3><?php sada_share(); ?></div><div class="diamond-divider" aria-hidden="true"><span></span></div>
<p class="excerpt"><?php sada_excerpt(); ?></p><a class="read-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'قراءة المزيد', 'sada-clips' ); ?> <span aria-hidden="true">←</span></a></div></article>
