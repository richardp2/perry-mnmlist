<?php
/**
 * Template Name: Main Site
 *
 * This template file is used to generate a static front page when that option
 * is selected. The theory is that it will only be used on the main site front
 * page and therefore is specifically designed as a central 'hub' or landing 
 * page for the Perry Online group of pages.
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 */

get_header(); ?>

        <div id="wide-content" role="main">
            <div class="breadcrumb">
                <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
            </div>
            
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class='entry'>
                    <?php the_content(); ?>
                    <?php edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); ?>
                </div><!-- .entry -->
            </article><!-- #post-<?php the_ID(); ?> -->          
            
            <?php endwhile; endif; ?>
            
            <h2>Latest Posts</h2>
            <?php $blogs = array(3,4); ?>
            <?php foreach ( $blogs as $blog ) : ?>
                <?php switch_to_blog($blog); ?>
                <?php $blog_details = get_blog_details( $blog ); ?>
                
            
            <div class='alignleft half'>
                <h3>
                    <a href='<?php echo $blog_details->siteurl; ?>' title='<?php echo $blog_details->blogname; ?>'>
                        <?php echo $blog_details->blogname; ?>
                    </a>
                </h3>
                
                <?php $args = array( 'numberposts' => 10, 'category'=> '-home' ); ?>
                <?php if( get_posts($args)) : ?>
                <ul class='blog-list'>
                <?php $posts = get_posts($args); ?>
                <?php foreach ( $posts as $post ) : ?>
                    <li class='entry-title'>
                        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'perrymnmlist' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <ul class='blog-list'>
                    <li>There are no posts on this blog yet :-(</li>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?> 
            <?php switch_to_blog(1); ?>
                  
        </div><!-- #wide-content -->

<?php get_footer(); ?>