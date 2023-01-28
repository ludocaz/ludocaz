<?php

// AUTO UPDATER
require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/ludocaz/ludocaz_theme/',
	__FILE__,
	'ludocaz_theme'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('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');

function ludocaz_supports () {
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'menus' );
}

function ludocaz_register_assets () {
  wp_register_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', );
  wp_register_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' );
  wp_enqueue_style( 'bootstrap' );
}

add_action( 'after_setup_theme',  'ludocaz_supports' );
add_action('wp_enqueue_scripts', 'ludocaz_register_assets');

function my_customizer_settings( $wp_customize ) {
  $wp_customize->add_setting( 'logo_upload' );
}
add_action( 'customize_register', 'my_customizer_settings' );

function my_customizer_controls( $wp_customize ) {
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
      'label'    => 'Logo du site',
      'section'  => 'title_tagline',
      'settings' => 'logo_upload',
  ) ) );
}
add_action( 'customize_register', 'my_customizer_controls' );