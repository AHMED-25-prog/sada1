<?php if ( ! defined( 'ABSPATH' ) ) { exit; } $sada_id = wp_unique_id( 'sada-search-' ); ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<label class="screen-reader-text" for="<?php echo esc_attr( $sada_id ); ?>"><?php esc_html_e( 'كلمة البحث', 'sada-clips' ); ?></label>
<input id="<?php echo esc_attr( $sada_id ); ?>" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'كلمة البحث…', 'sada-clips' ); ?>" required>
<button class="button" type="submit"><?php esc_html_e( 'بحث', 'sada-clips' ); ?></button></form>
