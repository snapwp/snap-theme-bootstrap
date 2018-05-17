<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4" role="navigation">
    <div class="container">
        <a class="navbar-brand" href="<?php echo  esc_attr( get_home_url() ); ?>">
            <img src="//getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block mr-lg-2 align-top" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <?php echo get_bloginfo( 'name' ); ?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-navigation" aria-controls="primary-navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        wp_nav_menu( [
            'menu'            => 'primary',
            'theme_location'  => 'primary',
            'container'       => 'div',
            'container_id'    => 'primary-navigation',
            'container_class' => 'collapse navbar-collapse',
            'menu_id'         => false,
            'menu_class'      => 'navbar-nav ml-auto mt-2 mt-lg-0',
            'depth'           => 2,
            'items_wrap'      => '<ul id="%1$s" class="%2$s" itemscope itemtype="http://www.schema.org/SiteNavigationElement">%3$s</ul>',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new Theme\Walkers\Navbar()
        ] );
        ?>
    </div>
</nav>