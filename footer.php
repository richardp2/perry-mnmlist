<?php
/**
 *  The template for displaying the footer.
 *
 *  Contains the closing of the id=main div and all content after
 *
 *  @package        Perry Minimalist
 *  @subpackage     Templates
 *  @copyright      Richard Perry <http: //www.perry-online.me.uk/>
 *  @since          Release 0.1.0
 *  @version        0.2.2
 *  @modifiedby     Richard Perry <richard@perrymail.me.uk>
 *  @lastmodified   15 July 2013
 *
 *  @todo           ToDo List
 *                  -  
 * 
 *  @change         v0.2.2 - Converted version control to Git
 *                         - Updated file information comments
 *                  v0.2.1 - Adjusted link to login page to redirect to referrer
 *                  v0.2.0 - Added link to login page
 *                  v0.1.0 - Initial import into SVN
 */

$login_referer = is_home() ? '/' : get_permalink();
?>

        </div><!-- #main -->

        <footer id='footer' role='contentinfo'>
            <div id='site-info'>
                Copyright &copy; 2009-<?php echo date('Y'); ?> Rosie & Jim. All 
                <a href='<?php echo wp_login_url( $login_referer ); ?>' title=''
                    class='secret'>Rights</a> Reserved. 
            </div>

            <div id='creative-commons'>
                <!-- Creative Commons Licence Information -->
                <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">
                    <img alt="Creative Commons Licence" style="border-width:0" 
                        src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" />
                </a>
                <!-- End of Creative Commons Licence Information -->
            </div>
   
            <div id="site-generator">
                <?php do_action( 'perrymnmlist_credits' ); ?>
                Hosted by <a href='http://www.supergreenhosting.co.uk/' title='Super Green Hosting' rel='host'>Super Green Hosting</a> &nbsp; &nbsp; | &nbsp; &nbsp; 
                <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'perrymnmlist' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'perrymnmlist' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'perrymnmlist' ), 'WordPress' ); ?></a>
            </div>
        </footer><!-- #footer -->
    </div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>