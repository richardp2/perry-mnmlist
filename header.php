<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" 
        content="<?php bloginfo('html_type'); ?>; 
        charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title(''); ?></title>
    
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php 
    if ( is_singular() && get_option( 'thread_comments' ) ) 
        wp_enqueue_script( 'comment-reply' );
    
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>
<div id='wrapper' class='hfeed'>
   <header id='header' role='banner' class='textcenter' style='background: url(<?php perrymnmlist_header_image(); ?>) no-repeat center top; line-height: 0; '>
         <hgroup style='background: url(<?php echo get_stylesheet_directory_uri() ?>/images/overlay.png) no-repeat center center; line-height: 0; '>
            <h1 id='site-title' >
               <span>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                     title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" 
                     rel='home'><?php bloginfo( 'name' ); ?></a>
               </span>
            </h1>
            <h2 id='site-description'><?php bloginfo( 'description' ); ?></h2>
         </hgroup>
			
         <nav id='access' role='navigation'><?php perrymnmlist_nav_menu() ?></nav><!-- #access -->
   </header><!-- #header -->


   <div id='main'>