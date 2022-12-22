<?php 
 get_header();
 pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'archive-program'
 ))
 ?>
<div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title">All Programs</h1>
                <div class="page-banner__intro">
                <p>archive-program</p>
                </div>
            </div>
    </div>

 
<div class="container container--narrow page-section">
  
    <?php 
 
        while (have_posts()) {
            the_post(); ?>
             <div class="event-summary">
            
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            </div>
          </div>
       <?php }
    ?>


</div>

<?php
get_footer();
?>