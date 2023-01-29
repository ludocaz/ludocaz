<?php

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

function check_and_update_theme() {
  // URL de l'API GitHub pour votre dépôt de thème
  $api_url = 'https://api.github.com/repos/ludocaz/ludocaz_theme/releases/latest';

  // Récupération des données de l'API GitHub
  $response = wp_remote_get( $api_url );

  // Vérification de la réponse de l'API
  if( ! is_wp_error( $response ) ) {
      $body = json_decode( $response['body'] );

      // Vérification de la version de la dernière publication
      if( version_compare( $body->tag_name, wp_get_theme()->get( 'Version' ), '>' ) ) {

          // Vérifie les autorisations d'écriture
          if( is_writable( WP_CONTENT_DIR . '/themes/' ) ) {

              // Téléchargement de l'archive de la dernière publication
              $zip_url = $body->zipball_url;
              $zip_file = download_url( $zip_url );

              // Extraction de l'archive
              $path = WP_CONTENT_DIR . '/themes/';
              $unzip = unzip_file( $zip_file, $path );

              // Vérification de l'extraction
              if( ! is_wp_error( $unzip ) ) {
                  // suppression de l'archive
                  unlink( $zip_file );

                  // Mise à jour de la base de données
                  $theme = wp_get_theme();
                  update_option( 'template', $theme->get_template() );
                  update_option( 'stylesheet', $theme->get_stylesheet() );

                  // Affiche un message de succès
                  echo 'Thème mis à jour avec succès';
              } else {
                  // Affiche un message d'erreur
                  echo 'Erreur lors de l\'extraction de l\'archive';
              }
          } else {
              // Affiche un message d'erreur
              echo 'Le répertoire des thèmes n\'est pas accessible en écriture';
          }
      }
  }
}

// Ajout de la tâche cron pour vérifier les mises à jour de thème toutes les heures
if ( ! wp_next_scheduled( 'check_and_update_theme_hook' ) ) {
  wp_schedule_event( time(), 'hourly', 'check_and_update_theme_hook' );
}
add_action( 'check_and_update_theme_hook', 'check_and_update_theme' );
