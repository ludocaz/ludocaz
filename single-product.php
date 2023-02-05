<?php get_header() ?>

<?php
while (have_posts()) :
  the_post();
  global $product;
?>

  <h1 class="product-title">
    <?php the_title(); ?>
  </h1>

  <div class="product-description">
    <?php the_content(); ?>
  </div>

  <div class="product-price">
    <p class="regular-price">
      <?php echo $product->get_regular_price(); ?>
    </p>
    <p class="sale-price">
      <?php echo $product->get_sale_price(); ?>
    </p>
  </div>

  <div class="product-reviews">
    <?php comments_template(); ?>
  </div>

<?php endwhile; ?>


<?php get_footer() ?>