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
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class='entry-header'>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'perrymnmlist' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php perrymnmlist_posted_on(); ?>
            <?php edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); ?>
        </header><!-- .entry-header -->

        <div class='entry'>
            <div class='wp-caption' style='width: 322px;'>
            <?php
            if ( has_post_thumbnail() ) {
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                the_post_thumbnail('medium', array('class' => 'aligncenter'));
                echo '</a>';
            }
            the_excerpt(); 
            ?>
            </div>
        </div><!-- .entry -->

        <footer class="entry-meta textright">
            <?php comments_number( '', '1 Comment', '% Comments' ); ?>
        </footer><!-- .entry-meta -->
    </article><!-- #post-<?php the_ID(); ?> -->