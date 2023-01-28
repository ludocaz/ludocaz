<?php

// URL de l'API GitHub pour votre dépôt de thème
$api_url = 'https://api.github.com/repos/ludocaz/ludocaz_theme/releases/latest';

// Récupération des données de l'API GitHub
$response = wp_remote_get( $api_url );

// Vérification de la réponse de l'API
if( ! is_wp_error( $response ) ) {
    $body = json_decode( $response['body'] );

    // Vérification de la version de la dernière publication
    if( version_compare( $body->tag_name, wp_get_theme()->get( 'Version' ), '>' ) ) {

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

        }
    }
}
