</main>
        </div>
            <footer>
            <?php
            if ( has_nav_menu( 'Menu pied de page' ) ) : ?>
          <?php wp_nav_menu( array (
          'theme_location' => 'Menu pied de page',
          'menu_class' => 'my-footer-menu', 
          'container' => false));
          ?>
           <?php endif;
          ?>
            </footer>
        </div>
        <?php wp_footer(); ?>
</body>
</html>




