<?php
/* SVN FILE: $Id$ */
/**
 *  A part theme for displaying content with the image post format
 *
 *  Displays content with the Image post format within a wp-caption box/div
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
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class='entry-header'>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" 
                title="<?php printf( esc_attr__( 'Permalink to %s', 'perrymnmlist' ), 
                    the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a></h2>
            <?php perrymnmlist_posted_on(); ?>
            <?php edit_post_link( __( 'Edit', 'perrymnmlist' ), 
                '<span class="edit-link alignright">', '</span>' ); ?>
        </header><!-- .entry-header -->

        <div class='entry'>
            <?php the_content(); ?>
        </div><!-- .entry -->

        <footer class="entry-meta">
            <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . 
                            __('Tagged ', 'perrymnmlist' ) . '</span>', ", ", 
                            "</span>" ) ?>
            <div class='comments'><?php comments_number( '0', '1', '%' ); ?></div>
        </footer><!-- .entry-meta -->
    </article><!-- #post-<?php the_ID(); ?> -->