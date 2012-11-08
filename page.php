<?php
/* SVN FILE: $Id$ */
/**
 *  The default template for displaying pages
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.1.0
 *  @version        $Rev$
 *  @modifiedby     $LastChangedBy$
 *  @lastmodified   $Date$
 *
 *  @todo           ToDo List
 *                  - 
 */

get_header(); ?>

        <section id='primary'>
            <div id="content" role="main">
                <nav class='breadcrumb'>
                    <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
                </nav>
    
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class='entry-header'>
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="
                            <?php printf( esc_attr__( '%s', 'perrymnmlist' ), 
                            the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                            <?php the_title(); ?></a></h2>
                        <?php 
                        edit_post_link( __( 'Edit', 'perrymnmlist' ), 
                            '<span class="edit-link alignright">', '</span>' );
                        ?>
                    </header><!-- .entry-header -->
            
                    <div class='entry'><?php the_content(); ?></div><!-- .entry -->
                </article><!-- #post-<?php the_ID(); ?> -->
            </div><!-- #content -->
        </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>