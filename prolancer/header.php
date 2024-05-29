<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prolancer
 */


global $prolancer_opt;

$site_preloader = !empty( $prolancer_opt['site_preloader'] ) ? $prolancer_opt['site_preloader'] : '';
$header_style = isset($prolancer_opt['header_style']) ? $prolancer_opt['header_style'] : '';
$prolancer_header_full_width = isset($prolancer_opt['prolancer_header_full_width']) ? $prolancer_opt['prolancer_header_full_width'] : '';
$prolancer_header_sticky = isset($prolancer_opt['prolancer_header_sticky']) ? $prolancer_opt['prolancer_header_sticky'] : '';
$prolancer_navbar_button = isset($prolancer_opt['prolancer_navbar_button']) ? $prolancer_opt['prolancer_navbar_button'] : '';
$prolancer_navbar_button_text = isset($prolancer_opt['prolancer_navbar_button_text']) ? $prolancer_opt['prolancer_navbar_button_text'] : '';

$buyer_id = get_user_meta( get_current_user_id(), 'buyer_id' , true );
$seller_id = get_user_meta( get_current_user_id(), 'seller_id' , true );
$visit_as = get_user_meta( get_current_user_id(), 'visit_as' , true );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	 <?php wp_body_open(); ?>
	
	<?php if ($site_preloader): ?>
		<!-- Preloading -->
		<div id="preloader">
			<div class="spinner">
				<div class="uil-ripple-css"><div></div><div></div></div>
			</div>
		</div>
	<?php endif ?>
	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'prolancer' ); ?></a>

    <header>
    	<?php if ($header_style == 'style2'){ ?>    		
		    <div class="top-header"> 
		        <div class="container<?php if( $prolancer_header_full_width == true ){ echo'-fluid'; } ?>">
		            <div class="row">
		                <div class="col-xl-2 col-lg-2 my-auto d-none d-lg-block">
		                    <div class="logo">
		                    <?php if (has_custom_logo()) {
		                        the_custom_logo();
		                    } else { ?>
		                        <a class="navbar-logo-text" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		                    <?php } ?>
		                    </div>
		                </div>
		                <div class="col-xl-6 col-lg-6 offset-lg-1 my-auto d-none d-lg-block">
		                    <form class="ajax-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
		                        <input type="text" name="s" id="keyword" placeholder="<?php echo esc_attr_x( 'Find Services', 'placeholder', 'prolancer' ); ?>" autocomplete="off">
		                        <button type="submit"><i class="fal fa-search"></i></button>
		                        <input type="hidden" name="post_type" value="services" />
		                    	<div id="datafetch"></div>
		                    </form>
		                </div>
		                <div class="col-xl-2 col-lg-2 col my-auto">
		                    <?php
		                        wp_nav_menu( array(
		                        'theme_location' => 'top-menu',
		                        'depth'          => 1,
		                        'container'      => 'ul',
		                        'fallback_cb' => false
		                    )); ?>
		                </div>
		                <div class="col-xl-1 col-lg-1 col my-auto">
		                    <div class="top-header-action">
		                        <div class="widget-header">
		                            <div class="my-account-widget">
		                                <div class="my-account-button">
		                                <?php
		                                if ( is_user_logged_in() && function_exists('prolancer_get_image_id')) {
		                                    if (isset($visit_as) && $visit_as == 'buyer'){
			                                    $buyer_image = wp_get_attachment_image ( prolancer_get_image_id(get_post_meta($buyer_id, 'buyer_profile_attachment', true )),array('50', '50') ,false);

			                                    if (!empty($buyer_image)) {
		                                			echo wp_kses($buyer_image,array(
		                                				"img" => array(
													        "src" => array(),
													        "alt" => array(),
													        "style" => array()
													    )
		                                			));
		                                		} else {
			                                    	echo get_avatar( wp_get_current_user()->ID, 50 );
			                                    }
		                                	} elseif (isset($visit_as) && $visit_as == 'seller'){
			                                	$seller_image = wp_get_attachment_image ( prolancer_get_image_id(get_post_meta($seller_id, 'seller_profile_attachment', true )),array('50', '50') ,false);

		                                		if (!empty($seller_image)) {
		                                			echo wp_kses($seller_image,array(
		                                				"img" => array(
													        "src" => array(),
													        "alt" => array(),
													        "style" => array()
													    )
		                                			));
		                                		} else {
			                                    	echo get_avatar( wp_get_current_user()->ID, 50 );
			                                    }
		                                    } else {
		                                    	echo get_avatar( wp_get_current_user()->ID, 50 );
		                                    }
		                                } else { ?>
		                                    <img src="<?php echo get_template_directory_uri() . '/assets/images/avatar.png' ?>" alt="avatar">                                
		                                <?php } ?>
		                                </div>
		                                <div class="my-account-content">
		                                    <?php if (is_user_logged_in()) { ?>

		                                        <div class="header-profile">
		                                            <div class="header-profile-content">
		                                                <h6><?php echo wp_get_current_user()->display_name; ?></h6>
		                                                <p><?php echo wp_get_current_user()->user_email ?></p>
		                                            </div>
		                                        </div>
	                                            <ul class="list-unstyled">
	                                            	<?php if (function_exists('prolancer_get_page_url_by_template')) { ?>
	                                                <li><a href="#" class="profile-switcher" data-visit-as="seller"  data-nonce="<?php echo wp_create_nonce('profile_switcher'); ?>"><?php echo esc_html__( 'Visit as Seller', 'prolancer' ); ?></a></li>
	                                                <li><a href="#" class="profile-switcher" data-visit-as="buyer"  data-nonce="<?php echo wp_create_nonce('profile_switcher'); ?>"><?php echo esc_html__( 'Visit as Buyer', 'prolancer' ); ?></a></li>
	                                            	<?php } ?>
	                                                <li><a href="<?php echo esc_url( wp_logout_url() ); ?>"><?php echo esc_html__( 'Logout','prolancer' ) ?></a></li>
	                                            </ul>

		                                    <?php } else { ?>

		                                        <div class="header-profile-login">
		                                            <h6 class="text-center"><?php echo esc_html__( 'Log In to Your Account', 'prolancer' ) ?></h6>
		                                            <?php wp_login_form(); ?>
		                                            <a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php esc_html_e( 'Register', 'prolancer' ); ?></a>
		                                            <span class="mr-2 ml-2">|</span>
		                                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
		                                                <?php esc_html_e( 'Lost password', 'prolancer' ); ?>
		                                            </a>
		                                        </div>
		                                        
		                                    <?php } ?>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
    	<?php } ?>

	    <div class="site-header <?php if( true == $prolancer_header_sticky ){ echo'sticky-header'; } ?>">
	        <div class="container<?php if( $prolancer_header_full_width == true ){ echo'-fluid'; } ?>">
	            <div class="row">
	            	<?php if ($header_style == 'style1'){ ?>
	            		<div class="col-xl-3 col-md-3 my-auto">
	            			<div class="logo">
			                    <?php if (has_custom_logo()) {
			                        the_custom_logo();
			                    } else { ?>
			                    	<a class="navbar-logo-text" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			                    <?php } ?>
		                    </div>
	            		</div>
	            	<?php } ?>	            	
	                <div class="<?php if (function_exists('prolancer_get_page_url_by_template') & $header_style == 'style1' & $prolancer_navbar_button == true) { 
	                		echo'col-xl-7 col-md-7'; 
	                	} elseif(function_exists('prolancer_get_page_url_by_template') & $header_style == 'style1' & $prolancer_navbar_button !== true) { 
	                		echo'col-xl-9 col-md-9'; 
	                	} elseif(function_exists('prolancer_get_page_url_by_template') & $header_style == 'style2' & $prolancer_navbar_button == true) { 
	                		echo'col-xl-10 col-md-10'; 
	                	} elseif(function_exists('prolancer_get_page_url_by_template') & $header_style == 'style2' & $prolancer_navbar_button !== true) { 
	                		echo'col-xl-12 col-md-12'; 
	                	} else { 
	                		echo'col-xl-12 col-md-12'; 
	                	} ?> my-auto">
	                    <div class="primary-menu d-none d-lg-inline-block">
	                        <nav class="desktop-menu">
	                            <?php
	                                wp_nav_menu( array(
	                                'theme_location'    => 'primary',
	                                'depth'             => 3,
	                                'container'         => 'ul',
	                            ) ); ?>
	                        </nav>                      
	                    </div>
	                </div>
	                <?php if (true == $prolancer_navbar_button){ ?>
	                <div class="col-xl-2 col-md-2 my-auto">
	                	<?php if (function_exists('prolancer_get_page_url_by_template')) { ?>
	                    <div class="header-btn d-none d-lg-block">
	                        <a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php').'=dashboard');} ?>">
	                            <?php echo esc_html($prolancer_navbar_button_text) ?>
	                        </a>
	                    </div>
	                	<?php } ?>
	                </div> 
	                <?php } ?>      
	            </div>
	        </div>
	    </div>
	</header><!-- #masthead -->

	<!--Mobile Navigation Toggler-->
	<div class="off-canvas-menu-bar">
	    <div class="container">
	        <div class="row">
	            <div class="col-6 my-auto">
	            <?php if (has_custom_logo()) {
	                the_custom_logo();
	            } else { ?>
	                <a class="navbar-logo-text" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
	            <?php } ?>
	            </div>
	            <div class="col-6">
	                <div class="mobile-nav-toggler float-end"><span class="fal fa-bars"></span></div>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Mobile Menu  -->
	<div class="off-canvas-menu">
	    <div class="menu-backdrop"></div>
	    <i class="close-btn fa fa-close"></i>
	    <nav class="mobile-nav">
	        <div class="text-center pt-3 pb-3">
	        <?php if (has_custom_logo()) {
	            the_custom_logo();
	        } else { ?>
	            <a class="navbar-logo-text" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
	        <?php } ?>
	        </div>
	        
	        <ul class="navigation"><!--Keep This Empty / Menu will come through Javascript--></ul>
	        <?php if (true == $prolancer_navbar_button){
	        	if (function_exists('prolancer_get_page_url_by_template')) { ?>
				<div class="text-center">
					<a href="<?php if(function_exists('prolancer_get_page_url_by_template')){ echo esc_url(prolancer_get_page_url_by_template('prolancer-dashboard.php').'=dashboard');} ?>" class="prolancer-btn mt-4">
						<?php echo esc_html($prolancer_navbar_button_text) ?>
					</a>
				</div>
			<?php }
			} ?>
	    </nav>
	</div>

	<?php if (!is_singular(array('buyers', 'sellers' )) and !is_page_template( 'custom-page-without-breadcrumb.php' ) and !is_page_template( 'login-and-register.php' )) { ?>	
		<section>
			<div class="breadcrumbs">
				<div class="container">
					<div class="row">
						<div class="col-md-12 my-auto">
							<h1>
						    	<?php
						      	if(is_home() && is_front_page()){
						            bloginfo( 'name' );
						      	} else { 
						            echo wp_title('', false);
						      	} ?>
						    </h1>
							<?php prolancer_breadcrumb(); ?>
						</div>
					</div>
					
				</div>
			</div>	
		</section>	
	
	<?php }