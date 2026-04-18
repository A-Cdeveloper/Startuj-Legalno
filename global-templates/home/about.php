<?php
/**
 * Početna — sekcija #about „Ko smo mi“ (maketa: startuj_legalno_landing — .about).
 *
 * ACF (opciono):
 * - about_badge — red iznad labela (podrazumevano: „◆ Digitalno Legalno“)
 * - about_label — mali naslov (podrazumevano: „Ko smo mi“)
 * - about_title — h2 (podrazumevano: „Ekspertiza koja razume digitalni svet“)
 * - about_quote — tekst citata (blockquote)
 * - about_credentials (repeater): about_cred_icon, about_cred_title, about_cred_text
 *
 * @package startuj-legalno
 */



$about_label = function_exists( 'get_field' ) && get_field( 'about_label' )
	? get_field( 'about_label' )
	: __( 'Ko smo mi', 'startuj-legalno' );

$about_title = function_exists( 'get_field' ) && get_field( 'about_title' )
	? get_field( 'about_title' )
	: __( 'Ekspertiza koja razume digitalni svet', 'startuj-legalno' );

$about_credentials = function_exists( 'get_field' ) ? get_field( 'about_credentials' ) : false;
if ( ! $about_credentials || ! is_array( $about_credentials ) || ! count( $about_credentials ) ) {
	$about_credentials = array(
		array(
			'about_cred_icon' => '⚖️',
			'about_cred_title' => __( 'Pravna ekspertiza', 'startuj-legalno' ),
			'about_cred_text'  => __( 'Master prava i digitalnih tehnologija · GDPR · AI Act · IP · Ugovorni odnosi', 'startuj-legalno' ),
		),
		array(
			'about_cred_icon' => '🏦',
			'about_cred_title' => __( 'Poslovno iskustvo', 'startuj-legalno' ),
			'about_cred_text'  => __( '15+ godina u bankarskom sektoru · Finansijsko savetovanje · Rad sa klijentima', 'startuj-legalno' ),
		),
		array(
			'about_cred_icon' => '🛡️',
			'about_cred_title' => __( 'Doktrina DNK', 'startuj-legalno' ),
			'about_cred_text'  => __( 'Zaštita neregulisanog digitalnog kapitala — vrednost koju ne vidiš ali je gubiš bez pravne osnove', 'startuj-legalno' ),
		),
	);
}

$about_quote = function_exists( 'get_field' ) && get_field( 'about_quote' )
	? get_field( 'about_quote' )
	: __( 'Digitalni preduzetnici gube hiljade evra godišnje ne zbog loših ideja, već zbog ugovora koji ih ne štite, propuštenih regulatornih obaveza i intelektualne svojine na koju nemaju papire. To je kapital koji postoji — samo ga treba zaštititi.', 'startuj-legalno' );

?>
<section id="about" class="about py-5 py-lg-6 py-xl-8 reveal-on-scroll" aria-labelledby="about_section_title">
    <div class="container about__inner">

        <p class="home_features__tag"><?php echo esc_html( $about_label ); ?></p>

        <div class="about__content">
            <div class="about-text">

                <h2 id="about_section_title" class="section-title"><?php echo esc_html( $about_title ); ?></h2>
                <p><?php echo wp_kses( __( 'Startuj Legalno je program u okviru brenda <strong>Digitalno Legalno</strong> — compliance konsaltinga specijalizovanog za digitalne preduzetnike u Srbiji i regionu.', 'startuj-legalno' ), array( 'strong' => array() ) ); ?>
                </p>
                <p><?php echo wp_kses( __( 'Iza projekta stoji jedinstven spoj koji ne postoji kod konkurencije: <strong>master prava i digitalnih tehnologija</strong> sa specijalizacijom u GDPR, AI Act i ugovornom pravu, i <strong>15+ godina bankarskog iskustva</strong> u radu sa klijentima i finansijskim savetovanjem.', 'startuj-legalno' ), array( 'strong' => array() ) ); ?>
                </p>
                <p><?php esc_html_e( 'Razumemo pravni okvir. Razumemo digitalni biznis. I razumemo da svaki početnik ima drugačiju situaciju koja zahteva konkretan, primeran savet — a ne generički odgovor.', 'startuj-legalno' ); ?>
                </p>

                <div class="about-credentials">
                    <?php
					foreach ( $about_credentials as $row ) :
						$icon  = isset( $row['about_cred_icon'] ) ? $row['about_cred_icon'] : '';
						$title = isset( $row['about_cred_title'] ) ? $row['about_cred_title'] : '';
						$text  = isset( $row['about_cred_text'] ) ? $row['about_cred_text'] : '';
						if ( ! $title && ! $text ) {
							continue;
						}
						?>
                    <div class="credential">
                        <?php if ( $icon ) : ?>
                        <div class="credential-icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></div>
                        <?php endif; ?>
                        <div class="credential-text">
                            <?php if ( $title ) : ?>
                            <strong><?php echo esc_html( $title ); ?></strong>
                            <?php endif; ?>
                            <?php if ( $text ) : ?>
                            <?php echo esc_html( $text ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="about-quote">
                <blockquote>
                    <?php echo esc_html( $about_quote ); ?>
                </blockquote>
                <div class="quote-author">
                    <div class="qa-avatar" aria-hidden="true">DL</div>
                    <div class="qa-info">
                        <strong><?php esc_html_e( 'Digitalno Legalno', 'startuj-legalno' ); ?></strong>
                        <span><?php esc_html_e( 'startuj-legalno.rs · digitalno-legalno.rs', 'startuj-legalno' ); ?></span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>