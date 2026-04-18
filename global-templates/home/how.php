<?php
/**
 * Početna — sekcija „Proces / Kako izgleda saradnja”. Ista struktura klasa kao u startuj_legalno_landing (1).html (.how).
 *
 * ACF (opciono; ako nema podataka, koriste se isti tekstovi kao u landing maketi):
 * - process_label — mali naslov iznad h2 (podrazumevano: „Proces“)
 * - process_title — h2.section-title
 * - process_lead — p.section-lead
 * - process_steps (repeater), red:
 *   - process_step_title — h3
 *   - process_step_text — p
 *
 * @package startuj-legalno
 */

$process_label = function_exists( 'get_field' ) && get_field( 'process_label' )
	? get_field( 'process_label' )
	: __( 'Proces', 'startuj-legalno' );

$process_title = function_exists( 'get_field' ) && get_field( 'process_title' )
	? get_field( 'process_title' )
	: __( 'Kako izgleda saradnja', 'startuj-legalno' );

$process_lead = function_exists( 'get_field' ) && get_field( 'process_lead' )
	? get_field( 'process_lead' )
	: __( 'Nema automatizovanih odgovora, nema botova. Svaki klijent prolazi kroz selekciju — jer nam je stalo da pomognemo pravim osobama na pravi način.', 'startuj-legalno' );

$process_steps = function_exists( 'get_field' ) ? get_field( 'process_steps' ) : false;

if ( ! $process_steps || ! is_array( $process_steps ) || ! count( $process_steps ) ) {
	$process_steps = array(
		array(
			'process_step_title' => __( 'Šalješ upit', 'startuj-legalno' ),
			'process_step_text'  => __( 'Ispuniš kratku kontakt formu. Pitamo te samo osnove — ko si i šta planiraš.', 'startuj-legalno' ),
		),
		array(
			'process_step_title' => __( 'Dobijaš intake formular', 'startuj-legalno' ),
			'process_step_text'  => __( 'Detaljniji upitnik koji nam pomaže da razumemo tvoju situaciju pre razgovora.', 'startuj-legalno' ),
		),
		array(
			'process_step_title' => __( 'Uvodna sesija', 'startuj-legalno' ),
			'process_step_text'  => __( 'Razgovor od 30–45 minuta. Mapiramo gde si, šta ti treba i da li smo pravi fit.', 'startuj-legalno' ),
		),
		array(
			'process_step_title' => __( 'Potpisuješ i krećeš', 'startuj-legalno' ),
			'process_step_text'  => __( 'Ugovor elektronskim putem. Od prvog dana imaš pristup svim benefitima programa.', 'startuj-legalno' ),
		),
	);
}

?>
<section class="how py-5 py-lg-6 py-xl-8 reveal-on-scroll" id="work" aria-labelledby="how_section_title">
    <div class="container how__inner">
        <p class="home_features__tag"><?php echo esc_html( $process_label ); ?></p>
        <h2 id="how_section_title" class="section-title"><?php echo esc_html( $process_title ); ?></h2>
        <p class="section-lead"><?php echo esc_html( $process_lead ); ?></p>

        <div class="steps">
            <?php
			$step_index = 0;
			foreach ( $process_steps as $row ) :
				$st = isset( $row['process_step_title'] ) ? $row['process_step_title'] : '';
				$sx = isset( $row['process_step_text'] ) ? $row['process_step_text'] : '';
				++$step_index;
				?>
            <div class="step">
                <div class="step-num"><?php echo (int) $step_index; ?></div>
                <?php if ( $st ) : ?>
                <h3><?php echo esc_html( $st ); ?></h3>
                <?php endif; ?>
                <?php if ( $sx ) : ?>
                <p><?php echo esc_html( $sx ); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>