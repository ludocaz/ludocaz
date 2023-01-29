<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
  <?php wp_head()?>
</head>
<body>
  <div class="logo-menu-search row align-items-center">
    <div class="logo-site col-2">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Retour à la page d'accueil">
      <img src="<?php echo get_theme_mod( 'logo_upload' ); ?>" alt="Logo" class="logo-site-img">
    </a>
    </div>
    <div class="header-search col-4">
      <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <input type="text" placeholder="Rechercher un jeu..." name="s" id="s" value="<?php the_search_query(); ?>">
      </form>
    </div>
    <div class="header-phone col-2">
      <img src="../wp-content/themes/ludocaz/img/logo-whatsapp.png" alt="">
        <a href="tel:0650292142">06 50 29 21 42</a>
    </div>
    <div class="header-socials col-2">
    <a href="https://www.instagram.com" target="_blank">
      <img src="..\wp-content\themes\ludocaz\img\logo-instagram.png" alt="">
    </a>
    <a href="https://www.facebook.com" target="_blank">
      <img src="..\wp-content\themes\ludocaz\img\logo-facebook.png" alt="">
    </a>
    <a href="https://www.tiktok.com" target="_blank">
      <img src="..\wp-content\themes\ludocaz\img\logo-tiktok.png" alt="">
    </a>
    <a href="https://www.twitter.com" target="_blank">
      <img src="..\wp-content\themes\ludocaz\img\logo-twitter.png" alt="">
    </a>
    <a href="https://www.youtube.com" target="_blank">
      <img src="..\wp-content\themes\ludocaz\img\logo-youtube.png" alt="">
    </a>

    </div>
    <div class="header-connexion col-2">
      <p>Connexion / Créer un compte</p>
    </div>
  </div>

  <div class="annonces align-items-center">
    <p>
      <?php 
        $args = array(
          'post_type' => 'annonce',
          'posts_per_page' => -1
        );
        $annonces = get_posts( $args );

        foreach ( $annonces as $annonce ) {
          echo '<div class="annonces align-items-center">';
          echo '<p>' . $annonce->post_content . '</p>';
          echo '</div>';
        }
      ?>
    </p>
  </div>
  <div class="container">