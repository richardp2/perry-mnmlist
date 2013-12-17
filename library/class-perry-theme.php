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
 * @copyright      Copyright (c) 2013 Richard Perry
 * @license        http://www.gnu.org/licenses/gpl-3.0.html
 * @since          1.0
 * @version        0.2.6
 * @modifiedby     Richard Perry <richard@perrymail.me.uk>
 * @lastmodified   15 July 2013
 *
 * @todo           ToDo List
 *                  -  
 * 
 * @change         v0.2.6 - Generated the empty class file
 */
class Bolts {
	
	/**
	 * Construct
	 * 
	 * 
	 * 
	 * @param     void
	 * @return    void
	 * 
	 * @uses      THEME_URI
	 * @uses      THEME_DIR
	 * @uses      
	 * 
	 * @access    public
	 * @since     1.0
	 */
	public function __construct() {
		
		if ( ! defined( 'THEME_NAME' ) )
			define( 'THEME_NAME',       'Perry Mnmlist' );
		
		define( 'THEME_URI',            get_template_directory_uri() );
		define( 'THEME_DIR',            get_template_directory() );
		
		define( 'CHILD_THEME_URI',      get_stylesheet_directory_uri() );
		define( 'CHILD_THEME_DIR',      get_stylesheet_directory() );
		
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'editor-style' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
		
		$this->wp_hooks();
	}

	
	
	/**
	 * Add WordPress hooks
	 * 
	 * @param     void
	 * @access    public
	 * @since     1.0
	 */
	public function wp_hooks() {
		
		
	}
	
}
