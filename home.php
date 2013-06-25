<?php
/* SVN FILE: $Id$*/
/**
 * Template Name: Home
 *
 * This is the home page template for displaying the main home page at the top
 * followed by the blog posts immediately after.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package        Perry Minimalist
 * @subpackage     Page Templates
 * @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 * @since          Release 1.1.0
 * @version        $Rev$
 * @modifiedby     $LastChangedBy$
 * @lastmodified   $Date$
 *
 * @todo           ToDo List
 */

get_header(); ?>

        <section id='primary'>
            <div id='content' role='main'>
                <nav class='breadcrumb'>
                    <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
                </nav>
                
                <?php
                $paged = $wp_query->get( 'paged' );
            	if ( ! $paged || $paged < 2 ) {
                    // This is not a paginated page (or it's simply the first page of a paginated page/post)
    	            $my_query = new WP_Query('pagename=home&posts_per_page=1'); 
    	            while ($my_query->have_posts()) {
    	            	$do_not_duplicate = $post->ID;
    	                $my_query->the_post(); 
    	            		get_template_part( '/partials/content', 'home'); 
                    }
                }
                
                /**
                 * Loop through the remaining posts for display on the home page excluding the post displayed above
                 */
                query_posts($query_string);
                if ( have_posts() ){
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( '/partials/summary', get_post_format());
                    }
                } else {
                    get_template_part( '/partials/content', 'noposts' );
                }
                ?>
            </div><!-- #content -->
        </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>