<?php
/**
 * Wootheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wootheme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wootheme_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Wootheme, use a find and replace
	 * to change 'wootheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('wootheme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header-menu' => esc_html__('Header Menu', 'wootheme'),
			'footer-menu' => esc_html__('Footer Menu', 'wootheme'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wootheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'wootheme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wootheme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('wootheme_content_width', 640);
}
add_action('after_setup_theme', 'wootheme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wootheme_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'wootheme'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'wootheme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'wootheme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function wootheme_scripts()
{
	wp_enqueue_style('wootheme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('wootheme-style', 'rtl', 'replace');

	// CSS files
	wp_enqueue_style('style_css', get_template_directory_uri() . '/assets/css/style.css', array(), time(), 'all');
	wp_enqueue_style('bootstrap_min_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), time(), 'all');
	wp_enqueue_style('owl_carousel_css', get_template_directory_uri() . '/assets/css/plugins/owl-carousel/owl.carousel.css', array(), time(), 'all');
	wp_enqueue_style('magnific_popup_css', get_template_directory_uri() . '/assets/css/plugins/magnific-popup/magnific-popup.css', array(), time(), 'all');
	wp_enqueue_style('jquery_countdown_css', get_template_directory_uri() . '/assets/css/plugins/jquery.countdown.css', array(), time(), 'all');
	wp_enqueue_style('skin_demo_4_css', get_template_directory_uri() . '/assets/css/skins/skin-demo-4.css', array(), time(), 'all');
	wp_enqueue_style('demo_4_css', get_template_directory_uri() . '/assets/css/demos/demo-4.css', array(), time(), 'all');
	wp_enqueue_style('line_awesome_min_css', get_template_directory_uri() . '/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css', array(), time(), 'all');

	// js Script Files
	wp_enqueue_script('jquery_min_js', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), time(), true);
	wp_enqueue_script('bootstrap_bundle_min_js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), time(), true);
	wp_enqueue_script('jquery_hoverIntent.min_js', get_template_directory_uri() . '/assets/js/jquery.hoverIntent.min.js', array(), time(), true);
	wp_enqueue_script('superfish_min_js', get_template_directory_uri() . '/assets/js/superfish.min.js', array(), time(), true);
	wp_enqueue_script('owl_carousel.min_js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), time(), true);
	wp_enqueue_script('bootstrap_input_spinner_js', get_template_directory_uri() . '/assets/js/bootstrap-input-spinner.js', array(), time(), true);
	wp_enqueue_script('jquery_plugin_min_js', get_template_directory_uri() . '/assets/js/jquery.plugin.min.js', array(), time(), true);
	wp_enqueue_script('jquery_magnific_popup_min_js', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), time(), true);
	wp_enqueue_script('jquery_countdown.min_js', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array(), time(), true);
	wp_enqueue_script('main_js', get_template_directory_uri() . '/assets/js/main.js', array(), time(), true);
	wp_enqueue_script('demo_4_js', get_template_directory_uri() . '/assets/js/demos/demo-4.js', array(), time(), true);



	wp_enqueue_script('wootheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'wootheme_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Two-shortcode version:
 * 1) [child_category_tabs_nav parent="popular-category"]
 * 2) [child_category_tabs_content parent="popular-category" limit="12"]
 */

add_shortcode('child_category_tabs_nav', 'cc_tabs_nav_shortcode');
add_shortcode('child_category_tabs_content', 'cc_tabs_content_shortcode');

/**
 * Helper — get parent term object from slug or ID
 */
function cc_get_parent_term( $parent ) {
    if ( empty( $parent ) ) {
        return false;
    }
    if ( is_numeric( $parent ) ) {
        return get_term_by( 'id', intval( $parent ), 'product_cat' );
    }
    return get_term_by( 'slug', sanitize_text_field( $parent ), 'product_cat' );
}

/**
 * Shortcode: nav only
 * Usage: [child_category_tabs_nav parent="popular-category"]
 */
function cc_tabs_nav_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'parent' => '',
    ), $atts, 'child_category_tabs_nav' );

    $parent_term = cc_get_parent_term( $a['parent'] );
    if ( ! $parent_term || is_wp_error( $parent_term ) ) {
        return '<p>' . esc_html__( 'Invalid parent category.', 'woocommerce' ) . '</p>';
    }

    $child_terms = get_terms( array(
        'taxonomy'   => 'product_cat',
        'parent'     => $parent_term->term_id,
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ) );

    if ( empty( $child_terms ) || is_wp_error( $child_terms ) ) {
        return '<p>' . esc_html__( 'No child categories found.', 'woocommerce' ) . '</p>';
    }

    // IDs use parent id for uniqueness
    $parent_id = intval( $parent_term->term_id );
    $html = '<ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">';

    // All tab
    $all_tab_id = 'cc-' . $parent_id . '-all';
    $html .= '<li class="nav-item">';
    $html .= '<a class="nav-link active" id="' . esc_attr( $all_tab_id ) . '-link" data-toggle="tab" href="#' . esc_attr( $all_tab_id ) . '" role="tab" aria-controls="' . esc_attr( $all_tab_id ) . '" aria-selected="true">' . esc_html__( 'All', 'woocommerce' ) . '</a>';
    $html .= '</li>';

    foreach ( $child_terms as $term ) {
        $tab_id = 'cc-' . $parent_id . '-' . intval( $term->term_id );
        $html .= '<li class="nav-item">';
        $html .= '<a class="nav-link" id="' . esc_attr( $tab_id ) . '-link" data-toggle="tab" href="#' . esc_attr( $tab_id ) . '" role="tab" aria-controls="' . esc_attr( $tab_id ) . '" aria-selected="false">' . esc_html( $term->name ) . '</a>';
        $html .= '</li>';
    }

    $html .= '</ul>';

    return $html;
}

/**
 * Shortcode: tab content + carousels
 * Usage: [child_category_tabs_content parent="popular-category" limit="12"]
 */
function cc_tabs_content_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'parent' => '',
        'limit'  => 12,
    ), $atts, 'child_category_tabs_content' );

    $parent_term = cc_get_parent_term( $a['parent'] );
    if ( ! $parent_term || is_wp_error( $parent_term ) ) {
        return '<p>' . esc_html__( 'Invalid parent category.', 'woocommerce' ) . '</p>';
    }

    $child_terms = get_terms( array(
        'taxonomy'   => 'product_cat',
        'parent'     => $parent_term->term_id,
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ) );

    if ( empty( $child_terms ) || is_wp_error( $child_terms ) ) {
        return '<p>' . esc_html__( 'No child categories found.', 'woocommerce' ) . '</p>';
    }

    // Owl options
    $owl_options = array(
        'nav' => true,
        'dots' => true,
        'margin' => 20,
        'loop' => false,
        'responsive' => array(
            '0'    => array('items' => 2),
            '480'  => array('items' => 2),
            '768'  => array('items' => 3),
            '992'  => array('items' => 4),
            '1200' => array('items' => 5),
        ),
    );
    $data_options = esc_attr( wp_json_encode( $owl_options ) );

    $parent_id = intval( $parent_term->term_id );
    $child_ids = wp_list_pluck( $child_terms, 'term_id' );

    ob_start();

    echo '<div class="tab-content tab-content-carousel just-action-icons-sm">';

    // ALL pane
    $all_tab_id = 'cc-' . $parent_id . '-all';
    ?>
    <div class="tab-pane p-0 fade show active" id="<?php echo esc_attr( $all_tab_id ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $all_tab_id ); ?>-link">
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='<?php echo $data_options; ?>'>
            <?php
            // Query products across all child categories
            $args_all = array(
                'post_type' => 'product',
                'posts_per_page' => intval( $a['limit'] ),
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $child_ids,
                        'operator' => 'IN',
                    ),
                ),
            );

            $q_all = new WP_Query( $args_all );
            if ( $q_all->have_posts() ) {
                while ( $q_all->have_posts() ) {
                    $q_all->the_post();
                    $product = wc_get_product( get_the_ID() );
                    // Use the same product markup you provided earlier (trimmed to essentials)
                    $prod_link = get_permalink();
                    $img_html = has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'woocommerce_thumbnail', array('class' => 'product-image') ) : ( function_exists('wc_placeholder_img') ? wc_placeholder_img( 'woocommerce_thumbnail' ) : '<img src="' . esc_url( wc_placeholder_img_src() ) . '" class="product-image" />' );
                    $terms = wp_get_post_terms( get_the_ID(), 'product_cat' );
                    $prod_cat_html = !empty($terms) ? '<a href="' . esc_url( get_term_link( $terms[0] ) ) . '">' . esc_html( $terms[0]->name ) . '</a>' : '';
                    $price_html = $product ? $product->get_price_html() : '';
                    $avg_rating = $product ? (float) $product->get_average_rating() : 0;
                    $rating_count = $product ? (int) $product->get_rating_count() : 0;
                    $rating_percent = $avg_rating > 0 ? ( ( $avg_rating / 5 ) * 100 ) : 0;
                    ?>
                    <div class="product product-2">
                        <figure class="product-media">
                            <?php if ( $product && method_exists( $product, 'is_featured' ) && $product->is_featured() ) : ?>
                                <span class="product-label label-circle label-top"><?php echo esc_html__('Top', 'woocommerce'); ?></span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url( $prod_link ); ?>"><?php echo $img_html; ?></a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist" title="<?php echo esc_attr__('Add to wishlist', 'woocommerce'); ?>"></a>
                            </div>
                            <div class="product-action">
                                <a href="<?php echo esc_url( add_query_arg( array('add-to-cart' => get_the_ID()), home_url('/') ) ); ?>" class="btn-product btn-cart"><span><?php echo esc_html__('add to cart','woocommerce'); ?></span></a>
                                <a href="#" class="btn-product btn-quickview"><span><?php echo esc_html__('quick view','woocommerce'); ?></span></a>
                            </div>
                        </figure>
                        <div class="product-body">
                            <div class="product-cat"><?php echo $prod_cat_html; ?></div>
                            <h3 class="product-title"><a href="<?php echo esc_url( $prod_link ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
                            <div class="product-price"><?php echo wp_kses_post( $price_html ); ?></div>
                            <div class="ratings-container">
                                <div class="ratings"><div class="ratings-val" style="width: <?php echo esc_attr( $rating_percent ); ?>%;"></div></div>
                                <span class="ratings-text">( <?php echo intval( $rating_count ); ?> <?php echo esc_html__('Reviews','woocommerce'); ?> )</span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo '<p>' . esc_html__( 'No products found.', 'woocommerce' ) . '</p>';
            }
            ?>
        </div>
    </div>
    <?php

    // Individual child panes
    foreach ( $child_terms as $term ) {
        $tab_id = 'cc-' . $parent_id . '-' . intval( $term->term_id );
        ?>
        <div class="tab-pane p-0 fade" id="<?php echo esc_attr( $tab_id ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $tab_id ); ?>-link">
            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='<?php echo $data_options; ?>'>
                <?php
                $args_child = array(
                    'post_type' => 'product',
                    'posts_per_page' => intval( $a['limit'] ),
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => intval( $term->term_id ),
                            'operator' => 'IN',
                        ),
                    ),
                );
                $q_child = new WP_Query( $args_child );
                if ( $q_child->have_posts() ) {
                    while ( $q_child->have_posts() ) {
                        $q_child->the_post();
                        $product = wc_get_product( get_the_ID() );
                        $prod_link = get_permalink();
                        $img_html = has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'woocommerce_thumbnail', array('class' => 'product-image') ) : ( function_exists('wc_placeholder_img') ? wc_placeholder_img( 'woocommerce_thumbnail' ) : '<img src="' . esc_url( wc_placeholder_img_src() ) . '" class="product-image" />' );
                        $prod_cat_html = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
                        $price_html = $product ? $product->get_price_html() : '';
                        $avg_rating = $product ? (float) $product->get_average_rating() : 0;
                        $rating_count = $product ? (int) $product->get_rating_count() : 0;
                        $rating_percent = $avg_rating > 0 ? ( ( $avg_rating / 5 ) * 100 ) : 0;
                        ?>
                        <div class="product product-2">
                            <figure class="product-media">
                                <?php if ( $product && method_exists( $product, 'is_featured' ) && $product->is_featured() ) : ?>
                                    <span class="product-label label-circle label-top"><?php echo esc_html__('Top', 'woocommerce'); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $prod_link ); ?>"><?php echo $img_html; ?></a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="<?php echo esc_attr__('Add to wishlist', 'woocommerce'); ?>"></a>
                                </div>
                                <div class="product-action">
                                    <a href="<?php echo esc_url( add_query_arg( array('add-to-cart' => get_the_ID()), home_url('/') ) ); ?>" class="btn-product btn-cart"><span><?php echo esc_html__('add to cart','woocommerce'); ?></span></a>
                                    <a href="#" class="btn-product btn-quickview"><span><?php echo esc_html__('quick view','woocommerce'); ?></span></a>
                                </div>
                            </figure>
                            <div class="product-body">
                                <div class="product-cat"><?php echo $prod_cat_html; ?></div>
                                <h3 class="product-title"><a href="<?php echo esc_url( $prod_link ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
                                <div class="product-price"><?php echo wp_kses_post( $price_html ); ?></div>
                                <div class="ratings-container">
                                    <div class="ratings"><div class="ratings-val" style="width: <?php echo esc_attr( $rating_percent ); ?>%;"></div></div>
                                    <span class="ratings-text">( <?php echo intval( $rating_count ); ?> <?php echo esc_html__('Reviews','woocommerce'); ?> )</span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p>' . esc_html__( 'No products found in this category.', 'woocommerce' ) . '</p>';
                }
                ?>
            </div>
        </div>
        <?php
    }

    echo '</div>'; // end tab-content

    return ob_get_clean();
}
