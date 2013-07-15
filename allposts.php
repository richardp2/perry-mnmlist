<?php
/**
 *  Template Name: All Post Archive
 *
 *  A page template to display all posts in a list
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.2.3
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  -  
 * 
 *  @change         v0.2.3 - Converted version control to Git
 *                         - updated file information comments
 *                  v0.2.2 - Removed surplus <br> tags
 *                  v0.2.1 - Amended for better HTML5 support
 *                  v0.2.0 - Reformatted the output
 *                  v0.1.0 - Initial import into SVN
 */
?>

<?php get_header(); ?>

	   <section id='primary'>
            <div id="content">
                <nav class='breadcrumb'>
                    <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
                </nav>
        		<article class="post" id="post-<?php the_ID(); ?>">
        			<h2 class='entry-title'>Archives</h2>
        			<div class="entry">
        
                        <table id='arc'>
        <?php
        $query = "SELECT YEAR(post_date) AS `year`, 
                        MONTH(post_date) as `month`, 
                        DAYOFMONTH(post_date) as `dayofmonth`, 
                        ID, 
                        post_name, 
                        post_title 
                    FROM $wpdb->posts 
                    WHERE post_type = 'post' 
                    AND post_status = 'publish' 
                    ORDER BY post_date DESC";
        $key = md5($query);
        $cache = wp_cache_get( 'mp_archives' , 'general');
        if ( !isset( $cache[ $key ] ) ) {
          $arcresults = $wpdb->get_results($query);
          $cache[ $key ] = $arcresults;
          wp_cache_add( 'mp_archives', $cache, 'general' );
        } else {
          $arcresults = $cache[ $key ];
        }
        if ($arcresults) {
          $last_year = 0;
          $last_month = 0;
          foreach ( $arcresults as $arcresult ) {
            $year = $arcresult->year;
            $month = $arcresult->month;
            if ($year != $last_year) {
              $last_year = $year;
              $last_month = 0;
        ?>
                            <tr class='year'>
                                <th><?php echo $arcresult->year; ?></th>
                            </tr>
        <?php
            }
            if ($month != $last_month) {
              $last_month = $month;
        ?>
                            <tr class='month'>
                                <th><?php echo $wp_locale->get_month($arcresult->month); ?></th>
                                <td></td>
                            </tr>
        <?php
            }
        ?>
                            <tr class='archive'>
                                <th><?php echo $arcresult->dayofmonth; ?></th>
                                <td id=p<?php echo $arcresult->ID; ?>>
                                    <a href='<?php echo get_permalink( $arcresult->ID ); ?>'
                                        title='<?php echo strip_tags(apply_filters('the_title', $arcresult->post_title)); ?>'>
                                        <?php echo strip_tags(apply_filters('the_title', $arcresult->post_title)); ?>
                                    </a>
                                </td>
                            </tr>
        <?php
          }
        }
        ?>
                        </table>
                    </div>
                </article>
            </div><!-- #content -->
        </section><!-- #primary -->


<?php get_footer(); ?>