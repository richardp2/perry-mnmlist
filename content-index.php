<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */
?>

<?php 
    /**
     * Display the latest home page post specifically for display at the top of the home page
     */ 
?>

<?php $my_query = new WP_Query('category_name=home&posts_per_page=1'); ?>
<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
<?php $do_not_duplicate = $post->ID;?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class='entry'>
        <?php the_content(); ?>
        </div><!-- .entry -->
    </article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; ?>

<?php 
    /**
     * Loop through the remaining posts for display on the home page excluding the post displayed above
     */ 
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if( $post->ID == $do_not_duplicate ) continue; ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class='entry-header'>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'perrymnmlist' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
            <?php perrymnmlist_posted_on(); ?>
            <?php edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); ?>
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
<?php endwhile; else: ?>
        <article id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title">
                    <?php _e( "There's nothing here :-(", 'perrymnmlist' ); ?>
                </h1>
            </header><!-- .entry-header -->
            <div class="entry-content">
                <p><?php _e( 'It seems there is nothing available to display here. This could be due to extreme laziness and a distinct lack of posts, however, there may be something interesting if you try the links above', 'perrymnmlist' ); ?></p>
            </div><!-- .entry-content -->
        </article><!-- #post-0 -->
<?php endif; ?>