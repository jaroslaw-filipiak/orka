<?php get_header() ?>

<!-- <header>
    <div class="container">
        <nav class="site_nav">
            <a class="logo" href="<?php echo get_home_url() ?>">
                <span class="menu_trigger"></span>
                <span class="orka_symbol"></span>
                <img class="orka_txt loaded" src="<?php echo get_theme_file_uri() ?>/assets/img/orka-txt.svg">
            </a>
        </nav>
        <h1>Home</h1>

    </div>
</header> -->

<section class="start" style="width: 100%; height: 100%">
    <video width="100%" autoplay muted loop playsinline>
        <source src="<?php echo get_home_url() ?>/wp-content/uploads/2023/01/background_v5.mp4" type="video/mp4">
    </video>
</section>


<nav id="menu" class="homepage-screen-menu">
    <div class="menu_inner">
        <?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
        <div class="home--lang-switcher">
            <?php // echo do_shortcode('[wpml_language_switcher]') ?>
        </div>

    </div>
</nav>


<style>
#menu-main-1 .wpml-ls-menu-item {
    display: none;
}

.orka-mobile-header {
    display: none;
}

.slicknav_menu {
    display: none;
}
</style>

<?php get_footer() ?>