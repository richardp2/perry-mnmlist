<?php
/**
 * Perry Mnmlist Theme for WordPress
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

/**
 * Perry Mnmlist
 * 
 * Master theme class
 * 
 * This file is what powers the entire theme. It sets theme constants;
 * initializes theme options; adds theme support for thumbnails, menus,
 * and post formats; initializes shortcodes; enables the custom background;
 * sets up admin area additions & modifications; handles SEO and meta tags;
 * tweaks the comment form; and a lot of other stuff.
 * 
 * This file is required by functions.php.
 * 
 * @package        Perry Mnmlist
 * @subpackage     Classes
 * @author         Richard Perry <http://www.perry-online.me.uk/>
 * @copyright      Copyright (c) 2014 Richard Perry
 * @license        http://www.gnu.org/licenses/gpl-3.0.html
 * @since          1.0
 * @version        1.0.0
 * @modifiedby     Richard Perry <richard@perrymail.me.uk>
 * @lastmodified   05 February 2014
 *
 * @todo           ToDo List
 *                  -  
 * 
 * @change         v0.2.6 - Generated the empty class file
 */
class PerryMnmlist_Theme {
	
	/**
	 * Initialise the class and hook the various functions into WordPress.
	 * 
	 * @return    void
	 * @since     1.0.0
	 */
	public function __construct() {
	    
	    // Actions to be dealt with immediately after theme setup
		add_action( 'after_setup_theme', array( $this, 'constants' ) );
        add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
        add_action( 'after_setup_theme', array( $this, 'menus' ) );
        add_action( 'after_setup_theme', array( $this, 'sidebars' ) );
        
        // Script and stylesheet actions
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
        
        // Content filters
        add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 9999 );
        add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
        add_filter( 'the_content', array( $this, 'unautop_for_img' ), 999 );
        add_filter( 'wp_title', array( $this, 'title' ), 10, 3 );
        add_filter( 'wp_page_menu_args', array( $this, 'page_menu_args' ) );
    
        // allow html in category and taxonomy descriptions
        remove_filter( 'pre_term_description', 'wp_filter_kses' );
        remove_filter( 'pre_link_description', 'wp_filter_kses' );
        remove_filter( 'pre_link_notes', 'wp_filter_kses' );
        remove_filter( 'term_description', 'wp_kses_data' );
        
        // Custom actions
        add_action( 'perry_content_navigation', array( $this, 'content_navigation' ) );
        add_action( 'perry_entry_meta', array( $this, 'entry_meta' ) );
        add_action( 'perry_header_image', array( $this, 'header_image' ) );
        add_action( 'perry_menu', array( $this, 'global_menu' ) );
        add_action( 'perry_url_grabber', array( $this, 'url_grabber' ) );
        
        // Various head tag actions
        add_action( 'wp_head', array( $this, 'favicon' ) );
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'wp_generator');
        
	}
	
	
	/**
     * Define theme constants.
     *
     * Defines the constant paths for use within the theme and child theme.  
	 * Constants prefixed with 'PERRY_' are for use only within the core  
	 * framework and don't reference other areas of the parent or child theme.
     * 
     * @return      void
	 * 
	 * @uses        PERRY_VERSION
	 * @uses        THEME_URI
	 * @uses        THEME_DIR
	 * @uses        PERRY_ASSETS
	 * @uses        PERRY_LIB
     * 
     * @since       1.0.0
     */
	public function constants() {
	    
	    define( 'PERRY_VERSION',        '3.0.0' );
        if ( ! defined( 'THEME_VERSION' ) )
                define( 'THEME_VERSION',    PERRY_VERSION );
                
    	if ( ! defined( 'THEME_NAME' ) )
		    define( 'THEME_NAME',       'Perry Mnmlist' );
		
		define( 'THEME_URI',            get_template_directory_uri() );
		define( 'THEME_DIR',            get_template_directory() );
		
		define( 'CHILD_THEME_URI',      get_stylesheet_directory_uri() );
		define( 'CHILD_THEME_DIR',      get_stylesheet_directory() );
		
		define( 'PERRY_ASSETS',         THEME_URI . '/assets' );
        define( 'PERRY_STYLES',         PERRY_ASSETS . '/css' );
        define( 'PERRY_SCRIPTS',        PERRY_ASSETS . '/js' );
        
		define( 'PERRY_LIB',            THEME_DIR . '/includes' );
		define( 'PERRY_CLASSES',        PERRY_LIB . '/classes' );
        define( 'PERRY_FUNCTIONS',      PERRY_LIB . '/functions' );
        define( 'PERRY_VIEWS',          PERRY_LIB . '/views' );
        define( 'PERRY_EXTENSIONS_URI', THEME_URI . '/includes/extensions' );
        
        define( 'PERRY_TEXT_DOMAIN',    'perry' );
	}
	
	
	
	
	/**
	 * Defines the various items that the theme supports.
	 * 
	 * @return      void
     * @since       1.0.0
	 */ 
	public function theme_support() {
	    
	    add_theme_support( 'post-thumbnails' );
        add_image_size( 'summary-image', 500, 500 );
		add_theme_support( 'menus' );
		add_theme_support( 'editor-style' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 
		    'aside', 
		    'audio', 
		    'gallery', 
		    'image', 
		    'link', 
		    'quote', 
		    'status', 
		    'video' ) );
		add_theme_support( 'infinite-scroll', array(
            'container' => 'content',
            'render'    => array( $this, 'infinite_scroll' )
        ) );
	}
	
	
	
	
	/**
	 * Register the navigation menus for use across the site.
	 * 
	 * @return      void
     * @since       1.0.0
	 */ 
	public function menus() {
	
    	// Register the menus for the theme
    	register_nav_menus(
    		array(
    		  'main-menu' => __( 'Main Menu' ),
    		  'footer-menu' => __( 'Footer Menu' )
    		)
    	);
	}
	
	
	
	
	/**
	 * Register the sidebars/widget areas for use across the site.
	 * 
	 * @return      void
     * 
     * @since       1.0.0
	 */ 
	public function sidebars() {
	
    	register_sidebar( array(
            'name' => __( 'Main Sidebar', 'perry' ),
            'id' => 'sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        
	}
	
	
	
	
	/**
	 * Register & queue the theme scripts.
	 * 
	 * Registers the javascripts that are needed by the theme and then enqueues 
	 * them as necessary. This includes the HTML5 Shiv script by Alexander Farkas 
	 * (https://github.com/aFarkas) and hosted at Google Code which is enqueued
	 * if the browser is IE.
	 * 
	 * @return      void
	 * 
	 * @uses        is_IE
	 * @uses        PERRY_SCRIPTS
     *
     * @since       1.0.0
	 */ 
	public function scripts() {
	    
	    global $is_IE;
	    
	    // Check if the browser if IE, and if so, enqueue the html5shiv script
	    if ( $is_IE ) {
	        wp_register_script( 'html5shiv', 'http://html5shiv.googlecode.com/svn/trunk/html5.js');
	        wp_enqueue_script( 'html5shiv' );
	    }
	    
	    if( ! is_singular() ) {
	        wp_register_script( 'infinite_scroll', PERRY_SCRIPTS . '/jquery.infinitescroll.min.js', array('jquery'),null,true );
            wp_enqueue_script('infinite_scroll');
            if( get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );
        }
	    
	    wp_register_script( 'perry-menu', PERRY_SCRIPTS . '/menu.js', array( 'jquery' ) );
	    wp_enqueue_script( 'perry-menu' );
	
	}
	
	
	
	
	/**
	 * Register & queue the theme stylesheets.
	 * 
	 * Registers the styles that are required by the theme, including the 
	 * normalize.css file by Nicolas Gallagher (http://nicolasgallagher.com/) 
	 * and the Google WebFonts that this theme uses (Lato). The styles are then
	 * enqueued, a check carried out for a child theme, and if one exists,
	 * including the child theme style last.
	 * 
	 * @return      void
	 * 
	 * @uses        PERRY_VERSION
	 * @uses        PERRY_STYLES
	 * @uses        CHILD_THEME_DIR
     * 
     * @since       1.0.0
	 */ 
	public function styles() {
	    
	    if ( ! is_admin() ) {

            wp_register_style( 'normalize', PERRY_STYLES . '/normalize/normalize.css', null, PERRY_VERSION );
            wp_register_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic', array( 'normalize' ), PERRY_VERSION );
            wp_register_style( 'perry-main', PERRY_STYLES . '/main.min.css', array( 'google-fonts' ), PERRY_VERSION );
            wp_register_style( 'perry-wordpress', PERRY_STYLES . '/wordpress.min.css', array( 'perry-main' ), PERRY_VERSION );
            wp_enqueue_style( 'perry-wordpress' );
                
            /*
             * Load child theme stylesheets after PML to override PML 
             * defaults (with thanks to Alison Barrett (http://alisothegeek.com/) 
             * for the code snippet from her Bolts theme
             */
            if ( file_exists( CHILD_THEME_DIR . '/style.css' ) ) {
                /* Compare child style.css to parent style.css, if they're the same, PML is active theme (not parent) */
                /* and there's no need to load the stylesheet again */
                if ( md5( CHILD_THEME_DIR . '/style.css' ) !== md5_file( THEME_DIR . '/style.css' ) ) {
                    wp_register_style( 'perry-child-theme', CHILD_THEME_URI . '/style.css', array( 'perry-wordpress' ), THEME_VERSION );
                    wp_enqueue_style( 'perry-child-theme' );
                }
            }
            
        }
	
	}
	
	
	
	
	/**
	 * Add the FreeSpirit ESU Favicon to the site.
	 * 
	 * @return      string
	 * 
	 * @uses        CHILD_THEME_URI
	 * @uses        THEME_URI
	 * 
	 * @since       1.0.0
	 */
    public function favicon() {
        /*
         * Check if a child theme favicon exists and if so, use that, else use
         * the parent theme favicon
         */
        if ( file_exists( CHILD_THEME_URI . '/favicon.ico' ) ) {
            echo '<link rel="shortcut icon" type="image/x-icon" href="' . CHILD_THEME_URI . '/favicon.ico" />' . "\n";
        } else {
            echo '<link rel="shortcut icon" type="image/x-icon" href="' . THEME_URI . '/favicon.ico" />' . "\n";
        }
    }
    
    
    
    
    /**
     * Change the default excerpt length so post summaries are more readable.
     * 
     * @param       int     $length number of words to include in the excerpt.
     * @return      int             number of words to include in the excerpt.
     * 
     * @since       1.0.0
     */
    public function excerpt_length( $length ) {
        return 125;
    }
    
    
    
    
    /**
     * Change the [...] to a Read More link.
     * 
     * @param       string  $more   the existing 'read more' text.
     * @return      string          the new 'read more' output.
     * 
     * @since       1.0.0
     */
    public function excerpt_more( $more ) {
        global $post;
        return '...<br /><a href="'. get_permalink($post->ID) . '" class="alignright">' . __( 'Read more', 'perry' ) . '</a>';
    }
    
    
    
    
    /**
     * Remove the automatic paragraph wrapper around images.
     * 
     * @param       string  $content    All post content for filtering.
     * @return      string  $content    Filtered post content.
     * 
     * @since       1.0.0
     */
    public function unautop_for_img( $content ) {
        $content = preg_replace(
            '/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
            '<figure>$1</figure>',
            $content
        );
        return $content;
    }
	
	
	
	
	/**
	 * Improve the wp_title output with a filter.
	 * 
	 * @param       string  $title  The base output of wp_title
	 * @param       string  $sep    The separator defined by wp_title
	 * @param       string  $seplocation The position of the separator (left or right)
	 * @return      string  $title  The filtered and updated title for display
	 * 
	 * @since       1.0.0
	 */
	function title( $title, $sep, $seplocation ) {
	    
	    global $page, $paged;
        
        // Don't revise the title in feeds.
        if ( is_feed() )
            return $title;
        
        /*
         * If this is the front page of the site then set a specific title 
         * regardless of the selected separator position
         */
        if ( is_home() || is_front_page() )
            $title = get_bloginfo( 'name' ) . $title . " {$sep} " . get_bloginfo( 'description', 'display' );
        
        // For other pages, add the blog name to the correct position
        if ( 'right' == $seplocation )
            $title .= get_bloginfo( 'name' );
        else
            $title = get_bloginfo( 'name' ) . $title;
            
        // Add a page number if necessary
        if ( $paged >= 2 || $page >= 2 )
            $title .= " {$sep} " . sprintf( __( 'Page %s', 'perry' ), max( $paged, $page ) );
            
        return $title;
        
	}
	
	
	
	
	/**
	 * Generate next/previous navigation for use anywhere within the theme
	 * 
	 * @param       string   nav_id     an ID tag for the navigation element.
	 * @return      void
	 * 
	 * @since     1.0.0
	 */
	function content_navigation( $nav_id ) {
	    
        global $wp_query;
        
        if ( $wp_query->max_num_pages > 1 ) : ?>
            <nav id="<?php echo $nav_id; ?>">
    			<h3 class="assistive-text"><?php _e( 'Post navigation', 'perry' ); ?></h3>
    			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'perry' ) ); ?></div>
    			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'perry' ) ); ?></div>
    		</nav><!-- #<?php echo $nav_id; ?> -->
        <?php endif;
    }
    
    
    
    
    /**
     * Generate an entry meta data tag for display within the theme
     * 
     * @return      void
     * @since       1.0.0
     */
    function entry_meta() {
        printf( __( "
                <small class='posted-on'>
                    <time class='entry-date' datetime='%1$s' pubdate>%2$s<br />%3$s</time>
                </small>
                <small class='entry-meta'>
                    <span class='meta-prep meta-prep-author'>%4$s</span>
                    <span class='author vcard'>
                        <a class='url fn n' href='%5$s' title='%6$s' rel='author'>%7$s, </a>
                    </span>
                    <span class='meta-categories'>in %8$s</span>
                </small>", 'perry' ),
            esc_attr( get_the_time( 'c' ) ),
            esc_html( get_the_date( 'd' ) ),
            esc_html( get_the_date( 'M Y' ),
            esc_attr( 'Written by ', 'perry' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_attr( sprintf( 'View all articles by %s',  get_the_author() ) ),
            get_the_author(),
            get_the_category_list( ', ' ) )
    	);
    }
    
    
    
    
    /**
     * Generates the navigation menu to be used across the network of sites.
     * 
     * If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu 
     * assiged to the primary position is the one used. If none is assigned, the 
     * menu with the lowest ID is used. 
     *
     * Pulls the main menu from blog ID 1 (the main site) and then resets the 
     * current blog ID.
     * 
     * @param       void
     * @return      void
     * 
     * @since       1.0.0
     */
    public function global_menu() {
        
        // Load all blog ids
        global $blog_ids;
    
        //Combine the navigation menus from each of the network blogs for output
        echo '<ul id="menu-main">';
        
        foreach ( $blog_ids as $blog ) {
            // Switch to the next blog in the network 
            switch_to_blog($blog);
            
            // Output the menu for the blog without any the containing <ul> tags
            wp_nav_menu( array( 'container' => 'false', 'items_wrap' => '%3$s' ) );
            restore_current_blog();
        }
        // Switch back to the main blog 
        switch_to_blog(1);
        
        // Output the End menu without any the containing <ul> tags
        wp_nav_menu( array( 'container' => 'false', 'items_wrap' => '%3$s', 'menu' => 'End' ) );
        
        echo '</ul>';
        
        //switch back to the current blog being viewed
        restore_current_blog();
    }
    
    
    
    
    /**
     * Displays a header image dependant on the subdomain
     * 
     * @return      void
     * @since       1.0.0
     */
    public function header_image() {
        $parsedUrl = parse_url( 'http://' . $_SERVER['HTTP_HOST'] );
        $host = explode('.', $parsedUrl['host']);
        $header = '/images/headers/' . $host[0] . '.jpg';
        $default = '/images/headers/default.jpg';
    
        $header = (file_exists(get_stylesheet_directory() . $header))
            ? get_stylesheet_directory_uri() . $header 
            : get_stylesheet_directory_uri() . $default;
       
        print $header;
    }
    
    
    
    
    /**
     * Set the code to be rendered on for calling posts, hooked to template 
     * parts when possible.
     *
     * Note: must define a loop.
     * 
     * @return      void
	 * @uses        PML_VIEWS
     * @since       1.0.0
     */
    public function infinite_scroll() {
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                get_template_part( PERRY_VIEWS . '/summary', get_post_format() ); 
            } 
        } else { 
            get_template_part( PERRY_VIEWS . '/content', 'noposts' ); 
        } 
    }
    
    
    
    
    /**
     * Return the URL for the first link found in the post content.
     *
     * @return      string|bool URL or false when no link is present.
     * @since       1.0.0
     */
    public function url_grabber() {
        if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
    		return false;
    
    	return esc_url_raw( $matches[1] );
    }
    
    
    
    
    /**
     * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
     * 
     * @return      array   page menu arguments.
     * @since       1.0.0
     */
    public function page_menu_args() {
        	$args['show_home'] = true;
	        return $args;
    }
	
}
