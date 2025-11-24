<?php

use Automattic\WooCommerce\Blocks\BlockTypes\EmptyCartBlock;
// Template Name: Homepage Template
get_header();
$dir_path = get_template_directory_uri();
?>



<main class="main">
    <!-- Slider Section -->
    <?php
    $slider_Section = get_field('slider_section');
    ?>
    <div class="intro-slider-container mb-5">
        <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{
                        "dots": true,
                        "nav": false, 
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
            <?php
            foreach ($slider_Section as $section):
                $slider_image = $section['slider_image']['url'] ?? "$dir_path.'/assets/images/demos/demo-4/slider/slide-1.png'";
                $old_price = $section['old_price'] ?? '349,95';
                $new_price = $section['new_price'] ?? '279.99';
                $button_link = $section['button_link'] ?? ['url' => '#', 'target' => '_self', 'title' => 'Shop More'];
                $sub_title = $section['sub_title'] ?? '';
                $title = $section['title'] ?? '';

                ?>
                <div class="intro-slide" style="background-image: url(<?php echo $slider_image ?>);">
                    <div class="container intro-content">
                        <div class="row justify-content-end">
                            <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                <h3 class="intro-subtitle text-third"><?php echo $sub_title ?></h3>

                                <h1 class="intro-title"><?php echo $title ?></h1>


                                <div class="intro-price">
                                    <sup class="intro-old-price"><?php echo $old_price ?></sup>
                                    <span class="text-third">
                                        <?php echo $new_price ?>
                                    </span>
                                </div>

                                <a href="<?php echo $button_link['url'] ?>" target="<?php echo $button_link['target'] ?>"
                                    class="btn btn-primary btn-round">
                                    <span><?php echo $button_link['title'] ?></span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <span class="slider-loader"></span>
    </div>

    <!-- Popular Categories Section -->
    <div class="container">
        <h2 class="title text-center mb-4">Explore Popular Categories</h2><!-- End .title text-center -->

        <div class="cat-blocks-container">
            <div class="row">

                <?php
                $parent_slug = 'popular-categories';
                $parent_term = get_term_by('slug', $parent_slug, 'product_cat');

                if ($parent_term && !is_wp_error($parent_term)) {

                    // Get child categories (subcategories). hide_empty => false shows empty categories.
                    $child_terms = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'parent' => $parent_term->term_id,
                        'hide_empty' => false,
                        'orderby' => 'name',
                        'order' => 'ASC',
                    ));

                    if (!empty($child_terms) && !is_wp_error($child_terms)) {

                        foreach ($child_terms as $term) {

                            // Category link
                            $link = get_term_link($term);

                            // Category title
                            $title = $term->name;

                            // Try to get WooCommerce category image (term meta 'thumbnail_id')
                            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                            if ($thumbnail_id) {
                                // Choose a size: 'woocommerce_thumbnail', 'medium', 'full', etc.
                                $image_url = wp_get_attachment_image_url($thumbnail_id, 'woocommerce_thumbnail');
                            } else {
                                // Fallback placeholder (replace with your own placeholder path if you want)
                                $image_url = wc_placeholder_img_src(); // WooCommerce helper
                            }

                            // Output markup (same structure as your original)
                            ?>
                            <div class="col-6 col-sm-4 col-lg-2">
                                <a href="<?php echo esc_url($link); ?>" class="cat-block">
                                    <figure>
                                        <span>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                        </span>
                                    </figure>

                                    <h3 class="cat-block-title"><?php echo esc_html($title); ?></h3>
                                </a>
                            </div>
                        <?php }
                    }
                } ?>

            </div>
        </div>
    </div>

    <div class="mb-4"></div>

    <!-- Offer Section -->

    <div class="container">
        <div class="row justify-content-center">
            <?php

            $offer_Section = get_field('offer_section');
            if (!empty($offer_Section)) {
                foreach ($offer_Section as $section) {
                    $link = $section['link'] ?? '#';
                    $image = $section['image'] ?? '';
                    $sub_title = $section['subtitle'] ?? '';
                    $title = $section['title'] ?? '';
                    $button_link = $section['button_link'] ?? ['url' => '#', 'title' => 'Shop Now', 'target' => '_self'];
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="<?php echo $link ?>">
                                <img src="<?php echo $image ?>" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="<?php echo $link ?>"><?php echo $sub_title ?></a></h4>

                                <h3 class="banner-title"><a href="<?php echo $link ?>"><?php echo $title ?></a>
                                </h3>
                                <a href="<?php echo $button_link['url'] ?>" class="banner-link"
                                    target="<?php echo $button_link['target'] ?>"><?php echo $button_link['title'] ?><i
                                        class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>

        </div>
    </div>

    <div class="mb-3"></div>

    <?php
    $parent = 'popular-categories';
    $limit = 12;
    ?>
    <div class="container new-arrivals">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">New Arrivals</h2>
            </div>

            <div class="heading-right">
                <?php echo do_shortcode('[child_category_tabs_nav parent="' . esc_attr($parent) . '"]'); ?>
            </div>
        </div>

        <?php echo do_shortcode('[child_category_tabs_content parent="' . esc_attr($parent) . '" limit="' . intval($limit) . '"]'); ?>
    </div>


    <div class="mb-6"></div><!-- End .mb-6 -->

    <div class="container">
        <?php
        $top_deal_section = get_field('top_deal_section');
        if (!empty($top_deal_section)) {
            $bgimage = $top_deal_section['bgimage'] ?? "$dir_path.'/assets/images/demos/demo-4/bg-1.jpg'";
            $image = $top_deal_section['image'] ?? "$dir_path.'/assets/images/demos/demo-4/camera.png'";
            $text = $top_deal_section['text'] ?? 'Shop Today’s Deals <br><strong>Awesome Made Easy. HERO7 Black</strong>';
            $link = $top_deal_section['link'] ?? ['url' => '#', 'title' => 'Shop Now - $429.99'];
            ?>
            <div class="cta cta-border mb-5" style="background-image: url(<?php echo $bgimage ?>);">
                <img src="<?php echo $image ?>" alt="camera" class="cta-img">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="cta-content">
                            <div class="cta-text text-right text-white">
                                <p><?php echo $text ?></p>
                            </div><!-- End .cta-text -->
                            <a href="<?php echo $link['url'] ?>"
                                class="btn btn-primary btn-round"><span><?php echo $link['title'] ?></span><i
                                    class="icon-long-arrow-right"></i></a>
                        </div><!-- End .cta-content -->
                    </div><!-- End .col-md-12 -->
                </div><!-- End .row -->
            </div><!-- End .cta -->
        <?php } ?>
    </div><!-- End .container -->

    <div class="container">
        <?php

        $deal_and_outlet_section = get_field('deal_and_outlet_section');
        $title = $deal_and_outlet_section['title'] ?? 'Deals & Outlet';
        $sub_title = $deal_and_outlet_section['sub_title'] ?? 'Today’s deal and more';
        $deals = $deal_and_outlet_section['deals'] ?? [];
        $button_link = $deal_and_outlet_section['button_link'] ?? ['url' => '#', 'title' => 'Shop more Outlet deals'];
        ?>
        <div class="heading text-center mb-3">
            <h2 class="title"><?php echo $title ?></h2>
            <p class="title-desc"><?php echo $sub_title ?></p>
        </div>

        <div class="row">
            <?php
            if (!empty($deals)) {
                foreach ($deals as $deal) {
                    $deal_title = $deal['title'] ?? '';
                    $deal_bgimage = $deal['bgimage'] ?? '';
                    $deal_sub_title = $deal['sub_title'] ?? '';
                    $deal_content = $deal['content'] ?? ['url' => '#', 'title' => 'Shop'];
                    $deal_button_link = $deal['button_link'] ?? ['url' => '#', 'title' => 'Shop Now'];
                    $deal_countdonw = $deal['countdown'] ?? '+10h';
                    $deal_price = $deal['price'] ?? '';

                    ?>
                    <div class="col-lg-6 deal-col">
                        <div class="deal" style="background-image: url('<?php echo $deal_bgimage ?>);">
                            <div class="deal-top">
                                <h2><?php echo $deal_title ?></h2>
                                <h4><?php echo $deal_sub_title ?></h4>
                            </div>

                            <div class="deal-content">
                                <h3 class="product-title"><a
                                        href="<?php echo $deal_content['url'] ?>"><?php echo $deal_content['title'] ?></a>
                                </h3>

                                <div class="product-price">
                                    <?php echo $deal_price ?>
                                </div>

                                <a href="<?php echo $deal_button_link['url'] ?>"
                                    class="btn btn-link"><span><?php echo $deal_button_link['title'] ?></span><i
                                        class="icon-long-arrow-right"></i></a>
                            </div>

                            <div class="deal-bottom">
                                <div class="deal-countdown daily-deal-countdown" data-until="<?php echo $deal_countdonw ?>">
                                </div>

                            </div>
                        </div>
                    </div>
                <?php }
            } ?>

        </div><!-- End .row -->

        <div class="more-container text-center mt-1 mb-5">
            <a href="<?php echo $button_link['url'] ?>"
                class="btn btn-outline-dark-2 btn-round btn-more"><span><?php echo $button_link['title'] ?></span><i
                    class="icon-long-arrow-right"></i></a>
        </div>
    </div><!-- End .container -->

    <div class="container">
        <?php
        $client_section = get_field('client_section');
        ?>
        <hr class="mb-0">
        <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl" data-owl-options='{
                        "nav": false, 
                        "dots": false,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":5
                            },
                            "1024": {
                                "items":6
                            }
                        }
                    }'>
            <?php
            if (!empty($client_section)) {
                foreach ($client_section as $section) {
                    $link = $section['link'] ?? '#';
                    $image = $section['image'] ?? ['url' => "$dir_path.'/assets/images/brands/1.png'", 'alt' => 'Brand Name'];
                    ?>
                    <a href="<?php echo $link ?>" class="brand">
                        <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                    </a>
                <?php }
            } ?>

        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->

    <div class="bg-light pt-5 pb-6">
        <?php
            $parent = 'trending-products';
            $limit = 12;
        ?>
        <?php
        $trending_product_section = get_field('trending_product_section');
        ?>
        <div class="container trending-products">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">Trending Products</h2><!-- End .title -->
                </div><!-- End .heading-left -->

                <div class="heading-right">

                    <?php echo do_shortcode('[child_category_tabs_nav parent="' . esc_attr($parent) . '"]'); ?>
                    
                </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="row">
                <?php
                if (!empty($trending_product_section)) {
                    $banner_image = $trending_product_section['banner'] ?? ['url' => "$dir_path.'/assets/images/demos/demo-4/banners/banner-4.jpg'", 'alt' => 'banner'];
                    $link = $trending_product_section['link'] ?? '#';
                    ?>
                    <div class="col-xl-5col d-none d-xl-block">
                        <div class="banner">
                            <a href="<?php echo $link ?>">
                                <img src="<?php echo $banner_image['url'] ?>" alt="<?php echo $banner_image['alt'] ?>">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-xl-5col -->
                <?php } ?>

                <div class="col-xl-4-5col">
                    
                    <?php echo do_shortcode('[child_category_tabs_content parent="' . esc_attr($parent) . '" limit="' . intval($limit) . '"]'); ?>
                </div><!-- End .col-xl-4-5col -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-light pt-5 pb-6 -->

    <div class="mb-5"></div><!-- End .mb-5 -->

    <div class="container for-you">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Recommendation For You</h2><!-- End .title -->
            </div><!-- End .heading-left -->

            <div class="heading-right">
                <a href="#" class="title-link">View All Recommendadion <i class="icon-long-arrow-right"></i></a>
            </div><!-- End .heading-right -->
        </div><!-- End .heading -->

        <div class="products">
            <!-- Shortcode for getting products from WooCommerce  -->
            <?php echo do_shortcode('[products limit="8" columns="4"]'); ?>
        </div><!-- End .products -->
    </div><!-- End .container -->

    <div class="mb-4"></div><!-- End .mb-4 -->

    <div class="container">
        <hr class="mb-0">
    </div><!-- End .container -->

    <div class="icon-boxes-container bg-transparent">
        <div class="container">
            <div class="row">
                <?php
                $support_section = get_field('support_section');

                if (!empty($support_section)) {
                    foreach ($support_section as $section) {

                        $icon = $section['icon'] ?? 'icon-rocket';
                        $title = $section['title'] ?? '';
                        $desc = $section['description'] ?? '';
                        ?>
                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="<?php echo $icon ?>"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title"><?php echo $title ?></h3>
                                    <p><?php echo $desc ?></p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .icon-boxes-container -->
</main><!-- End .main -->

<?php get_footer() ?>