<?php
/**
 * Logo i naziv sajta (ACF Options).
 *
 * @package startuj-legalno
 */

defined( 'ABSPATH' ) || exit;

$logo = get_field( 'logo', 'options' );
?>

<div id="logo">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
        <?php echo wp_get_attachment_image( $logo['ID'],'', 'full',array( "alt" => get_bloginfo('name') ));?>
        <p class="logo__title mb-0"><?php echo esc_html( get_bloginfo( 'name' ) ); ?> <span class="logo__subtitle">deo
                Digitalno Legalno</span></p>
    </a>
</div>