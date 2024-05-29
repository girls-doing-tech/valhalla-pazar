<?php 
//inline style
function prolancer_inline_style() {
    ob_start();
    global $prolancer_opt;

    $primary_color = !empty($prolancer_opt['primary_color']) ? $prolancer_opt['primary_color'] : '#6787FE';
    $primary_color_1 = !empty($prolancer_opt['primary_color_1']) ? $prolancer_opt['primary_color_1'] : '#1661ff';
    $primary_color_2 = !empty($prolancer_opt['primary_color_2']) ? $prolancer_opt['primary_color_2'] : '#00e9b9';
    $primary_color_3 = !empty($prolancer_opt['primary_color_3']) ? $prolancer_opt['primary_color_3'] : '#ffbb00';
    $primary_color_4 = !empty($prolancer_opt['primary_color_4']) ? $prolancer_opt['primary_color_4'] : '#ff007a';
    $primary_color_5 = !empty($prolancer_opt['primary_color_5']) ? $prolancer_opt['primary_color_5'] : '#9981fb';
    $primary_color_6 = !empty($prolancer_opt['primary_color_6']) ? $prolancer_opt['primary_color_6'] : '#81d742';
 	?>
	
	.featured-post,.notifications-widget .notifications-button span,.wp-block-search .wp-block-search__button,.sellers .slick-arrow.fa-chevron-left,.sellers .slick-arrow.fa-chevron-right,.buyers .slick-arrow.fa-chevron-left,.buyers .slick-arrow.fa-chevron-right,.services .slick-arrow.fa-chevron-left,.services .slick-arrow.fa-chevron-right,.projects .slick-arrow.fa-chevron-left,.projects .slick-arrow.fa-chevron-right,.page-links a.post-page-numbers,.my-account-widget i,.brands_form input[type="submit"],.header-btn a:hover,.top-header .ajax-search-form button,.service-widget .skills a:hover,.follow-button:hover,.message-button:hover,.progress-bar,.irs--round .irs-from,.irs--round .irs-to,.irs--round .irs-bar,.prolancer-rgb-btn:hover,.skills-required a:hover,.select2-container--default .select2-selection--multiple .select2-selection__choice,.message_sender,.feds-user-profile a,.shopping-cart-widget i,.countdown-date span,.preview-btn li a:hover,#backtotop i,.product-item-content .add_to_cart_button:hover,.product-item-content .added_to_cart:hover,.comment-navigation .nav-links a,.select-items div:hover,.same-as-selected,.mean-container .mean-nav ul li a.mean-expand:hover,button,input[type="button"],.widget_price_filter .ui-slider .ui-slider-range,.widget_price_filter .ui-slider .ui-slider-handle,input[type="reset"],.off-canvas-menu .navigation li>a:hover,.off-canvas-menu .navigation .dropdown-btn:hover,.off-canvas-menu .navigation li .cart-contents,input[type="submit"],.prolancer-search-btn,.video-item .view-detail,.widget-product-details .widget-add-to-cart .variations .value .variation-radios [type="radio"]:checked+label:after,.single-product .product_meta .tagged_as a:hover,.single-product .product_meta .posted_in a:hover,.widget-product-details .widget-add-to-cart .variations .value .variation-radios [type="radio"]:not(:checked)+label:after,.widget_shopping_cart_content .button,.banner2 .banner-cat .cat-count,ul.banner-button li:first-child a,ul.banner-button li a:hover,.prolancer-pricing-table.recommended,.prolancer-pricing-table a:hover,.wedocs-single-wrap .wedocs-sidebar ul.doc-nav-list>li.current_page_parent>a,.wedocs-single-wrap .wedocs-sidebar ul.doc-nav-list>li.current_page_item>a,.wedocs-single-wrap .wedocs-sidebar ul.doc-nav-list>li.current_page_ancestor>a,.primary-menu ul li .children li.current-menu-item>a,.recent-themes-widget,.newest-filter ul li.select-cat,.download-filter ul li.select-cat,input[type="button"],input[type="reset"],input[type="submit"],.checkout-button,.tag-cloud-link:hover,.prolancer-btn,.prolancer-btn.bordered:hover,.post-navigation .nav-previous a,.post-navigation .nav-next a,.blog-btn .btn:hover,.mean-container .mean-nav,.recent-theme-item .permalink,.banner-item-btn a,.meta-attributes li span a:hover,.theme-item-price span,.error-404 a,.product-item-image .onsale,.theme-item-btn a:hover,.theme-banner-btn a,.comment-list .comment-reply-link,.comment-form input[type=submit],.pagination .nav-links .page-numbers.current,.pagination .nav-links .page-numbers:hover,.excerpt-date,.woocommerce-MyAccount-navigation li.is-active a,.primary-menu ul li .children li a:hover,.header-btn .sub-menu li a:hover,a.product_type_variable,a.product_type_simple,a.product_type_external,a.product_type_grouped,a.add_to_cart_button,a.added_to_cart,.tags>a:hover,.single-post .post-share ul li a:hover,.playerContainer .seekBar .outer .inner,.playerContainer .volumeControl .outer .inner {
		background: <?php echo esc_attr( $primary_color ) ?>;
	}

	.prolancer-service-item.style-1 .service-price h4,.prolancer-project-item.style-1 ul li,.stats .col-lg-4:nth-child(1) .dashboard-stats-item,.stats .col-lg-3:nth-child(1) .dashboard-stats-item,.prolancer-buyer-item.style-1 ul li,#newsletterModal .modal-content .close,.prolancer-service-item.style-2 .service-price h4,.prolancer-seller-item.style-1 ul li,.follow-button,.message-button,.prolancer-rgb-btn,.pagination .nav-links .page-numbers,.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
		background: rgb(<?php echo esc_attr(prolancer_hex2rgb($primary_color))?> / 10%);
	}
	
	.seller-profile .stats-list .stats:nth-child(1) span {
		background: <?php echo esc_attr($primary_color_1) ?>;
	}

	
	.widget .seller-detail:nth-child(6) i,
	.widget .seller-detail:nth-child(2) i,
	.buyer-profile ul.stats li:nth-child(1),
	.buyer-profile ul.meta li:nth-child(1),
	.prolancer-seller-item.style-2 ul li:nth-child(1),
	.prolancer-service-item.style-2 ul li:nth-child(1),
	.service-meta-cards .col-xl-4:nth-child(1) .service-meta,
	.project-meta-cards .col-xl-4:nth-child(1) .project-meta,
	.project-meta-cards .col-xl-4:nth-child(5) .project-meta,
	.seller-profile .stats-list .stats:nth-child(1){
		background: rgb(<?php echo esc_attr(prolancer_hex2rgb($primary_color_1)) ?> / 20%);
	}

	.seller-profile .stats-list .stats:nth-child(2) span {
		background: <?php echo esc_attr($primary_color_2) ?>;
	}

	.widget .seller-detail:nth-child(3) i,
	.stats .col-lg-3:nth-child(4) .dashboard-stats-item,
	.frontend-dashboard-header .balance-in-navbar,.buyer-profile ul.meta li:nth-child(2),
	.buyer-profile ul.stats li:nth-child(2),
	.prolancer-seller-item.style-2 ul li:nth-child(2),
	.prolancer-service-item.style-2 ul li:nth-child(2),
	.service-meta-cards .col-xl-4:nth-child(2) .service-meta,
	.project-meta-cards .col-xl-4:nth-child(6) .project-meta,
	.project-meta-cards .col-xl-4:nth-child(2) .project-meta,
	.seller-profile .stats-list .stats:nth-child(2){
		background: rgb(<?php echo esc_attr(prolancer_hex2rgb($primary_color_2)) ?> / 20%);
	}

	.seller-profile .stats-list .stats:nth-child(3) span {
		background: <?php echo esc_attr($primary_color_3) ?>;
	}

	.stats .col-lg-4:nth-child(3) .dashboard-stats-item,.stats .col-lg-3:nth-child(3) .dashboard-stats-item,.frontend-dashboard-header .balance-in-navbar,.widget .seller-detail:nth-child(4) i,.buyer-profile ul.meta li:nth-child(3),
	.prolancer-project-item.style-1 ul li:nth-child(3),
	.prolancer-buyer-item.style-2 ul li:nth-child(2),
	.prolancer-service-item.style-2 ul li:nth-child(3),
	.service-meta-cards .col-xl-4:nth-child(3) .service-meta,
	.project-meta-cards .col-xl-4:nth-child(3) .project-meta,
	.seller-profile .stats-list .stats:nth-child(3){
		background: rgb(<?php echo esc_attr(prolancer_hex2rgb($primary_color_3)) ?> / 20%);
	}

	.seller-profile .stats-list .stats:nth-child(4) span {
		background: <?php echo esc_attr($primary_color_4) ?>;
	}


	.stats .col-lg-4:nth-child(2) .dashboard-stats-item,.stats .col-lg-3:nth-child(2) .dashboard-stats-item,.widget .seller-detail:nth-child(5) i,
	.buyer-profile ul.stats li:nth-child(3),	
	.prolancer-buyer-item.style-2 ul li:nth-child(1),
	.prolancer-service-item.style-2 ul li:nth-child(4),
	.project-meta-cards .col-xl-4:nth-child(4) .project-meta,
	.seller-profile .stats-list .stats:nth-child(4){
		background: rgb(<?php echo esc_attr(prolancer_hex2rgb($primary_color_4)) ?> / 20%);
	}

	.project-meta-cards .col-xl-4:nth-child(5) .project-meta {
		background: rgb(<?php echo esc_attr(prolancer_hex2rgb($primary_color_5)) ?> / 20%);
	}

	.project-meta-cards .col-xl-4:nth-child(6) .project-meta {
		background: rgb(<?php echo esc_attr(prolancer_hex2rgb($primary_color_6)) ?> / 20%);
	}

	.notifications-content i,i.verified,.page-template-custom-page-without-breadcrumb .site-header.fixed-top .header-btn a,.prolancer-service-item.style-2 .slick-dots li button:before,.header-btn a,.prolancer-service-item.style-1 .service-price h4,.primary-menu ul li .sub-menu li a:hover,.primary-menu ul li .sub-menu li.current-menu-item>a,.header-btn .sub-menu li.is-active a,.product-item-button a:hover,.wp-block-search .wp-block-search__button,.prolancer-table td a .fa-edit,.price-tab .fa-check,table .fa-check,.prolancer-rgb-btn,.pagination .nav-links .page-numbers,.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active,.banner.style-2 .banner-content h1 span,.client-info h4,.product-filter ul li a.active,a,a:hover,.current_page_item a,.tags a:hover,blockquote:before,.cart_item .product-name a:hover,.widget_recent_comments ul li .comment-author-link a,.mini-cart .cart-contents:hover span,ul.banner-button li a,.testimonial-content>i,.prolancer-btn.bordered,.cat-links a,.plyr--full-ui input[type=range],.prolancer-team-social li a,.preview-btn li a,.related-post-title a:hover,.comment-author-link,.entry-meta ul li a:hover,.widget-product-details table td span a:hover,.iconbox-item i,.footer-widget ul li a:hover,.widget li a:hover,p.no-comments a,.blog-meta span,.blog-content h4:hover a,.tags-links a,.tags a,.navbar-logo-text,.docs-single h4 a:hover,.docs-single ul li a:hover,.navbar .menu-item>.active,blockquote::before,.primary-menu ul li>a:hover,.tags a,a.button,.the_excerpt .entry-title a:hover {
		color: <?php echo esc_attr( $primary_color) ?>;
	}

	
	.message_receiver .download,.page-template-custom-page-without-breadcrumb .site-header.fixed-top .header-btn a,.header-btn a,.dropzone.is-dragover,.irs--round .irs-handle,.prolancer-project-item.style-1:hover,.prolancer-project-item.style-2:hover,.feds-user-profile a,.feds-user-profile img,.category-item h5,.uil-ripple-css div,.testimonial-img img,.product-item.style-3:hover,.prolancer-btn.bordered,ul.banner-button li a,.preview-btn li a,.prolancer-pricing-table a,blockquote,.loader,.related-themes .single-related-theme:hover,.theme-author span,.tags a,.playerContainer,.sticky .the_excerpt_content {
		border-color: <?php echo esc_attr( $primary_color ) ?>!important;
	}

	.irs-from:before,.irs-to:before {
		border-top-color: <?php echo esc_attr( $primary_color ) ?>!important;
	}

	
	.navbar-toggler-icon {
	  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='<?php echo esc_attr( $primary_color ) ?>' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
	}

	/*----------------------------------------
	IF SCREEN SIZE LESS THAN 769px WIDE
	------------------------------------------*/

	@media screen and (max-width: 768px) {
		.navbar .menu-item>.active {
	 		background: <?php echo esc_attr( $primary_color ) ?>;
		}
	}
<?php
	return ob_get_clean();
}