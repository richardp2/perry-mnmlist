<?php
/**
 *  The template for displaying 404 pages (Not Found).
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.2.0
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  - Make the 404 page more interesting 
 * 
 *  @change         v0.2.0 - Converted version control to Git
 *                         - Updated file information comments
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Umm... there may be a 
					   problem here!', 'perrymnmlist' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re 
					   looking for. Perhaps searching, or one of the links below, 
					   can help.', 'perrymnmlist' ); ?></p>
                    <?php get_template_part( '/partials/nothing', '' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>