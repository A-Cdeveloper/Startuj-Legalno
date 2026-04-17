<?php
/**
 * Prazan rezultat ili 404 — poruka korisniku.
 *
 * @package startuj-legalno
 */
?>
<section class="content-none d-flex flex-column flex-grow-1 justify-content-center align-items-center w-100 py-5">

	<img src="<?php echo esc_url( get_theme_file_uri( 'images/icons/triangle-alert.svg' ) ); ?>" alt=""
		style="width: 150px; height: auto;" />
	<h2 class="my-4 display-3 fw-semibold"><?php esc_html_e( 'Stranica nije pronađena', 'startuj-legalno' ); ?></h2>
	<p>
		<a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-primary mt-4">
			<?php esc_html_e( 'Vrati se na početnu stranicu', 'startuj-legalno' ); ?>
		</a>
	</p>
</section>