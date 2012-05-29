<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class='entry-header'>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'perrymnmlist' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php perrymnmlist_posted_on(); ?>
			<?php edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); ?>
		</header><!-- .entry-header -->

		<div class='entry'><?php the_content(); ?></div><!-- .entry -->

		<footer class="entry-meta textright">
			<?php comments_number( '', '1 Comment', '% Comments' ); ?>
		</footer><!-- .entry-meta -->
	</div><!-- #post-<?php the_ID(); ?> -->
    
    
<?php endwhile; else: ?>
        <div id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title">
                    <?php _e( "There's nothing here :-(", 'perrymnmlist' ); ?>
                </h1>
            </header><!-- .entry-header -->
            <div class="entry-content">
                <p><?php _e( 'It seems there is nothing available to display here. This could be due to extreme laziness and a distinct lack of posts, however, there may be something interesting if you try the links above', 'perrymnmlist' ); ?></p>
            </div><!-- .entry-content -->
        </div><!-- #post-0 -->
<?php endif; ?>