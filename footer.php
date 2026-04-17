<?php
/**
 * Podnožje sajta.
 *
 * @package startuj-legalno
 */

?>

<footer class="site-footer bg-brand-navy">
    <div class="container-fluid px-6">
        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">

            <p class="site-footer__title mb-0">
                <?php echo esc_html( get_bloginfo( 'name' ) ); ?> <span class="site-footer__subtitle">deo Digitalno
                    Legalno</span>
            </p>

            <p class="site-footer__copy mb-0 order-2 order-lg-1">
                <?php echo esc_html( '©' . date_i18n( 'Y' )); ?>.
                <?php esc_html_e( 'Sva prava zadržana.', 'startuj-legalno' ); ?>
            </p>
            <nav class="order-1 order-lg-2"
                aria-label="<?php esc_attr_e( 'Navigacija u podnožju', 'startuj-legalno' ); ?>">
                <?php
            wp_nav_menu( [
                'theme_location' => 'meta_menu',
                'depth'          => 1,
                'container'      => false,
                'menu_class'     => 'site-footer__menu mb-0',
                'fallback_cb'    => false,
            ] );
            ?>
            </nav>
        </div>
    </div>
</footer>




<?php wp_footer(); ?>




</body>

</html>