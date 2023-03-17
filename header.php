<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php $viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' ); ?>
    <meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.0/slicknav.min.css"
        integrity="sha512-MVXhwgzug/vd2/6CjhEI2KY7Hl60+LM3alGwzQAnlOifbQqEbiUb8nfQHonBMDJUT8J/AT6xoWv07G96TL7fFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.0/jquery.slicknav.min.js"
        integrity="sha512-9I/r/FKSSM9BN2CSYwWY1psDPVBLN+ygCmtUjzNdyVpD96xVDTuRv1wyMkTGMWGBAAlgSAYZygVBz0Wsp6B1nQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>





    <!-- fav + mobile color theme -->

    <link rel="apple-touch-icon" sizes="180x180"
        href="<?php echo get_home_url(); ?>/app/themes/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?php echo get_home_url(); ?>/app/themes/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?php echo get_home_url(); ?>/app/themes/assets/favicon/favicon-16x16.png">
    <link rel="manifest"
        href="<?php echo get_home_url(); ?>/app/themes/assets/favicon/site.webmanifest">
    <link rel="mask-icon"
        href="<?php echo get_home_url(); ?>/app/themes/assets/favicon/safari-pinned-tab.svg"
        color="#5bbad5">
    <link rel="shortcut icon"
        href="<?php echo get_home_url(); ?>/app/themes/assets/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config"
        content="<?php echo get_home_url(); ?>/app/themes/assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- end fav + mobile color theme -->

    <!-- used in portfolio page -->
    <script type="text/javascript">
    var templateUrl = '<?= get_bloginfo("template_url"); ?>';
    var blogUrl = '<?= get_bloginfo("url"); ?>';
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="preloader">
        <img src="<?php echo get_theme_file_uri() ?>/assets/img/logo.jpg" alt="orkafilm logotyp">

    </div>

    <div class="orka-mobile-header">
        <?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
    </div>

    <?php hello_elementor_body_open(); ?>
    <?php
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
			if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
				get_template_part( 'template-parts/dynamic-header' );
			} else {
				get_template_part( 'template-parts/header' );
			}
		}