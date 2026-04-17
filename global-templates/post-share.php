<?php
/**
 * Share sekcija za pojedinačnu objavu.
 *
 * @package startuj-legalno
 */

defined( 'ABSPATH' ) || exit;

$share_url_encoded   = rawurlencode( get_permalink() );
$share_title_encoded = rawurlencode( wp_strip_all_tags( get_the_title() ) );
$share_email_subject = rawurlencode( wp_strip_all_tags( get_the_title() ) );
$share_email_body    = rawurlencode( get_permalink() );

$icon_linkedin = get_theme_file_uri( 'images/icons/social-linkedin.svg' );
$icon_x        = get_theme_file_uri( 'images/icons/social-x.svg' );
$icon_facebook = get_theme_file_uri( 'images/icons/social-facebook.svg' );
$icon_email    = get_theme_file_uri( 'images/icons/social-email.svg' );
?>

<div class="single-post__share" aria-label="<?php esc_attr_e( 'Podeli članak', 'startuj-legalno' ); ?>">
	<span class="single-post__share-label"><?php esc_html_e( 'Podeli:', 'startuj-legalno' ); ?></span>
	<div class="single-post__share-links">
		<a class="single-post__share-link" href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url_encoded ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Podeli na LinkedIn', 'startuj-legalno' ); ?>">
			<img class="single-post__share-icon" src="<?php echo esc_url( $icon_linkedin ); ?>" alt="" width="14" height="14" loading="lazy" decoding="async">
			LinkedIn
		</a>
		<a class="single-post__share-link" href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url=' . $share_url_encoded . '&text=' . $share_title_encoded ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Podeli na X', 'startuj-legalno' ); ?>">
			<img class="single-post__share-icon" src="<?php echo esc_url( $icon_x ); ?>" alt="" width="14" height="14" loading="lazy" decoding="async">
			X
		</a>
		<a class="single-post__share-link" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url_encoded ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Podeli na Facebook', 'startuj-legalno' ); ?>">
			<img class="single-post__share-icon" src="<?php echo esc_url( $icon_facebook ); ?>" alt="" width="14" height="14" loading="lazy" decoding="async">
			Facebook
		</a>
		<a class="single-post__share-link" href="<?php echo esc_url( 'mailto:?subject=' . $share_email_subject . '&body=' . $share_email_body ); ?>" aria-label="<?php esc_attr_e( 'Podeli putem emaila', 'startuj-legalno' ); ?>">
			<img class="single-post__share-icon" src="<?php echo esc_url( $icon_email ); ?>" alt="" width="14" height="14" loading="lazy" decoding="async">
			Email
		</a>
	</div>
</div>
