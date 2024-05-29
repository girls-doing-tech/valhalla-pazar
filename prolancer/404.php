<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package prolancer 
 */
global $prolancer_opt;

$prolancer_error_title = !empty( $prolancer_opt['prolancer_error_title'] ) ? $prolancer_opt['prolancer_error_title'] : esc_html__( 'Oops! That page can&rsquo;t be found.', 'prolancer' );
$prolancer_error_text = !empty( $prolancer_opt['prolancer_error_text'] ) ? $prolancer_opt['prolancer_error_text'] : esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'prolancer' );

get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="error-404">
				<h1><?php echo esc_html( $prolancer_error_title ); ?></h1>
				<p><?php echo esc_html( $prolancer_error_text ); ?></p>
				<a href="<?php echo esc_url( get_home_url() ); ?>" class="prolancer-btn"><?php echo esc_html__( 'Go to Home', 'prolancer' ); ?></a>
			</div>
		</div>
	</div>
</div>

<?php get_footer();