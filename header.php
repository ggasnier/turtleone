<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>    
    <?php wp_head(); ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/site.webmanifest">
<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/safari-pinned-tab.svg" color="#679436">
<meta name="msapplication-TileColor" content="#679436">
<meta name="theme-color" content="#679436">
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="header">
    <div class="header-wrapper">
      <a href="<?php echo home_url('/'); ?>" class="header-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="La Totrue Facile">
        <span>La Tortue Facile</span>
      </a>
<div class="header-menu">
  <div class="header-menu-hamburger"><span class="dashicons dashicons-menu-alt"></span></div>
      
      <?php wp_nav_menu([
        'menu_class' => 'header-menu-items',
        'menu_id' => 'menu',
        'container' => '',
        'theme_location' => 'primary',
      ]); ?>
</div>
    </div>
  </header>


<main class="main">
  <div class="main-wrapper">

  <?php if (function_exists('yoast_breadcrumb')) {
    if (!is_home() && !is_front_page() && !is_search()) {
      yoast_breadcrumb('<p class="breadcrumbs">', '</p>');
    }
  }
?>
