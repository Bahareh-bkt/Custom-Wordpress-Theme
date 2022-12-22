<?php 
 get_header();
 pageBanner(array(
  'title'=> 'Past Events',
  'subtitle' => 'See what is going in our Hospital'
 ))
 ?>
<div class="container container--narrow page-section">
  
    <?php 
            $today = date('Ymd');
            $pastEvents = new WP_Query(array(
            'post_type' => 'event',
            'orderby' => 'meta_value_num',
            'meta_key' => 'event_date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
                )
            )
            ));
            while($pastEvents ->have_posts()){
            $pastEvents -> the_post();
            ?>

             <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">

            <?php $eventDate = new DateTime(get_field('event_date')); ?>
              <span class="event-summary__month"><?php echo $eventDate-> format('M');?></span>
              <span class="event-summary__month"><?php echo $eventDate-> format('d');?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php if(has_excerpt()){echo get_the_excerpt(); } else{ echo wp_trim_words(get_the_content(), 12); } ?>
              <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
            </div>
          </div>
       <?php }
    ?>
<?php echo paginate_links(); ?>
</div>



<?php
get_footer();
?>