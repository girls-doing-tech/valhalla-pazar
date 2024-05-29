<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prolancer
 */
namespace Elementor;
global $prolancer_opt;

$footer_widget_display = !empty( $prolancer_opt['footer_widget_display'] ) ? $prolancer_opt['footer_widget_display'] : '';
$prolancer_footer_template = !empty( $prolancer_opt['prolancer_footer_template'] ) ? $prolancer_opt['prolancer_footer_template'] : '';
$prolancer_copyright_info = isset( $prolancer_opt['prolancer_copyright_info'] ) ? $prolancer_opt['prolancer_copyright_info'] : '';
$supported_currency = isset( $prolancer_opt['supported_currency'] ) ? $prolancer_opt['supported_currency'] : '';
$newsletter_modal_switch = isset( $prolancer_opt['newsletter_modal_switch'] ) ? $prolancer_opt['newsletter_modal_switch'] : '';
$modal_image = isset( $prolancer_opt['modal_image']['url'] ) ? $prolancer_opt['modal_image']['url'] : '';
$modal_title = isset( $prolancer_opt['modal_title'] ) ? $prolancer_opt['modal_title'] : '';
$modal_description = isset( $prolancer_opt['modal_description'] ) ? $prolancer_opt['modal_description'] : '';
$modal_shortcode = isset( $prolancer_opt['modal_shortcode'] ) ? $prolancer_opt['modal_shortcode'] : '';
$modal_timeout = isset( $prolancer_opt['modal_timeout'] ) ? $prolancer_opt['modal_timeout'] : 5000;
$backtotop = isset( $prolancer_opt['backtotop'] ) ? $prolancer_opt['backtotop'] : true; ?>

	<footer id="colophon" class="site-footer">
		<?php 
		if ( $footer_widget_display == true ){

			if (did_action( 'elementor/loaded' )) {
				echo Plugin::instance()->frontend->get_builder_content_for_display( $prolancer_footer_template );
			}			
		}
		?>


		<div class="copyright-bar">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm-<?php if ( $supported_currency ) { echo'7 text-start'; }else{ echo'12 text-center'; }?>">
						<p>
						<?php
			    		if( $prolancer_copyright_info ) {
							echo wp_kses( $prolancer_copyright_info , array(
								'a'       => array(
								'href'    => array(),
								'title'   => array()
								),
								'br'      => array(),
								'em'      => array(),
								'strong'  => array(),
								'img'     => array(
									'src' => array(),
									'alt' => array()
								),
							));
						} else {
							echo esc_html__('Copyright', 'prolancer'); ?> &copy; <?php echo esc_html( date("Y") ).' '.esc_html( get_bloginfo('name') ).' '.esc_html__(' All Rights Reserved.', 'prolancer' );
						}
						?>
						</p>
					</div>
					<?php if ($supported_currency) { ?>
						<div class="col-sm-5 currency-footer">
							<?php foreach ( $supported_currency as $key => $currency ) { ?>
								<img src="<?php echo esc_url($currency['image']) ?>" alt="<?php echo esc_attr($currency['title']) ?>">
							<?php } ?>
						</div>
					<?php } ?>
					
				</div>
			</div>
		</div>
	</footer>

<?php if ($backtotop == true) {?>
	<!--======= Back to Top =======-->
	<div id="backtotop"><i class="fal fa-lg fa-arrow-up"></i></div>
<?php } ?>


<?php if ($newsletter_modal_switch == true): ?>
	<div class="modal fade" id="newsletterModal" tabindex="-1" data-time="<?php echo esc_attr( $modal_timeout ) ?>" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <a href="#" type="button" class="close" id="dont-show-hour" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	      	</a>
		    <div class="modal-body">
		    	<?php if ($modal_image){ ?>
		    		<img src="<?php echo esc_html( $modal_image ) ?>" alt="<?php echo esc_attr( $modal_title ) ?>">
		    	<?php } ?>    			
    			<div class="modal-text-content">
	    			<h2><?php echo esc_html( $modal_title ) ?></h2>
	    			<p><?php echo esc_html( $modal_description ) ?></p>
	    			<div class="mt-4"><?php echo do_shortcode( $modal_shortcode ) ?></div>

	    			<div class="d-inline-block mt-3">
					    <input type="checkbox" class="form-check-input" id="dont-show">
					    <label class="form-check-label" for="dont-show"><?php echo esc_html__( 'Don\'t show this message again', 'prolancer' ) ?></label>
				    </div>
			    </div>
		    </div>
	    </div>
	  </div>
	</div>
<?php endif ?>

<?php wp_footer(); ?>

</body>
</html>
