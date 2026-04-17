<?php
/**
 * Blog listing — kartica pregleda (category arhiva).
 *
 * @package startuj-legalno
 */

$display       = function_exists( 'startuj_legalno_post_display_category' ) ? startuj_legalno_post_display_category() : null;
$category_name = $display ? $display->name : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>
    <a class="blog-card__link" href="<?php the_permalink(); ?>">
        <div class="blog-card__row">
            <div class="blog-card__meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                <?php if ( '' !== $category_name ) : ?>
                <span class="blog-card__meta-sep" aria-hidden="true">|</span>
                <span class="blog-card__meta-category"><?php echo esc_html( $category_name ); ?></span>
                <?php endif; ?>
            </div>
            <span class="blog-card__arrow" aria-hidden="true">
                <svg class="blog-card__arrow-svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
        </div>
        <h2 class="blog-card__title"><?php the_title(); ?></h2>
        <p class="blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 36, '…' ) ); ?></p>
    </a>
</article>