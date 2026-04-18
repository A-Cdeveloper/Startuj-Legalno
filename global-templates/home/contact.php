<?php
/**
 * Početna — sekcija #kontakt (maketa: startuj_legalno_landing — .contact).
 * Formular: Contact Form 7 (shortcode ispod).
 *
 * ACF (kasnije, opciono):
 * - contact_label, contact_title, contact_lead
 *
 * @package startuj-legalno
 */

$contact_label = function_exists( 'get_field' ) && get_field( 'contact_label' )
	? get_field( 'contact_label' )
	: __( 'Kontakt', 'startuj-legalno' );

$contact_title = function_exists( 'get_field' ) && get_field( 'contact_title' )
	? get_field( 'contact_title' )
	: __( 'Pričamo?', 'startuj-legalno' );

$contact_lead = function_exists( 'get_field' ) && get_field( 'contact_lead' )
	? get_field( 'contact_lead' )
	: __( 'Pošalji nam kratki upit. Nema automatskog odgovora — čitamo svaki i vraćamo se u roku od jednog radnog dana.', 'startuj-legalno' );

$contact_email = apply_filters( 'startuj_legalno_contact_email', 'hello@startuj-legalno.rs' );
$dl_url        = apply_filters( 'startuj_legalno_digitalno_legalno_url', 'https://digitalno-legalno.rs' );

?>
<section id="kontakt" class="home_contact py-5 py-lg-6 py-xl-8 reveal-on-scroll" aria-labelledby="home_contact_title">
    <div class="container">
        <div class="home_contact__inner">
            <div class="home_contact__intro">
                <div class="home_features__tag"><?php echo esc_html( $contact_label ); ?></div>
                <h2 id="home_contact_title" class="section-title"><?php echo esc_html( $contact_title ); ?></h2>
                <p class="section-lead"><?php echo esc_html( $contact_lead ); ?></p>

                <div class="home_contact__info">
                    <div class="home_contact__info-row">
                        <span class="home_contact__info-icon" aria-hidden="true">&#9993;</span>
                        <span>
                            <strong><a class="home_contact__link"
                                    href="<?php echo esc_url( 'mailto:' . antispambot( $contact_email, 1 ) ); ?>"><?php echo esc_html( antispambot( $contact_email ) ); ?></a></strong>
                        </span>
                    </div>
                    <div class="home_contact__info-row">
                        <span class="home_contact__info-icon" aria-hidden="true">&#127760;</span>
                        <span>
                            <?php esc_html_e( 'startuj-legalno.rs ·', 'startuj-legalno' ); ?>
                            <a class="home_contact__link"
                                href="<?php echo esc_url( $dl_url ); ?>">digitalno-legalno.rs</a>
                        </span>
                    </div>
                    <div class="home_contact__info-row">
                        <span class="home_contact__info-icon" aria-hidden="true">&#128197;</span>
                        <span><?php esc_html_e( 'Odgovaramo radnim danima · do 24h', 'startuj-legalno' ); ?></span>
                    </div>
                    <div class="home_contact__notice">
                        <?php
						echo wp_kses(
							__( 'Podaci koje ostavljaš obrađuju se u skladu sa <a href="#">Privacy Policy</a> na osnovu legitimnog interesa za odgovor na tvoj upit.', 'startuj-legalno' ),
							array(
								'a' => array( 'href' => array() ),
							)
						);
						?>
                    </div>
                </div>
            </div>

            <div class="home_contact__aside">
                <div class="home_contact__form contact-form">
                    <?php echo do_shortcode( '[contact-form-7 id="b91be0f" title="Kontakt formular"]' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>