<?php
// Template Name: Blog Template

get_header();
$dir_path = get_template_directory_uri();
?>


<main class="main">
    <?php
    $banner_image = get_field('banner_image') ?? ['url' => '<?php echo $dir_path?>/assets/images/page-header-bg.jpg'];
    $section_title = get_field('section_title') ?? 'Blog Classic';
    ?>
    <div class="page-header text-center" style="background-image: url('<?php echo $banner_image['url'] ?>')">
        <div class="container">
            <h1 class="page-title"><?php echo $section_title ?></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>
">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Classic</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <!-- get posts from server -->
                    <?php
                    $args = array(
                        'numberposts' => 5,          // number of posts
                        'post_type' => 'post',     // type of post: 'post', 'page', 'product', etc.
                        'orderby' => 'date',     // order by date
                        'order' => 'DESC',     // newest first
                        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()):
                        while ($query->have_posts()):
                            $query->the_post();

                            ?>
                            <article class="entry">
                                <figure class="entry-media">
                                    <a href="<?php the_permalink()?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                                            alt="<?php the_title(); ?>">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <span class="entry-author">
                                            by <a href="<?php the_permalink()?>"><?php the_author() ?></a>
                                        </span>
                                        <span class="meta-separator">|</span>
                                        <a href="<?php the_permalink()?>"><?php echo get_the_date('M d, Y'); ?>
                                        </a>
                                        <span class="meta-separator">|</span>
                                        <a href="<?php the_permalink()?>"><?php echo get_comments_number(); ?> Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink()?>"><?php the_title() ?></a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in
                                        <?php
                                        $cats = get_the_category(); // returns array of WP_Term objects or empty
                                
                                        if (!empty($cats) && !is_wp_error($cats)) {
                                            foreach ($cats as $cat) {
                                                // $cat->term_id, $cat->name, $cat->slug, $cat->term_taxonomy_id
                                                echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>,';
                                            }
                                        }
                                        ?>
                                    </div><!-- End .entry-cats -->

                                    <div class="entry-content">
                                        <p><?php the_excerpt() ?></p>
                                        <a href="<?php echo get_permalink(); ?>" class="read-more">Continue Reading</a>
                                    </div><!-- End .entry-content -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                            <?php
                        endwhile;
                        ?>

                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php
                                echo paginate_links(array(
                                    'total' => $query->max_num_pages,
                                ));
                                ?>
                            </ul>
                        </nav>
                        <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <h3 class="widget-title">Search</h3><!-- End .widget-title -->

                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                <label for="ws" class="sr-only">Search in blog</label>

                                <input type="search" class="form-control" name="s" id="ws" placeholder="Search in blog"
                                    value="<?php echo get_search_query(); ?>" required>

                                <input type="hidden" name="post_type" value="post">

                                <button type="submit" class="btn">
                                    <i class="icon-search"></i>
                                    <span class="sr-only">Search</span>
                                </button>
                            </form>

                        </div><!-- End .widget -->

                        <div class="widget widget-cats">
                            <h3 class="widget-title">Categories</h3><!-- End .widget-title -->

                            <?php
                            $parent_cat = get_category_by_slug('blog');
                            $subcats = get_categories([
                                'taxonomy' => 'category',
                                'parent' => $parent_cat->term_id,
                                'hide_empty' => false,
                            ]);

                            echo '<ul>';
                            foreach ($subcats as $cat) {
                                echo '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '<span>(' . intval($cat->count) . ')</span></a></li>';
                            }
                            echo '</ul>';
                            ?>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">Popular Posts</h3><!-- End .widget-title -->

                            <ul class="posts-list">
                                <?php

                                $popular_posts = get_posts([
                                    'numberposts' => 5,
                                    'orderby' => 'comment_count', // sort by comment count
                                    'order' => 'DESC',
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                ]);

                                if ($popular_posts) {
                                    foreach ($popular_posts as $post) {
                                        setup_postdata($post);
                                        $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                        $permalink = get_the_permalink();
                                        $author = get_the_author();
                                        $date = get_the_date('M d, Y');
                                        $excerpt = wp_trim_words(get_the_excerpt(), 15, ' [Read More]');
                                        ?>
                                        <li>
                                            <figure>
                                                <a href="<?php $permalink ?>">
                                                    <img src="<?php echo $image ?>" alt="<?php $author ?>">
                                                </a>
                                            </figure>

                                            <div>
                                                <span><?php echo $date ?></span>
                                                <h4><a href="<?php echo $permalink ?>"><?php echo $excerpt ?></a></h4>
                                            </div>
                                        </li>
                                    <?php }
                                } ?>

                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">Browse Tags</h3><!-- End .widget-title -->

                            <div class="tagcloud">
                                <?php
                                $tags = get_tags();

                                foreach ($tags as $tag) {
                                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                                }
                                ?>
                            </div><!-- End .tagcloud -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<?php get_footer() ?>