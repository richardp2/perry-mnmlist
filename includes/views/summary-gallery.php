<?php
/* SVN FILE: $Id$ */
/**
 *  A part theme for displaying gallery summaries
 *
 *  Displays galleries in a narrow, floated div with the title as simply a 
 *  paragraph so it doesn't distract from the main element which is a thumbnail
 *  representing the gallery content. This partial is for use on a photoblog 
 *  rather than a standard blog
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
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" 
                    title="<?php printf( esc_attr__( '%s', 'perrymnmlist' ), 
                    the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                    <?php the_title(); ?></a>
            </h2>
            <h3 class='entry-format'>Gallery</h3>
            <?php 
            perrymnmlist_posted_on();  
            edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); 
            ?>
		</header><!-- .entry-header -->

		<div class='entry'>
    		<a href="<?php the_permalink(); ?>" 
                title="<?php printf( esc_attr__( '%s', 'perrymnmlist' ), 
                the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                <?php                
                $images = get_children( array(
                    'post_parent' => get_the_ID(),
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image')
                );
                $total_images = count( $images );
                $attachments = get_children( array(
                    'post_parent' => get_the_ID(),
                    'post_status' => 'inherit',
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'order' => 'ASC',
                    'orderby' => 'menu_order ID',
                    'numberposts' => 6)
                );
                foreach ( $attachments as $thumb_id => $attachment ) {
                    echo wp_get_attachment_image($thumb_id, 'thumbnail', array(
                            'alt'   => trim(strip_tags( get_post_meta($thumb_id, '_wp_attachment_image_alt', true) )),
                            'title' => trim(strip_tags( $attachment->post_title )),
                        ) );
                }
                ?>
            </a>
        </div><!-- .entry -->

		<footer class="entry-meta">
	    <?php printf( _n( 'This gallery contains %1$s photo</a>.', 'This gallery contains %1$s photos</a>.', $total_images, 'perrymnmlist' ),
                        number_format_i18n( $total_images )
                    ); ?>
        <?php if ( have_comments() ) : ?>
            <span class='point'></span>
            <div class='comments'><?php comments_number( '', '1', '%' ); ?></div>
        <?php endif; ?>
        </footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
