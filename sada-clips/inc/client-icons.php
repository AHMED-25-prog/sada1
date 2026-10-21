<?php
/** Original line icons for the client homepage, using the existing icon treatment. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function sada_client_icon( $name = 'star' ) {
    $paths = array(
        'question' => '<circle cx="12" cy="12" r="9"/><path d="M9 9a3 3 0 1 1 4.5 2.6c-1 .5-1.5 1-1.5 2.4M12 17h.01"/>',
        'warning' => '<path d="m12 3 10 18H2L12 3Zm0 6v5m0 3h.01"/>',
        'key' => '<circle cx="8" cy="8" r="5"/><path d="m11.5 11.5 9 9m-4-4 3-3m-6 0 3-3M6.5 6.5h.01"/>',
        'document-search' => '<path d="M13 21H4V3h11l4 4v4M15 3v5h4M7 7h4M7 11h5M7 15h3"/><circle cx="16" cy="16" r="4"/><path d="m19 19 3 3"/>',
        'film' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 3v18M17 3v18M3 8h4M3 16h4M17 8h4M17 16h4M7 12h10"/>',
        'text-bubble' => '<path d="M3 3h18v14H9l-6 5V3Zm5 5h8m-4 0v6m-2 0h4"/>',
        'network' => '<circle cx="12" cy="5" r="3"/><circle cx="5" cy="18" r="3"/><circle cx="19" cy="18" r="3"/><path d="M12 8v4m-7 3v-3h14v3"/>',
        'chart' => '<path d="M3 3v18h18M7 17v-5h3v5m3 0V8h3v9m3 0V4h3v13"/>',
        'shield' => '<path d="M12 2c3 2 6 3 9 3v7c0 5-5 8-9 10-4-2-9-5-9-10V5c3 0 6-1 9-3Zm-5 10 3 3 7-7"/>',
        'star' => '<path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8-6.2-3.2L5.8 21 7 14.2l-5-4.9 6.9-1L12 2Z"/>',
        'megaphone' => '<path d="m4 10 16-6v16L4 14v-4Zm4 6 2 6H6l-2-8M20 9l2-1m-2 8 2 1M4 10H2v4h2"/>',
        'book-crescent' => '<path d="M12 8C8 5 4 6 2 7v14c4-2 7-1 10 1 3-2 6-3 10-1V7c-2-1-6-2-10 1Zm0 0v14M5 10l4 1M15 13l4-1M15 17l4-1M16 2a3 3 0 1 0 4 3 3 3 0 0 1-4-3Z"/>',
        'heart-hands' => '<path d="M12 13 6.7 8.1a3 3 0 0 1 4.3-4.2l1 1 1-1a3 3 0 0 1 4.3 4.2L12 13ZM2 14l4 3 3-1 3 2 3-2 3 1 4-3M2 18l5 4h10l5-4M2 14v4m20-4v4"/>',
        'infinity' => '<path d="M12 12c-2-3-3-5-5.5-5a5 5 0 0 0 0 10c2.5 0 3.5-2 5.5-5Zm0 0c2-3 3-5 5.5-5a5 5 0 0 1 0 10c-2.5 0-3.5-2-5.5-5Z"/>',
        'coin' => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="6"/><path d="M14.5 8.5h-3a2 2 0 0 0 0 4h1a2 2 0 0 1 0 4h-3M12 7v2m0 7v2"/>',
        'lamp' => '<path d="M8 17c0-4-3-4-3-8a7 7 0 0 1 14 0c0 4-3 4-3 8ZM8 20h8M10 23h4"/>',
    );

    if ( ! isset( $paths[ $name ] ) ) { return sada_icon( 'star' ); }

    return '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths[ $name ] . '</svg>';
}
