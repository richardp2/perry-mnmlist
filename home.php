<?php
/**
 * Template Name: Home
 *
 * This is the home page template for displaying the main home page at the top
 * followed by the blog posts immediately after.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 */

get_header(); ?>

        <div id='content' role='main'>
            <nav class='breadcrumb'>
                <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
            </nav>

            <?php get_template_part( 'content', 'index'); ?>
                        
            <?php perrymnmlist_content_nav( 'nav-below' ); ?>
        </div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>