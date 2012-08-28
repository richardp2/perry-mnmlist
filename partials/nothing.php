<?php
/* SVN FILE: $Id$ */
/**
 *  A part theme for displaying alternative when there is nothing available
 *
 *  Displays a list of recent posts, categories, archives and a tag cloud for use
 *  in any theme file
 *
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.1.0
 *  @version        $Rev$
 *  @modifiedby     $LastChangedBy$
 *  @lastmodified   $Date$
 *
 *  @todo           ToDo List
 *                  - 
 */
?>

                    <?php get_search_form(); ?>

                    <?php the_widget( 'WP_Widget_Recent_Posts', 
                       array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

                    <div class="widget">
                        <h2 class="widgettitle">
                            <?php _e( 'Most Used Categories', 'perrymnmlist' ); ?>
                        </h2>
                        <ul>
                        <?php wp_list_categories( array( 'orderby' => 'count', 
                            'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 
                            'number' => 10 ) ); ?>
                        </ul>
                    </div>

                    <?php
                    /* translators: %1$s: smilie */
                    $archive_content = '<p>' . sprintf( __( 'Try looking in the 
                       monthly archives. %1$s', 'perrymnmlist' ), 
                       convert_smilies( ':)' ) ) . '</p>';
                    the_widget( 'WP_Widget_Archives', array('count' => 0 , 
                       'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
                    ?>

                    <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>