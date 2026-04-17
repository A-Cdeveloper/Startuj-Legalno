<?php
/**
 * Sekundarni (meta) meni u zaglavlju.
 *
 * @package startuj-legalno
 */
?>
<div class="col-30 col-md-11 d-none d-lg-flex justify-content-end">
    <?php
			  $args = [
				  'theme_location'    => 'meta_menu',
				  'depth'             =>  1,
				  'container'         => '',
				  'container_class'   => '',
				  'container_id'      => '',
				  'menu_class'        => '',
                  'fallback_cb'       => false,
			  ];
			  wp_nav_menu($args);
        ?>
</div>