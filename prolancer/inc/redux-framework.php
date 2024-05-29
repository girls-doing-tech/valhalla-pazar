<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $opt_name = "prolancer_opt";
    $theme = wp_get_theme();

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__( 'ProLancer Opt', 'prolancer' ),
        'page_title'           => esc_html__( 'ProLancer Opt', 'prolancer' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => false,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-portfolio',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => true,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => '',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '_options',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );
    

    $elementor_library = new WP_Query( array( 
        'post_type' => 'elementor_library',
        'posts_per_page' => -1
    ));

    $template_lists = [];

    /* Start the Loop */
    if ( $elementor_library->have_posts()) {
        while ( $elementor_library->have_posts()) : $elementor_library->the_post();
            $template_lists[ get_the_ID() ] = get_the_title();
        endwhile;
        wp_reset_postdata();
    }

    $pagesx = new WP_Query( array( 
        'post_type' => 'page',
        'posts_per_page' => -1
    ));

    $page_lists = [];

    /* Start the Loop */
    if ( $pagesx->have_posts()) {
        while ( $pagesx->have_posts()) : $pagesx->the_post();
            $page_lists[ get_the_ID() ] = get_the_title();
        endwhile;
    }

    // General
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General', 'prolancer' ),
        'id'     => 'general',
        'desc'   => esc_html__( 'General theme options.', 'prolancer' ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'site_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'prolancer' ),
                'default'  => true,
            ),            
            array(
                'id'       => 'email_on_registration',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on new registration', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_registration_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'New user registration subject', 'prolancer' ),
                'default'  => esc_html__( 'New user registred on your website', 'prolancer' ),
                'required' => array( 'email_on_registration','equals', true ),
            ),
            array(
                'id'       => 'email_on_registration_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'New user registration content', 'prolancer' ),
                'required' => array( 'email_on_registration','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{full_name}},{{email}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'prolancer_signup_email_verification',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send password to user\'s email when sign up', 'prolancer' )
            ),
            array(
                'id'       => 'prolancer_header_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Header', 'prolancer' ),
                'subtitle' => esc_html__( 'Controls the width of the header area. ', 'prolancer' ),
                'default'  => false
            ),
            array(
                'id'               => 'prolancer_service_fee',
                'type'             => 'text',
                'title'            => esc_html__('Service Fee %', 'prolancer'),
                "default"          => 5,
            ),
            array(
                'id'               => 'prolancer_deposit_fee',
                'type'             => 'text',
                'title'            => esc_html__('Deposit Fee %', 'prolancer'),
                "default"          => 10,
            ),
            array(
                'id'               => 'prolancer_project_featuring_fee',
                'type'             => 'text',
                'title'            => esc_html__('Project featuring fee ', 'prolancer').(class_exists('WooCommerce') ? get_woocommerce_currency_symbol() . '0' : ''),
                "default"          => 5,
            ),
            array(
                'id'               => 'prolancer_service_featuring_fee',
                'type'             => 'text',
                'title'            => esc_html__('Service featuring fee ', 'prolancer').(class_exists('WooCommerce') ? get_woocommerce_currency_symbol() . '0' : ''),
                "default"          => 5,
            )
        )
    ));

    // Style
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Style', 'prolancer' ),
        'id'     => 'style',
        'desc'   => esc_html__( 'Header menu options.', 'prolancer' ),
        'icon'   => 'el el-edit',
        'fields' => array(
            array(
                'id'       => 'primary_color',
                'type'     => 'color',
                'title'    => esc_html__('Primary Color', 'prolancer'), 
                'validate' => 'color',
                'default'  => '#6787FE'
            ),
            array(
                'id'       => 'primary_color_1',
                'type'     => 'color',
                'title'    => esc_html__('Random Color 1', 'prolancer'), 
                'validate' => 'color',
                'default'  => '#1661ff'
            ),
            array(
                'id'       => 'primary_color_2',
                'type'     => 'color',
                'title'    => esc_html__('Random Color 2', 'prolancer'), 
                'validate' => 'color',
                'default'  => '#00e9b9'
            ),
            array(
                'id'       => 'primary_color_3',
                'type'     => 'color',
                'title'    => esc_html__('Random Color 3', 'prolancer'), 
                'validate' => 'color',
                'default'  => '#ffbb00'
            ),
            array(
                'id'       => 'primary_color_4',
                'type'     => 'color',
                'title'    => esc_html__('Random Color 4', 'prolancer'), 
                'validate' => 'color',
                'default'  => '#ff007a'
            ),
            array(
                'id'       => 'primary_color_5',
                'type'     => 'color',
                'title'    => esc_html__('Random Color 5', 'prolancer'), 
                'validate' => 'color',
                'default'  => '#9981fb'
            ),
            array(
                'id'       => 'primary_color_6',
                'type'     => 'color',
                'title'    => esc_html__('Random Color 6', 'prolancer'), 
                'validate' => 'color',
                'default'  => '#81d742'
            )
        )
    ));

    // Typography
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Typography', 'prolancer' ),
        'id'               => 'page_title_typography',  
        'icon'   => 'el el-pencil',
        'fields'           => array(
            array(
                'id'          => 'prolancer_heading_typography',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading Typography', 'prolancer' ),
                'subtitle'    => esc_html__('H1, H2, H3,H4, H5, H6  Tags', 'prolancer'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array('h1,h2,h3,h4,h5,h6'),
                'units'       =>'px',
                'default'     => array(
                    'color'       => '#333',
                    'font-weight' => '700', 
                    'font-family' => 'Rubik', 
                    'google'      => true,
                ),
            ),
            array(
                'id'          => 'prolancer_typography',
                'type'        => 'typography',
                'title'       => esc_html__( 'Typography', 'prolancer' ),
                'subtitle'    => esc_html__('body, p Tags', 'prolancer'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array('body,p'),
                'units'       =>'px',
                'default'     => array(
                    'color'       => '#4A6375', 
                    'font-weight'  => 'normal', 
                    'line-height' => '28px',
                    'font-family' => 'Rubik', 
                    'google'      => true,
                    'font-size'   => '16px',
                ),
            )
        )
    ) );

    // Header
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header', 'prolancer' ),
        'id'     => 'header',
        'desc'   => esc_html__( 'Header menu options.', 'prolancer' ),
        'icon'   => 'el el-heart-empty',
        'fields' => array(
            array(         
                'id'       => 'logo_width',
                'type'     => 'dimensions',                
                'height'   => false,                
                'units'    => array('em','px','%'),
                'output'   => array('.custom-logo-link img'),
                'title'    => esc_html__('Logo Dimensions', 'prolancer'),
            ),
            array(
                'id'       => 'alt_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Alternative Logo', 'prolancer' )
            ),
            array(
                'id'       => 'header_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Header Style', 'prolancer' ),
                'options'  => array(
                    'style1' => esc_html__( 'Style one','prolancer' ), 
                    'style2' => esc_html__( 'Style two','prolancer' )
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'prolancer_login_and_register_page',
                'type'     => 'select',
                'title'    => esc_html__('Login and Register Page', 'prolancer'),
                'options'  => $page_lists
            ),
            array(
                'id'       => 'prolancer_header_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'prolancer' ),
                'subtitle' => esc_html__( 'Turn on to activate the sticky header.', 'prolancer' ),
                'default'  => false
            ),
            array(
                'id'       => 'prolancer_navbar_button',
                'type'     => 'switch',
                'title'    => esc_html__( 'Navbar button', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'prolancer_navbar_button_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Navbar button text', 'prolancer' ),
                'default'  => esc_html__( 'Dashboard', 'prolancer' ),
                'required' => array('prolancer_navbar_button','equals', true)

            ),
            array(         
                'id'       => 'breadcrumbs',
                'type'     => 'background',
                'output'     => array('.breadcrumbs'),
                'title'    => esc_html__('Breadcrumbs', 'prolancer'),
                'subtitle' => esc_html__('Set breadcrumbs background with image, color', 'prolancer'),
                'default'  => array(
                    'background-color' => '#333',
                )
            )
        )
    ) );

    // Projects
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Projects', 'prolancer' ),
        'id'    => 'projects',
        'icon'  => 'el el-briefcase',
        'fields'     => array(  
            array(
                'id'               => 'prolancer_project_per_page',
                'type'             => 'slider',
                'title'            => esc_html__('Project per page', 'prolancer'),
                "default"          => 5,
                "min"              => 1,
                "step"             => 1,
                "max"              => 100,
                'display_value'    => 'text'
            ),
            array(
                'id'       => 'prolancer_project_details_navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Navigation (Next/Previous)', 'prolancer' ),
                'default'  => false,
            ),
            array( 
                'id'       => 'prolancer_projects_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'prolancer'),
                'options'  => Array(
                    'projects_full_width'=> Array (
                         'alt'  => 'Full Width',
                         'img'  =>  get_template_directory_uri() . '/assets/images/full-width.jpg',
                    ),
                    'projects_left_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/left-sidebar.jpg',
                    ),
                    'projects_right_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/right-sidebar.jpg',
                    )
                ),
                'default'  => 'projects_right_sidebar',
            ),                                 
            array(
                'id'       => 'prolancer_project_auto_approval',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Auto Approval', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_project_creation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on project creation', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_project_creation_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'The buyer has submitted a project', 'prolancer' ),
                'default'  => esc_html__( 'Your project has been created', 'prolancer' ),
                'required' => array( 'email_on_project_creation','equals', true ),
            ),
            array(
                'id'       => 'email_on_project_creation_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Project creation content', 'prolancer' ),
                'required' => array( 'email_on_project_creation','equals', true ),
                'desc'     => esc_html__("{{buyer_name}},{{display_name}},{{project_link}},{{project_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_project_approval',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on project approval', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_project_approval_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Project approval subject', 'prolancer' ),
                'default'  => esc_html__( 'Your project has been approved', 'prolancer' ),
                'required' => array( 'email_on_project_approval','equals', true ),
            ),
            array(
                'id'       => 'email_on_project_approval_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Project approval content', 'prolancer' ),
                'required' => array( 'email_on_project_approval','equals', true ),
                'desc'     => esc_html__("{{buyer_name}},{{display_name}},{{project_link}},{{project_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),            
            array(
                'id'       => 'email_on_proposal',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on project proposal', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_proposal_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Project proposal subject', 'prolancer' ),
                'default'  => esc_html__( 'You Got a New Proposal', 'prolancer' ),
                'required' => array( 'email_on_proposal','equals', true ),
            ),
            array(
                'id'       => 'email_on_proposal_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Project proposal content', 'prolancer' ),
                'required' => array( 'email_on_proposal','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{buyer_name}},{{seller_name}},{{project_link}},{{project_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),          
            array(
                'id'       => 'email_on_proposal_cancel',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on proposal cancel', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_proposal_cancel_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Proposal cancel subject', 'prolancer' ),
                'default'  => esc_html__( 'Your proposal has been canceled', 'prolancer' ),
                'required' => array( 'email_on_proposal_cancel','equals', true ),
            ),
            array(
                'id'       => 'email_on_proposal_cancel_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Proposal cancel content', 'prolancer' ),
                'required' => array( 'email_on_proposal_cancel','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{buyer_name}},{{seller_name}},{{project_link}},{{project_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_project_assigned',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on project assigned', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_project_assigned_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Project assigned subject', 'prolancer' ),
                'default'  => esc_html__( 'Congratulations! You Got a New Project', 'prolancer' ),
                'required' => array( 'email_on_project_assigned','equals', true ),
            ),
            array(
                'id'       => 'email_on_project_assigned_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Project assigned content', 'prolancer' ),
                'required' => array( 'email_on_project_assigned','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{buyer_name}},{{seller_name}},{{project_link}},{{project_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_project_complete',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on project completed', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_project_complete_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Project completed subject', 'prolancer' ),
                'default'  => esc_html__( 'You Have Completed a Project', 'prolancer' ),
                'required' => array( 'email_on_project_complete','equals', true ),
            ),
            array(
                'id'       => 'email_on_project_complete_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Project completed content', 'prolancer' ),
                'required' => array( 'email_on_project_complete','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{buyer_name}},{{seller_name}},{{project_link}},{{project_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_project_cancel',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on project cancel', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_project_cancel_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Project cancel subject', 'prolancer' ),
                'default'  => esc_html__( 'Your project has been canceled', 'prolancer' ),
                'required' => array( 'email_on_project_cancel','equals', true ),
            ),
            array(
                'id'       => 'email_on_project_cancel_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Project cancel content', 'prolancer' ),
                'required' => array( 'email_on_project_cancel','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{buyer_name}},{{seller_name}},{{project_link}},{{project_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_sending_project_messages',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on sending messages', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_sending_project_messages_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Sending messages subject', 'prolancer' ),
                'default'  => esc_html__( 'You have received a messages', 'prolancer' ),
                'required' => array( 'email_on_sending_project_messages','equals', true ),
            ),
            array(
                'id'       => 'email_on_sending_project_messages_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Sending messages content', 'prolancer' ),
                'required' => array( 'email_on_sending_project_messages','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{receiver_name}},{{message_link}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            )
        )
    ) );

    // Services
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Services', 'prolancer' ),
        'id'    => 'services',
        'icon'  => 'el el-idea',
        'fields'     => array(  
            array(
                'id'               => 'prolancer_service_per_page',
                'type'             => 'slider',
                'title'            => esc_html__('Service per page', 'prolancer'),
                "default"          => 5,
                "min"              => 1,
                "step"             => 1,
                "max"              => 100,
                'display_value'    => 'text'
            ),            
            array(
                'id'       => 'prolancer_service_details_navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Service Navigation (Next/Previous)', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'=>'prolancer_packages',
                'type'             => 'slider',
                'title'            => esc_html__('Package Variation', 'prolancer'),
                "default"          => 3,
                "min"              => 1,
                "step"             => 1,
                "max"              => 10
            ),
            array(
                'id'=>'prolancer_package_feature',
                'type' => 'multi_text',
                'title' => esc_html__('Package feature', 'prolancer')
            ),
            array( 
                'id'       => 'prolancer_services_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'prolancer'),
                'options'  => Array(
                    'services_full_width'=> Array (
                         'alt'  => 'Full Width',
                         'img'  =>  get_template_directory_uri() . '/assets/images/full-width.jpg',
                    ),
                    'services_left_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/left-sidebar.jpg',
                    ),
                    'services_right_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/right-sidebar.jpg',
                    )
                ),
                'default'  => 'services_right_sidebar',
            ),                       
            array(
                'id'       => 'prolancer_service_auto_approval',
                'type'     => 'switch',
                'title'    => esc_html__( 'Service Auto Approval', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_service_creation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on service creation', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_service_creation_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Service creation subject', 'prolancer' ),
                'default'  => esc_html__( 'Your service has been created', 'prolancer' ),
                'required' => array( 'email_on_service_creation','equals', true ),
            ),
            array(
                'id'       => 'email_on_service_creation_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Service creation content', 'prolancer' ),
                'required' => array( 'email_on_service_creation','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{seller_name}},{{service_link}},{{service_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_service_approval',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on service approval', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_service_approval_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Service approval subject', 'prolancer' ),
                'default'  => esc_html__( 'Your service has been approved', 'prolancer' ),
                'required' => array( 'email_on_service_approval','equals', true ),
            ),
            array(
                'id'       => 'email_on_service_approval_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Service approval content', 'prolancer' ),
                'required' => array( 'email_on_service_approval','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{seller_name}},{{service_link}},{{service_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_order_a_service',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on order a service', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_order_a_service_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Service order subject', 'prolancer' ),
                'default'  => esc_html__( 'You have just received an order', 'prolancer' ),
                'required' => array( 'email_on_order_a_service','equals', true ),
            ),
            array(
                'id'       => 'email_on_order_a_service_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Service order content', 'prolancer' ),
                'required' => array( 'email_on_order_a_service','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{seller_name}},{{buyer_name}},{{service_link}},{{service_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_service_complete',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on service completed', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_service_complete_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Service completed subject', 'prolancer' ),
                'default'  => esc_html__( 'You Have Completed a service', 'prolancer' ),
                'required' => array( 'email_on_service_complete','equals', true ),
            ),
            array(
                'id'       => 'email_on_service_complete_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Service completed content', 'prolancer' ),
                'required' => array( 'email_on_service_complete','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{seller_name}},{{buyer_name}},{{service_link}},{{service_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_service_cancel',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on service cancel', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_service_cancel_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Service cancel subject', 'prolancer' ),
                'default'  => esc_html__( 'Your order has been canceled', 'prolancer' ),
                'required' => array( 'email_on_service_cancel','equals', true ),
            ),
            array(
                'id'       => 'email_on_service_cancel_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Service cancel content', 'prolancer' ),
                'required' => array( 'email_on_service_cancel','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{seller_name}},{{buyer_name}},{{service_link}},{{service_title}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_sending_service_messages',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on sending messages', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_sending_service_messages_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Sending messages subject', 'prolancer' ),
                'default'  => esc_html__( 'You have received a messages', 'prolancer' ),
                'required' => array( 'email_on_sending_service_messages','equals', true ),
            ),
            array(
                'id'       => 'email_on_sending_service_messages_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Sending messages content', 'prolancer' ),
                'required' => array( 'email_on_sending_service_messages','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{receiver_name}},{{message_link}} will be translated accordingly.", 'prolancer'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            )
        )
    ) );

    // Buyers
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Buyers', 'prolancer' ),
        'id'    => 'buyers',
        'icon'  => 'el el-torso',
        'fields'     => array(  
            array(
                'id'               => 'prolancer_buyer_per_page',
                'type'             => 'slider',
                'title'            => esc_html__('Buyer per page', 'prolancer'),
                "default"          => 5,
                "min"              => 1,
                "step"             => 1,
                "max"              => 100,
                'display_value'    => 'text'
            ),
            array( 
                'id'       => 'prolancer_buyers_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'prolancer'),
                'options'  => Array(
                    'buyers_full_width'=> Array (
                         'alt'  => 'Full Width',
                         'img'  =>  get_template_directory_uri() . '/assets/images/full-width.jpg',
                    ),
                    'buyers_left_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/left-sidebar.jpg',
                    ),
                    'buyers_right_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/right-sidebar.jpg',
                    )
                ),
                'default'  => 'buyers_right_sidebar',
            )  
        )
    ) );

    // Sellers
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Sellers', 'prolancer' ),
        'id'    => 'sellers',
        'icon'  => 'el el-group',
        'fields'     => array(  
            array(
                'id'               => 'prolancer_seller_per_page',
                'type'             => 'slider',
                'title'            => esc_html__('Sellers per page', 'prolancer'),
                'default'          => 5,
                'min'              => 1,
                'step'             => 1,
                'max'              => 100,
                'display_value'    => 'text'
            ),
            array( 
                'id'       => 'prolancer_sellers_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'prolancer'),
                'options'  => Array(
                    'sellers_full_width'=> Array (
                         'alt'  => 'Full Width',
                         'img'  =>  get_template_directory_uri() . '/assets/images/full-width.jpg',
                    ),
                    'sellers_left_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/left-sidebar.jpg',
                    ),
                    'sellers_right_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/right-sidebar.jpg',
                    )
                ),
                'default'  => 'sellers_right_sidebar',
            )            
        )
    ) );

    // Blog Page
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog Page', 'prolancer' ),
        'id'    => 'blog_page',
        'icon'  => 'el el-wordpress',
        'fields'     => array( 
            array(
                'id'               => 'prolancer_excerpt_length',
                'type'             => 'slider',
                'title'            => esc_html__('Excerpt Length', 'prolancer'),
                'subtitle'         => esc_html__('Controls the excerpt length on blog page','prolancer'),
                "default"          => 55,
                "min"              => 10,
                "step"             => 2,
                "max"              => 1000,
                'display_value'    => 'text'
            ),
            array( 
                'id'       => 'prolancer_blog_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'prolancer'),
                'options'  => Array(
                    'blog_full_width'=> Array (
                         'alt'  => 'Full Width',
                         'img'  =>  get_template_directory_uri() . '/assets/images/full-width.jpg',
                    ),
                    'blog_left_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/left-sidebar.jpg',
                    ),
                    'blog_right_sidebar'=> Array (
                         'alt'  => 'Image Name 2',
                         'img'  => get_template_directory_uri() . '/assets/images/right-sidebar.jpg',
                    )
                ),
                'default'  => 'blog_right_sidebar',
            )            
        )
    ));

    // Single Blog
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Single Blog Page', 'prolancer' ),
        'id'    => 'single_blog_page',
        'icon'  => 'el el-wordpress',
        'subsection' => true,
        'fields'     => array(              
            array(
                'id'       => 'social_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Share', 'prolancer' ),
                'default'  => true,
            ),
            array(
                'id'       => 'prolancer_blog_details_post_navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Navigation (Next/Previous)', 'prolancer' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Related Post', 'prolancer' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_post_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Post Title', 'prolancer' ),
                'required' => array( 'related_posts','equals', true ),
                'default'  => esc_html__( 'Related Post', 'prolancer' ),
            ),
            array(
                'id' => 'posts_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Related Posts', 'prolancer' ),
                'subtitle' => esc_html__( 'Related posts per page', 'prolancer' ),
                'desc' => esc_html__('Number of related posts to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'prolancer'),
                "default" => 3,
                "min" => 1,
                "step" => 1,
                "max" => 10000,
                'required' => array( 'related_posts','equals', true ),
                'display_value' => 'text'
            ),
            array(
                'id'       => 'related_posts_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Posts Column', 'prolancer' ), 
                'subtitle' => esc_html__( 'Number of column', 'prolancer' ),
                'desc'     => esc_html__( 'Specify the number of related posts column.', 'prolancer' ),
                'required' => array( 'related_posts','equals', true ),
                'options'  => array(
                    '12' => esc_html__( 'One Column','prolancer' ), 
                     '6' => esc_html__( 'Two Columns','prolancer' ), 
                     '4' => esc_html__( 'Three Columns','prolancer' ), 
                     '3' => esc_html__( 'Four Columns','prolancer' ), 
                     '2' => esc_html__( 'Six Columns','prolancer' ),
                ),
                'default'  => '4',
            )
        )
    ));

    // Payout
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Payout', 'prolancer' ),
        'id'     => 'payout',
        'desc'   => esc_html__( 'Payout theme options.', 'prolancer' ),
        'icon'   => 'el el-usd',
        'fields' => array(
            array(
                'id'               => 'minimum_threshold',
                'type'             => 'text',
                'title'            => esc_html__('Minimum Withdrow Threshold', 'prolancer'),
                "default"          => 20
            ),
            array(
                'id'       => 'email_on_withdrawal_money_request',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send email on withdrawal money request by seller', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'email_on_withdrawal_money_request_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Withdrawal money request subject', 'prolancer' ),
                'default'  => esc_html__( 'The user has request for withdrawal money', 'prolancer' ),
                'required' => array( 'email_on_withdrawal_money_request','equals', true ),
            ),
            array(
                'id'       => 'email_on_withdrawal_money_request_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Withdrawal money request content', 'prolancer' ),
                'required' => array( 'email_on_withdrawal_money_request','equals', true ),
                'desc'     => esc_html__("{{site_name}},{{username}},{{method}},{{withdrawal_amount}} will be translated accordingly.", 'prolancer')
            )
        )
    ));
 
    // Badges
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Badges', 'prolancer' ),
        'id'     => 'badges',
        'desc'   => esc_html__( 'Badges for selers and buyers.', 'prolancer' ),
        'icon'   => 'el el-certificate',
        'fields' => array(
            array(
                'id'       => 'id_verified',
                'type'     => 'switch',
                'title'    => esc_html__( 'ID Verified', 'prolancer' ),
                'default'  => true
            ),            
            array(
                'id'       => 'id_verified_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'ID Verified badge', 'prolancer' ),
                'required' => array( 'id_verified','equals', true ),
            ),
            array(
                'id'       => 'buyer_first_order',
                'type'     => 'switch',
                'title'    => esc_html__( 'Buyer first order', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'buyer_first_order_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Buyer first order badge', 'prolancer' ),
                'required' => array( 'buyer_first_order','equals', true ),
            ),
            array(
                'id'       => 'seller_first_order_received',
                'type'     => 'switch',
                'title'    => esc_html__( 'Seller first order received', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'seller_first_order_received_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'First order received badge', 'prolancer' ),
                'required' => array( 'seller_first_order_received','equals', true ),
            ),
            array(
                'id'       => 'new_member',
                'type'     => 'switch',
                'title'    => esc_html__( 'New member', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'new_member_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'New member badge', 'prolancer' ),
                'required' => array( 'new_member','equals', true ),
            ),
            array(
                'id'       => 'new_member_days',
                'type'     => 'slider',
                'title'    => esc_html__('Joining days less than', 'prolancer'),
                "default"  => 90,
                "min"      => 1,
                "step"     => 1,
                "max"      => 1000,
                'required' => array( 'new_member','equals', true ),
            ),
            array(
               'id' => 'seller_level_1_section',
               'type' => 'section',
               'title' => __('Level 1', 'prolancer'),
               'indent' => true 
            ),
            array(
                'id'       => 'seller_level_1',
                'type'     => 'switch',
                'title'    => esc_html__( 'Seller Level 1', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'seller_level_1_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Seller Level 1 badge', 'prolancer' ),
                'required' => array( 'seller_level_1','equals', true ),
            ),            
            array(
                'id'       => 'seller_level_1_earnings',
                'type'     => 'text',
                'title'    => esc_html__( 'Seller Level 1 total earnings', 'prolancer' ),
                'default'  => 500,
                'required' => array( 'seller_level_1','equals', true ),
            ),
            array(
               'id' => 'seller_level_2_section',
               'type' => 'section',
               'title' => __('Level 2', 'prolancer'),
               'indent' => true 
            ),
            array(
                'id'       => 'seller_level_2',
                'type'     => 'switch',
                'title'    => esc_html__( 'Seller Level 2', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'seller_level_2_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Seller Level 2 badge', 'prolancer' ),
                'required' => array( 'seller_level_2','equals', true ),
            ),          
            array(
                'id'       => 'seller_level_2_earnings',
                'type'     => 'text',
                'title'    => esc_html__( 'Seller Level 2 total earnings', 'prolancer' ),
                'default'  => 2000,
                'required' => array( 'seller_level_2','equals', true ),
            ),
            array(
               'id' => 'seller_level_3_section',
               'type' => 'section',
               'title' => __('Level 3', 'prolancer'),
               'indent' => true 
            ),
            array(
                'id'       => 'seller_level_3',
                'type'     => 'switch',
                'title'    => esc_html__( 'Seller Level 3', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'seller_level_3_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Seller Level 3 badge', 'prolancer' ),
                'required' => array( 'seller_level_3','equals', true ),
            ),           
            array(
                'id'       => 'seller_level_3_earnings',
                'type'     => 'text',
                'title'    => esc_html__( 'Seller Level 3 total earnings', 'prolancer' ),
                'default'  => 20000,
                'required' => array( 'seller_level_3','equals', true ),
            ),
            array(
               'id' => 'buyer_level_1_section',
               'type' => 'section',
               'title' => __('Level 1', 'prolancer'),
               'indent' => true 
            ),
            array(
                'id'       => 'buyer_level_1',
                'type'     => 'switch',
                'title'    => esc_html__( 'Buyer Level 1', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'buyer_level_1_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Buyer Level 1 badge', 'prolancer' ),
                'required' => array( 'buyer_level_1','equals', true ),
            ),
            array(
                'id'       => 'buyer_level_1_spent',
                'type'     => 'text',
                'title'    => esc_html__( 'Buyer Level 1 total spent', 'prolancer' ),
                'default'  => 500,
                'required' => array( 'buyer_level_1','equals', true ),
            ),
            array(
               'id' => 'buyer_level_2_section',
               'type' => 'section',
               'title' => __('Level 2', 'prolancer'),
               'indent' => true 
            ),
            array(
                'id'       => 'buyer_level_2',
                'type'     => 'switch',
                'title'    => esc_html__( 'Buyer Level 2', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'buyer_level_2_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Buyer Level 2 badge', 'prolancer' ),
                'required' => array( 'buyer_level_2','equals', true ),
            ),
            array(
                'id'       => 'buyer_level_2_spent',
                'type'     => 'text',
                'title'    => esc_html__( 'Buyer Level 2 total spent', 'prolancer' ),
                'default'  => 1000,
                'required' => array( 'buyer_level_2','equals', true ),
            ),
            array(
               'id' => 'buyer_level_3_section',
               'type' => 'section',
               'title' => __('Level 3', 'prolancer'),
               'indent' => true 
            ),
            array(
                'id'       => 'buyer_level_3',
                'type'     => 'switch',
                'title'    => esc_html__( 'Buyer Level 3', 'prolancer' ),
                'default'  => true
            ),
            array(
                'id'       => 'buyer_level_3_badge',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Buyer Level 3 badge', 'prolancer' ),
                'required' => array( 'buyer_level_3','equals', true ),
            ),
            array(
                'id'       => 'buyer_level_3_spent',
                'type'     => 'text',
                'title'    => esc_html__( 'Buyer Level 3 total spent', 'prolancer' ),
                'default'  => 5000,
                'required' => array( 'buyer_level_3','equals', true ),
            ),
        )
    )); 

    // Newsletter Modal
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Newsletter Modal', 'prolancer' ),
        'id'     => 'newsletter_modal',
        'icon'   => 'el el-envelope',
        'fields' => array(
            array(
                'id'          => 'newsletter_modal_switch',
                'type'        => 'switch',
                'title'       => esc_html__( 'Newsletter Modal', 'prolancer' ),
                'default'  => false,
            ),
            array(
                'id'          => 'modal_image',
                'type'        => 'media',
                'title'       => esc_html__( 'Modal image', 'prolancer' ),
                'default'  => '#',
                'required' => array( 'newsletter_modal_switch','equals', true ),
            ),
            array(
                'id'          => 'modal_title',
                'type'        => 'text',
                'title'       => esc_html__( 'Modal title', 'prolancer' ),
                'default'     => esc_html__( 'Subscribe And Get 30% Discount!', 'prolancer' ),
                'required'    => array( 'newsletter_modal_switch','equals', true ),
            ),
            array(
                'id'          => 'modal_description',
                'type'        => 'textarea',
                'title'       => esc_html__( 'Modal description', 'prolancer' ),
                'default'     => esc_html__( 'Subscribe to our newsletter to get updates and big discount offer!.', 'prolancer' ),
                'required'    => array( 'newsletter_modal_switch','equals', true ),
            ),
            array(
                'id'          => 'modal_shortcode',
                'type'        => 'text',
                'title'       => esc_html__( 'Modal shortcode', 'prolancer' ),
                'default'  => '[mc4wp_form id="302"]',
                'required' => array( 'newsletter_modal_switch','equals', true ),
            ),
            array(
                'id'          => 'modal_timeout',
                'type'        => 'text',
                'title'       => esc_html__( 'Modal timeout', 'prolancer' ),
                'default'  => 5000,
                'required' => array( 'newsletter_modal_switch','equals', true ),
            )
        )
    ) );


    // Footer
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer', 'prolancer' ),
        'id'     => 'footer',
        'icon'   => 'el el-arrow-down',
        'fields' => array(
            array(
                'id'          => 'footer_widget_display',
                'type'        => 'switch',
                'title'       => esc_html__( 'Footer widget display', 'prolancer' ),
                'default'  => true,
            ),
            array(
                'id'         => 'prolancer_footer_template',
                'type'       => 'select',
                'title'      => esc_html__( 'Footer template', 'prolancer' ), 
                'required'   => array( 'footer_widget_display','equals', true ),
                'desc'       => esc_html__('To set a footer template click ', 'prolancer').' <a href="edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=page">'.esc_html__('Here', 'prolancer').'</a>',
                'options'  => $template_lists
            ),
            array(
                'id'          => 'backtotop',
                'type'        => 'switch',
                'title'       => esc_html__( 'Back to top', 'prolancer' ),
                'default'  => true,
            ),
            array(
                'id'              => 'prolancer_copyright_info',
                'type'            => 'editor',
                'title'           => esc_html__( 'Copyright text', 'prolancer' ),
                'subtitle'        => esc_html__( 'Enter your company information here. HTML tags allowed: a, br, em, strong', 'prolancer' ),
                'default'         => esc_html__( 'Copyright © 2022 prolancer All Rights Reserved.', 'prolancer' ),
                'args'            => array(
                'wpautop'         => false,
                'teeny'           => true,
                'textarea_rows'   => 5
                )
            ),
            array(
                'id'          => 'supported_currency',
                'type'        => 'slides',
                'title'       => esc_html__('Supported currency', 'prolancer'),
                'subtitle'    => esc_html__('Unlimited currency with drag and drop sortings.', 'prolancer')
            )
        )
    ) );

    // 404 
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( '404 Error', 'prolancer' ),
        'id'     => 'error-page',
        'icon'   => 'el el-error-alt',
        'fields' => array(
            array(
                'id'          => 'prolancer_error_title',
                'type'        => 'text',
                'title'       => esc_html__( 'Error title', 'prolancer' ),
                'default'     => esc_html__( 'Oops! That page can’t be found.', 'prolancer' ),
                ),
            array(
                'id'          => 'prolancer_error_text',
                'type'        => 'textarea',
                'title'       => esc_html__('Error message', 'prolancer'),
                'subtitle'    => esc_html__('Enter "not found" error message.', 'prolancer'),
                'default'     => esc_html__('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'prolancer'),
                )
            ),
    ) );