<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */

get_header(); ?>

        <?php if ( has_post_format( 'gallery' )) : ?>
        <section id='wide-primary'>
            <div id="wide-content" role="main"> 
        <?php else: ?>
        <section id='primary'>
            <div id="content" role="main">
        <?php endif; ?>
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
            </div><!-- #content/#wide-content -->
        </section><!-- #primary/#wide-primary -->

<?php if ( !has_post_format( 'gallery' )) { get_sidebar(); } ?>
<?php get_footer(); ?>