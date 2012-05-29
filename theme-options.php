<?php

add_action( 'admin_init', 'perrymnmlist_theme_options_init' );
add_action( 'admin_menu', 'perrymnmlist_theme_options_add_page' );

/**
 * Init plugin options to white list our options
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_theme_options_init(){
    register_setting( 'perrymnmlist_options', 'perrymnmlist_theme_options' );
}

/**
 * Load up the menu page
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'perrymnmlist' ), __( 'Theme Options', 'perrymnmlist' ), 'edit_theme_options', 'theme_options', 'perrymnmlist_theme_options_render_page' );
}



/**
 * Build up the default theme options
 *
 * @since Perry Minimalist 1.0
 */
global $wpdb;
$prefix = 'pml_';

// Query all blogs from multi-site install
$blogs = $wpdb->get_results("SELECT blog_id,domain,path FROM wp_blogs ORDER BY path");

// For each blog search for blog name in respective options table
$i = 0;
foreach( $blogs as $blog ) {
    // Get rest of the sites
    $blogname = $wpdb->get_results("SELECT option_value FROM wp_".$blog->blog_id ."_options WHERE option_name='blogname' ");
    foreach( $blogname as $name ) {
        $perrymnmlist_theme_options[$i] = array(
            'name'  =>  __($name->option_value),
            'desc'  =>  __(''),
            'id'    => $prefix . 'blogs_' . $blog->blog_id,
            'std'   => 'false',
            'type'  => 'checkbox');
    }
    $i++;
}

$perrymnmlist_theme_options[$i] = array(
    'name'  => __('Footer Text'),
    'desc'  => __('Text to be added to the standard theme footer'),
    'id'    => $prefix . 'footer_text',
    'std'   => '',
    'type'  => 'text');


/**
 * Create the options page
 *
 * @since Perry Minimalist 1.0
 */
function perrymnmlist_theme_options_render_page() {

    global $perrymnmlist_theme_options;
    
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'perrymnmlist' ) . "</h2>"; ?>
        <?php settings_errors(); ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'perrymnmlist' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php 
                $settings = get_option( 'perrymnmlist_theme_options', $perrymnmlist_theme_options );
                print_r($settings);
                settings_fields( 'perrymnmlist_options' ); 
            ?>
			

			<table class="form-table">
                <tr valign="top"><th scope="row"><?php _e( 'Select sites to include on the Main Site page', 'perrymnmlist' ); ?></th>
					<td>
                    <?php foreach( $settings as $value ) : ?>
                        <?php print_r($value); ?>
                        <input id="<?php echo $value['id']; ?>" 
                               name="<?php echo $value['id']; ?>" 
                               type="<?php echo $value['type']; ?>" 
                               value="<?php 
                                    if( get_option( $value['id'] ) != "") { 
                                        echo get_option( $value['id'] ); 
                                    } else { 
                                        echo $value['std']; 
                                    } ?>" />
                        <label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br />
                    <?php endforeach; ?>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'perrymnmlist' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/