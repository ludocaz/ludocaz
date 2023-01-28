<?php get_header() ?>

<div class="calltoaction">
  <div class="row">
    <div class="col-4">
      <img src="../wp-content/themes/ludocaz/img/envoi-rapide.png" alt="">
    </div>
    <div class="col-4">
      <img src="../wp-content/themes/ludocaz/img/envoi-rapide.png" alt="">
    </div>
    <div class="col-4">
      <img src="../wp-content/themes/ludocaz/img/envoi-rapide.png" alt="">
    </div>
  </div>
</div>

<div class="les-nouveautees row">
  <div class="col-9"><h2>Les nouveautées</h2></div>
  <div class="nouveautees-produits col-12"><?php 
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 4
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
      while ( $loop->have_posts() ) : $loop->the_post();
  ?>
        <div class="product-item">
          <div class="product-image">
            <?php the_post_thumbnail(); ?>
          </div>
          <h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <div class="product-excerpt">
          <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
          </div>
          <div class="product-price">
        <?php 
            $product = wc_get_product( get_the_ID() );
            if ( $product->is_on_sale() ) {
                echo '<del>' . wc_price( $product->get_regular_price() ) . '</del>';
                echo '<ins>' . wc_price( $product->get_sale_price() ) . '</ins>';
            } else {
                echo wc_price( $product->get_regular_price() );
            }
        ?>
      </div>
        </div>
  <?php
      endwhile;
    } else {
      echo __( 'Aucun produit trouvé' );
    }
    wp_reset_postdata();
  ?></div>
</div>

<?php get_footer() ?>