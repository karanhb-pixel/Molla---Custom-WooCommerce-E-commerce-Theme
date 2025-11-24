<?php
// Template Name: Shop Template

get_header();
$dir_path = get_template_directory_uri();
?>

<main class="main">
    <div class="container for-you">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Shop</h2><!-- End .title -->
            </div><!-- End .heading-left -->

            <div class="heading-right">
                <a href="#" class="title-link">View All Recommendadion <i class="icon-long-arrow-right"></i></a>
            </div><!-- End .heading-right -->
        </div><!-- End .heading -->

        <div class="products">
            <!-- Shortcode for getting products from WooCommerce  -->
            <?php echo do_shortcode('[products paginate="true" limit="8"  columns="4"]'); ?>
        </div><!-- End .products -->
    </div><!-- End .container -->

</main>
<?php get_footer() ?>