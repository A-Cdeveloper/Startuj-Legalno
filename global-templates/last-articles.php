<?php
/**
 * Kratki pregled bloga — poslednje 3 objave (post).
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
		$items[] = array(
			'tag'   => $display ? $display->name : __( 'Članak', 'startuj-legalno' ),
			'title' => get_the_title(),
			'meta'  => get_the_date(),
			'url'   => get_permalink(),
		);
	}
	wp_reset_postdata();
}
?>

<section class="last-articles py-5 py-lg-6 py-xl-8 border-top reveal-on-scroll" aria-labelledby="last-articles-heading">
    <div class="container">

        <h2 id="last-articles-heading" class="section-heading">
            <?php esc_html_e( 'Poslednji članci', 'startuj-legalno' ); ?>
        </h2>

        <div class="row g-4 justify-content-center">
            <?php foreach ( $items as $item ) : ?>
            <div class="col-30 col-md-15 col-lg-10">
                <article class="last-articles__card">
                    <span class="last-articles__tag"><?php echo esc_html( $item['tag'] ); ?></span>
                    <h3 class="last-articles__title">
                        <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                    </h3>
                    <p class="last-articles__meta"><?php echo esc_html( $item['meta'] ); ?></p>
                </article>
            </div>
            <?php endforeach; ?>
        </div>

        <p class="text-center mt-4 mt-lg-5 mb-0">
            <a class="btn btn-outline-primary" href="<?php echo esc_url( $blog_url ); ?>">
                <?php esc_html_e( 'Svi članci', 'startuj-legalno' ); ?>
                <span class="home-section__cta-arrow" aria-hidden="true">→</span>
            </a>
        </p>

    </div>
</section>