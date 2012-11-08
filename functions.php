<?php
/**
 * Perry Minimalist functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, perrymnmlist_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'perrymnmlist_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run perrymnmlist_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'perrymnmlist_setup' );

if ( ! function_exists( 'perrymnmlist_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override perrymnmlist_setup() in a child theme, add your own perrymnmlist_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_setup() {

		// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'perrymnmlist' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'image', 'chat', 'gallery', 'quote', 'status', 'video', 'audio' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
}
endif; // perrymnmlist_setup


/**
 * Sets the post excerpt length to 125 words.
 */
function perrymnmlist_excerpt_length( $length ) {
	return 125;
}
add_filter( 'excerpt_length', 'perrymnmlist_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with a custom Read More link.
 */
function perrymnmlist_excerpt_more( $more ) {
	return '...<br /><a href="'. esc_url( get_permalink() ) . '" class="alignright">' . __( 'Read more', 'perrymnmlist' ) . '</a>';
}
add_filter( 'excerpt_more', 'perrymnmlist_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function perrymnmlist_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= perrymnmlist_excerpt_more();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'perrymnmlist_custom_excerpt_more' );





/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function perrymnmlist_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'perrymnmlist_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'perrymnmlist' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'perrymnmlist_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function perrymnmlist_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'perrymnmlist' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'perrymnmlist' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'perrymnmlist' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Perry Minimalist 1.0
 * @return string|bool URL or false when no link is present.
 */
function perrymnmlist_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}



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

if ( ! function_exists( 'perrymnmlist_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own perrymnmlist_posted_on to override in a child theme
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_posted_on( ) {
	printf( __( '
            <small class="posted-on">
                <time class="entry-date" datetime="%1$s" pubdate>%2$s<br />%3$s</time>
                <span class="meta-prep meta-prep-author">%4$s</span>
                <span class="author vcard">
                    <a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s, </a>
                </span>
                <span class="meta-categories">in %8$s</span>
            </small>', 'perrymnmlist' ),
        esc_attr( get_the_time( 'c' ) ),
        esc_html( get_the_date( 'd' ) ),
        esc_html( get_the_date( 'M Y' ) ),
        esc_attr( 'Written by ', 'perrymnmlist' ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( 'View all articles by %s',  get_the_author() ) ),
        get_the_author(),
        get_the_category_list( ', ' )
	);
}
endif;



if ( ! function_exists( 'perrymnmlist_image_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time only, 
 * originally created for use with the gallery post format
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_image_posted_on( ) {
    printf( __( '
            <small class="posted-on">
                <time class="entry-date" datetime="%1$s" pubdate>%2$s<br />%3$s</time>
            </small>', 'perrymnmlist' ),
        esc_attr( get_the_time( 'c' ) ),
        esc_html( get_the_date( 'd' ) ),
        esc_html( get_the_date( 'M Y' ) )
    );
}
endif;

if ( ! function_exists( 'get_perrymnmlist_image_posted_on' ) ) :
/**
 * Generates HTML with meta information for the current post-date/time only, 
 * originally created for use with the gallery post format, outputs to a string
 *
 * @since Perry Minimalist 1.0
 */
function get_perrymnmlist_image_posted_on( ) {
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



if ( ! function_exists( 'perrymnmlist_header_image' ) ) :
/**
 * Displays a header image dependant on the subdomain
 * Create your own perrymnmlist_header_image to override in a child theme
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_header_image() {
    $parsedUrl = parse_url( 'http://' . $_SERVER['HTTP_HOST'] );
    $host = explode('.', $parsedUrl['host']);
    $header = '/images/headers/' . $host[0] . '.jpg';
    $default = '/images/headers/default.jpg';

    $header = (file_exists(get_stylesheet_directory() . $header))
        ? get_stylesheet_directory_uri() . $header 
        : get_stylesheet_directory_uri() . $default;
   
    print $header;
}
endif;





if ( ! function_exists( 'perrymnmlist_nav_menu' ) ) :
/** 
 * Our global navigation menu. 
 *
 * If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu 
 * assiged to the primary position is the one used. If none is assigned, the 
 * menu with the lowest ID is used. 
 *
 * Pulls the main menu from blog ID 1 (the main site) and then resets the 
 * current blog ID.
 *
 * @since Perry Minimalist 1.0
 */ 
function perrymnmlist_nav_menu() {
    //store the current blog_id being viewed
    global $blog_id;
    $current_blog_id = $blog_id;

    //Combine the navigation menus from each of the network blogs for output
    ?> <ul id='menu-main'> <?php
    
    $blogs = array(1,3,4);
    foreach ( $blogs as $blog ) {
        // Switch to the next blog in the network 
        switch_to_blog($blog);
        
        // Output the menu for the blog without any the containing <ul> tags
        wp_nav_menu( array( 'container' => 'false', 'items_wrap' => '%3$s' ) );
    }
    // Switch back to the main blog 
    switch_to_blog(1);
    
    // Output the End menu without any the containing <ul> tags
    wp_nav_menu( array( 'container' => 'false', 'items_wrap' => '%3$s', 'menu' => 'End' ) );
    
    ?> </ul> <?php
    
    //switch back to the current blog being viewed
    switch_to_blog($current_blog_id);
}
endif;

/**
 * Remove the automatic paragraph wrapper around images
 */
function perrymnmlist_unautop_4_img( $content ) {
    $content = preg_replace(
        '/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
        '<figure>$1</figure>',
        $content
    );
    return $content;
}
add_filter( 'the_content', 'perrymnmlist_unautop_4_img', 999 );



remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version


/**
 * Add javascript files to the theme
 */
function perrymnmlist_theme_js(){
    wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'),null,true );
    if( ! is_singular() ) {
        wp_enqueue_script('infinite_scroll');
    }
}
add_action('wp_enqueue_scripts', 'perrymnmlist_theme_js');

/**
 * Infinite Scroll
 */
function perrymnmlist_infinite_scroll_js() {
    if( ! is_singular() ) { ?>
    <script>
    var infinite_scroll = {
        loading: {
            img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
            msgText: "<?php _e( 'Loading the next set of posts...', 'perrymnmlist' ); ?>",
            finishedMsg: "<?php _e( 'All posts loaded.', 'perrymnmlist' ); ?>"
        },
        "nextSelector":"#nav-below .nav-previous a",
        "navSelector":"#nav-below",
        "itemSelector":"article",
        "contentSelector":"#content"
    };
    jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
    </script>
    <?php
    }
}
add_action( 'wp_footer', 'perrymnmlist_infinite_scroll_js',100 );



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

