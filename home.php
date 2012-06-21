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
            
            <?php
            $do_not_duplicate = 0;
            $paged = $wp_query->get( 'paged' );
            if ( ! $paged || $paged < 2 ) {
                 // This is not a paginated page (or it's simply the first page of a paginated page/post)
                $my_query = new WP_Query('category_name=home&posts_per_page=1'); 
                while ($my_query->have_posts()) {
                    $my_query->the_post(); 
                    $do_not_duplicate = $post->ID;
                    get_template_part( 'content', 'home'); 
                }
            }
            
            /**
             * Loop through the remaining posts for display on the home page excluding the post displayed above
             */ 
            if ( have_posts() ){
                while ( have_posts() ) {
                    the_post();
                    if( $post->ID == $do_not_duplicate ) continue; 
                    get_template_part( 'content', 'summary');
                }
            } else {
                get_template_part( 'content', 'noposts' );
            }
            perrymnmlist_content_nav( 'nav-below' ); 
            ?>
        </div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>