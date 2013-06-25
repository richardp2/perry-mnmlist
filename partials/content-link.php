<?php
/* SVN FILE: $Id: content-image.php 15 2012-11-08 14:39:59Z richard@perrymail.me.uk $ */
/**
 *  A part theme for displaying content with the link post format
 *
 *  Displays content with the link post format with the link highlighted at the top
 *
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.1.0
 *  @version        $Rev: 15 $
 *  @modifiedby     $LastChangedBy: richard@perrymail.me.uk $
 *  @lastmodified   $Date: 2012-11-08 14:39:59 +0000 (Thu, 08 Nov 2012) $
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
            <?php
                $content = get_the_content();
                $linktoend = stristr($content, "http" );
                $afterlink = stristr($linktoend, ">");
                if ( ! strlen( $afterlink ) == 0 ):
                    $linkurl = substr($linktoend, 0, -(strlen($afterlink) + 1));
                else:
                    $linkurl = $linktoend;
                endif;
                $link_title_to_end = stristr($content, 'title="');
                $after_link_title = stristr($link_title_to_end, '" ');
                if ( ! strlen( $after_link_title ) == 0 ):
                    $link_title = substr($link_title_to_end, 7, -(strlen($after_link_title) + 0));
                else:
                    $link_title = $link_title_to_end;
                endif;
            ?>
            <div class='link-tag'>
                <div class='icon'></div>
                <a href="<?php echo $linkurl; ?>"><?php echo $link_title; ?></a>
            </div>
            
            <?php the_content(); ?>
            
            <div class='link-tag'>
                <div class='icon'></div>
                <a href="<?php echo $linkurl; ?>"><?php echo $link_title; ?></a>
            </div>
        </div><!-- .entry -->

        <footer class="entry-meta">
            <div class='comments'><?php comments_number( '0', '1', '%' ); ?></div>
        </footer><!-- .entry-meta -->
    </article><!-- #post-<?php the_ID(); ?> -->