</main>
        </div>
            <footer>
            <nav class="main-footer">
            <?php wp_nav_menu([
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => 'my-footer-menu'
                ]) 
            ?>
            </nav>
            </footer>
        </div>
        <?php wp_footer(); ?>
</body>
</html>