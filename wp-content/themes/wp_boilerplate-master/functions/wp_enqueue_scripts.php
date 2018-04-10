<?php

	function dl_enqueue_scripts() {
		$theme_data = wp_get_theme();

		/* Register Scripts */
		wp_register_script('flickity', get_theme_file_uri('/assets/js/lib/flickity.pkgd.js'), array('jquery-migrate'), '2.1.0', true);
		wp_register_script('bootstrap', get_theme_file_uri('/assets/js/lib/bootstrap.js'), array('jquery-migrate'), null, true);
		wp_register_script('mainJS', get_theme_file_uri('/assets/js/functions.js'), array('jquery-migrate', 'bootstrap'), $theme_data->get( 'Version' ), true);

		/* Enqueue Scripts */
		wp_enqueue_script('flickity');
		wp_enqueue_script('mainJS');
		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU&sensor=false');
  	wp_enqueue_script('google-jsapi','https://www.google.com/jsapi');
	}

	add_action( 'wp_enqueue_scripts', 'dl_enqueue_scripts' );
?>
