</main>
        </div>
            <footer>
            <nav class="main-footer">
            <?php
                wp_nav_menu(array(
                 'theme_location' => 'Menu pied de page',
                 'menu_class' => 'my-footer-menu', 
                 'container' => false,
                ));
             ?>
            </nav>
            </footer>
        </div>
        <?php wp_footer(); ?>
</body>
</html>