<?php
/**
 * A part theme for displaying content summaries on the home/blog page
 *
 * Displays the default summary including a post thumbnail, if one exists
 *
 * @package        Perry Minimalist
 * @subpackage     Partials
 * @author         Richard Perry <http://www.perry-online.me.uk/>
 * @copyright      Copyright (c) 2014 Richard Perry
 * @license        http://www.gnu.org/licenses/gpl-3.0.html
 * @since          0.4.0
 * @version        1.0.0
 * @modifiedby     Richard Perry <richard@perrymail.me.uk>
 * @lastmodified   05 February 2014
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class='entry-header'>
<h2 class="entry-title">
<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'perry' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
<?php the_title(); ?>
</a>
</h2>
<?php if (get_post_format()) : ?>
<h3 class='entry-format'><?php echo get_post_format(); ?></h3>
<?php
endif; 
do_action( 'perry_entry_meta' );
edit_post_link( __( 'Edit', 'perry' ), '<span class="edit-link alignright">', '</span>' ); 
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
