<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package prolancer
 */

global $prolancer_opt;
 
$related_posts = !empty( $prolancer_opt['related_posts'] ) ? $prolancer_opt['related_posts'] : '';

$prolancer_blog_details_post_navigation = !empty( $prolancer_opt['prolancer_blog_details_post_navigation'] ) ? $prolancer_opt['prolancer_blog_details_post_navigation'] : '';

get_header(); ?>

<section class="section-padding">
    <div class="container">
    	<div class="row justify-content-center">
    		<div class="<?php if ( is_active_sidebar('sidebar_widgets') ){ echo'col-xl-8'; } else { echo'col-xl-12'; } ?>">
    		<?php
            
    		while ( have_posts() ) : the_post();
                if (function_exists('setPostViews')) {
                    setPostViews(get_the_id());
                }
    			
    			get_template_part( 'template-parts/content', get_post_type() );

    			if ( true == $prolancer_blog_details_post_navigation ) {
    				the_post_navigation( array(
    		            'prev_text' => esc_html__('&#171; Previous Post', 'prolancer'),
    		            'next_text' => esc_html__('Next Post &#187;', 'prolancer')
    		        ) );
    			}

                if ( $related_posts == true ){
                    prolancer_related_posts();
                }

    			// If comments are open or we have at least one comment, load up the comment template.
    			if ( comments_open() || get_comments_number() ) :
    				comments_template();
    			endif;

    		endwhile; // End of the loop.
    		?>
    		</div>
            <?php if ( is_active_sidebar('sidebar_widgets') ){ ?>
    		<div class="col-xl-4 position-relative">
    			<?php get_sidebar(); ?>
    		</div>
            <?php } ?>
    	</div>
    </div>
</section>

<?php get_footer();