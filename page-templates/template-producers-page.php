<?php get_header();
/*
Template name: Producers
*/
?>

<section class="page_content">

	<div class="container">

		<div class="producers">

			<?php
			while(have_rows('producenci')): the_row();
				$producent = get_sub_field('producent');
				$stanowisko = get_sub_field('stanowisko');
				$zdjecie = get_sub_field('zdjecie');
				$opis = get_sub_field('opis'); ?>
			<div class="producer">
				<figure style="padding-bottom:100%">
					<img loading="lazy" src="<?php echo $zdjecie['sizes']['large']; ?>"
						alt="<?php echo $zdjecie['alt']; ?>" />
				</figure>
				<div class="producer_info">
					<h3 class="headline_m"><?php echo $producent; ?></h3>
					<h4><?php echo $stanowisko; ?></h4>
					<div class="desc"><?php echo $opis; ?></div>
				</div>
				<h3 class="headline_m mobile_headline"><?php echo $producent; ?></h3>
			</div>
			<?php endwhile; ?>

			<div class="clear"></div>

		</div>

	</div>

</section>

<?php get_footer(); ?>