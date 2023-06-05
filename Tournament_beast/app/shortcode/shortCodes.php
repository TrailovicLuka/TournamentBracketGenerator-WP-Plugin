<?php 

add_shortcode( 'tournament', 'generateShortCode' );

function generateShortCode( $atts ) {
	$attributes = shortcode_atts( array(
		'id'		=> 	17,
		'background'=>	'',
		'sport'		=> 	'',
		'type'		=>	'',
	), $atts );
	
	ob_start();

	// get_template_part( PLUGIN_ROOT . '/view/template-parts/template', $attributes['sport']);
		include( PLUGIN_ROOT . 'app/view/template-parts/'. $attributes['sport'] .'/'. $attributes['type'].'.php' );
	
	return ob_get_clean();
}

?>