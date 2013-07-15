<?php
/**
 *  The main template file.
 *
 *  This is the most generic template file in a WordPress theme
 *  and one of the two required files for a theme (the other being style.css).
 *  It is used to display a page when nothing more specific matches a query.
 *  E.g., it puts together the home page when no home.php file exists.
 *  Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.2
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  - 
 * 
 *  @change         v0.2 - updated file header information
 */

get_header(); ?>

        <section id='primary'>
            <div id='content' role='main'>
                <nav class='breadcrumb'>
                    <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
                </nav>
                
                <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( '/partials/summary', get_post_format() ); 
                    } 
                } else { 
                    get_template_part( '/partials/content', 'noposts' ); 
                } 
                ?>
            </div><!-- #content -->
        </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>