<?php
/* SVN FILE: $Id: summary-image.php 16 2012-12-04 12:25:31Z richard@perrymail.me.uk $ */
/**
 *  A part theme for displaying video content summaries on the home/blog page
 *
 *  Displays the title and video associated with the video post format 
 * 
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.1.0
 *  @version        $Rev: 16 $
 *  @modifiedby     $LastChangedBy: richard@perrymail.me.uk $
 *  @lastmodified   $Date: 2012-12-04 12:25:31 +0000 (Tue, 04 Dec 2012) $
 *
 *  @todo           ToDo List
 *                  - 
 *  @change         Rev 16 - Changed post thumbnail size to summary-image
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class='entry-header'>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" 
                    title="<?php printf( esc_attr__( '%s', 'perrymnmlist' ), 
                    the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                    <?php the_title(); ?></a>
            </h2>
            <h3 class='entry-format'>Video</h3>
            <?php perrymnmlist_posted_on();  
            edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); ?>
        </header><!-- .entry-header -->
        
        <div class="entry-media">
            <?php 
                if ( function_exists('the_post_format_video') ) {
                     the_post_format_video(); 
                } else {
                    global $wp_embed;
                    add_filter( 'the_excerpt', array($wp_embed, 'autoembed'), 8 );
                    the_excerpt();
                } 
                
            ?>
        </div><!-- .entry-media -->

        <footer class="entry-meta">
        <?php $comment_count = get_comment_count($post->ID); ?>
        <?php if ($comment_count['approved'] > 0) : ?>
            <div class='comments'><?php comments_number( '', '1', '%' ); ?></div>
        <?php endif; ?>
        </footer><!-- .entry-meta -->
    </article><!-- #post-<?php the_ID(); ?> -->