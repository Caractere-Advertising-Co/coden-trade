<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// Menu 
register_nav_menus( array(
    'megamenu' => 'Mega Menu',
	  'main' => 'Menu Principal',
	  'footer' => 'Bas de page',
    'topheader' => 'Top menu'
) );

add_theme_support( 'post-thumbnails' ); 

//SVG Files
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
  
function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
  
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
  add_filter( 'upload_mimes', 'cc_mime_types' );
  add_action( 'admin_head', 'fix_svg' );

  
/*******************************
Custom Post Type  ---- EMPLOYE
/*******************************/

function add_custom_post_employe() {

	$labels = array(
		'name'                  => _x( 'Employé.e.s', 'Post Type General Name', 'custom_post_type' ),
		'singular_name'         => _x( 'Employé.e', 'Post Type Singular Name', 'custom_post_type' ),
		'menu_name'             => __( 'Employés', 'custom_post_type' ),
		'name_admin_bar'        => __( 'Employés', 'custom_post_type' ),
		'archives'              => __( 'Archives', 'custom_post_type' ),
		'attributes'            => __( 'Item Attributes', 'custom_post_type' ),
		'all_items'             => __( 'Tous', 'custom_post_type' ),
		'add_new_item'          => __( 'Ajouter employé', 'custom_post_type' ),
		'add_new'               => __( 'Créer employé', 'custom_post_type' ),
		'new_item'              => __( 'Nouveau', 'custom_post_type' ),
		'edit_item'             => __( 'Modifier', 'custom_post_type' ),
		'update_item'           => __( 'Mettre à jour', 'custom_post_type' ),
		'view_item'             => __( 'Voir', 'custom_post_type' ),
		'view_items'            => __( 'Voir', 'custom_post_type' ),
		'search_items'          => __( 'Recherche', 'custom_post_type' ),
		'not_found'             => __( 'Non trouvé', 'custom_post_type' ),
		'not_found_in_trash'    => __( 'Non trouvé', 'custom_post_type' ),
		'featured_image'        => __( 'Photo de profil', 'custom_post_type' ),
		'set_featured_image'    => __( 'Définir la photo de profil', 'custom_post_type' ),
		'remove_featured_image' => __( 'Retirer la photo de profil', 'custom_post_type' ),
		'use_featured_image'    => __( 'Utiliser comme photo de profil', 'custom_post_type' ),
		'insert_into_item'      => __( 'Insérer', 'custom_post_type' ),
		'uploaded_to_this_item' => __( 'Uploader', 'custom_post_type' ),
		'items_list'            => __( 'List', 'custom_post_type' ),
		'items_list_navigation' => __( 'Items list navigation', 'custom_post_type' ),
		'filter_items_list'     => __( 'Filtrer', 'custom_post_type' ),
	);
	$args = array(
		'label'                 => __( 'Employés', 'custom_post_type' ),
		'description'           => __( 'Membres de Coden trade', 'custom_post_type' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'employe' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-category',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'employe', $args );

}
add_action( 'init', 'add_custom_post_employe', 0 );

add_filter('woocommerce_resize_images', static function() {
    return false;
});


/********************
     WOOCOMMERCE
*********************/

function coden_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
	) );
}
add_action( 'after_setup_theme', 'coden_add_woocommerce_support' );

/**
 * Change number of upsells output
 */
add_filter( 'woocommerce_upsell_display_args', 'wc_change_number_related_products', 20 );

function wc_change_number_related_products( $args ) {
 
 $args['posts_per_page'] = 3;
 $args['columns'] = 3; //change number of upsells here
 return $args;
}

/**
 * @snippet       Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 8
 * @community     https://businessbloomer.com/club/
 */
 
 add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus' );
 
 function bbloomer_display_quantity_minus() {
	if ( ! is_product() ) return;
	echo '<div class="chgQty">
			<button type="button" class="plus" >▲</button>
			<button type="button" class="minus" >▼</button>
		  </div>';
 }
 
 add_action( 'woocommerce_before_single_product', 'bbloomer_add_cart_quantity_plus_minus' );
  
 function bbloomer_add_cart_quantity_plus_minus() {
	wc_enqueue_js( "
	   $('form.cart').on( 'click', 'button.plus, button.minus', function() {
			 var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
			 var val   = parseFloat(qty.val());
			 var max = parseFloat(qty.attr( 'max' ));
			 var min = parseFloat(qty.attr( 'min' ));
			 var step = parseFloat(qty.attr( 'step' ));
			 if ( $( this ).is( '.plus' ) ) {
				if ( max && ( max <= val ) ) {
				   qty.val( max );
				} else {
				   qty.val( val + step );
				}
			 } else {
				if ( min && ( min >= val ) ) {
				   qty.val( min );
				} else if ( val > 1 ) {
				   qty.val( val - step );
				}
			 }
		  });
	" );
 }