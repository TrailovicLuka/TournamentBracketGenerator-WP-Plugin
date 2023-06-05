<?php

// add_action( 'admin_init','tournament_options' );
// add_action('admin_init','tournament_settings');

use Tournament\Model\DB\TournamentDB;

add_action( "admin_menu", "add_tournament_page" );

include_once(__DIR__ . '/inc/settings-page.php');
include_once(__DIR__ . '/inc/preview-page.php');

//Settings pages
function add_tournament_page(): void {
	
	add_menu_page(
		__( "Set Tournament" ),
		__( "Set Tournament" ),
		"manage_options",
		"tournament-settings",
		"tournament_settings_callback",
		"dashicons-networking",
		100
	);
	
    add_submenu_page(
		            NULL,
        __('Preview Page'),
        __('Preview Page'),
        "manage_options",
        "tournament-preview",
        'tournament_preview_callback',
	);
}
