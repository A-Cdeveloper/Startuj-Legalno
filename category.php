<?php
/**
 * Arhiva kategorije — blog layout (pill filter + kartice).
 *
 * @package startuj-legalno
 */

get_header();

global $wp_query;
?>

<main id="main-content" <?php post_class( [ 'blog-archive', 'flex-grow-1', 'container-fluid' ] ); ?>>
    <div class="container py-4 py-lg-6 px-3 px-xl-6">

        <?php get_template_part( 'global-templates/blog', 'category-pills' ); ?>


        <div class="blog-archive__loop d-flex flex-column gap-4 flex-grow-1">
            <?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'loop-templates/content', 'posts' );
				endwhile;
			else :
				get_template_part( 'loop-templates/content', 'none' );
			endif;
			?>
        </div>

        <?php if ( isset( $wp_query->max_num_pages ) && $wp_query->max_num_pages > 1 ) : ?>
        <div class="blog-archive__pagination mt-5">
            <?php
			the_posts_pagination(
				array(
					'mid_size'   => 2,
					'prev_text' => '<span aria-hidden="true">&larr;</span>',
					'next_text' => '<span aria-hidden="true">&rarr;</span>',
					'aria_label' => __( 'Paginacija stranica arhive', 'startuj-legalno' ),
				)
			);
			?>
        </div>
        <?php endif; ?>

    </div>
</main>

<?php
get_footer();