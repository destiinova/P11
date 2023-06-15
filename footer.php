</main>
        </div>
                <footer id="footer" role="contentinfo">
                <?php wp_footer() ?>

<?php
 if ( has_nav_menu( 'footer-menu' ) ) : ?>
 <?php 
 wp_nav_menu ( array (
 'theme_location' => 'footer-menu' ,
 'menu_class' => 'my-footer-menu', // classe CSS pour customiser mon menu
 'items_wrap'     => '<ul>%3$s</ul>',
 ) ); 
 echo apply_filters( 'wp_nav_menu_items', wp_nav_menu( $args ), $args );
 ?>










 <?php endif;
 ?>
                <?php get_template_part('template-parts/modal-contact'); ?>
                </footer>
        </div>


        
    
</body>
</html>