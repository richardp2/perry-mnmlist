<?php
/* SVN FILE: $Id$ */
/**
 *  A part theme for displaying content summaries on the home/blog page
 *
 *  Displays the default summary including a post thumbnail, if one exists
 *
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.0.0
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
            <?php if (get_post_format()) : ?>
                <h3 class='entry-format'><?php echo get_post_format(); ?></h3>
            <?php
            endif; 
            perrymnmlist_posted_on(); 
            perrymnmlist_meta();
			edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); 
			?>
		</header><!-- .entry-header -->

		<div class='entry'>
		<?php
            if ( has_post_thumbnail() ) {
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
                echo '</a>';
            }
            the_excerpt(); 
        ?>
        </div><!-- .entry -->

		<footer class="entry-meta">
        <?php $comment_count = get_comment_count($post->ID); ?>
        <?php if ($comment_count['approved'] > 0) : ?>
            <div class='comments'><?php comments_number( '', '1', '%' ); ?></div>
        <?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
