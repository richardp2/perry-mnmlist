<?php
/**
 * Perry Minimalist functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * @package        Perry Mnmlist
 * @subpackage     Functions
 * @author         Richard Perry <http://www.perry-online.me.uk/>
 * @copyright      Copyright (c) 2014 Richard Perry
 * @license        http://www.gnu.org/licenses/gpl-3.0.html
 * @since          0.1.0
 * @version        1.0.0
 * @modifiedby     Richard Perry <richard@perrymail.me.uk>
 * @lastmodified   05 February 2014
 *
 *  @todo           ToDo List
 *                  -  Internationalisation
 */
 
 if ( ! isset( $content_width ) ) $content_width = 500;



/**
 * Register the perry global for use across the theme and instantiate the theme object
 */
require_once locate_template( '/includes/classes/class-perrymnmlist-theme.php' );
$perry = new PerryMnmlist_Theme();


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
//function perrymnmlist_custom_excerpt_more( $output ) {
//	if ( has_excerpt() && ! is_attachment() ) {
//		$output .= perrymnmlist_excerpt_more();
//	}
//	return $output;
//}
//add_filter( 'get_the_excerpt', 'perrymnmlist_custom_excerpt_more' );





if ( ! function_exists( 'perrymnmlist_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own perrymnmlist_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'perrymnmlist' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
                <?php
                    /* translators: 1: comment author, 2: date and time */
                    printf( __( '%1$s %2$s', 'perrymnmlist' ),
                        sprintf( '<div class="comment-author vcard"><cite>%s</cite></div>', get_comment_author_link() ),
                        sprintf( '<div class="comment-time"><small><a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a></small></div>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s at %2$s', 'perrymnmlist' ), get_comment_date(), get_comment_time() )
                        )
                    );
                ?>

					<?php edit_comment_link( __( 'Edit', 'perrymnmlist' ), '<div class="edit-link alignright">', '</div>' ); ?>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'perrymnmlist' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<cite>Reply</cite>', 'perrymnmlist' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for perrymnmlist_comment()





if ( ! function_exists( 'get_perrymnmlist_posted_on' ) ) :
/**
 * Generates HTML with meta information for the current post-date/time only, 
 * originally created for use with the gallery post format, outputs to a string
 *
 * @since Perry Minimalist 1.0
 */
function get_perrymnmlist_posted_on( ) {
    $return_string = sprintf( __( '
            <small class="posted-on">
                <time class="entry-date" datetime="%1$s" pubdate>%2$s<br />%3$s</time>
            </small>', 'perrymnmlist' ),
        esc_attr( get_the_time( 'c' ) ),
        esc_html( get_the_date( 'd' ) ),
        esc_html( get_the_date( 'M Y' ) )
    );
    return $return_string;
}
endif;









/**
 *  SHORTCODES
 */
 
/**
 *  Obscures an email when wrapped with the [mailto][/mailto] shortcode
 */
function perrymnmlist_obfuscate( $atts , $content=null ) {
   return antispambot($content);
}
add_shortcode('mailto', 'perrymnmlist_obfuscate');

/**
 * Displays a list of gallery posts by year
 * 
 * Reads through and lists the gallery posts in reverse date order collated
 * by year. Can also be restricted to displaying certain categories only
 */
function perrymnmlist_display_galleries( $atts ){
    // Default parameters
    extract( shortcode_atts( array(
        'cat' => ''
    ), $atts));
    query_posts( array(
        'orderby' => 'date', 
        'order' => 'DESC' , 
        'category_name' => $cat
    ));
    $return_string = "<div class='albums'>";
    if (have_posts()) :
        while (have_posts()) : the_post();
            $return_string .= "
    <article id='post-" . get_the_ID() . "' " . get_post_class( '', get_the_ID() ) . ">
        <header class='entry-header'>
            <h4 class='entry-title'>
                <a href='" . get_permalink() . "' 
                    title='" . sprintf( esc_attr__( '%s', 'perrymnmlist' ), 
                    the_title_attribute( 'echo=0' ) ) . "' rel='bookmark'>
                    " . get_the_title() . "</a>
            </h4>
        </header><!-- .entry-header -->

        <div class='entry'>
            <a href='" . get_permalink() . "' 
                title='" . sprintf( esc_attr__( '%s', 'perrymnmlist' ), 
                the_title_attribute( 'echo=0' ) ) . "' rel='bookmark'>
                " . get_the_post_thumbnail( get_the_ID(), 'thumbnail') . "
            </a>
        </div><!-- .entry -->

        <footer class='entry-meta'>
            " . get_perrymnmlist_image_posted_on('aligncenter') . "
        </footer><!-- .entry-meta -->
    </article><!-- #post-" . get_the_ID() . " -->";
        endwhile;
    endif;
    $return_string .= "</div>";
    wp_reset_query();
    return $return_string;
    
}
add_shortcode('gall_list', 'perrymnmlist_display_galleries');

