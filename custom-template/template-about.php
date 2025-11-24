<?php
// Template Name: About Template

get_header();
$dir_path = get_template_directory_uri();
?>


<main class="main">
    <?php

    // banner section
    $banner_Section = get_field('banner');
    $bgimage = $banner_Section['banner_image'] ?? ['url' => '#', 'alt' => 'banner'];
    $banner_title = $banner_Section['banner_title'] ?? 'About Us';

    // Our Mission section
    $our_mission = get_field('our_mission');
    $our_mission_title = $our_mission['title'] ?? '';
    $our_mission_desc = $our_mission['description'] ?? '';

    // our_vision section
    $our_vision = get_field('our_vision');
    $our_vision_title = $our_vision['title'] ?? '';
    $our_vision_desc = $our_vision['description'] ?? '';

    // who_we_are section
    $who_we_are = get_field('who_we_are');
    $who_we_are_title = $who_we_are['title'] ?? '';
    $who_we_are_sub_title = $who_we_are['sub_title'] ?? '';
    $who_we_are_desc = $who_we_are['description'] ?? '';
    $who_we_are_link = $who_we_are['link'] ?? ['url' => '#', 'title' => 'Learn More'];
    $who_we_are_image_1 = $who_we_are['image_1'] ?? ['url' => '#', 'alt' => 'who_we_are_image'];
    $who_we_are_image_2 = $who_we_are['image_2'] ?? ['url' => '#', 'alt' => 'who_we_are_image'];


    // client_section
    $client_section = get_field('client_section');
    $client_section_title = $client_section['title'] ?? '';
    $client_section_desc = $client_section['description'] ?? '';
    $client_info_client_info = $client_section['client_info'] ?? [];

    // our_team section
    $our_team = get_field('our_team');
    $our_team_title = $our_team['title'] ?? '';
    $our_team_team_info = $our_team['team_info'] ?? [];


    // testimonial_section 
    $testimonial_section = get_field('testimonial_section');
    $testimonial_section_title = $testimonial_section['title'] ?? '';
    $testimonial_section_testimonies = $testimonial_section['testimonies'] ?? [];

    ?>
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">About us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <?php if (!empty($banner_Section)): ?>
        <div class="container">
            <div class="page-header page-header-big text-center"
                style="background-image: url(<?php echo $bgimage['url'] ?>)">
                <h1 class="page-title text-white"><?php echo $banner_title ?></h1>
            </div><!-- End .page-header -->
        </div><!-- End .container -->
    <?php endif; ?>
    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <?php if (!empty($our_vision)): ?>
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h2 class="title"><?php echo $our_vision_title ?></h2><!-- End .title -->
                        <p><?php echo $our_vision_desc ?> </p>
                    </div><!-- End .col-lg-6 -->
                <?php endif; ?>
                <?php if (!empty($our_mission)): ?>
                    <div class="col-lg-6">
                        <h2 class="title"><?php echo $our_mission_title ?></h2><!-- End .title -->
                        <p><?php echo $our_mission_desc ?></p>
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->
            <?php endif; ?>
            <div class="mb-5"></div><!-- End .mb-4 -->
        </div><!-- End .container -->

        <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
            <?php if (!empty($who_we_are)): ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 mb-3 mb-lg-0">
                            <h2 class="title"><?php echo $who_we_are_title ?></h2><!-- End .title -->
                            <p class="lead text-primary mb-3"><?php echo $who_we_are_sub_title ?></p>
                            <!-- End .lead text-primary -->
                            <p class="mb-2"><?php echo $who_we_are_desc ?></p>

                            <a href="<?php echo $who_we_are_link['url'] ?>"
                                class="btn btn-sm btn-minwidth btn-outline-primary-2">
                                <span><?php echo $who_we_are_link['title'] ?></span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .col-lg-5 -->

                        <div class="col-lg-6 offset-lg-1">
                            <div class="about-images">
                                <img src="<?php echo $who_we_are_image_1['url'] ?>"
                                    alt="<?php echo $who_we_are_image_1['alt'] ?>" class="about-img-front">
                                <img src="<?php echo $who_we_are_image_2['url'] ?>"
                                    alt="<?php echo $who_we_are_image_2['alt'] ?>" class="about-img-back">
                            </div><!-- End .about-images -->
                        </div><!-- End .col-lg-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            <?php endif; ?>
        </div><!-- End .bg-light-2 pt-6 pb-6 -->

        <div class="container">
            <?php if (!empty($client_section)): ?>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="brands-text">
                            <h2 class="title"><?php echo $client_section_title ?></h2><!-- End .title -->
                            <p><?php echo $client_section_desc ?></p>
                        </div><!-- End .brands-text -->
                    </div><!-- End .col-lg-5 -->
                    <div class="col-lg-7">
                        <div class="brands-display">
                            <div class="row justify-content-center">
                                <?php
                                if (!empty($client_info_client_info)) {
                                    foreach ($client_info_client_info as $client) {
                                        $link = $client['link'] ?? '#';
                                        $image = $client['logo'] ?? ['url' => '#', 'alt' => 'Client Image'];
                                        ?>
                                        <div class="col-6 col-sm-4">
                                            <a href="<?php echo $link ?>" class="brand">
                                                <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                                            </a>
                                        </div><!-- End .col-sm-4 -->
                                    <?php }
                                } ?>
                            </div><!-- End .row -->
                        </div><!-- End .brands-display -->
                    </div><!-- End .col-lg-7 -->
                </div><!-- End .row -->
            <?php endif; ?>

            <hr class="mt-4 mb-6">
            <?php if (!empty($our_team)): ?>
                <h2 class="title text-center mb-4"><?php echo $our_team_title ?></h2><!-- End .title text-center mb-2 -->

                <div class="row">
                    <?php
                    if (!empty($our_team_team_info)) {
                        foreach ($our_team_team_info as $team) {
                            $name = $team['name'] ?? '';
                            $designation = $team['position'] ?? '';
                            $description = $team['description'] ?? '';
                            $image = $team['image'] ?? ['url' => '#', 'alt' => 'Team Member'];
                            $facebook = $team['social_links']['facebook'] ?? '#';
                            $twitter = $team['social_links']['twitter'] ?? '#';
                            $instagram = $team['social_links']['instagram'] ?? '#';
                            ?>
                            <div class="col-md-4">
                                <div class="member member-anim text-center">
                                    <figure class="member-media">
                                        <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">

                                        <figcaption class="member-overlay">
                                            <div class="member-overlay-content">
                                                <h3 class="member-title"><?php echo $name ?><span><?php echo $designation ?></span>
                                                </h3>
                                                <!-- End .member-title -->
                                                <p><?php echo $description ?></p>
                                                <div class="social-icons social-icons-simple">
                                                    <a href="<?php echo $facebook ?>" class="social-icon" title="Facebook"
                                                        target="_blank"><i class="icon-facebook-f"></i></a>
                                                    <a href="<?php echo $twitter ?>" class="social-icon" title="Twitter"
                                                        target="_blank"><i class="icon-twitter"></i></a>
                                                    <a href="<?php echo $instagram ?>" class="social-icon" title="Instagram"
                                                        target="_blank"><i class="icon-instagram"></i></a>
                                                </div><!-- End .soial-icons -->
                                            </div><!-- End .member-overlay-content -->
                                        </figcaption><!-- End .member-overlay -->
                                    </figure><!-- End .member-media -->
                                    <div class="member-content">
                                        <h3 class="member-title"><?php echo $name ?><span><?php echo $designation ?></span></h3>
                                        <!-- End .member-title -->
                                    </div><!-- End .member-content -->
                                </div><!-- End .member -->
                            </div><!-- End .col-md-4 -->
                        <?php }
                    }
                    ?>

                </div><!-- End .row -->
            <?php endif; ?>
        </div><!-- End .container -->

        <div class="mb-2"></div><!-- End .mb-2 -->

        <div class="about-testimonials bg-light-2 pt-6 pb-6">
            <?php if (!empty($testimonial_section)): ?>
                <div class="container">
                    <h2 class="title text-center mb-3"><?php echo $testimonial_section_title ?></h2>
                    <!-- End .title text-center -->

                    <div class="owl-carousel owl-simple owl-testimonials-photo" data-toggle="owl" data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "1200": {
                                        "nav": true
                                    }
                                }
                            }'>
                        <?php

                        if (!empty($testimonial_section_testimonies)) {
                            foreach ($testimonial_section_testimonies as $testimony) {
                                $image = $testimony['image'] ?? ['url' => '#', 'alt' => 'User Image'];
                                $testimony = $testimony['testimony'] ?? '';
                                $name = $testimony['name'] ?? '';
                                $position = $testimony['position'] ?? '';
                                ?>
                                <blockquote class="testimonial text-center">
                                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
                                    <p>“ <?php echo $testimony ?> ”</p>
                                    <cite>
                                        <?php echo $name ?>
                                        <span><?php echo $position ?></span>
                                    </cite>
                                </blockquote><!-- End .testimonial -->
                            <?php }
                        }
                        ?>
                    </div><!-- End .testimonials-slider owl-carousel -->
                </div><!-- End .container -->
            <?php endif; ?>
        </div><!-- End .bg-light-2 pt-5 pb-6 -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php get_footer() ?>