<?php get_header();
/*
Template name: Page news
*/
?>


<!-- jquery for single portfolio page , on others page we have jquery from elementor -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<!-- portfolio page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Shuffle/5.1.1/shuffle.js"></script>

<section class="page_content">
    <div class="container" style="padding: 0px;">

        <div class="projects_container">
            <div class="projects" style="max-width: 1400px; margin: 0 auto;">

                <?php 

					// WP_Query arguments
					$args = array(
						'post_type' => 'newsy',
						'posts_per_page'         => 	-1,
					);

					// The Query
					$query = new WP_Query( $args );

					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post(); 	?>

                <!-- item -->


                <div class="news--item">

                    <a class="link" href="<?php the_permalink(); ?>">
                        <figure style="padding-bottom:100%">
                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" />
                        </figure>
                        <div class="news--title">
                            <h2> <?php the_title(); ?> </h2>
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


<style>
.dont-have-img {
    /* border: 3px solid blue; */
    display: none;
}

.has-img {}

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


.scrolled #orka-portfolio-header {
    height: auto;
    padding: 15px 0 15px !important;

}

.scrolled #orka-portfolio-header h1 {
    font-size: 20px;
    margin-top: 26px;
}

.scrolled #orka-portfolio-header h1 {
    font-size: 15px;
    margin-top: 0;
}

.scrolled #orka-portfolio-header {
    height: auto;
    padding: 15px 0 15px;
}

.scrolled #orka-portfolio-header {
    background: #000;
    padding: 0;

}

.scrolled .page_content .cats {
    visibility: hidden;
}
</style>


<?php get_footer(); ?>