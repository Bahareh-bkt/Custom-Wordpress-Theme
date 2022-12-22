<?php

function hospital_functions() {
    wp_enqueue_style('hospital_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('hospital_extra_styles', get_theme_file_uri('/build/index.css'));
    wp_enqueue_script('main_js', get_theme_file_uri('build/index.js') , array('jquery') , 1.0 , true);
}
add_action('wp_enqueue_scripts','hospital_functions');


function hospital_features(){

    register_nav_menu('headerMenuLocation','Header Menu Location');
    register_nav_menu('footerLocationOne','Footer Location One');
    register_nav_menu('footerLocationTwo','Footer Location Two');
    add_theme_support('post-thumbnails');
    add_image_size('doctorLandscape' , 400 , 260 , true);
    add_image_size('doctorPortrait' , 480 , 650 , true);
    add_image_size('pageBanner', 1500, 260, true);
}
add_action('after_setup_theme', 'hospital_features');

function hospital_adjust_query($query) {

    if(!is_admin() AND is_post_type_archive('program') AND $query-> is_main_query()){

        $query -> set('orderby', 'title');
        $query -> set('order', 'ASC');
        $query -> set('posts_per_page', -1);
    }


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

function pageBanner($args = Null){ 
    if(!isset($args['title'])){
        $args['title'] = get_the_title();
    }
    if(!isset($args['subtitle'])){
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if(!isset($args['photo'])){
        if(get_field('page_banner_subtitle') AND !is_home() AND !is_archive()){
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else{
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    } ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ;?>")></div>
            <div class="page-banner__content container container--narrow ">
                <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
            <div class="page-banner__intro">
            <p><?php echo $args['subtitle'] ?></p>
            </div>
        </div>
    </div>

<?php }

