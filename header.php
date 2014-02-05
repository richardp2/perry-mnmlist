<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package        Perry Minimalist
 * @subpackage     Templates
 * @author         Richard Perry <http://www.perry-online.me.uk/>
 * @copyright      Copyright (c) 2014 Richard Perry
 * @license        http://www.gnu.org/licenses/gpl-3.0.html
 * @since          0.1.0
 * @version        1.0.0
 * @modifiedby     Richard Perry <richard@perrymail.me.uk>
 * @lastmodified   05 February 2014
 */
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset='<?php bloginfo( 'charset' ); ?>' />
<meta name='viewport' content='width=device-width' />
<title><?php wp_title(''); ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id='wrapper' class='hfeed'>

<header id='header' role='banner' class='textcenter' style='background: url(<?php do_action( 'perry_header_image' ); ?>) no-repeat center top; line-height: 0; '>

<hgroup style='background: url(<?php echo get_stylesheet_directory_uri() ?>/images/overlay.png) center center; line-height: 0; '>
<h1 id='site-title' >
<span>

<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel='home'>
<?php bloginfo( 'name' ); ?>
</a>

</span>
</h1>
<h2 id='site-description'><?php bloginfo( 'description' ); ?></h2>
</hgroup>

<nav id='access' role='navigation'><?php do_action( 'perry_menu' ); ?></nav><!-- #access -->
</header><!-- #header -->


<div id='main'>