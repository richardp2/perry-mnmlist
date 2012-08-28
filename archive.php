<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */

get_header(); ?>

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
                while ( have_posts() ) {
                    the_post();
                    get_template_part( '/partials/summary', get_post_format() ); 
                } 
            } else { 
                get_template_part( '/partials/content', 'noposts' ); 
            } 
            
            perrymnmlist_content_nav( 'nav-below' );
            ?>
        
        </div><!-- #content -->
         
<?php get_sidebar(); ?>
<?php get_footer(); ?>