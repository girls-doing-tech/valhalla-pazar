<?php

function prolancer_ajax_search(){

  // Search available only for post
  function prolancer_services_search_filter($query) {   
      if ($query->is_search) {
          $query->set('post_type',array('services'));
      }
      return $query;
  }
   
  add_filter('pre_get_posts','prolancer_services_search_filter');

  $the_query = new WP_Query( array( 'posts_per_page' => 10 , 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'services' ) );
    if( $the_query->have_posts() ) { ?>
    <ul class="ajax-search-results list-unstyled">
      <?php
      while( $the_query->have_posts() ){ $the_query->the_post();
        $attachments = get_post_meta(get_the_ID(), 'service_attachments', false );
        if ($attachments) {
            foreach ($attachments as $attachment) {
                if ($attachment) {
                    $image_ids = array_keys($attachment);
                }
            }
        } ?>
      <li>
        <a href="<?php echo esc_url( get_permalink() ); ?>">
          <img src="<?php echo esc_url( wp_get_attachment_image_src($image_ids[0],'prolancer-32x32',true)[0] ); ?>" alt="<?php the_title(); ?>">
          <?php echo mb_strimwidth( get_the_title(), 0, 40, '..' );?>
        </a>
      </li>
      <?php }; ?>
    </ul>
    <?php
    wp_reset_postdata();  
    }
  die();
}

add_action( 'wp_ajax_prolancer_ajax_search',  'prolancer_ajax_search' );
add_action( 'wp_ajax_nopriv_prolancer_ajax_search',  'prolancer_ajax_search' );











