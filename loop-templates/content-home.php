<?php
/**
 * Sadržaj početne stranice.
 *
 * Ikone: images/icons/*.svg.
 *
 * @package startuj-legalno
 */
$icon_contract = get_theme_file_uri( 'images/icons/home-recognize-contract.svg' );
$icon_help     = get_theme_file_uri( 'images/icons/home-recognize-help.svg' );
$icon_chart    = get_theme_file_uri( 'images/icons/home-recognize-chart.svg' );

$intro_caption = get_field( 'intro_caption' );
$intro_boxes   = get_field( 'intro_boxes' );
$intro_icons   = array( $icon_contract, $icon_help, $icon_chart );

?>


<section class="home-recognize py-5 py-lg-6 py-xl-8 bg-light reveal-on-scroll" aria-labelledby="home-recognize-heading">
    <div class="container">
        <?php if ( $intro_caption ) : ?>
        <h2 id="home-recognize-heading" class="section-heading">
            <?php echo esc_html( $intro_caption ); ?>
        </h2>
        <?php endif; ?>
        <div class="row gy-4 gy-md-4 gx-md-4 justify-content-center">


            <?php if ( $intro_boxes ) : ?>
            <?php foreach ( $intro_boxes as $index => $box ) : ?>
            <?php $icon = isset( $intro_icons[ $index ] ) ? $intro_icons[ $index ] : $icon_contract; ?>
            <div class="col-30 col-md-15 col-lg-10">
                <article class="home-card home-recognize-card h-100">
                    <div class="home-recognize-card__icon" aria-hidden="true">
                        <img src="<?php echo esc_url( $icon ); ?>" alt="" width="40" height="40" loading="lazy"
                            decoding="async" class="home-card__icon-img">
                    </div>
                    <h3 class="home-card__title">
                        <?php echo esc_html( $box['intro_box_caption'] ); ?></h3>
                    <p class="home-card__text mb-0">
                        <?php echo esc_html( $box['intro_box_description'] ); ?>
                    </p>
                </article>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

