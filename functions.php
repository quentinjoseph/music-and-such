<?php



// include custom jQuery
function shapeSpace_include_custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');


// Scripts and Such
function musicAndSuch_script_enqueue(){
    wp_enqueue_style('load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
    //wp_enqueue_style('pretty-checkbox', 'https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css');
    wp_enqueue_style('customstyles', get_template_directory_uri() . '/source/style.css', [], '1.0.0', 'all' );
    wp_enqueue_style('lightbox', get_template_directory_uri() . '/source/lightbox.css', [], '1.0.0', 'all' );
    wp_enqueue_style('lityCSS', get_template_directory_uri() . '/source/lity.css', [], '1.0.0', 'all' );
    //wp_enqueue_script('youtubeApi', 'https://apis.google.com/js/client.js');
    wp_enqueue_script('lightboxJS', get_template_directory_uri() . '/js/lightbox.js', [], '1.0.0', true );
    wp_enqueue_script('lityJS', get_template_directory_uri() . '/js/lity.js', [], '1.0.0', true );
    wp_enqueue_script('axios', 'https://unpkg.com/axios/dist/axios.min.js', [], '1.0.0', true );
    wp_enqueue_script('customJS', get_template_directory_uri() . '/js/script.js', [], '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'musicAndSuch_script_enqueue');

function music_nav_menu() {
  register_nav_menus(
    array(
      'top-nav' => __( 'Top Nav' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'music_nav_menu' );



