<?php
/*
 * Template Name: Marie Dvorzak'S Portfolio
 * Template Post Type: post
 */


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset='utf-8'>

  <title>Marie Dvorzak</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <meta name="description" content="I am a passionate programmer and visual artist based in Vienna, currently specializing in Frontend Development and UI-Design with Vue, React and Three.js">
  <meta name="author" content="Marie Dvorzak">

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
  <link src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TimelineMax.min.js" />
  <link rel="stylesheet" href="<? bloginfo('stylesheet_url') ?>">
  <?php
  function theme_enqueue_styles()
  {
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/scss/scss.css');
  }
  add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

  ?>
  <? wp_head(); ?>
  <header id="" class="header header-mobile container-fluid">
    <div id="me-link"></div>
    <a class="work selected" href="<?php echo get_home_url() ?>">Work</a>
    <a class="" href="<?php echo get_page_link(780); ?>">About</a>
    <p class="current-alert">Currently based in Vienna
      and open for <strong>Freelance work</strong></p>
  </header>
  <section class="container-fluid single">
    <span class="nav"><a class="back button" href="<?php echo get_home_url() ?>">back</a>

    <p class="index"><strong>

        <?php
        while (have_posts()) : the_post();

          $id = $post->ID;
          $currentPostId = $id;
        endwhile;
        global $i;
        global $post;
        $currentIndex = 0;
        $args = array('category' => 2); //25 //2 for dev
        $work = get_posts($args);
        ?>
        <?php foreach ($work as $post) : setup_postdata($post); ?>
          <?php $currentIndex += 1;
          if ($currentPostId === $id) {
            echo ("0" . $currentIndex);
          } ?>
        <?php endforeach;
        wp_reset_postdata(); ?>

      </strong> / <?php echo "0" . count_cat_post(2) ?>
      <!--   2 25 -->
        </p></span>
    <h2 class="title"><?php echo get_field('single-title'); ?></h2>
    <h3 class="subheadline"><?php echo get_field('single-subheadline') ?></h3>
    <p class="description"><?php echo get_field('description') ?></p>


    <?php
    global $currentPostId;
    while (have_posts()) : the_post();

      $id = $post->ID;
      $post = get_post($id);
      $content = apply_filters('the_content', $post->post_content);
      $currentPostId = $id;
      echo $content;
    endwhile;
    ?>

    <?php if (has_post_thumbnail($post->ID)) : ?>
      <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
    <?php endif; ?>
    <p class="hidden-thumbnail">
      <?php echo $image[0] ?>
    </p>
    <div id="overview-swiper-single" class="swiper-container overview-container">
      <div id="overview" class="quickOverview swiper-wrapper">
        <?php
        global $i;
        global $post;
        $currentIndex = 0;
        $args = array('category' => 25); //25 //2 for dev
        $work = get_posts($args);
        ?>
        <?php foreach ($work as $post) : setup_postdata($post); ?>
          <?php $currentIndex += 1;
          if ($currentPostId !== $id) { ?>


            <a class="swiper-slide single-slide" href="<?php echo get_permalink($post->ID) ?>">
              <?php
              $title = get_the_title();
              // echo str_replace('<br>', ' ', $title);
              echo $title;
              ?>
            </a>
          <?php }  ?>
        <?php endforeach; ?>
      </div>
    </div>
    </div>
    <?php require(dirname(__FILE__) . '/footer.php'); ?>
  </section>