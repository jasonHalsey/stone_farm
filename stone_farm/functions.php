<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );



// Halsey Design Functions
// =============================================================================

/*  Remove Admin Bar
/* ------------------------------------ */ 
add_filter('show_admin_bar', '__return_false');


/*  Enqueue scripts
/* ------------------------------------ */ 

	function wpb_adding_scripts() {

		$vars = "value";
		wp_register_script('app', get_stylesheet_directory_uri() . '/js/stone_farm.js');

		wp_enqueue_script('app');

	}
	add_action( 'wp_footer', 'wpb_adding_scripts' ); 


// WooCommerce Functions
// =============================================================================

//* Make Font Awesome available
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

}

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'your-theme-slug');
		$start_shopping = __('Start shopping', 'your-theme-slug');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}

// Add SVG Support
// =============================================================================

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// Add Title Support
// =============================================================================
add_filter( 'the_seo_framework_force_title_fix', '__return_true' );

function x_wp_title( $title ) { return $title; }

/*THIS CODE WILL BE OUTPUT INSIDE THE <HEAD> tag*/
add_action('wp_head','my_tracking', 1);
function my_tracking () { ?>
  <!-- Google Tag Manager -->

<script>

(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P48CTBL');</script>
<!-- End Google Tag Manager -->
<?php }

// Add Google Tag Manager Code
// =============================================================================
function add_google_tag_manager_code(){
?>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P48CTBL"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<?php 
}
add_action( 'x_before_site_begin', 'add_google_tag_manager_code' );
// End Add Google Tag Manager Code
// =============================================================================
