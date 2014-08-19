<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="196x196" href="images/touch/chrome-touch-icon-196x196.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <!-- build:css styles/components/main.min.css -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?> ">
    <!-- endbuild -->
    <?php wp_head() ?>
  </head>
  <body>
  <?php 
    
    echo '<div class="top-nav"></div>';
    wow_navigation_menu();
    
    if (is_front_page())
        wow_custom_header();
    