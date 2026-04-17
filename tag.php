<?php
/**
 * Arhiva tagova — blog layout (naslov/opis + kartice).
 *
 * @package startuj-legalno
 */

get_header();

global $wp_query;
?>

<main id="main-content" class="blog-archive flex-grow-1 container-fluid">
    <div class="container py-4 py-lg-6 px-3 px-xl-6">
        <header class="tag-archive mb-4 mb-lg-5">
            <h1 class="tag-archive__title"><?php single_tag_title(); ?></h1>
            <?php if ( tag_description() ) : ?>
            <div class="tag-archive__desc text-muted"><?php echo wp_kses_post( tag_description() ); ?></div>
            <?php endif; ?>
        </header>

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
						'prev_text'  => '<span aria-hidden="true">&larr;</span>',
						'next_text'  => '<span aria-hidden="true">&rarr;</span>',
						'aria_label' => __( 'Paginacija stranica arhive tagova', 'startuj-legalno' ),
					)
				);
				?>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();