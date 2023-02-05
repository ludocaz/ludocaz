<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
  <?php wp_head() ?>
</head>

<body>
  <div class="logo-menu-search row align-items-center">
    <div class="logo-site col-2">
      <a href="<?php echo esc_url(home_url('/')); ?>" title="Retour à la page d'accueil">
        <img src="<?php echo get_theme_mod('logo_upload'); ?>" alt="Logo" class="logo-site-img">
      </a>
    </div>

    <nav class="menu-principal col-6">
      <?php
      wp_nav_menu(array(
        'menu' => 'menu-principal',
        'container' => false,
        'menu_class' => 'menu-principal-container'
      ));
      ?>
    </nav>

    <div class="recherche col-2">
      <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
        <label>
          <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Rechercher…', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
        </label>
      </form>
    </div>

    <div class="connexion-inscription col-2">
      <?php
      if (is_user_logged_in()) {
      ?>
        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Mon compte</a>
      <?php
      } else {
      ?>
        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Connexion / Inscription</a>
      <?php
      }
      ?>
    </div>

    <div class="connexion-inscription">

    </div>

  </div>

  <div class="annonces align-items-center">
    <p>
      <?php
      $args = array(
        'post_type' => 'annonce',
        'posts_per_page' => -1
      );
      $annonces = get_posts($args);

      foreach ($annonces as $annonce) {
        echo '<div class="annonces align-items-center">';
        echo '<p>' . $annonce->post_content . '</p>';
        echo '</div>';
      }
      ?>
    </p>
  </div>