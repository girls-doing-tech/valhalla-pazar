<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package prolancer
 */

get_header();

global $prolancer_opt;

$prolancer_blog_layout = !empty( $prolancer_opt['prolancer_blog_layout'] ) ? $prolancer_opt['prolancer_blog_layout'] : '';

//HTTP GET
if(!empty($_GET['blog-layout'])){
    $prolancer_blog_layout = $_GET['blog-layout'];
}
// http://localhost/prolancer/?blog-layout=blog_full_width

?>

<section class="section-padding">
	<div class="container">
		<div class="row justify-content-center <?php if ($prolancer_blog_layout == 'blog_left_sidebar'){echo'flex-row-reverse';} ?>">
			<div class="<?php 
			if(is_active_sidebar('sidebar_widgets') & $prolancer_blog_layout == 'blog_fullwidth'){ 
				echo'col-xl-12'; 
			} elseif(is_active_sidebar('sidebar_widgets')) {
				echo'col-xl-8';
			} else {
				echo'col-lg-12';
			} ?>">
				<?php
				echo wp_kses($prolancer_blog_layout == 'blog_fullwidth' ? '<div class="row blog-fullwidth">' : '', array(
					'div'     => array(
						'class' => array()
					)
				));
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile; ?>

					<div class="text-center">
					<?php 
					the_posts_pagination( array(
					    'mid_size'  => 2,
					    'prev_text' => esc_html__( '&#10094; Prev', 'prolancer' ),
					    'next_text' => esc_html__( 'Next &#10095;', 'prolancer' ),
					) ); ?>
					</div>

				<?php
				echo wp_kses($prolancer_blog_layout == 'blog_fullwidth' ? '</div>' : '', array(
					'div' => array()
					)
				);
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
			<?php if (is_active_sidebar('sidebar_widgets') & $prolancer_blog_layout !== 'blog_fullwidth'){ ?>
				<div class="col-xl-4 position-relative">
					<?php get_sidebar() ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php get_footer();