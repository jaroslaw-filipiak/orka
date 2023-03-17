<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<footer class="orka--footer">
    <div class="container">

        <div class="social">
            <div class="social_icons">
                <a target="_blank" href="https://www.facebook.com/orkafilm"><img
                        data-src="<?php echo get_theme_file_uri() ?>/assets/img/fb.svg"
                        src="<?php echo get_theme_file_uri() ?>/assets/img/fb.svg" data-was-processed="true"></a>
                <a target="_blank" href="https://www.instagram.com/orka_postproduction/"><img
                        data-src="<?php echo get_theme_file_uri() ?>/assets/img/insta.svg"
                        src="<?php echo get_theme_file_uri() ?>/assets/img/insta.svg" data-was-processed="true"></a>
                <a target="_blank" href="https://www.linkedin.com/company/studio-produkcyjne-orka-sp-z-o-o-"><img
                        data-src="<?php echo get_theme_file_uri() ?>/assets/img/linkedin.svg"
                        src="<?php echo get_theme_file_uri() ?>/assets/img/linkedin.svg" data-was-processed="true"></a>
                <a target="_blank" href="https://vimeo.com/orka"><img
                        data-src="<?php echo get_theme_file_uri() ?>/assets/img/vimeo.svg"
                        src="<?php echo get_theme_file_uri() ?>/assets/img/vimeo.svg" data-was-processed="true"></a>
            </div>
        </div>

        <div style="display: none;">
            <?php // echo do_shortcode('[wpml_language_switcher]') ?>
        </div>


    </div>
</footer>

<div class="lightbox">
    <div id="video" class="vimeo_container"></div>
    <div class="close"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.0/jquery.slicknav.min.js"
    integrity="sha512-9I/r/FKSSM9BN2CSYwWY1psDPVBLN+ygCmtUjzNdyVpD96xVDTuRv1wyMkTGMWGBAAlgSAYZygVBz0Wsp6B1nQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
window.addEventListener('DOMContentLoaded', (event) => {

    $('.preloader').fadeOut();

});
</script>

<script>
window.addEventListener('DOMContentLoaded', () => {
    $(function() {
        $('.menu-main-container #menu-main').slicknav({
            'duplicate': false,
        });
    });
})
</script>



<?php wp_footer(); ?>

</body>

</html>