<?php
/**
 * Pojedinačna objava.
 *
 * @package startuj-legalno
 */

get_header();
?>

<main id="main-content" class="single-main flex-grow-1 container-fluid bg-light">
    <div class="col-27 col-md-20 col-xl-13 mx-auto py-4 pt-lg-5 pb-lg-8">
        <?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'loop-templates/content', 'single' );
			endwhile;
		else :
			get_template_part( 'loop-templates/content', 'none' );
		endif;
		?>
    </div>
</main>

<?php
get_footer();