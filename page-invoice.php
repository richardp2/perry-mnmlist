<?php
/* SVN FILE: $Id: page.php 15 2012-11-08 14:39:59Z richard@perrymail.me.uk $ */
/**
 *  The default template for displaying pages
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 1.2.0
 *  @version        $Rev: 15 $
 *  @modifiedby     $LastChangedBy: richard@perrymail.me.uk $
 *  @lastmodified   $Date: 2012-11-08 14:39:59 +0000 (Thu, 08 Nov 2012) $
 *
 *  @todo           ToDo List
 *                  - 
 */

  ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" 
        content="<?php bloginfo('html_type'); ?>; 
        charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title(''); ?></title>
    
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php 
    if ( is_singular() && get_option( 'thread_comments' ) ) 
        wp_enqueue_script( 'comment-reply' );
    
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>
    <div id='wrapper' class='hfeed'>
    
       <div id='main'>
    
            <section id='primary'>
                <div id="content" role="main">
        
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>            
                        <div class='entry'><?php the_content(); ?></div><!-- .entry -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                </div><!-- #content -->
            </section><!-- #primary -->
    
        </div><!-- #main -->

        <footer id='footer' role='contentinfo'>
            <div id='payment-terms'>PAYMENT WITHIN 30 DAYS PLEASE</div>
            <div id='overdue'>Late charges of 5% above base rate will be applied to all overdue accounts</div>
        </footer><!-- #footer -->
    </div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>