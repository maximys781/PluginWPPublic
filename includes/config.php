<?php

global $wp_styles;
print_r( $wp_styles );

add_action( 'wp_enqueue_scripts', 'special_plugin_styles' );
function special_plugin_styles() {
    wp_register_style('datatables', plugins_url('css/datatables.min.css', __FILE__) );
    wp_register_style('mystyle', plugins_url('css/style.css', __FILE__) );
    wp_register_style('mystyle2', plugins_url('css/animate.css', __FILE__) );


    wp_enqueue_style('datatables','mystyle','style2');
}




function my_scripts_method(){
    wp_enqueue_script( 'newscript', plugins_url(__FILE__) . 'js/index.js');
    wp_enqueue_script( 'newscript2', plugins_url(__FILE__) . 'js/datatables.min.js');
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );