<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class='entry-header'>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'perrymnmlist' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php 
            perrymnmlist_posted_on(); 
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

		<footer class="entry-meta textright">
			<?php comments_number( '', '1 Comment', '% Comments' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
