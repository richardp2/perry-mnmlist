<?php
/**
 *  The searchform template file.
 *
 *  @package        Perry Minimalist
 *  @subpackage     Content
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.2
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  -  
 * 
 *  @change         v0.2 - updated file header information
 */
?>
                <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <label for="s" class="assistive-text"><?php _e( 'Search', 'perrymnmlist' ); ?></label>
                    <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'perrymnmlist' ); ?>" />
                    <button type="submit" class="submit" name="submit" id="searchsubmit"><?php esc_attr_e( 'Search', 'perrymnmlist' ); ?></button>
                </form>