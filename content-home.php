<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */
?>

<?php 
    /**
     * Display the latest home page post specifically for display at the top of the home page
     */ 
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class='entry'>
        <?php the_content(); ?>
        </div><!-- .entry -->
    </article><!-- #post-<?php the_ID(); ?> -->

