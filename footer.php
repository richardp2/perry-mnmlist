<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage perry_mnmlist
 * @since Perry Minimalist 1.0
 */
?>

        </div><!-- #main -->

        <footer id='footer' role='contentinfo'>
            <div id='site-info'>
                Copyright &copy; 2009-<?php echo date('Y');?> Rosie & Jim. All Rights Reserved. 
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