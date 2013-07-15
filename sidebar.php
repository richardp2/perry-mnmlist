<?php
/**
 *  The sidebar template file.
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.3
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  - 
 * 
 *  @change         v0.3 - updated file header information
 */
?>
            <?php if ( is_active_sidebar('sidebar-1') ) : ?>
            <section id='secondary' class='widget-area'>
                <ul class="xoxo">
                    <?php dynamic_sidebar('sidebar-1'); ?>
                </ul>
            </section><!-- #secondary .widget-area -->
            <?php endif; ?>