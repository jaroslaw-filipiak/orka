<?php get_header();

/*
Template name: Portfolio
*/

?>



<?php echo do_shortcode('[elementor-template id="3795"]'); ?>

<!-- cats  -->
<div style="display: none;" class="container-fluid border" style="background-color: #000; margin-top: 150px;">
    <div class="container">
        <ul class="cats-portfolio shuffle-filter">

            <span style="display: block" class="cat">
                <span style="display: inline-block" class="cats--filter" data-target="animation" data-group="animation">
                    Animation</span>
            </span>
            <span style="display: block" class="cat">
                <span style="display: inline-block" class="cats--filter" data-target="commercial"
                    data-group="commercial">
                    Commercial</span>
            </span>
            <span style="display: block" class="cat">
                <span style="display: inline-block" class="cats--filter" data-target="digital/other"
                    data-group="digital-other">
                    Digital/Other</span>
            </span>
            <span style="display: block" class="cat">
                <span style="display: inline-block" class="cats--filter" data-target="features" data-group="features">
                    Features</span>
            </span>
            <span style="display: block" class="cat">
                <span style="display: inline-block" class="cats--filter" data-target="reel" data-group="reel">
                    Reel</span>
            </span>
            <span style="display: block" class="cat">
                <span style="display: inline-block" class="cats--filter" data-target="vfx" data-group="vfx">
                    VFX</span>
            </span>
        </ul>
    </div>

</div>
<!-- cats -->

<!-- jquery for single portfolio page , on others page we have jquery from elementor -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<!-- portfolio page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Shuffle/5.1.1/shuffle.js"></script>

<section class="page_content">
    <div class="container" style="padding: 0px;">

        <ul style="display: none;" class="cats shuffle-filter">
            <!-- <li class="cat clear_filters active">
				<a data-cat="1" href="<?php bloginfo('url'); ?>/portfolio/">all</a>
			</li> -->
            <?php $categories = get_categories('hide_empty=0&exclude=1&orderby=menu_order&order=ASC');
			foreach ($categories as $category):
				$cat_ID = $category->cat_ID; ?>
            <span style="display: block" class="cat">
                <?php $name = $category->name; ?>
                <?php $slug = $category->slug; ?>
                <span style="display: inline-block" class="cats--filter" data-target='<?php echo strtolower($name) ; ?>'
                    data-group='<?php echo strtolower($slug) ; ?>'>
                    <?php echo $category->name ?></span>
            </span>
            <?php endforeach; ?>
        </ul>



        <div class="projects_container">
            <div class="projects shuffle-container" style="max-width: 1400px; margin: 0 auto;">

                <?php 

					// WP_Query arguments
					$args = array(
						// 'nopaging'               => false,
						'posts_per_page'         => 	-1,
					);

					// The Query
					$query = new WP_Query( $args );

					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post(); 	

							$categories = get_the_category(); 
							$post_classes = array(); // Create an empty array for the post classes
							$cat_name = $categories[0]->cat_name;
							$img = get_the_post_thumbnail_url($post->ID);


							  // Loop through the categories and add a class for each one
							  foreach ( $categories as $category ) {
								$post_classes[] = '' . $category->slug. '';
							}

							 // Add the post classes to the existing post classes
							 $post_classes = array_merge( $post_classes );

							
			
				if($img):

				$hasImgClass = 'has-img';
				$imageAlt = get_post_meta(get_post_thumbnail_id(),'_wp_attachment_image_alt',true);

				else:
				// $video = get_field('film');
				// $video_url = get_field('film', FALSE, FALSE);
				// $imageUrl = 'rere';
				$hasImgClass = 'dont-have-img';
				// $imageUrl = str_replace('.jpg','_800.jpg',$imageUrl);
				// $imageAlt = get_the_title();
				
				endif; ?>


                <!-- item -->


                <div data-groups='<?php echo esc_attr( join( ',', $post_classes ) ); ?>'
                    class="project_asset <?php echo $hasImgClass ?>">
                    <a class="link" href="<?php the_permalink(); ?>">
                        <figure style="padding-bottom:100%">
                            <img loading="lazy" src="<?php echo $img; ?>" alt="<?php echo $imageAlt; ?>" />
                        </figure>
                        <div class="project_title">
                            <h2> <?php the_title(); ?> <span><?php if(get_field('podtytul')): ?>|
                                    <?php the_field('podtytul'); ?></span><?php endif; ?></h2>
                        </div>
                    </a>
                </div>
                <!-- item END -->



                <?php }
					} else {
						// no posts found
					}

					// Restore original Post Data
					wp_reset_postdata();

					?>


            </div>
        </div>
    </div>

</section>


<script>
window.addEventListener('DOMContentLoaded', (event) => {

    var Shuffle = window.Shuffle;
    var element = document.querySelector('.shuffle-container');

    var shuffleInstance = new Shuffle(element, {
        itemSelector: '.project_asset',
        delimeter: ',',
        isCentered: true,
    });

    $('.shuffle-filter .cats--filter').on('click', function(event) {
        event.preventDefault();
        console.log('click')
        $('.shuffle-filter .cats--filter').removeClass('selected');
        $(this).addClass('selected');

        var button = event.target;
        var group = button.getAttribute('data-group');
        shuffleInstance.filter(group);

    });

});
</script>


<style>
.dont-have-img {
    display: none;
}

.project_asset a:hover img {
    filter: contrast(1.1) brightness(1.1) grayscale(0.8);
}

.project_asset:nth-child(6n + 1) a:after {
    background: #871199;
}

.project_asset:nth-child(6n + 2) a:after {
    background: #22cc11;
}

.project_asset:nth-child(6n + 3) a:after {
    background: #cccc00;
}

.project_asset:nth-child(6n + 4) a:after {
    background: #0000ee;
}

.project_asset:nth-child(6n + 5) a:after {
    background: #ff7700;
}

.project_asset:nth-child(6n + 6) a:after {
    background: #ff1199;
}

.page-template-template-portfolio-page .page_content {
    padding-top: 30px;
}

.menu_trigger {
    border: 11px solid white;
}

#orka-header {
    background-color: #000 !important;
}
</style>


<?php get_footer(); ?>