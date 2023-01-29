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

// Mises à jour automatiques du thème à partir du dépôt GitHub
add_filter( 'pre_set_site_transient_update_themes', 'automatic_GitHub_updates', 100, 1 );
function automatic_GitHub_updates( $data ) {
  // Informations sur le thème
  $theme   = get_stylesheet(); // Nom du dossier du thème actuel
  $current = wp_get_theme()->get( 'Version' ); // Obtenir la version du thème actuel
  // Informations sur GitHub
  $user = 'ludocaz'; // Nom d'utilisateur GitHub hébergeant le dépôt
  $repo = 'ludocaz'; // Nom du dépôt tel qu'il apparaît dans l'URL
  // Obtenir la dernière étiquette de version du dépôt. L'entête User-Agent doit être envoyée, selon la documentation
  // de l'API de GitHub: https://developer.github.com/v3/#user-agent-required
  $file = @json_decode( @file_get_contents( 'https://api.github.com/repos/'.$user.'/'.$repo.'/releases/latest', false,
      stream_context_create( [ 'http' => [ 'header' => "User-Agent: ".$user."\r\n" ] ] )
  ) );
  if ( $file ) {
    $update = filter_var( $file->tag_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    // Renvoyer une réponse uniquement si le nouveau numéro de version est supérieur à la version actuelle
    if ( $update > $current ) {
      $data->response[$theme] = array(
        'theme'       => $theme,
        // Supprimez le numéro de version de tous les caractères non alphabétiques (à l'exclusion du point)
        // de cette façon, vous pouvez toujours utiliser des étiquettes comme v1.1 ou ver1.1 si vous le souhaitez
        'new_version' => $update,
        'url'         => 'https://github.com/'.$user.'/'.$repo,
        'package'     => $file->assets[0]->browser_download_url,
      );
    }
  }
  return $data;
}


// ******************************************************************************************

// Mises à jour automatiques du plugin à partir du dépôt GitHub
add_filter( 'pre_set_site_transient_update_plugins', 'automatic_GitHub_updates_plugins', 100, 1 );
function automatic_GitHub_updates_plugins( $data ) {
// Informations sur le plugin
$plugin = plugin_basename( FILE ); // Nom du plugin
$current = get_option( 'your_current_version_option' ); // Obtenir la version actuelle du plugin
// Informations sur GitHub
$user = 'ludocaz'; // Nom d'utilisateur GitHub hébergeant le dépôt
$repo = 'annonces-bandeau'; // Nom du dépôt tel qu'il apparaît dans l'URL
// Obtenir la dernière étiquette de version du dépôt. L'entête User-Agent doit être envoyée, selon la documentation
// de l'API de GitHub: https://developer.github.com/v3/#user-agent-required
$file = @json_decode( @file_get_contents( 'https://api.github.com/repos/'.$user.'/'.$repo.'/releases/latest', false,
stream_context_create( [ 'http' => [ 'header' => "User-Agent: ".$user."\r\n" ] ] )
) );
if ( $file ) {
$update = filter_var( $file->tag_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
// Renvoyer une réponse uniquement si le nouveau numéro de version est supérieur à la version actuelle
if ( $update > $current ) {
$data->response[$plugin] = array(
'plugin' => $plugin,
// Supprimez le numéro de version de tous les caractères non alphabétiques (à l'exclusion du point)
// de cette façon, vous pouvez toujours utiliser des étiquettes comme v1.1 ou ver1.1 si vous le souhaitez
'new_version' => $update,
'url' => 'https://github.com/'.$user.'/'.$repo,
'package' => $file->assets[0]->browser_download_url,
);
}
}
return $data;
}