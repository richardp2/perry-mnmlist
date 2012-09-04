<?php
/* SVN FILE: $Id$ */
/**
 *  A part theme for displaying home specific content
 *
 *  Displays the home page post(s) without titles, meta data or comment data
 *
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.0.0
 *  @version        $Rev$
 *  @modifiedby     $LastChangedBy$
 *  @lastmodified   $Date$
 *
 *  @todo           ToDo List
 *                  - 
 */
 
    /**
     * Display the latest home page post specifically for display at the top of the home page
     */ 
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class='entry'>
        <?php the_content(); ?>
        </div><!-- .entry -->
    </article><!-- #post-<?php the_ID(); ?> -->

