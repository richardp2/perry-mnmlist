<?php
/**
 *  Perry Minimalist functions and definitions
 *
 *  Sets up the theme and provides some helper functions. Some helper functions
 *  are used in the theme as custom template tags. Others are attached to action and
 *  filter hooks in WordPress to change core functionality.
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.2.5
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  -  
 * 
 *  @change         v0.2.5 - Converted version control to Git
 *                         - Updated file information comments
 *                  v0.2.4 - Added content width setting back in (I know what it does now)
 *                  v0.2.3 - Added post thumbnail size (summary-image) of 500x500
 *                         - Remove content width setting
 *                  v0.2.2 - Modified variuos functions to give better HTML5 support
 *                         - Added shortcodes for email obfuscation and gallery lists
 *                  v0.2.1 - Modified the perrymnmlist_posted_on function to include the class
 *                           'posted_on'
 *                  v0.2.0 - Added perrymnmlist_theme_js & perrymnmlist_inifinte_scroll_js
 *                           to give the theme support for infinite scroll
 *                  v0.1.0 - Initial import into SVN
 *//**
 * 
 *  @package        Perry Minimalist
 *  @subpackage     Functions
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.0.0
 *  @version        $Rev$
 *  @modifiedby     $LastChangedBy$
 *  @lastmodified   $Date$
 *
 *  @todo           ToDo List
 *                  - 
 *  @change         
 */
 
 if ( ! isset( $content_width ) ) $content_width = 500;

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
    add_image_size( 'summary-image', 500, 500 ); 
    
    // allow html in category and taxonomy descriptions
    remove_filter( 'pre_term_description', 'wp_filter_kses' );
    remove_filter( 'pre_link_description', 'wp_filter_kses' );
    remove_filter( 'pre_link_notes', 'wp_filter_kses' );
    remove_filter( 'term_description', 'wp_kses_data' );
    
    add_theme_support( 'infinite-scroll', array(
        'container' => 'content',
        'render'    => 'perrymnmlist_infinite_scroll_render'
    ) );
    
}
endif; // perrymnmlist_setup

/**
 * Set the code to be rendered on for calling posts,
 * hooked to template parts when possible.
 *
 * Note: must define a loop.
 */
function perrymnmlist_infinite_scroll_render() {
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            get_template_part( '/partials/summary', get_post_format() ); 
        } 
    } else { 
        get_template_part( '/partials/content', 'noposts' ); 
    } 
}


/**
 * Sets the post excerpt length to 125 words.
 */
function perrymnmlist_excerpt_length( $length ) {
	return 125;
}
add_filter( 'excerpt_length', 'perrymnmlist_excerpt_length', 9999 );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with a custom Read More link.
 */
function perrymnmlist_excerpt_more( $more ) {
    global $post;
	return '...<br /><a href="'. get_permalink($post->ID) . '" class="alignright">' . __( 'Read more', 'perrymnmlist' ) . '</a>';
}
add_filter( 'excerpt_more', 'perrymnmlist_excerpt_more' );

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
            </small>', 'perrymnmlist' ),
        esc_attr( get_the_time( 'c' ) ),
        esc_html( get_the_date( 'd' ) ),
        esc_html( get_the_date( 'M Y' ) )
	);
}
endif;

if ( ! function_exists( 'perrymnmlist_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own perrymnmlist_posted_on to override in a child theme
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_meta( ) {
    printf( __( '
            <small class="entry-meta">
                <span class="meta-prep meta-prep-author">%1$s</span>
                <span class="author vcard">
                    <a class="url fn n" href="%2$s" title="%3$s" rel="author">%4$s, </a>
                </span>
                <span class="meta-categories">in %5$s</span>
            </small>', 'perrymnmlist' ),
        esc_attr( 'Written by ', 'perrymnmlist' ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( 'View all articles by %s',  get_the_author() ) ),
        get_the_author(),
        get_the_category_list( ', ' )
    );
}
endif;




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

