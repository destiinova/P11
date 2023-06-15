<header class="d-flex py-3 px-5 bg-info">
    <?php $logo = get_theme_mod( 'header_logo' );
if ( $logo ) {
   echo '<a id="link" href="'. home_url().'"> <img class="headerlogo" src="' . esc_url( $logo ) . '" alt="Header Logo"></a>';
}   ?>
    <nav class="nav" id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
        <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span id="burger" itemprop="name">', 'link_after' => '</span>' ) ); 
        ?>
    </nav>
</header>



