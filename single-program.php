<?php 
    get_header();

    while (have_posts()) {
        the_post();
        pageBanner();?>
        
        <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
          <i class="fa fa-home" aria-hidden="true"></i>Program Home </a> <span class="metabox__main">
           <?php the_title();?></span>
        </p>
        </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>

        <hr class="section-break">
    <!-- Related Doctors Part-->
    <?php 

        $relatedDoctor = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'doctor',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
            array(
                'key'=> 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            )
          )
        ));
        echo '<ul class="professor-cards">';
        while($relatedDoctor ->have_posts()){
          $relatedDoctor -> the_post();?>
            <li class="professor-card__list-item">
                <a class="professor-card" href="<?php the_permalink();?>">
                    <img class="professor-card__image" src="<?php the_post_thumbnail_url(); ?>">
                        <span class="professor-card__name"><?php the_title(); ?>
                        </span>
                </a>
            </li>
    <?php } 
    echo '</ul>'; ?>

    <?php }
        wp_reset_postdata();
    ?>

        <!-- Related Events Part-->
        <?php 
        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
          'posts_per_page' => 2,
          'post_type' => 'event',
          'orderby' => 'meta_value_num',
          'meta_key' => 'event_date',
          'order' => 'ASC',
          'meta_query' => array(
            array(
                'key'=> 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            )
          )
        ));
        echo '<hr class="section-break">';
        echo '<h4 class="headline headline--medium"> Upcomin '.get_the_title().' Events</h4>';
        while($homepageEvents ->have_posts()){
          $homepageEvents -> the_post();?>
          <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <?php $eventDate = new DateTime(get_field('event_date')); ?>
              <span class="event-summary__month"><?php echo $eventDate-> format('M');?></span>
              <span class="event-summary__month"><?php echo $eventDate-> format('d');?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            </div>
          </div>
       
        </div>
    <?php }

    get_footer();
?>