<?php
/**
 * The template used for displaying "Top News" on the site home page
 *
 * @package gwbchild
 */

 // The Query
$args = array(
	'post_type'      => array( 'top_news' ),
	'nopaging'       => true,
	'posts_per_page' => 2,
	'tax_query'      => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => array( 'home-banner' ),
		),
	),
);
$top_news_query = new WP_Query( $args );

// The Loop
if ( $top_news_query->have_posts() ) { ?>

	 <section class="top-news">
	 	<h2 class="top-news-title"><span>Announcements</span></h2>
	 	<div class="entry">

	<?php
	while ( $top_news_query->have_posts() ) {
		$top_news_query->the_post();

		// get the categories, add icons according to priority
		$post_cats = wp_get_post_categories( get_the_ID() );
		$news_cats = array();

		foreach( $post_cats as $c  ){
			$cat = get_category( $c );
			$news_cats[] = $cat->name;
		}

		$icon = '';
		if ( in_array( 'emergency', $news_cats ) ) {
			$icon = 'important';
		} elseif ( in_array( 'information', $news_cats ) ) {
			$icon = 'info';
		}

		if ( '' != $icon ) {
			echo '<article class="' . $icon . "\">\n";
			echo '<img src="' . get_stylesheet_directory_uri() . '/images/' . $icon . '.png" />';
		} else {
			echo "<article>\n";
		}
		echo '<h3>' . get_the_title() . "</h3>\n";
		the_content();
		echo "</article>\n";
	}
	/* Restore original Post Data */
	wp_reset_postdata(); ?>

		</div>
	</section>
	<?php
} else {
	// no posts found
}
?>
