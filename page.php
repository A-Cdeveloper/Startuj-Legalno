<?php
/** 
 *  Template Name: Page
 * @package startuj-legalno
 */

get_header();
?>

<main id="main-content" class="single-main flex-grow-1 container-fluid bg-light">
    <div class="container py-4 py-lg-6 px-3 px-xl-6">
        <?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'loop-templates/content', 'page' );
			endwhile;
		else :
			get_template_part( 'loop-templates/content', 'none' );
		endif;
		?>
    </div>
</main>

<?php
get_footer();