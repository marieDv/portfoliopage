<?php /* Template Name: about */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset='utf-8'>

  <title>Marie Dvorzak</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <meta name="description" content="I am a passionate programmer and visual artist based in Vienna, currently specializing in Frontend Development and UI-Design with Vue, React and Three.js">
  <meta name="author" content="Marie Dvorzak">

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/brands.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/regular.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">

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


</head>
<header id="" class="header header-mobile container-fluid">
  <?php $page = get_page_by_path('about'); ?>
  <div id="me-link"></div>
  <a class="work" href="<?php echo get_home_url() ?>">Work</a>
  <a class="selected" href="<?php echo get_the_title($page); ?>">About</a>
  <p class="current-alert">Currently based in Vienna
    and open for <strong>Freelance work</strong></p>
</header>
<section class="container-fluid about">


  <!-- <img alt="me" id="portrait" src="<?php bloginfo('stylesheet_directory'); ?>/assets/derpme.jpg"> -->

  <div id="about-clients" class="about-clients  inline text-left">
    <h2 class="ic-headline--xl-xl">“Marie is a true pleasure to work with, her approach is goal oriented and passionate. She’s reliable and comes up with thoughtful ideas and input.”</h2>
    <h4>– Moritz Resl (Creative Director <a href="https://process.studio/">@ Process Studio</a>)</h4>
    <!-- <div class="education">
    <h3>Education</h3>
      <ul class="container container-fluid">
        <li class="update col-3"><span class="date">STARTING 2020</span> <h4>Master Information Design</h4><span class="location">Design Academy Eindhoven</span></li>
        <img class="col-1"src="<?php bloginfo('stylesheet_directory'); ?>/assets/arrow.png">
        <li class="col-3"><span class="date">2019</span> <h4>BSc in Mediatechnology and Design</h4><span class="location">FH Upper Austria</span></li>
        <img class="col-1"src="<?php bloginfo('stylesheet_directory'); ?>/assets/arrow.png">
        <li class="col-3"><span class="date">2015</span> <h4>Diploma in Graphic Design</h4><span class="location">Graphische Bundes Lehr- und Versuchsanstalt</span></li>
      </ul>
    </div> -->
    <div class="resume">


      <!-- <h3>Who I worked with: </h3> -->
      <div class="skill-list container flex">
        <ul class="col-xl-3 col-lg-12">
          <li>Skills & Focus:</li>
          <li>Digital Design</li>
          <li>UI/UX</li>
          <li>Three.js programming</li>
          <li>Frontend Development (React / Vue)</li>
        </ul>
        <ul class="col-xl-3 col-lg-12">
          <li>Agencies:</li>
          <li>Process Studio (Freelance)</li>
          <li>Wild (Intern Creative Development)</li>
          <li>Campaigning Bureau (Intern)</li>
        </ul>
        <ul class="col-xl-3 col-lg-12">
          <li>Clients:</li>
          <li>Care01</li>
          <li>Hosi Wien</li>
          <li>Schwarz Brillen</li>
          <li>Züricher Hochschule der Künste</li>
          <li>Ascendum Österreich</li>
          <li>FIV Wien</li>
          <li>Sabre Austria</li>
        </ul>
        <ul class="col-xl-3 col-lg-12">
          <li>Education:</li>
          <li>Master Information Design (starting 2020)</li>
          <li>BSc in Mediatechnology and Design</li>
          <li>Diploma in Graphic Design</li>
        </ul>
      </div>
    </div>

  </div>
  <!-- <div id="trigger3" class="indicators">Resume</div> -->



      <!-- <div class="download-resume-container">
        <a class="download-resume" href="<?php bloginfo('stylesheet_directory'); ?>/assets/dvorzak_marie_resume.pdf" download>Download Resume</a>
      </div> -->


  <div class="about-clients resume-section">
    <!-- <span id="" class="ic-headline--xl">My former internships gave me the opportunity to learn how to program and design from some of the leading companies in Austria and now I am more than eager to use that to make your projects awesome! 💥</span> -->
    <!-- <a href="<?php bloginfo('stylesheet_directory'); ?>/assets/dvorzak_marie_resume.pdf" download>Download Resume</a> -->
  </div>
  </div>



  <?php require(dirname(__FILE__) . '/footer.php'); ?>
</section>