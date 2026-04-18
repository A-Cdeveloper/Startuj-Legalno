<?php
/**
 * Početna — sekcija #usluga (.home_recognize). Maketa: startuj_legalno_landing — .forwhom
 *
 * ACF na stranici koja koristi ovaj šablon:
 * - recognize_caption — glavni naslov (npr. „Prepoznaješ li se?“)
 * - recognize_intro_text — lead ispod naslova
 * - recognize_boxes (repeater):
 *   - recognize_box_caption
 *   - recognize_box_description
 *   - recognize_box_icon (opciono) — emoji; ako je prazno: 💻 🎬 🛒 🤖 📚 🌍 po redu
 *
 * @package startuj-legalno
 */

$recognize_caption        = function_exists( 'get_field' ) ? get_field( 'recognize_caption' ) : '';
$recognize_intro_text     = function_exists( 'get_field' ) ? get_field( 'recognize_intro_text' ) : '';
$recognize_boxes          = function_exists( 'get_field' ) ? get_field( 'recognize_boxes' ) : false;
$recognize_default_emojis = array( '💻', '🎬', '🛒', '🤖', '📚', '🌍' );

?>
<section id="usluga" class="home_recognize py-5 py-lg-6 py-xl-8 reveal-on-scroll"
    <?php echo $recognize_caption ? ' aria-labelledby="home_recognize_heading"' : ' aria-label="' . esc_attr__( 'Za koga je ovo', 'startuj-legalno' ) . '"'; ?>>
    <div class="container">
        <p class="home_features__tag"><?php esc_html_e( 'Za koga je ovo', 'startuj-legalno' ); ?></p>
        <?php if ( $recognize_caption ) : ?>
        <h2 id="home_recognize_heading" class="home_recognize__title">
            <?php echo esc_html( $recognize_caption ); ?>
        </h2>
        <?php endif; ?>
        <?php if ( $recognize_intro_text ) : ?>
        <p class="home_recognize__intro mb-4 mb-lg-5">
            <?php echo esc_html( $recognize_intro_text ); ?>
        </p>
        <?php endif; ?>

        <?php if ( $recognize_boxes ) : ?>
        <div class="home_recognize__grid">
            <?php foreach ( $recognize_boxes as $index => $box ) : ?>
            <?php
				$box_title = isset( $box['recognize_box_caption'] ) ? $box['recognize_box_caption'] : '';
				$box_text  = isset( $box['recognize_box_description'] ) ? $box['recognize_box_description'] : '';
				$icon_txt  = isset( $box['recognize_box_icon'] ) ? trim( (string) $box['recognize_box_icon'] ) : '';
				$emoji     = '' !== $icon_txt
					? $icon_txt
					: ( isset( $recognize_default_emojis[ $index ] ) ? $recognize_default_emojis[ $index ] : $recognize_default_emojis[0] );
				?>
            <article class="home_recognize__card">
                <div class="home_recognize__emoji" aria-hidden="true"><?php echo esc_html( $emoji ); ?></div>
                <?php if ( $box_title ) : ?>
                <h3 class="home_recognize__card_title"><?php echo esc_html( $box_title ); ?></h3>
                <?php endif; ?>
                <?php if ( $box_text ) : ?>
                <p class="home_recognize__card_text"><?php echo esc_html( $box_text ); ?></p>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>