<?php
/**
 * Početna — hero blok (.home_features). Maketa: startuj_legalno_landing — .hero
 *
 * @package startuj-legalno
 */
?>
<section id="startuj" class="home_features py-5 py-lg-6 py-xl-8" aria-labelledby="home_features_title">
    <div class="container home_features__inner">
        <div class="home_features__content">
            <p class="home_features__tag"><?php esc_html_e( 'Za početnike u digitalnom biznisu', 'startuj-legalno' ); ?>
            </p>
            <h1 id="home_features_title" class="home_features__title">
                <?php
				echo wp_kses(
					__( 'Krenuo si sa <em>idejom.</em><br>Krenimo zajedno sa pravnom osnovom.', 'startuj-legalno' ),
					array(
						'em' => array(),
						'br' => array(),
					)
				);
				?>
            </h1>
            <p class="home_features__lead">
                <?php esc_html_e( 'Startuj Legalno je program za sve koji žele da pokrenu digitalni biznis bez pravnih grešaka od prvog dana. Ugovori, firma, zaštita podataka, intelektualna svojina — sve što trebaš znati, bez žargona i bez advokatskih cijena.', 'startuj-legalno' ); ?>
            </p>
            <ul class="home_features__checks">
                <li><?php esc_html_e( 'Objašnjenje svake pravne obaveze na tvom jeziku', 'startuj-legalno' ); ?></li>
                <li><?php esc_html_e( 'Dokumenti i odgovori na tvoja konkretna pitanja', 'startuj-legalno' ); ?></li>
                <li><?php esc_html_e( 'Savetnik koji razume digitalni biznis — ne samo pravo', 'startuj-legalno' ); ?>
                </li>
            </ul>
            <div class="home_features__actions">
                <a class="home_features__btn home_features__btn--primary"
                    href="#kontakt"><?php esc_html_e( 'Pošalji upit →', 'startuj-legalno' ); ?></a>
                <a class="home_features__btn home_features__btn--ghost"
                    href="#usluga"><?php esc_html_e( 'Šta je uključeno ↓', 'startuj-legalno' ); ?></a>
            </div>
        </div>

        <aside class="home_features__aside"
            aria-label="<?php echo esc_attr__( 'Mesečni program', 'startuj-legalno' ); ?>">
            <p class="home_features__plan_label"><?php esc_html_e( 'Mesečni program', 'startuj-legalno' ); ?></p>
            <div class="home_features__plan_price">
                <span class="home_features__plan_price_num">49</span>
                <span
                    class="home_features__plan_price_unit"><?php esc_html_e( 'EUR / mesec', 'startuj-legalno' ); ?></span>
            </div>
            <p class="home_features__plan_note">
                <?php esc_html_e( 'Trajanje: 12 meseci · Dinarska protivvrednost', 'startuj-legalno' ); ?></p>
            <div class="home_features__plan_divider" aria-hidden="true"></div>
            <ul class="home_features__plan_features">
                <li>
                    <span class="home_features__plan_bullet" aria-hidden="true">&#9670;</span>
                    <span><?php esc_html_e( 'Dva pisana pravna pitanja mesečno — odgovor za 48 sati', 'startuj-legalno' ); ?></span>
                </li>
                <li>
                    <span class="home_features__plan_bullet" aria-hidden="true">&#9670;</span>
                    <span><?php esc_html_e( 'Pristup biblioteci pravnih dokumenata za početnike', 'startuj-legalno' ); ?></span>
                </li>
                <li>
                    <span class="home_features__plan_bullet" aria-hidden="true">&#9670;</span>
                    <span><?php esc_html_e( 'Mesečni Compliance Brief — šta je novo u regulativi', 'startuj-legalno' ); ?></span>
                </li>
                <li>
                    <span class="home_features__plan_bullet" aria-hidden="true">&#9670;</span>
                    <span><?php esc_html_e( 'Savetnik koji zna gde su granice i kada ti treba neko drugi', 'startuj-legalno' ); ?></span>
                </li>
            </ul>
            <a class="home_features__plan_cta"
                href="#kontakt"><?php esc_html_e( 'Zatraži razgovor', 'startuj-legalno' ); ?></a>
            <p class="home_features__plan_consult">
                <?php
				echo wp_kses(
					__( 'Jednokratna konsultacija <strong>90 EUR</strong> · 60 minuta', 'startuj-legalno' ),
					array( 'strong' => array() )
				);
				?>
            </p>
        </aside>
    </div>
</section>