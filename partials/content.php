<?php
/* SVN FILE: $Id$ */
/**
 *  A part theme for displaying content
 *
 *  Displays the default layout for blog content
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
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="
			    <?php printf( esc_attr__( '%s', 'perrymnmlist' ), 
			    the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			    <?php the_title(); ?></a></h2>
            <?php 
            perrymnmlist_posted_on();
            edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' );
            ?>
		</header><!-- .entry-header -->

		<div class='entry'>
		<?php 
            the_content(); 
            wp_link_pages( array( 
                'before'           => '',
                'after'            => '',
                'nextpagelink'     => '<span class="alignright">' . __('Next page') . '</span>',
                'previouspagelink' => '<span class="alignleft">' . __('Previous page') . '</span>',
                'next_or_number'   => 'next' 
            ));  
            wp_link_pages( array( 
                'before'           => '<p class="aligncenter textcenter">Skip to page ',
                'after'            => '</p>',
                'next_or_number'   => 'number' 
            )); 
        ?>
	    </div><!-- .entry -->

		<footer class="entry-meta">
		    <?php the_tags( '<span class="tag-links"><h4 class="entry-utility-prep entry-utility-prep-tag-links">' . 
                            __('Tags ', 'perrymnmlist' ) . '</h4>', ", ", 
                            "</span>" ) ?>
            <div class='comments'><?php comments_number( '0', '1', '%' ); ?></div>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
