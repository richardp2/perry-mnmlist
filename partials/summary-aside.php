<?php
/* SVN FILE: $Id: summary.php 15 2012-11-08 14:39:59Z richard@perrymail.me.uk $ */
/**
 *  A part theme for displaying aside summaries
 *
 *  Displays asides as a full post, not just an excerpt
 *
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.2.0
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
			edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); 
			?>
		</header><!-- .entry-header -->

		<div class='entry'>
		<?php the_content(); ?>
        </div><!-- .entry -->

		<footer class="entry-meta">
        <?php $comment_count = get_comment_count($post->ID); ?>
        <?php if ($comment_count['approved'] > 0) : ?>
            <div class='comments'><?php comments_number( '', '1', '%' ); ?></div>
        <?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
