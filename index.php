<?php


get_header();
?>

<main id="main-content" class="single-main flex-grow-1 container-fluid">
    <div class="col-30 col-lg-13 mx-auto py-4 py-lg-5">
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
</main>

<?php
get_footer();