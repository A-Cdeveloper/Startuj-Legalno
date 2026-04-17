<?php
/**
 * Stranica nije pronađena.
 *
 * @package startuj-legalno
 */

get_header();
?>

<main id="main-content" class="error-404 single-main flex-grow-1 container-fluid">
	<div class="col-30 col-lg-13 mx-auto py-4 py-lg-5">
		<?php get_template_part( 'loop-templates/content', 'none' ); ?>
	</div>
</main>

<?php
get_footer();
