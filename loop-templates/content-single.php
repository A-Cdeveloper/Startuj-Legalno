<?php
/**
 * Pojedinačna objava — breadcrumb, naslov, meta, sadržaj.
 *
 * @package startuj-legalno
 */

$display = function_exists( 'startuj_legalno_post_display_category' ) ? startuj_legalno_post_display_category() : null;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
    <?php get_template_part( 'global-templates/single', 'breadcrumb' ); ?>

    <header class="single-post__header mb-4">
        <?php if ( has_post_thumbnail() ) : ?>
        <figure class="single-post__thumb mb-4 w-100">
            <?php
				the_post_thumbnail(
					'full',
					array(
						'class'   => 'single-post__thumb-img w-100',
						'loading' => 'eager',
						'decoding' => 'async',
					)
				);
				?>
        </figure>
        <?php endif; ?>
        <h1 class="single-post__title"><?php the_title(); ?></h1>
        <div class="single-post__meta">
            <time class="single-post__date"
                datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
            <?php if ( $display ) : ?>
            <?php
				$term_link = get_term_link( $display );
				if ( ! is_wp_error( $term_link ) ) :
					?>
            <span class="single-post__meta-dot" aria-hidden="true">•</span>
            <a class="single-post__category"
                href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $display->name ); ?></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </header>

    <div class="single-post__content entry-content">
        <?php the_content(); ?>
    </div>

    <?php get_template_part( 'global-templates/post', 'tags' ); ?>
    <?php get_template_part( 'global-templates/post', 'share' ); ?>
</article>