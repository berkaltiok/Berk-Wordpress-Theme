<?php $version = "1.0.0"; ?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?=bloginfo('template_url')?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=bloginfo('template_url')?>/assets/css/jquery.mmenu.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="<?=bloginfo("stylesheet_url")?>?v=<?=$version?>">

    <title><?php wp_title('-', true, 'right'); ?></title>

    <meta name="title" content="<?php wp_title('-', true, 'right'); ?>">
    <meta name="theme-color" content="#ffffff">
    <meta name="author" content="Berk Altıok">
    <meta name="owner" content="Berk Altıok">
    <meta name="copyright" content="(c) 2020">
    <meta name="rating" content="General">
    <meta name="keywords" content="Berk Wordpress Theme"/>
    
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="header">
      <div class="container d-flex justify-content-between align-items-center">
        <h1 class="header__logo"><a href="<?=bloginfo('url')?>">Berk <span>Altıok</span></a></h1>
        <nav class="header__nav">
          <?php
            wp_nav_menu(array(
              "theme_location" => "header-menu",
              "container" => false,
              "item_spacing" => "asd"
            ));
          ?>
        </nav>
        <div class="header__mobile">
          <a title="Menu" href="#mobileMenu"><i class="fas fa-bars"></i></a>
          <nav id="mobileMenu">
            <?php
              wp_nav_menu(array(
                "theme_location" => "header-menu",
                "container" => false,
                "item_spacing" => "asd"
              ));
            ?>
          </nav>
        </div>
      </div>
    </div>