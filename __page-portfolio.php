<?php get_header() ?>



<h1 style="color: red;">sa;sdf</h1>
<?php


$args = array(
'post_type' => 'post', // The post type you want to retrieve
'posts_per_page' => 200, // The number of posts to display
);

$query = new WP_Query( $args ); // Create a new WP_Query object with the arguments

if ( $query->have_posts() ) {
while ( $query->have_posts() ) {
$query->the_post();
$categories = get_the_category(); // Get the categories for the post
$post_classes = array(); // Create an empty array for the post classes

// Loop through the categories and add a class for each one
foreach ( $categories as $category ) {
$post_classes[] = 'category-' . $category->slug;
}

// Add the post classes to the existing post classes
$post_classes = array_merge( $post_classes, get_post_class() );

// Output the post item with the classes inline
?>
<div style="padding: 10px; border: 1px solid red; color: white;"
	class="<?php echo esc_attr( join( ' ', $post_classes ) ); ?>">
	<a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a>
	<h1><?php echo esc_attr( join( ' ', $post_classes ) ); ?></h1>
</div>
<?php
    }
} else {
    // If no posts are found, display a message
    echo 'No posts found.';
}

wp_reset_postdata(); // Reset the global post data after the loop

?>
<?php get_footer() ?>