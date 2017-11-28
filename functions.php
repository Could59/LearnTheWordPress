<?php 

function salutlol_enqueue_style() {
    wp_enqueue_style('salutlolnormalise', get_template_directory_uri() . '/assets/css/normalize.css', false);
    wp_enqueue_style('salutlolcss', get_stylesheet_uri(), false );
    wp_enqueue_style('salutlolato', '//fonts.googleapis.com/css?family=Lato', false);
    wp_enqueue_style('salutlolfont', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0');

}

function salutlol_enqueue_script() {
    
}
add_action( 'wp_enqueue_scripts', 'salutlol_enqueue_style');
add_action( 'wp_enqueue_scripts', 'salutlol_enqueue_script');
# Image de logo perso
function salutlol_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => false,
        'flex-width'  => false,
        'header-text' => array( 'site-title', 'site-description' )
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'salutlol_custom_logo_setup' );

function sunset_register_nav_menu() {
    register_nav_menu( 'primary', 'Header Navigation Menu');
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu');


# image du header perso 

$args = array (
    'width' => 1600,
    'height' => 359,
    'default-image' => get_template_directory_uri() .'/assets/img/bandeau-saint-marc.jpg',
    'uploads' => true,
);

add_theme_support( 'custom_header', $args );

register_default_headers( array (
    'bandeauDuHaut' => array (
        'url' => '%s/assets/img/bandeauDuHaut.jpg',
        'thumbnail_url' => '%s/assets/img/bandeauDuHaut.jpg',
        'description' => __( 'Proposition 1', 'isen')
    ),
    'bandeauSalutlol' => array (
        'url' => '%s/assets/img/bandeau-saint-marc.jpg',
        'thumbnail_url' => '%s/assets/img/bandeau-saint-marc.jpg',
        'description' => __( 'Proposition 2', 'salutlol')
    ),
    ));
    $args = array(
        'default-color' => '000000',
        'default-image' => '%1$s/img/fond2.jpg',
    );
    add_theme_support( 'custom-background', $args );


    # Création
add_action( 'init', 'create_post_type');
function create_post_type() {
    register_post_type( 'accueil-news', array(
        'labels' => array(
            'name' => __( 'Accueil News' ),
            'singular_name' => __( 'Accueil News' )
        ),
        'public' => true,
        'has_archive' => false
    ));
}
#featured image

add_theme_support( 'post-thumbnails' );
add_post_type_support( 'accueil-news', 'thumbnail');
add_image_size( 'accueil_size', 500, 310, true );

add_action( 'widgets_init', 'salutlol_widgets_init' );
function salutlol_widgets_init(){
    register_sidebar( array(
        'name' => 'pied de page 1',
        'id' => 'salutlol-footer-1',
        'description' => 'Widget pour le placement de la google map',
        'before_widget' => '<div id="%1$s" class="gmap %2$s"',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>' 
    ));
    register_sidebar( array(
        'name' => 'pied de page 2',
        'id' => 'salutlol-footer-2',
        'description' => 'Widget pour le placement de la Newsletter',
        'before_widget' => '<div id="%1$s" class="newsletter %2$s"',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>' 
    ));
    register_sidebar( array(
        'name' => 'pied de page 3',
        'id' => 'salutlol-footer-3',
        'description' => 'Widget pour les coordonnées de contact',
        'before_widget' => '<div id="%1$s" class="contact %2$s"',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>' 
    ));
}