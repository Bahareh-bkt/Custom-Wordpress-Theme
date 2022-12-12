<?php

function hospital_functions() {


    wp_enqueue_style('hospital_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('hospital_extra_styles', get_theme_file_uri('/build/index.css'));
}
add_action('wp_enqueue_scripts','hospital_functions');


function hospital_features(){

    register_nav_menu('headerMenuLocation','Header Menu Location');
    register_nav_menu('footerLocationOne','Footer Location One');
    register_nav_menu('footerLocationTwo','Footer Location Two');
}
add_action('after_setup_theme', 'hospital_features');

