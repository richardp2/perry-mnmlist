<?php
/**
 *  The template for displaying Archive pages.
 *
 *  Used to display archive-type pages if nothing more specific matches a query.
 *  For example, puts together date-based pages if no date.php file exists.
 *
 *  Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.2.5
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  -  
 * 
 *  @change         v0.2.5 - Converted version control to Git
 *                         - updated file information comments
 *                  v0.2.4 - Added a category description
 *                         - Removed nav links at the bottom of the page
 *                  v0.2.3 - Wrapped template in section #primary for better 
 *                           HTML5 support
 *                  v0.2.2 - Changed loop to look in partials folder to suit
 *                           modified theme file structure
 *                  v0.2.1 - Changed loop to look for summary partial
 *                  v0.2.0 - Added loop
 *                  v0.1.0 - Initial import into SVN
 */

get_header(); ?>

            <section id='primary'>
                <div id='content' role='main'>
                    <div class='breadcrumb'>
                        <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
                    </div>
        
                    <header class="page-header">
                        <h1 class="page-title">
                        <?php if ( is_day() ) : ?>
                          <?php printf( __( '%s', 'perrymnmlist' ), '<span>' . get_the_date() . '</span>' ); ?>
                        <?php elseif ( is_month() ) : ?>
                          <?php printf( __( '%s', 'perrymnmlist' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
                        <?php elseif ( is_year() ) : ?>
                          <?php printf( __( '%s', 'perrymnmlist' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
                        <?php elseif ( is_category() ) : ?>
                          <?php printf( __( '%s', 'perrymnmlist' ), '<span>' . single_cat_title( '', false )  . '</span>' ); ?>
                        <?php elseif ( is_tag() ) : ?>
                          <?php printf( __( '%s', 'perrymnmlist' ), '<span>' . single_tag_title( '', false )  . '</span>' ); ?>
                        <?php else : ?>
                          <?php _e( 'Blog Archives', 'perrymnmlist' ); ?>
                        <?php endif; ?>
                        </h1>
                    </header>
        
                    <?php 
                        if ( have_posts() ) {
                            if ( is_category() ) {
                                global $cat;
                                echo category_description( $cat );
                            }
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