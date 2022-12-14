<?php 
 get_header();
 pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See what is going in our Hospital'
))
 ?>

<div class="container container--narrow page-section">
  
    <?php 
 
        while (have_posts()) {
            the_post(); ?>
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

<p>See the recap of our past Events <a href="<?php echo site_url('/past-events') ?>"> Here.</a></p>
</div>

<?php
get_footer();
?>