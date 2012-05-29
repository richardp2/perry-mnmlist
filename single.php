<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */

get_header(); ?>

        <div id="content" role="main">
            <nav class='breadcrumb'>
                <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
            </nav>

            <nav class='postnav'>
               <span class='nav-previous alignleft'><?php previous_post( '&laquo; %', '', 'yes' ); ?></span>
               <span class='nav-next alignright'><?php next_post( '% &raquo;', '', 'yes' ); ?></span>
            </nav><!-- nav -->

            <?php get_template_part( 'content', 'default' ); ?>

            <nav class='postnav'>
               <span class='nav-previous alignleft'><?php previous_post( '&laquo; %', '', 'yes' ); ?></span>
               <span class='nav-next alignright'><?php next_post( '% &raquo;', '', 'yes' ); ?></span>
            </nav><!-- nav -->

            <?php comments_template( '', true ); ?>
        </div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>