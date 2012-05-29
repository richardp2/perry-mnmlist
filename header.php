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
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta name='author' content='Richard Perry' />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
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


   <div id="main">