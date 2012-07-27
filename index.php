<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
            
            <?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    get_template_part( 'summary', get_post_format() ); 
                } 
            } else { 
                get_template_part( 'content', 'noposts' ); 
            } 
            
            perrymnmlist_content_nav( 'nav-below' );
            ?>
        </div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>