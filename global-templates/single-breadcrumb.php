<?php
/**
 * Breadcrumb za pojedinačnu objavu (Početna / blog roditelj / podkategorija / naslov).
 *
 * @package startuj-legalno
 */

defined( 'ABSPATH' ) || exit;

$blog_cat = get_term_by( 'slug', startuj_legalno_blog_category_slug(), 'category' );
$display  = function_exists( 'startuj_legalno_post_display_category' ) ? startuj_legalno_post_display_category() : null;

if ( ( ! $blog_cat || is_wp_error( $blog_cat ) ) && $display instanceof WP_Term ) {
	$ancestors = get_ancestors( (int) $display->term_id, 'category' );
	$top_id    = ! empty( $ancestors ) ? (int) end( $ancestors ) : (int) $display->term_id;
	$blog_cat  = get_term( $top_id, 'category' );
}
?>

<nav class="single-breadcrumb mb-3 mb-lg-4" aria-label="<?php esc_attr_e( 'Putanja do članka', 'startuj-legalno' ); ?>">
	<ol class="single-breadcrumb__list list-unstyled d-flex flex-wrap align-items-center gap-1 gap-sm-2 mb-0">
		<li class="single-breadcrumb__item">
			<a class="single-breadcrumb__link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Početna', 'startuj-legalno' ); ?></a>
		</li>

		<?php if ( $blog_cat && ! is_wp_error( $blog_cat ) ) : ?>
			<?php $blog_link = get_term_link( $blog_cat ); ?>
			<?php if ( ! is_wp_error( $blog_link ) ) : ?>
				<li class="single-breadcrumb__sep" aria-hidden="true">/</li>
				<li class="single-breadcrumb__item">
					<a class="single-breadcrumb__link" href="<?php echo esc_url( $blog_link ); ?>"><?php echo esc_html( $blog_cat->name ); ?></a>
				</li>
			<?php endif; ?>
		<?php endif; ?>

		<?php
		if ( $display && $blog_cat && (int) $display->term_id !== (int) $blog_cat->term_id ) :
			$d_link = get_term_link( $display );
			if ( ! is_wp_error( $d_link ) ) :
				?>
				<li class="single-breadcrumb__sep" aria-hidden="true">/</li>
				<li class="single-breadcrumb__item">
					<a class="single-breadcrumb__link" href="<?php echo esc_url( $d_link ); ?>"><?php echo esc_html( $display->name ); ?></a>
				</li>
				<?php
			endif;
		elseif ( $display && ( ! $blog_cat || is_wp_error( $blog_cat ) ) ) :
			$d_link = get_term_link( $display );
			if ( ! is_wp_error( $d_link ) ) :
				?>
				<li class="single-breadcrumb__sep" aria-hidden="true">/</li>
				<li class="single-breadcrumb__item">
					<a class="single-breadcrumb__link" href="<?php echo esc_url( $d_link ); ?>"><?php echo esc_html( $display->name ); ?></a>
				</li>
				<?php
			endif;
		endif;
		?>

		<li class="single-breadcrumb__sep" aria-hidden="true">/</li>
		<li class="single-breadcrumb__item single-breadcrumb__current text-body-secondary" aria-current="page"><?php the_title(); ?></li>
	</ol>
</nav>
