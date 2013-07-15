<?php
/**
 *  Template Name: Single
 *
 *  This is the template for displaying full, single posts
 *  Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.4
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  - 
 * 
 *  @change         v0.4 - updated file header information
 *                  svn Rev 16 - Removed references to wide-container/wide 
 *                               content for galleries
 *                  svn Rev 15 - Wrapped page in a 'section' for clarity
 */

get_header(); ?>

        <section id='primary'>
            <div id="content" role="main">
                <nav class='breadcrumb'>
                    <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
                </nav>
    
                <nav class='postnav'>
                   <span class='nav-previous alignleft'><?php previous_post( '&laquo; %', '', 'yes' ); ?></span>
                   <span class='nav-next alignright'><?php next_post( '% &raquo;', '', 'yes' ); ?></span>
                </nav><!-- nav -->
    
                <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( '/partials/content', get_post_format() ); 
                    } 
                } else { 
                    get_template_part( '/partials/content', 'noposts' ); 
                } 
                ?>
    
                <nav class='postnav'>
                   <span class='nav-previous alignleft'><?php previous_post( '&laquo; %', '', 'yes' ); ?></span>
                   <span class='nav-next alignright'><?php next_post( '% &raquo;', '', 'yes' ); ?></span>
                </nav><!-- nav -->
    
                <?php comments_template( '', true ); ?>
            </div><!-- #content -->
        </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>