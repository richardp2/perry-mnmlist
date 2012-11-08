<?php
/* SVN FILE: $Id$ */
/**
 *  The searchform template file.
 *
 *  @package        Perry Minimalist
 *  @subpackage     Content
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.1.0
 *  @version        $Rev$
 *  @modifiedby     $LastChangedBy$
 *  @lastmodified   $Date: 2012-09-20 11:45:48 +0100 (Thu, 20 Sep 2012) $
 *
 *  @todo           ToDo List
 *                  -
 */
?>
                <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <label for="s" class="assistive-text"><?php _e( 'Search', 'perrymnmlist' ); ?></label>
                    <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'perrymnmlist' ); ?>" />
                    <button type="submit" class="submit" name="submit" id="searchsubmit"><?php esc_attr_e( 'Search', 'perrymnmlist' ); ?></button>
                </form>