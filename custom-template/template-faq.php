<?php
// Template Name: FAQ Template

get_header();
$dir_path = get_template_directory_uri();
?>



<main class="main">
    <?php
    $banner_image = get_field('banner_image') ?? ['url' => '<?php echo $dir_path?>/assets/images/page-header-bg.jpg', 'alt' => 'BG Image'];
    $section_title = get_field('section_title') ?? 'F.A.Q<span>Pages</span>';
    $faq_qa_section = get_field('faq_qa_section') ?? [];
    ?>
    <div class="page-header text-center" style="background-image: url('<?php echo $banner_image['url'] ?>')">
        <div class="container">
            <h1 class="page-title"><?php echo $section_title ?></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <?php
            //  Loop through FAQ Q&A array
            if (!empty($faq_qa_section)):
                $i = 1;
                foreach ($faq_qa_section as $faq_section) {
                    $section_title = $faq_section['question_title'] ?? '';
                    $faq_qas = $faq_section['faq_qas'] ?? [];
                    ?>
                    <h2 class="title text-center mb-3"><?php echo $section_title ?></h2><!-- End .title -->
                    <div class="accordion accordion-rounded" id="accordion-<?php echo $i?>">
                            <?php if (!empty($faq_qas)): ?>
                            <?php
                            $j =1;
                            foreach ($faq_qas as $faq) {
                                $que = $faq['que'] ?? '';
                                $ans = $faq['ans'] ?? '';
                                ?>
                                <div class="card card-box card-sm bg-light">
                                    <div class="card-header" id="heading<?php echo $i?>-<?php echo $j?>">
                                        <h2 class="card-title">
                                            <a role="button" data-toggle="collapse" href="#collapse<?php echo $i?>-<?php echo $j?>" aria-expanded="false" class="collapsed"
                                                aria-controls="collapse<?php echo $i?>-<?php echo $j?>">
                                                <?php echo $que ?>
                                            </a>
                                        </h2>
                                    </div><!-- End .card-header -->
                                    <div id="collapse<?php echo $i?>-<?php echo $j?>" class="collapse" aria-labelledby="heading<?php echo $i?>-<?php echo $j?>" data-parent="#accordion-<?php echo $i?>">
                                        <div class="card-body">
                                            <?php echo $ans ?>
                                        </div><!-- End .card-body -->
                                    </div><!-- End .collapse -->
                                </div><!-- End .card -->
                            <?php 
                            $j++;
                            } 
                        endif;
                            ?>
                        </div><!-- End .accordion -->
                    <?php 
                $i++;
                }
            endif;
            ?>
        </div><!-- End .container -->
    </div><!-- End .page-content -->


</main><!-- End .main -->


<?php get_footer() ?>