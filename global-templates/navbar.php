<?php
/**
 * Glavni meni (desktop).
 *
 * @package startuj-legalno
 */
?>
<nav class="navbar p-0 site-nav d-none d-lg-flex"
    aria-label="<?php esc_attr_e( 'Glavna navigacija', 'startuj-legalno' ); ?>">
    <?php
	  $args = [
		  'theme_location'    => 'main_menu',
          'depth' => 1,
          'container' => false,
		  'menu_class'        => 'navbar-nav flex-row align-items-center gap-2',
		  'fallback_cb'       => false,
	  ];
	  wp_nav_menu($args);
    ?>
</nav>