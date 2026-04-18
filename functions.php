<?php
/**
 * Startuj Legalno — funkcije teme.
 *
 * @package startuj-legalno
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Osnovna podešavanja teme.
 *
 * @return void
 */
function theme_setup() {
	load_theme_textdomain( 'startuj-legalno', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'main_menu'       => esc_html__( 'MAIN', 'startuj-legalno' ),
			'meta_menu'       => esc_html__( 'META', 'startuj-legalno' ),
			'responsive_menu' => esc_html__( 'MOBILE', 'startuj-legalno' ),
		)
	);
}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Dodaje Bootstrap klasu linkovima u glavnom meniju bez custom walkera.
 *
 * @param array    $atts Atributi linka.
 * @param WP_Post  $item Stavka menija.
 * @param stdClass $args Argumenti menija.
 * @return array
 */
function startuj_legalno_main_menu_link_class( $atts, $item, $args ) {
	if ( ! isset( $args->theme_location ) || 'main_menu' !== $args->theme_location ) {
		return $atts;
	}

	$existing = isset( $atts['class'] ) ? trim( (string) $atts['class'] ) : '';
	$classes  = '' !== $existing ? preg_split( '/\s+/', $existing ) : array();
	$classes  = array_filter( (array) $classes );
	$classes[] = 'nav-link';
	$classes  = array_unique( $classes );

	$atts['class'] = implode( ' ', $classes );

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'startuj_legalno_main_menu_link_class', 10, 3 );

/**
 * Glavni / mobilni meni: linkovi ka sidrima početne (#startuj, #usluga, #work, …) uvek vode na
 * početnu URL adresu sajta, ne na pogrešno sačuvan path (npr. /blog/#usluga) kad si na drugoj stranici.
 *
 * @param array    $atts Atributi linka.
 * @param WP_Post  $item Stavka menija.
 * @param stdClass $args Argumenti menija.
 * @return array
 */
function startuj_legalno_home_anchor_menu_hrefs( $atts, $item, $args ) {
	$locations = array( 'main_menu', 'responsive_menu' );
	if ( ! isset( $args->theme_location ) || ! in_array( $args->theme_location, $locations, true ) ) {
		return $atts;
	}
	if ( empty( $atts['href'] ) ) {
		return $atts;
	}
	$parsed = wp_parse_url( $atts['href'] );
	if ( empty( $parsed['fragment'] ) ) {
		return $atts;
	}
	$fragment = $parsed['fragment'];
	$allowed  = apply_filters(
		'startuj_legalno_home_anchor_fragments',
		array( 'startuj', 'usluga', 'work', 'about', 'blog', 'kontakt', 'pocetak', 'kako-radi' )
	);
	if ( ! in_array( $fragment, $allowed, true ) ) {
		return $atts;
	}
	$base         = trailingslashit( home_url( '/' ) );
	$atts['href'] = esc_url( $base ) . '#' . rawurlencode( $fragment );

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'startuj_legalno_home_anchor_menu_hrefs', 9, 3 );

/**
 * Contact Form 7: bez automatskih <p> na početnoj da landing layout (.form-row / .form-group) ostane ispravan.
 *
 * @param bool $use_autop Podrazumevano true.
 * @return bool
 */
function startuj_legalno_wpcf7_autop_front_page( $use_autop ) {
	if ( is_front_page() ) {
		return false;
	}
	return $use_autop;
}
add_filter( 'wpcf7_autop_or_not', 'startuj_legalno_wpcf7_autop_front_page', 10, 1 );

/**
 * Bez istaknute slike za stranice (ostaje uključeno za objave i druge tipove koji je koriste).
 *
 * @return void
 */
function startuj_legalno_remove_page_thumbnail_support() {
	remove_post_type_support( 'page', 'thumbnail' );
}
add_action( 'init', 'startuj_legalno_remove_page_thumbnail_support', 11 );

/**
 * U adminu ponovo uključuje editor i atribute stranice (šablon, roditelj, redosled).
 *
 * Neki plugini pozivaju remove_post_type_support() za `page` i time nestane izbor šablona u Gutenbergu.
 *
 * @return void
 */
function startuj_legalno_ensure_page_admin_supports() {
	if ( ! is_admin() ) {
		return;
	}

	add_post_type_support( 'page', 'editor' );
	add_post_type_support( 'page', 'page-attributes' );
}
add_action( 'init', 'startuj_legalno_ensure_page_admin_supports', 999 );
add_action( 'admin_init', 'startuj_legalno_ensure_page_admin_supports', 999 );

/**
 * Dopunjava listu page šablona ako sken teme iz nekog razloga ne vrati sve fajlove.
 *
 * @param string[]     $post_templates Ključ = ime fajla u korenu teme.
 * @param WP_Theme     $theme          Objekat aktivne teme.
 * @param WP_Post|null $post           Stranica u editoru (može biti null).
 * @param string       $post_type      Tip zapisa.
 * @return string[]
 */
function startuj_legalno_merge_page_templates( $post_templates, $theme, $post, $post_type ) {
	if ( 'page' !== $post_type ) {
		return $post_templates;
	}

	$dir      = trailingslashit( get_template_directory() );
	$defaults = array(
		'front-page.php'    => __( 'Front Page', 'startuj-legalno' ),
	);

	foreach ( $defaults as $file => $label ) {
		if ( ! isset( $post_templates[ $file ] ) && is_readable( $dir . $file ) ) {
			$post_templates[ $file ] = $label;
		}
	}

	return $post_templates;
}
add_filter( 'theme_page_templates', 'startuj_legalno_merge_page_templates', 10000, 4 );

/**
 * Da li stranica koristi podrazumevani sadržajni šablon (sadržaj iz baze / page.php).
 *
 * Starije instalacije mogu imati meta šablon `page.php`.
 *
 * @param int $post_id ID stranice.
 * @return bool
 */
function startuj_legalno_page_uses_default_content_template( $post_id ) {
	$template = get_page_template_slug( $post_id );

	if ( false === $template || '' === $template || 'default' === $template ) {
		return true;
	}

	if ( 'page.php' === $template ) {
		return true;
	}

	return false;
}

/**
 * Isključuje polje sadržaja (editor) za stranice koje koriste prilagođeni PHP šablon.
 *
 * Šablon stranice i dalje može da se menja (page-attributes); sadržaj je u `loop-templates/` / partialima.
 *
 * @return void
 */
function startuj_legalno_page_editor_visibility_by_template() {
	global $pagenow;

	if ( 'post.php' !== $pagenow ) {
		return;
	}

	$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( ! $post_id ) {
		return;
	}

	$post = get_post( $post_id );
	if ( ! $post || 'page' !== $post->post_type ) {
		return;
	}

	if ( startuj_legalno_page_uses_default_content_template( $post_id ) ) {
		return;
	}

	remove_post_type_support( 'page', 'editor' );
}
add_action( 'load-post.php', 'startuj_legalno_page_editor_visibility_by_template' );

/**
 * Registracija stilova i skripti.
 *
 * @return void
 */
function enqueue_theme_assets() {
	wp_enqueue_style( 'startuj-legalno-bootstrap', get_template_directory_uri() . '/bootstrap.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'startuj-legalno-style', get_stylesheet_directory_uri() . '/style.css', array( 'startuj-legalno-bootstrap' ), _S_VERSION );
	wp_enqueue_script( 'bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'startuj-legalno-base', get_template_directory_uri() . '/js/base.js', array( 'bootstrap-bundle' ), _S_VERSION, true );

	// Hint browseru da deferuje skripte i rastereti rendering.
	if ( function_exists( 'wp_script_add_data' ) ) {
		wp_script_add_data( 'bootstrap-bundle', 'strategy', 'defer' );
		wp_script_add_data( 'startuj-legalno-base', 'strategy', 'defer' );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_theme_assets' );

/**
 * Preload glavne hero slike na početnoj zbog bržeg LCP otkrivanja.
 *
 * @return void
 */
function startuj_legalno_preload_home_hero_image() {
	if ( ! is_front_page() ) {
		return;
	}

	$hero_image_uri = get_theme_file_uri( 'images/home-hero.jpg' );
	if ( ! $hero_image_uri ) {
		return;
	}
	?>
<link rel="preload" as="image" href="<?php echo esc_url( $hero_image_uri ); ?>" fetchpriority="high">
<?php
}
add_action( 'wp_head', 'startuj_legalno_preload_home_hero_image', 1 );

/**
 * Slug roditeljske kategorije za blog (pill filteri; „Svi“ = ta arhiva).
 *
 * @return string
 */
function startuj_legalno_blog_category_slug() {
	$slug = apply_filters( 'startuj_legalno_blog_category_slug', 'compliance-resursi' );

	// Back-compat: zadržava podršku za stari filter naziv.
	return apply_filters( 'digitalno_legalno_blog_category_slug', $slug );
}

/**
 * ACF kontekst za hero na arhivi kategorije (drugi argument get_field): prvo trenutna kategorija,
 * zatim roditelji do korena — prva koja ima caption / glavni_naslov / intro (roditelj može da važi za sve podkategorije).
 *
 * @param WP_Term $term Kategorija prikazana na arhivi.
 * @return string Format 'category_{term_id}'.
 */
function startuj_legalno_category_hero_acf_context( $term ) {
	if ( ! $term instanceof WP_Term || 'category' !== $term->taxonomy ) {
		return '';
	}

	$current_id = (int) $term->term_id;
	$chain      = array( $current_id );
	$ancestors  = get_ancestors( $term->term_id, 'category' );
	if ( ! empty( $ancestors ) ) {
		$chain = array_merge( $chain, array_map( 'intval', $ancestors ) );
	}

	if ( ! function_exists( 'get_field' ) ) {
		return 'category_' . $current_id;
	}

	foreach ( $chain as $term_id ) {
		$ctx     = 'category_' . $term_id;
		$caption = get_field( 'caption', $ctx );
		$title   = get_field( 'glavni_naslov', $ctx );
		$intro   = get_field( 'intro', $ctx );
		if ( $caption || $title || $intro ) {
			return $ctx;
		}
	}

	return 'category_' . $current_id;
}

/**
 * Kategorija za prikaz na kartici / single.
 *
 * @return WP_Term|null
 */
function startuj_legalno_post_display_category() {
	$blog_cat = get_term_by( 'slug', startuj_legalno_blog_category_slug(), 'category' );
	$cats     = get_the_category();
	if ( empty( $cats ) ) {
		return null;
	}
	foreach ( $cats as $c ) {
		if ( 'uncategorized' === $c->slug ) {
			continue;
		}
		if ( $blog_cat && (int) $c->term_id === (int) $blog_cat->term_id ) {
			continue;
		}
		return $c;
	}
	if ( $blog_cat ) {
		foreach ( $cats as $c ) {
			if ( (int) $c->term_id === (int) $blog_cat->term_id ) {
				return $c;
			}
		}
	}
	foreach ( $cats as $c ) {
		if ( 'uncategorized' !== $c->slug ) {
			return $c;
		}
	}

	foreach ( $cats as $c ) {
		if ( 'uncategorized' === $c->slug ) {
			continue;
		}
		if ( 'category' !== $c->taxonomy ) {
			continue;
		}
		if ( ! empty( $c->name ) ) {
			return $c;
		}
	}

	return $cats[0];
}

/**
 * ID kategorije "Uncategorized" (ako postoji).
 *
 * @return int
 */
function startuj_legalno_uncategorized_term_id() {
	static $uncategorized_id = null;

	if ( null !== $uncategorized_id ) {
		return (int) $uncategorized_id;
	}

	global $wpdb;

	$term_id = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT t.term_id
			FROM {$wpdb->terms} t
			INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_id = t.term_id
			WHERE t.slug = %s
			AND tt.taxonomy = %s
			LIMIT 1",
			'uncategorized',
			'category'
		)
	);

	$uncategorized_id = $term_id ? (int) $term_id : 0;

	return (int) $uncategorized_id;
}

/**
 * Skrivanje "Uncategorized" u admin izboru kategorija (metabox/checklist).
 *
 * @param array $args Argumenti za wp_terms_checklist().
 * @return array
 */
function startuj_legalno_hide_uncategorized_in_admin_checklist( $args ) {
	if ( ! is_admin() ) {
		return $args;
	}

	$taxonomy = isset( $args['taxonomy'] ) ? (string) $args['taxonomy'] : 'category';
	if ( 'category' !== $taxonomy ) {
		return $args;
	}

	$uncategorized_id = startuj_legalno_uncategorized_term_id();
	if ( $uncategorized_id <= 0 ) {
		return $args;
	}

	$exclude = isset( $args['exclude'] ) ? $args['exclude'] : array();
	if ( is_string( $exclude ) ) {
		$exclude = array_filter( array_map( 'trim', explode( ',', $exclude ) ) );
	} elseif ( ! is_array( $exclude ) ) {
		$exclude = array();
	}

	$exclude   = array_map( 'intval', $exclude );
	$exclude[] = $uncategorized_id;
	$exclude   = array_unique( $exclude );

	$args['exclude'] = implode( ',', $exclude );

	return $args;
}
add_filter( 'wp_terms_checklist_args', 'startuj_legalno_hide_uncategorized_in_admin_checklist' );

/**
 * Skrivanje "Uncategorized" i iz admin term listi/dropdown-a.
 *
 * @param array $args       Argumenti za get_terms().
 * @param array $taxonomies Takse koje se učitavaju.
 * @return array
 */
function startuj_legalno_hide_uncategorized_in_admin_terms( $args, $taxonomies ) {
	if ( ! is_admin() ) {
		return $args;
	}

	if ( empty( $taxonomies ) || ! in_array( 'category', (array) $taxonomies, true ) ) {
		return $args;
	}

	$uncategorized_id = startuj_legalno_uncategorized_term_id();
	if ( $uncategorized_id <= 0 ) {
		return $args;
	}

	$exclude = isset( $args['exclude'] ) ? $args['exclude'] : array();
	if ( is_string( $exclude ) ) {
		$exclude = array_filter( array_map( 'trim', explode( ',', $exclude ) ) );
	} elseif ( ! is_array( $exclude ) ) {
		$exclude = array();
	}

	$exclude   = array_map( 'intval', $exclude );
	$exclude[] = $uncategorized_id;
	$exclude   = array_unique( $exclude );

	$args['exclude'] = implode( ',', $exclude );

	return $args;
}
add_filter( 'get_terms_args', 'startuj_legalno_hide_uncategorized_in_admin_terms', 10, 2 );

/**
 * Na arhivi roditelja bloga uključuje objave iz svih podkategorija.
 *
 * @param WP_Query $query Glavni upit.
 * @return void
 */
function startuj_legalno_blog_category_query_include_children( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_category() ) {
		return;
	}

	$blog = get_term_by( 'slug', startuj_legalno_blog_category_slug(), 'category' );
	if ( ! $blog || is_wp_error( $blog ) ) {
		return;
	}

	$current_id = (int) $query->get_queried_object_id();
	if ( $current_id !== (int) $blog->term_id ) {
		return;
	}

	$child_ids = get_terms(
		array(
			'taxonomy'   => 'category',
			'child_of'   => (int) $blog->term_id,
			'fields'     => 'ids',
			'hide_empty' => false,
		)
	);
	if ( is_wp_error( $child_ids ) ) {
		return;
	}

	$ids = array_unique(
		array_merge(
			array( (int) $blog->term_id ),
			array_map( 'intval', $child_ids )
		)
	);

	$query->set( 'cat', '' );
	$query->set( 'category_name', '' );
	$query->set( 'category__in', $ids );
}
add_action( 'pre_get_posts', 'startuj_legalno_blog_category_query_include_children' );

/**
 * Paginacija objava: ukloni <h2 class="screen-reader-text"> iz markupa.
 *
 * @param string $html Markup iz get_the_posts_pagination().
 * @return string
 */
function startuj_legalno_posts_pagination_no_sr_heading( $html ) {
	if ( '' === $html ) {
		return $html;
	}

	return preg_replace( '/\s*<h2\b[^>]*\bscreen-reader-text\b[^>]*>.*?<\/h2>\s*/is', '', $html );
}
add_filter( 'get_the_posts_pagination', 'startuj_legalno_posts_pagination_no_sr_heading' );

/**
 * Contact Form 7 — putanja do ajax loader GIF-a.
 *
 * @return string
 */
function startuj_legalno_wpcf7_ajax_loader() {
	return trailingslashit( get_stylesheet_directory_uri() ) . 'images/ajax-loader.gif';
}
add_filter( 'wpcf7_ajax_loader', 'startuj_legalno_wpcf7_ajax_loader' );

if ( function_exists( 'eae_encode_emails' ) ) {
	add_filter( 'acf_the_content', 'eae_encode_emails' );
	add_filter( 'acf/load_value', 'eae_encode_emails' );
}

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => 'Osnovne postavke',
			'menu_title' => 'Osnovne postavke',
			'menu_slug'  => 'general-settings',
			'position'   => '8',
		)
	);
}

/**
 * Prilagođeni logo na stranici prijave.
 *
 * @return void
 */
function startuj_legalno_login_logo() {
	$logo = esc_url( get_template_directory_uri() . '/images/logo.png' );
	?>
<style type="text/css">
body.login div#login h1 a {
    background-image: url(<?php echo esc_url( $logo );
    ?>);
    background-size: contain !important;
    background-repeat: no-repeat;
    background-position: center center;
    width: 100% !important;
    height: 80px;
    padding-bottom: 0;
}
</style>
<?php
}
add_action( 'login_enqueue_scripts', 'startuj_legalno_login_logo' );

/**
 * Sakriva osetljive stavke admin menija za uloge bez prava kreiranja korisnika.
 *
 * @return void
 */
function startuj_legalno_hide_admin_menus() {
	if ( current_user_can( 'create_users' ) ) {
		return;
	}

	remove_menu_page( 'plugins.php' );
	remove_menu_page( 'themes.php' );
	remove_menu_page( 'tools.php' );
	remove_menu_page( 'users.php' );
	remove_menu_page( 'wpcf7' );
	remove_menu_page( 'edit.php?post_type=acf-field-group' );
	remove_menu_page( 'edit.php?post_type=rmp_menu' );
	remove_menu_page( 'duplicator' );
	remove_menu_page( 'wpseo_dashboard' );
	remove_menu_page( 'sucuriscan' );
	remove_menu_page( 'aiowpsec' );
}
add_action( 'admin_menu', 'startuj_legalno_hide_admin_menus', 120 );

/**
 * Osnovna HTTP bezbednosna zaglavlja.
 *
 * @return void
 */
function startuj_legalno_security_headers() {
	if ( headers_sent() ) {
		return;
	}

	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );

	if ( is_ssl() ) {
		header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains' );
	}
}
add_action( 'send_headers', 'startuj_legalno_security_headers', 1 );


/**
 * Uklanja dugme za medije iz klasičnog editora u adminu.
 *
 * @return void
 */
function startuj_legalno_remove_media_buttons() {
	remove_action( 'media_buttons', 'media_buttons' );
}
add_action( 'admin_head', 'startuj_legalno_remove_media_buttons' );