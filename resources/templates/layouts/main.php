<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=2,user-scalable=1">
        <title><?php wp_title(''); ?></title>

        <!--[if IEMobile]><meta http-equiv="cleartype" content="on"><![endif]-->

        <?php wp_head(); ?>
    </head>

    <body itemscope itemtype="http://schema.org/WebPage" <?php body_class(); ?>>

        <?php
        // Include the navigation partial.
        $this->partial('navigation');

        // Outputs the content of the current view template.
        $this->outputView();

        $this->partial('footer');
        ?>

        <?php wp_footer(); ?>

    </body>
</html>
