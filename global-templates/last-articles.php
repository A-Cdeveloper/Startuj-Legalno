<?php
/**
 * Blog blok na početnoj — poslednje 3 objave (kartice kao u startuj_legalno_landing .blog).
 *
 * ACF (opciono na stranici koja koristi početni šablon):
 * - blog_section_label — mali naslov (podrazumevano: „Blog za početnike“)
 * - blog_section_title — h2
 * - blog_section_lead — uvodni pasus
 *
 * @package startuj-legalno
 */

defined( 'ABSPATH' ) || exit;

$blog_url  = home_url( '/' );
$blog_term = get_term_by( 'slug', startuj_legalno_blog_category_slug(), 'category' );
if ( $blog_term && ! is_wp_error( $blog_term ) ) {
	$term_link = get_term_link( $blog_term );
	if ( ! is_wp_error( $term_link ) ) {
		$blog_url = $term_link;
	}
}

$blog_label = function_exists( 'get_field' ) && get_field( 'blog_section_label' )
	? get_field( 'blog_section_label' )
	: __( 'Blog za početnike', 'startuj-legalno' );

$blog_title = function_exists( 'get_field' ) && get_field( 'blog_section_title' )
	? get_field( 'blog_section_title' )
	: __( 'Praktični vodiči. Bez žargona.', 'startuj-legalno' );

$blog_lead = function_exists( 'get_field' ) && get_field( 'blog_section_lead' )
	? get_field( 'blog_section_lead' )
	: __( 'Sve što bi trebalo da znaš pre nego što potpišeš nešto, otvoriš firmu ili pustiš sajt u svet.', 'startuj-legalno' );

$items = array();

$last_posts = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( $last_posts->have_posts() ) {
	while ( $last_posts->have_posts() ) {
		$last_posts->the_post();
		$display = function_exists( 'startuj_legalno_post_display_category' )
			? startuj_legalno_post_display_category()
			: null;
		$raw_excerpt = get_the_excerpt();
		if ( '' === trim( wp_strip_all_tags( $raw_excerpt ) ) ) {
			$raw_excerpt = wp_trim_words(
				wp_strip_all_tags( (string) get_post_field( 'post_content', get_the_ID() ) ),
				40,
				'…'
			);
		} else {
			$raw_excerpt = wp_trim_words( $raw_excerpt, 28, '…' );
		}
		$items[] = array(
			'tag'     => $display ? $display->name : __( 'Članak', 'startuj-legalno' ),
			'title'   => get_the_title(),
			'excerpt' => $raw_excerpt,
			'url'     => get_permalink(),
		);
	}
	wp_reset_postdata();
}
?>

<section id="blog" class="last-articles py-5 py-lg-6 py-xl-8 reveal-on-scroll" aria-labelledby="last-articles-heading">
    <div class="container">
        <div class="last-articles__inner">
            <div class="home_features__tag"><?php echo esc_html( $blog_label ); ?></div>
            <h2 id="last-articles-heading" class="section-title"><?php echo esc_html( $blog_title ); ?></h2>
            <p class="section-lead"><?php echo esc_html( $blog_lead ); ?></p>

            <?php if ( count( $items ) ) : ?>
            <div class="last-articles__grid" role="list">
                <?php foreach ( $items as $item ) : ?>
                <article class="last-articles__card" role="listitem">
                    <div class="last-articles__card-top">
                        <span class="last-articles__tag"><?php echo esc_html( $item['tag'] ); ?></span>
                        <h3 class="last-articles__title">
                            <a
                                href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                        </h3>
                    </div>
                    <div class="last-articles__card-body">
                        <?php if ( ! empty( $item['excerpt'] ) ) : ?>
                        <p class="last-articles__excerpt"><?php echo esc_html( $item['excerpt'] ); ?></p>
                        <?php endif; ?>
                        <a class="last-articles__read" href="<?php echo esc_url( $item['url'] ); ?>">
                            <?php esc_html_e( 'Pročitaj više', 'startuj-legalno' ); ?>
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <p class="last-articles__more text-center mt-4 mt-lg-5 mb-0">
                <a class="btn btn-outline-primary" href="<?php echo esc_url( $blog_url ); ?>">
                    <?php esc_html_e( 'Svi članci', 'startuj-legalno' ); ?>
                    <span class="last-articles__cta-arrow" aria-hidden="true">→</span>
                </a>
            </p>
        </div>
    </div>
</section>