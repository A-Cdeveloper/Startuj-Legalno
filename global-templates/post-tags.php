<?php
/**
 * Tagovi za pojedinačnu objavu.
 *
 * @package startuj-legalno
 */

defined( 'ABSPATH' ) || exit;

$tags = get_the_tags();
if ( empty( $tags ) || is_wp_error( $tags ) ) {
	return;
}
?>

<div class="single-post__tags">
    <ul class="single-post__tags-list list-unstyled d-flex flex-wrap gap-2 mb-0" role="list"
        aria-label="<?php esc_attr_e( 'Tagovi članka', 'startuj-legalno' ); ?>">
        <?php foreach ( $tags as $tag ) : ?>
        <?php
			$tag_link = get_tag_link( $tag );
			if ( is_wp_error( $tag_link ) ) {
				continue;
			}
			?>
        <li>
            <a class="single-post__tag-link"
                href="<?php echo esc_url( $tag_link ); ?>"><?php echo esc_html( $tag->name ); ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>