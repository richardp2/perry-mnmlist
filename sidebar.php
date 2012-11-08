<?php
/* SVN FILE: $Id: sidebar.php 17 2012-09-20 10:45:48Z richard@perry-online.me.uk $ */
/**
 *  The sidebar template file.
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.1.0
 *  @version        $Rev: 17 $
 *  @modifiedby     $LastChangedBy: richard@perry-online.me.uk $
 *  @lastmodified   $Date: 2012-09-20 11:45:48 +0100 (Thu, 20 Sep 2012) $
 *
 *  @todo           ToDo List
 *                  -
 */
?>
            <?php if ( is_active_sidebar('sidebar-1') ) : ?>
            <section id='secondary' class='widget-area'>
                <ul class="xoxo">
                    <?php dynamic_sidebar('sidebar-1'); ?>
                </ul>
            </section><!-- #secondary .widget-area -->
            <?php endif; ?>