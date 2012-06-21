<?php
/**
 * The default template for displaying content when no post is found
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */
?>

        <article id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title">
                    <?php _e( "There's nothing here :-(", 'perrymnmlist' ); ?>
                </h1>
            </header><!-- .entry-header -->
            <div class="entry-content">
                <p><?php _e( 'It seems there is nothing available to display here. This could be due to extreme laziness and a distinct lack of posts, however, there may be something interesting if you try the links above', 'perrymnmlist' ); ?></p>
            </div><!-- .entry-content -->
        </article><!-- #post-0 -->