<?php
/**
 * Zaglavlje HTML dokumenta i gornja traka sajta.
 *
 * @package startuj-legalno
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>


<body <?php body_class();?>>
    <?php wp_body_open(); ?>

    <a class="skip-link" href="#main-content"><?php esc_html_e( 'Preskoči na sadržaj', 'startuj-legalno' ); ?></a>

    <header class="site-header sticky-top py-2_5  px-3 px-xl-6">
        <div
            class="container-fluid d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between">
            <?php get_template_part( 'global-templates/logo' ); ?>
            <div
                class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3  gap-xl-6">
                <?php get_template_part( 'global-templates/navbar' ); ?>
                <?php get_template_part( 'global-templates/nav-cta' ); ?>
            </div>
        </div>
    </header>