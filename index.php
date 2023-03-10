<?php get_header() ?>
<div class="highlight">
  <img src="<?php echo get_template_directory_uri(); ?>/img/image-highlight.png" alt="">
</div>

<div class="container">

  <div class="calltoaction row">
    <div class="col-4">
      <img src="<?php echo get_template_directory_uri(); ?>/img/envoi-rapide.png" alt="">
    </div>
    <div class="col-4">
      <img src="<?php echo get_template_directory_uri(); ?>/img/envoi-rapide.png" alt="">
    </div>
    <div class="col-4">
      <img src="<?php echo get_template_directory_uri(); ?>/img/envoi-rapide.png" alt="">
    </div>
  </div>

  <div class="les-nouveautees row">
    <div class="col-3">
      <h2 class="titre-h2-accueil">Les nouveautées</h2>
    </div>
    <div class="nouveautees-produits col-12">
      <?php
      $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4
      );
      $loop = new WP_Query($args);
      if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
      ?>
          <div class="product-item">
            <div class="product-image">
              <?php the_post_thumbnail(); ?>
            </div>
            <h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="product-excerpt">
              <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
            <div class="product-price">
              <?php
              $product = wc_get_product(get_the_ID());
              if ($product->is_on_sale()) {
                echo '<p class="prix"><del>' . wc_price($product->get_regular_price()) . '</del></p>';
                echo '<p class="prix"><ins>' . wc_price($product->get_sale_price()) . '</ins></p>';
              } else {
                echo '<p class="prix">' . wc_price($product->get_regular_price()) . '</p>';
              }
              ?>

            </div>
          </div>
      <?php
        endwhile;
      } else {
        echo __('Aucun produit trouvé');
      }
      wp_reset_postdata();
      ?>
    </div>
  </div>

  <div class="liste-nouveautees">
    <h2 class="titre-h2-accueil col-3">Derniers arrivages</h2>
    <div class="titre-liste row">
      <div class="col-5">
        <h3>Titre des articles</h3>
      </div>
      <div class="col-1">
        <h3>Stock(s)</h3>
      </div>
      <div class="col-1">
        <h3>État</h3>
      </div>
      <div class="col-2">
        <h3>Prix du produit</h3>
      </div>
      <div class="col-3">
        <h3>Bouton accès article</h3>
      </div>
    </div>

    <?php
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 10,
    );
    $counter = 1;
    $latest_products = new WP_Query($args);
    while ($latest_products->have_posts()) : $latest_products->the_post();
      $product = wc_get_product(get_the_ID());
    ?>
      <div class="row">
        <div class="col-5">
          <?php if ($counter == 1) : ?>
          <?php endif; ?>
          <a href="<?php the_permalink(); ?>" class="titrearticles">
            <?php the_title(); ?>
          </a>
        </div>

        <div class="col-1">
          <?php if ($counter == 1) : ?>
          <?php endif; ?>
          <p class="stock"><?php echo $product->get_stock_quantity(); ?></p>
        </div>

        <div class="col-1">
          <?php
          // Récupérer l'ID du produit
          $product_id = $product->get_id();

          // Récupérer les termes pour l'attribut personnalisé "etatduproduit"
          $etatduproduit_terms = wp_get_post_terms($product_id, 'pa_etatduproduit');

          // Boucle à travers les termes de l'attribut personnalisé "etatduproduit"
          foreach ($etatduproduit_terms as $etatduproduit_term) {
            // Récupérer le nom du terme pour l'attribut personnalisé "etatduproduit"
            $etatduproduit_term_name = $etatduproduit_term->name;

            // Définir une classe CSS pour chaque terme en utilisant le nom du terme en minuscule
            $etatduproduit_term_slug = $etatduproduit_term->slug;
            $etatduproduit_term_class = 'etatduproduit-' . strtolower($etatduproduit_term_slug);
          ?>
            <!-- Afficher le nom du terme pour l'attribut personnalisé "etatduproduit" avec la classe CSS correspondante -->
            <p class="etatduproduit <?php echo $etatduproduit_term_class; ?>"><?php echo $etatduproduit_term_name; ?></p>
          <?php } ?>
        </div>

        <div class="col-2">
          <?php if ($counter == 1) : ?>
          <?php endif; ?>
          <p class="prix"><?php echo $product->get_price(); ?>€</p>
        </div>

        <div class="col-3">
          <?php if ($counter == 1) : ?>
          <?php endif; ?>
          <a href="<?php the_permalink(); ?>" class="button">Accéder à l'article</a>
        </div>
      </div>
    <?php
      $counter++;
    endwhile;
    wp_reset_postdata();
    ?>
  </div>
</div>

<div class="call-to-action">
  <div class="row">
    <div class="col-2">
      <h2>Jeux d'ambiance</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 1"></a>
    </div>
    <div class="col-2">
      <h2>Incontournables</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 2"></a>
    </div>
    <div class="col-2">
      <h2>Jeux de cartes</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 3"></a>
    </div>
    <div class="col-2">
      <h2>jeux de reflexion</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 4"></a>
    </div>
    <div class="col-2">
      <h2>Se la jouer en solo</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 5"></a>
    </div>
    <div class="col-2">
      <h2>Se la jouer en duo</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 6"></a>
    </div>
  </div>
  <div class="row">
    <div class="col-2">
      <h2>Les oldies</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 1b"></a>
    </div>
    <div class="col-2">
      <h2>Escape games</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 2b"></a>
    </div>
    <div class="col-2">
      <h2>Jeux de rôles</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 3b"></a>
    </div>
    <div class="col-2">
      <h2>Jeux enfants</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 4b"></a>
    </div>
    <div class="col-2">
      <h2>Promotions</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 5b"></a>
    </div>
    <div class="col-2">
      <h2>Jeux entre adultes</h2>
      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icone-categorie.png" alt="Image 6b"></a>
    </div>
  </div>
</div>

<div class="histoire-ludocaz container">
  <h2 class="titre-h2-accueil">Histoire de Ludocaz</h2>

  <div class="row">
    <div class="col-3 photo-profil-apropos">
      <img src="<?php echo get_template_directory_uri(); ?>/img/photo-profil.jpg" alt="">
    </div>

    <div class="col-9">
      <p>Ludocaz est né d'une constatation alarmante : des milliers de jeux de société sont abandonnés dans nos greniers, nos caves ou nos placards, condamnés à finir leur vie dans l'oubli. Mon projet consiste à redonner vie à ces jeux oubliés en leur offrant une seconde chance.<br>
        <br>
        En restaurant ces jeux de société anciens et abîmés avec soin, en remplaçant les pièces manquantes et en réparant les dégâts, Ludocaz permet aux amateurs passionnés de jeux de société de découvrir des trésors cachés et de profiter de jeux uniques et authentiques à prix malin!<br>
        <br>
        L'initiative vise à préserver la culture ludique en restaurant des jeux de société anciens et en les offrant à une nouvelle génération de joueurs. En achetant des jeux restaurés sur Ludocaz, nos clients font un geste pour la planète en évitant le gaspillage de jeux qui méritent d'être appréciés à leur juste valeur.<br>
        <br>
        Rejoignez notre communauté de joueurs passionnés et contribuez à la préservation de la culture ludique en redonnant vie à des jeux de société oubliés.<br>
        <br>
        Gérald JOLY<br>
        Directeur général. LOOOL
      </p>
    </div>
  </div>
</div>

<?php get_footer() ?>