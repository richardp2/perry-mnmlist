<?php
/* SVN FILE: $Id: summary.php 15 2012-11-08 14:39:59Z richard@perrymail.me.uk $ */
/**
 *  A part theme for displaying link summaries on the home/blog page
 *
 *  Displays the title of the post as a link to the linked content instead
 *  of the post and removes some of the extraneous details
 *
 *  @package        Perry Minimalist
 *  @subpackage     Partials
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.0.0
 *  @version        $Rev: 15 $
 *  @modifiedby     $LastChangedBy: richard@perrymail.me.uk $
 *  @lastmodified   $Date: 2012-11-08 14:39:59 +0000 (Thu, 08 Nov 2012) $
 *
 *  @todo           ToDo List
 *                  - 
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class='entry-header'>
		    <?php
                $content = get_the_content();
                $linktoend = stristr($content, "http" );
                $afterlink = stristr($linktoend, ">");
                if ( ! strlen( $afterlink ) == 0 ):
                    $linkurl = substr($linktoend, 0, -(strlen($afterlink) + 1));
                else:
                    $linkurl = $linktoend;
                endif;
            ?>
			<h2 class="entry-title">
			    <div class='link-tag'>
    			    <div class='icon'></div>
    			    <a href="<?php echo $linkurl; ?>"><?php the_title(); ?></a>
			    </div>
			</h2>
            <h3 class='entry-format'><?php echo get_post_format(); ?></h3>
            <?php
            perrymnmlist_posted_on(); 
			edit_post_link( __( 'Edit', 'perrymnmlist' ), '<span class="edit-link alignright">', '</span>' ); 
			?>
		</header><!-- .entry-header -->

		<div class='entry'>
		    <?php the_content( "Read More..." ); ?>
        </div><!-- .entry -->
	</article><!-- #post-<?php the_ID(); ?> -->
