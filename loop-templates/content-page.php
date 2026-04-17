<?php
/**
 * Podrazumevana stranica — naslov + sadržaj (npr. politika privatnosti, uslovi, cookies, AI politika).
 * Bez breadcrumb-a i meta; isti tipografski ritam kao single.
 *
 * @package startuj-legalno
 */
?>

<article id="page-<?php the_ID(); ?>" <?php post_class( 'single-post page-content' ); ?>>
    <header class="single-post__header mb-4">
        <h1 class="single-post__title"><?php the_title(); ?></h1>
    </header>

    <div class="single-post__content entry-content">
        <?php the_content(); ?>
    </div>
</article>