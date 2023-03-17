<?php get_header();
	while(have_posts()): the_post();
		$category = get_the_category();
		$catID = $category[0]->term_id; ?>

<!-- jquery for single page , on others page we have jquery from elementor -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
	integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script src="https://player.vimeo.com/api/player.js"></script>

<section class="page_content">

	<div class="container">

		<?php
				$video = get_field('film');
				$video_url = get_field('film', FALSE, FALSE);
				//$imageUrl = get_video_thumbnail_uri($video_url);
				$imageUrl = grab_vimeo_thumbnail($video_url);
				$imageUrl = str_replace('_640','',$imageUrl);
				$imageAlt = get_the_title();
				$imageData = get_field('kadr_emblematyczny');
				if($imageData):
					$imageUrl = $imageData['sizes']['1536x1536'];
					$imageAlt = $imageData['alt'];
				endif; ?>
		<div class="video">
			<figure class="placeholder" style="padding-bottom:56.25%">
				<img loading="lazy" src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>" />
			</figure>
			<div class="vimeo"><?php the_field('film'); ?></div>
			<img loading="lazy" class="play" src="<?php echo get_theme_file_uri(); ?>/assets/img/play.svg"
				alt="Play vimeo video" />
		</div>
		<div class="clear"></div>


		<div class="project_info">
			<h2 class="headline_m"><?php the_title(); if(get_field('podtytul')): ?>.
				<?php the_field('podtytul'); ?>.<?php endif; ?></h2>

			<div class="info_left">
				<?php while(have_rows('info')): the_row();
							if(get_sub_field('naglowek')): ?><h3><?php the_sub_field('naglowek'); ?></h3><?php endif;
							if(get_sub_field('nazwa')): ?><h4><?php the_sub_field('nazwa'); ?></h4><?php endif; ?>
				<?php endwhile; ?>
			</div>

			<div class="info_right">
				<?php the_content(); ?>
			</div>

		</div>

	</div>

</section>

<?php endwhile; ?>

<script>
window.addEventListener('DOMContentLoaded', () => {

	$('.video').click(function() {
		var $this = $(this);
		$this.addClass('loaded');
		var iframe = $this.find('iframe');
		var player = new Vimeo.Player(iframe);
		player.play();
		player.on('play', function() {
			$this.addClass('active');
		});
	});
})
</script>

<?php get_footer(); ?>