<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>

    <title>Marie Dvorzak</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="description" content="I am a passionate programmer and visual artist based in Vienna, currently specializing in Frontend Development and UI-Design with Vue, React and Three.js">
    <meta name="author" content="Marie Dvorzak">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<? bloginfo('stylesheet_url') ?>">
    <?php
    function theme_enqueue_styles()
    {
        // wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
        wp_enqueue_style('parent-style', get_template_directory_uri() . '/scss/scss.css');
    }
    add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

    ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.0.0/p5.min.js"></script> -->
    <!-- <script type="text/javascript">
        const templateUrl = '<?= get_bloginfo("template_url"); ?>';
    </script> -->

    <? wp_head(); ?>
    <script src="<?php bloginfo('template_url'); ?>/js/sketch.js"></script>


</head>

<body class="">
    <header id="" class="header header-mobile container-fluid">
        <?php $page = get_page_by_path( 'about' );?>
        <div id="me-link"></div>
        <a class="work selected" href="<?php echo get_home_url() ?>">Work</a>
        <a class="" href="<?php echo get_the_title( $page ); ?>">About</a>
        <p class="current-alert">Currently based in Vienna
            and open for <strong>Freelance work</strong></p>
    </header>

    <div class="cursor cursor--small"></div>
    <canvas class="cursor cursor--canvas" resize></canvas>
    <section id="main">
        <div class="absolute pin-t mt-16 mr-6 w-full z-50">


            <ul class="name inline toggleabout text--sm text--nav headline--sm texthover texthover-up pr-3" target="_blank" href="https://www.instagram.com/madvo.design/">
                <!-- <img id="" alt="about me ring" class="info-ring" src="<?php bloginfo('stylesheet_directory'); ?>/assets/info-ring.png"> -->
                <li class="header-nav">
                    <!-- <a class="bottomNav work active" href="<?php echo get_home_url() ?>">Work</a>
                    <a class="bottomNav" href="<?php echo get_page_link(780); ?>">About</a>
                    <a class="bottomNav" href="mailto:mariedvorzak@gmail.com?Subject=Hi!">contact</a> -->
                </li>


            </ul>
        </div>



        <!-- ///////////////////////////////WHEEL -->
        <section class="greeting container-fluid">
            <div id="container"></div>
            <h2> 
                <!-- <span style="background-image: url('<?php bloginfo('stylesheet_directory'); ?>/assets/marie.png');" class="mini-me"></span> -->
                <span class="serif">Visual Designer, three.js programmer</span>
                <!-- <span class="mini-me video-bg-container"> -->
                    <!-- <video width="55" height="55" autoplay loop muted>
                        <source src="<?php bloginfo('stylesheet_directory') ?>/assets/videos/cellular.mp4" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                    </video> -->
                </span> and future Information Design student at Design Academy Eindhoven. </h2>

                <h4>currently open for all sorts of freelance projects!</h4>
        </section>
        <section class="update">
            <h3>Selected Works</h3><span class="text-small">2015 - 2020</span>
            <?php
                    global $i;
                    global $post;
                    $args = array('category_name'  => 'latest-update', 'posts_per_page' => 1,); ///25 //2 for dev
                    $update = get_posts($args);
                    ?>
                    <?php foreach ($update as $post) : setup_postdata($post); 
                    $imageUpdate = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                    ?>
                    <div class="update-container container-fluid">
                    <img class="col-8" src="<?php echo $imageUpdate[0] ?>" alt="updated-image">
                    <div class="col-4">
                    <p><?php echo get_field('work-category') ?></p>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_field('update-description') ?></p>
                    </div>
                    </div>
                    <?php endforeach;
                    wp_reset_postdata(); ?>
        </section>
        <section class="works">
            <!-- <h3>Selected Works</h3><span class="text-small">2015-2020</span> -->
            <span class="work-filters">
                <a id="select-all" class="filter-selected">All</a>
                <a id="select-web-non-commercial">Web Non-Commercial</a>
                <a id="select-web-commercial">Web Commercial</a>
                <a id="select-creative-coding">Creative Coding</a>

            </span>
            <div class="works-container container-fluid">
                <div class="small-section col-12 col-lg-4">
                    <?php
                    global $i;
                    global $post;
                    $args = array('category_name'  => 'post-small', 'posts_per_page' => -1,); ///25 //2 for dev
                    $work = get_posts($args);
                    ?>
                    <?php global $i;
                    $i = 0; ?>
                    <?php foreach ($work as $post) : setup_postdata($post); ?>

                        <?php if (has_post_thumbnail($post->ID) && !get_field('video-bg-link')) : ?>
                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                        <?php endif; ?>
                        <a class="item <?php echo get_field('work-category') ?>" style="background-image: url('<?php echo $image[0]; ?>');" href="<?php echo get_permalink($post->ID) ?>">
                            <?php if (get_field('video-bg-link')) : ?>
                                <div class="embed-container video-bg-container">
                                    <video width="320" height="240" autoplay loop muted>
                                        <source src="<?php bloginfo('stylesheet_directory'); ?><?php the_field('video-bg-link'); ?>" type="video/mp4">
                                        <source src="movie.ogg" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            <?php endif; ?>
                            <div class="" style="background-image: url('<?php echo $image[0]; ?>');">
                                <img class="more-button" alt="more-button" src="<?php bloginfo('stylesheet_directory'); ?>/assets/more-button.png">
                                <span class="position-absolute item-text">
                                    <h3 class="">
                                        <span class="">
                                            <?php
                                            $i += 1;
                                            // echo "0" . $i . " "; ?>
                                        </span>

                                        <?php the_title(); ?>
                                    </h3>
                                    <span class="text-subheadline">
                                        <span class="text-indicator">
                                            <?php
                                            echo "0" . $i . " "; ?>
                                        </span>
                                        <?php $posttags = get_the_tags();
                                        if ($posttags) {
                                            foreach ($posttags as $tag) {
                                                echo $tag->name . ' ';
                                            }
                                        }
                                        ?>
                                    </span>
                                </span>
                            </div>
                        </a>

                    <?php endforeach;
                    wp_reset_postdata(); ?>
                </div>

                <div class="big-section col-12 col-lg-8">
                    <?php
                    global $i;
                    global $post;
                    $args = array('category_name'  => 'post-big', 'posts_per_page' => -1,); ///25 //2 for dev
                    $work = get_posts($args);
                    ?>
                    <?php foreach ($work as $post) : setup_postdata($post); ?>
                        <?php if (has_post_thumbnail($post->ID)) : ?>
                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                        <?php endif; ?>
                        <a class="item <?php echo get_field('work-category') ?>" style="background-image: url('<?php echo $image[0]; ?>');" href="<?php echo get_permalink($post->ID) ?>">
                            <?php if (get_field('image_mobile')) : ?>
                            <?php endif; ?>
                            <img class="more-button" alt="more-button" src="<?php bloginfo('stylesheet_directory'); ?>/assets/more-button.png">
                            <span class="position-absolute item-text">
                                <h3 class="">
                                    <span class="">
                                        <?php
                                        $i += 1;
                                        // echo "0" . $i . " "; ?>
                                    </span>
                                    <?php the_title(); ?>
                                </h3>
                                <span class="text-subheadline">
                                    <?php $posttags = get_the_tags();
                                    if ($posttags) {
                                        foreach ($posttags as $tag) {
                                            echo $tag->name . ' ';
                                        }
                                    }
                                    ?>
                                </span>
                            </span>

                        </a>

                    <?php endforeach;
                    wp_reset_postdata(); ?>
                    <?php
                    global $i;
                    global $post;
                    $args = array('category_name'  => 'post-long', 'posts_per_page' => -1,); ///25 //2 for dev
                    $work = get_posts($args);
                    ?>
                    <?php foreach ($work as $post) : setup_postdata($post); ?>
                        <?php if (has_post_thumbnail($post->ID) && !get_field('video-bg-link')) : ?>
                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                        <?php endif; ?>
                        <a class="item item-long  <?php echo get_field('work-category') ?>" style="background-image: url('<?php if (!get_field('video-bg-link')) : echo $image[0];
                                                                                                                            endif; ?>');" href="<?php echo get_permalink($post->ID) ?>">
                            <?php if (get_field('video-bg-link')) : ?>
                                <div class="embed-container video-bg-container">
                                    <video width="320" height="240" autoplay loop muted>
                                        <source src="<?php bloginfo('stylesheet_directory'); ?><?php the_field('video-bg-link'); ?>" type="video/mp4">
                                        <source src="movie.ogg" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            <?php endif; ?>
                            <?php if (get_field('image_mobile')) : ?>
                            <?php endif; ?>
                            <img class="more-button" alt="more-button" src="<?php bloginfo('stylesheet_directory'); ?>/assets/more-button.png">

                            <span class="position-absolute item-text">
                                <h3 class="">
                                    <span class="">
                                        <?php
                                        $i += 1;
                                        // echo "0" . $i . " "; ?>
                                    </span>
                                    <?php the_title(); ?>
                                </h3>
                                <span class="text-subheadline">
                                    <?php $posttags = get_the_tags();
                                    if ($posttags) {
                                        foreach ($posttags as $tag) {
                                            echo $tag->name . ' ';
                                        }
                                    }
                                    ?>
                                </span>
                            </span>

                        </a>

                    <?php endforeach;
                    wp_reset_postdata(); ?>
                </div>


            </div>
        </section>
        <section class="section-insta">
            <?php /*
                    $filter = array('category_name'  => 'insta', 'posts_per_page' => -1,); ///25 //2 for dev
                    $insta = get_posts($filter);
                    ?>
                    <?php foreach ($insta as $post) : setup_postdata($post); 
                    $content = apply_filters('the_content', $post->post_content);
                    echo $content;
                    ?>

                    <?php endforeach;
                    wp_reset_postdata(); */ ?>
        </section>
        <!-- <section class="contact-section">
            <h3>Let's grab a coffee together!</h3>
            <ul class="contact-links">
                <li>E-Mail</li>
                <li>Behance</li>
                <li>Vimeo</li>

            </ul>
        </section> -->
    </section>
    <?php require(dirname(__FILE__) . '/footer.php'); ?>

    

</body>
<footer>
    <?php
    wp_enqueue_script('/js/main.js');
    ?>
</footer>

</html>