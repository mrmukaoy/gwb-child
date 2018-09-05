<?php
/* FUNCTIONS FOR CHILD THEME  */

function gwbchild_enqueue_styles() {

	$parent_style = 'glades';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'gwbchild_enqueue_styles' );

if ( ! function_exists( 'glades_site_title' ) ) {
	/**
	 * Displays the site title in the header area
	 */
	function glades_site_title() {
		if ( is_home() || is_front_page() || is_page_template( 'template-magazine.php' )  ) { ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php } else { ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php } //endif
	}
} //endif

?>
