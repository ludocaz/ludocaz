<div class="newsletter">
  <div class="partie-gauche">
    <div class="texte-newsletter">
      <h2>S'inscrire à la Newsletter</h2>
      <p>Place holder</p>
    </div>
  </div>
  <div class="partie-droite">
    <form class="newsletter-form" action="#" method="post">
      <input type="email" name="email" placeholder="Votre adresse e-mail" required>
      <button type="submit">S'inscrire</button>
    </form>
  </div>
</div>

<div class="footer row">
  <div class="infos-generales col-2">
    <a href="<?php echo esc_url(home_url('/')); ?>" title="Retour à la page d'accueil">
      <img src="<?php echo get_theme_mod('logo_upload'); ?>" alt="Logo" class="logo-site-img">
    </a>
    <p>Voici toutes les informations necessaires afin de pouvoir nous contacter :</p>
    <ul>
      <li>7 clos du forestel<br>60120 Paillart</li>
      <li>Email : <a href="mailto:contact@ludocaz.fr">contact@ludocaz.fr</a></li>
      <li>WhatsApp : <a href="tel:0650292142">06 50 29 21 42</a></li>
    </ul>

  </div>
  <div class="liens-footer col-6">

  </div>
  <div class="feed-insta col-4">
    <div class="tagembed-container" style=" width:100%;height:100%;overflow: auto;">
      <div class="tagembed-socialwall" data-wall-id="88220"></div>
      <script src="//widget.tagembed.com/embed.min.js" type="text/javascript"></script>
    </div>
  </div>
</div>

<div class="copyright">
  <div class="left">
    &copy; 2022 - <?php echo date('Y'); ?> Ludocaz.fr
  </div>
  <div class="right">
    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-mastercard.png" alt="Image 1">
    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-visa.png" alt="Image 2">
    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-paypal.png" alt="Image 3">
    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-skrill.png" alt="Image 4">
    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-mondial-relay.png" alt="Image 5">
  </div>

</div>

</body>

</html>