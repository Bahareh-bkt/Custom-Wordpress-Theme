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

function hospital_adjust_query($query) {
    if (! is_admin() AND is_post_type_archive('event') AND $query-> is_main_query()){
        
        $query-> set('orderby', 'meta_value_num');
        $query-> set('order' , 'ASC');
        $query-> set('meta_key', 'event_date');
        $today= date('Ymd');
        $query-> set('meta_query', array(
            array(
                'key'=>'event_date',
                'compare'=> '>=',
                'value'=> $today ,
                'type'=>'numeric'
            ))
        ); 
    }
}
add_action('pre_get_posts', 'hospital_adjust_query');