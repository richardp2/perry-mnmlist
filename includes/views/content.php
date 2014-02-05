<?php
/**
 * A part theme for displaying content.
 *
 * Displays the default layout for blog content.
 *
 * @package        Perry Minimalist
 * @subpackage     Partials
 * @author         Richard Perry <http://www.perry-online.me.uk/>
 * @copyright      Copyright (c) 2014 Richard Perry
 * @license        http://www.gnu.org/licenses/gpl-3.0.html
 * @since          0.1.0
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
<?php do_action( 'perry_entry_meta' ); ?>
<?php edit_post_link( __( 'Edit', 'perry' ), '<span class="edit-link alignright">', '</span>' ); ?>
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
                __('Tags ', 'perry' ) . '</h4>', ", ", 
                "</span>" ) ?>
<div class='comments'><?php comments_number( '0', '1', '%' ); ?></div>
</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
