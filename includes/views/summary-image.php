<?php
/* SVN FILE: $Id$ */
/**
 *  A part theme for displaying image content summaries on the home/blog page
 *
 *  Displays the title and thumbnail image associated with the image post format 
 * 
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.1.0
 *  @version        $Rev$
 *  @modifiedby     $LastChangedBy$
 *  @lastmodified   $Date$
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
            <h3 class='entry-format'>Image</h3>
            <?php perrymnmlist_posted_on();  
            edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); ?>
        </header><!-- .entry-header -->
        
        <div class='entry'>
            <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" 
                title="<?php the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                <?php the_post_thumbnail( 'summary-image' ); ?>
            </a>
            <?php endif; ?>
        </div><!-- .entry -->

        <footer class="entry-meta">
        <?php $comment_count = get_comment_count($post->ID); ?>
        <?php if ($comment_count['approved'] > 0) : ?>
            <div class='comments'><?php comments_number( '', '1', '%' ); ?></div>
        <?php endif; ?>
        </footer><!-- .entry-meta -->
    </article><!-- #post-<?php the_ID(); ?> -->