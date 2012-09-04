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
			<p class="entry-title">
			    <a href="<?php the_permalink(); ?>" 
    			    title="<?php printf( esc_attr__( '%s', 'perrymnmlist' ), 
    			    the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
    			    <?php the_title(); ?></a>
			</p>
		</header><!-- .entry-header -->

		<div class='entry'>
    		<a href="<?php the_permalink(); ?>" 
                title="<?php printf( esc_attr__( '%s', 'perrymnmlist' ), 
                the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
            <?php perrymnmlist_posted_on('aligncenter'); ?>
        </div><!-- .entry -->

		<footer class="entry-meta textright">
		<?php 
			comments_number( '', '1 Comment', '% Comments' );
            edit_post_link( __( 'Edit', 'perrymnmlist' ), 
                '<span class="edit-link aligncenter textcenter">', '</span>' ); 
        ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
