<?php

add_action('wp_enqueue_scripts','loadScripts');
add_action('admin_enqueue_scripts','loadScripts');
add_filter( 'script_loader_tag', 'add_id_to_script', 10, 3 );

function loadScripts(){
    wp_enqueue_style('main-style', plugin_dir_url( __DIR__ ) .'/assets/styles/css/main.css');
    wp_enqueue_style('bootstrap_css', "//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css");

    wp_enqueue_script('main-js', plugin_dir_url( __DIR__ ) . '/assets/js/index.js');
	wp_script_add_data( 'main-js', 'type','module' );
    wp_enqueue_script('font_awesome', "//kit.fontawesome.com/9e4949fd74.js");
    wp_enqueue_script('bootstrap_js', "//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js");

    wp_enqueue_style('font_Holtwood', "//fonts.googleapis.com/css?family=Holtwood+One+SC");
    wp_enqueue_style('font_Holtwood', "//fonts.googleapis.com/css?family=Kaushan+Script|Herr+Von+Muellerhoff");
    wp_enqueue_style('font_Holtwood', "//fonts.googleapis.com/css?family=Abel");
    wp_enqueue_style('font_Holtwood', "//fonts.googleapis.com/css?family=Istok+Web|Roboto+Condensed:700");

	wp_localize_script( 'main-js', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}

function add_id_to_script( $tag, $handle, $src ) {
    if ( 'main-js' === $handle ) {
        $tag = '<script type="module" src="' . esc_url( $src ).'"></script>';
    }

    return $tag;
}



?>