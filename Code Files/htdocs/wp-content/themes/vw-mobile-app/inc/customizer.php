<?php
/**
 * VW Mobile App Theme Customizer
 *
 * @package VW Mobile App
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_mobile_app_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_mobile_app_custom_controls' );

function vw_mobile_app_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_mobile_app_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_mobile_app_customize_partial_blogdescription', 
	));

	//add home page setting pannel
	$VWMobileAppParentPanel = new VW_Mobile_App_WP_Customize_Panel( $wp_customize, 'vw_mobile_app_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'vw-mobile-app' ),
		'priority' => 10,
	));

	$wp_customize->add_section( 'vw_mobile_app_left_right', array(
    	'title'      => esc_html__( 'General Settings', 'vw-mobile-app' ),
		'priority'   => 30,
		'panel' => 'vw_mobile_app_panel_id'
	));

	$wp_customize->add_setting('vw_mobile_app_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Mobile_App_Image_Radio_Control($wp_customize, 'vw_mobile_app_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-mobile-app'),
        'description' => __('Here you can change the width layout of Website.','vw-mobile-app'),
        'section' => 'vw_mobile_app_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_mobile_app_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_mobile_app_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-mobile-app'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-mobile-app'),
        'section' => 'vw_mobile_app_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-mobile-app'),
            'Right Sidebar' => __('Right Sidebar','vw-mobile-app'),
            'One Column' => __('One Column','vw-mobile-app'),
            'Three Columns' => __('Three Columns','vw-mobile-app'),
            'Four Columns' => __('Four Columns','vw-mobile-app'),
            'Grid Layout' => __('Grid Layout','vw-mobile-app')
        ),
	));

	$wp_customize->add_setting('vw_mobile_app_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control('vw_mobile_app_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-mobile-app'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-mobile-app'),
        'section' => 'vw_mobile_app_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-mobile-app'),
            'Right Sidebar' => __('Right Sidebar','vw-mobile-app'),
            'One Column' => __('One Column','vw-mobile-app')
        ),
    ));

    //Sticky Header
	$wp_customize->add_setting( 'vw_mobile_app_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','vw-mobile-app' ),
        'section' => 'vw_mobile_app_left_right'
    )));

    $wp_customize->add_setting('vw_mobile_app_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_left_right',
		'type'=> 'text'
	));

	//Pre-Loader
	$wp_customize->add_setting( 'vw_mobile_app_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-mobile-app' ),
        'section' => 'vw_mobile_app_left_right'
    )));

	$wp_customize->add_setting('vw_mobile_app_preloader_bg_color', array(
		'default'           => '#fd6c4f',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_mobile_app_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'vw-mobile-app'),
		'section'  => 'vw_mobile_app_left_right',
	)));

	$wp_customize->add_setting('vw_mobile_app_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_mobile_app_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'vw-mobile-app'),
		'section'  => 'vw_mobile_app_left_right',
	)));

	//Slider
	$wp_customize->add_section( 'vw_mobile_app_banner_section' , array(
    	'title'      => __( 'Banner Settings', 'vw-mobile-app' ),
		'priority'   => null,
		'panel' => 'vw_mobile_app_panel_id'
	) );

	$wp_customize->add_setting( 'vw_mobile_app_search_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_search_hide_show',array(
      'label' => esc_html__( 'Show / Hide Search','vw-mobile-app' ),
      'section' => 'vw_mobile_app_banner_section'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_mobile_app_banner_settings',array(
		'selector'        => '.box-content h1',
		'render_callback' => 'vw_mobile_app_customize_partial_vw_mobile_app_banner_settings',
	));

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'vw_mobile_app_banner_settings', array(
		'default'           => '',
		'sanitize_callback' => 'vw_mobile_app_sanitize_dropdown_pages'
	));
	$wp_customize->add_control( 'vw_mobile_app_banner_settings', array(
		'label'    => __( 'Select Banner Image Page', 'vw-mobile-app' ),
		'description' => __('Banner image size (1500 x 600)','vw-mobile-app'),
		'section'  => 'vw_mobile_app_banner_section',
		'type'     => 'dropdown-pages'
	));

	//content layout
	$wp_customize->add_setting('vw_mobile_app_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Mobile_App_Image_Radio_Control($wp_customize, 'vw_mobile_app_slider_content_option', array(
        'type' => 'select',
        'label' => __('Banner Content Layouts','vw-mobile-app'),
        'section' => 'vw_mobile_app_banner_section',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_mobile_app_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	));
	$wp_customize->add_control( 'vw_mobile_app_slider_excerpt_number', array(
		'label'       => esc_html__( 'Banner Excerpt length','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_banner_section',
		'type'        => 'range',
		'settings'    => 'vw_mobile_app_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	));

	//Opacity
	$wp_customize->add_setting('vw_mobile_app_slider_opacity_color',array(
      'default'              => 0.5,
      'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control( 'vw_mobile_app_slider_opacity_color', array(
	'label'       => esc_html__( 'Banner Image Opacity','vw-mobile-app' ),
	'section'     => 'vw_mobile_app_banner_section',
	'type'        => 'select',
	'settings'    => 'vw_mobile_app_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','vw-mobile-app'),
      '0.1' =>  esc_attr('0.1','vw-mobile-app'),
      '0.2' =>  esc_attr('0.2','vw-mobile-app'),
      '0.3' =>  esc_attr('0.3','vw-mobile-app'),
      '0.4' =>  esc_attr('0.4','vw-mobile-app'),
      '0.5' =>  esc_attr('0.5','vw-mobile-app'),
      '0.6' =>  esc_attr('0.6','vw-mobile-app'),
      '0.7' =>  esc_attr('0.7','vw-mobile-app'),
      '0.8' =>  esc_attr('0.8','vw-mobile-app'),
      '0.9' =>  esc_attr('0.9','vw-mobile-app')
	),
	));

	//Slider height
	$wp_customize->add_setting('vw_mobile_app_banner_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_banner_height',array(
		'label'	=> __('Banner Height','vw-mobile-app'),
		'description'	=> __('Specify the banner height (px).','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_banner_section',
		'type'=> 'text'
	));

	//About Category
	$wp_customize->add_section( 'vw_mobile_app_category_section' , array(
    	'title'      => __( 'About us', 'vw-mobile-app' ),
		'priority'   => null,
		'panel' => 'vw_mobile_app_panel_id'
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_mobile_app_section_title', array( 
		'selector' => '#about-us h2', 
		'render_callback' => 'vw_mobile_app_customize_partial_vw_mobile_app_section_title',
	));

	$wp_customize->add_setting('vw_mobile_app_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_mobile_app_section_title',array(
		'label'	=> __('Section Title','vw-mobile-app'),
		'section'=> 'vw_mobile_app_category_section',
		'setting'=> 'vw_mobile_app_section_title',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_mobile_app_section_text',array(
		'label'	=> __('Section Text','vw-mobile-app'),
		'section'=> 'vw_mobile_app_category_section',
		'setting'=> 'vw_mobile_app_section_text',
		'type'=> 'text'
	));	

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_mobile_app_about_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_mobile_app_sanitize_choices',
	));
	$wp_customize->add_control('vw_mobile_app_about_category',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display services','vw-mobile-app'),
		'description' => __('Image size (70 x 70)','vw-mobile-app'),
		'section' => 'vw_mobile_app_category_section',
	));

	//About excerpt
	$wp_customize->add_setting( 'vw_mobile_app_about_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	));
	$wp_customize->add_control( 'vw_mobile_app_about_excerpt_number', array(
		'label'       => esc_html__( 'About Excerpt length','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_category_section',
		'type'        => 'range',
		'settings'    => 'vw_mobile_app_about_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	));

	//Blog Post
	$wp_customize->add_panel( $VWMobileAppParentPanel );

	$BlogPostParentPanel = new VW_Mobile_App_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-mobile-app' ),
		'panel' => 'vw_mobile_app_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	$wp_customize->add_section('vw_mobile_app_post_settings',array(
		'title'	=> __('Post Settings','vw-mobile-app'),
		'panel' => 'blog_post_parent_panel',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_mobile_app_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_mobile_app_customize_partial_vw_mobile_app_toggle_postdate', 
	));

	$wp_customize->add_setting( 'vw_mobile_app_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-mobile-app' ),
        'section' => 'vw_mobile_app_post_settings'
    )));

    $wp_customize->add_setting( 'vw_mobile_app_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_toggle_author',array(
		'label' => esc_html__( 'Author','vw-mobile-app' ),
		'section' => 'vw_mobile_app_post_settings'
    )));

    $wp_customize->add_setting( 'vw_mobile_app_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-mobile-app' ),
		'section' => 'vw_mobile_app_post_settings'
    )));

     $wp_customize->add_setting( 'vw_mobile_app_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_toggle_time',array(
		'label' => esc_html__( 'Time','vw-mobile-app' ),
		'section' => 'vw_mobile_app_post_settings'
    )));

    $wp_customize->add_setting( 'vw_mobile_app_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	));
	$wp_customize->add_control( 'vw_mobile_app_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_mobile_app_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	));

	//Blog layout
    $wp_customize->add_setting('vw_mobile_app_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Mobile_App_Image_Radio_Control($wp_customize, 'vw_mobile_app_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-mobile-app'),
        'section' => 'vw_mobile_app_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/images/blog-layout3.png',
    ))));

    $wp_customize->add_setting('vw_mobile_app_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control('vw_mobile_app_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-mobile-app'),
        'section' => 'vw_mobile_app_post_settings',
        'choices' => array(
        	'Content' => __('Content','vw-mobile-app'),
            'Excerpt' => __('Excerpt','vw-mobile-app'),
            'No Content' => __('No Content','vw-mobile-app')
        ),
	));

	$wp_customize->add_setting('vw_mobile_app_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_mobile_app_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','vw-mobile-app' ),
      'section' => 'vw_mobile_app_post_settings'
    )));

	$wp_customize->add_setting( 'vw_mobile_app_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_mobile_app_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_mobile_app_blog_pagination_type', array(
        'section' => 'vw_mobile_app_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-mobile-app' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-mobile-app' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-mobile-app' ),
    )));

	// Button Settings
	$wp_customize->add_section( 'vw_mobile_app_button_settings', array(
		'title' => esc_html__( 'Button Settings','vw-mobile-app'),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting('vw_mobile_app_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_mobile_app_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	));
	$wp_customize->add_control( 'vw_mobile_app_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_mobile_app_button_text', array( 
		'selector' => '.post-main-box a.content-bttn', 
		'render_callback' => 'vw_mobile_app_customize_partial_vw_mobile_app_button_text', 
	));

	$wp_customize->add_setting('vw_mobile_app_button_text',array(
		'default'=> esc_html__( 'READ MORE', 'vw-mobile-app' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_button_text',array(
		'label'	=> __('Add Button Text','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_mobile_app_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-mobile-app' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_mobile_app_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_mobile_app_customize_partial_vw_mobile_app_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_mobile_app_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_related_post',array(
		'label' => esc_html__( 'Related Post','vw-mobile-app' ),
		'section' => 'vw_mobile_app_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_mobile_app_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_mobile_app_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_mobile_app_sanitize_float'
	));
	$wp_customize->add_control('vw_mobile_app_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_related_posts_settings',
		'type'=> 'number'
	));

	// Single Posts Settings
	$wp_customize->add_section( 'vw_mobile_app_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-mobile-app' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_mobile_app_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-mobile-app' ),
		'section' => 'vw_mobile_app_single_blog_settings'
    )));

	$wp_customize->add_setting( 'vw_mobile_app_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Post Navigation','vw-mobile-app' ),
		'section' => 'vw_mobile_app_single_blog_settings'
    )));

	//navigation text
	$wp_customize->add_setting('vw_mobile_app_single_blog_prev_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_single_blog_next_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_single_blog_settings',
		'type'=> 'text'
	));

    //404 Page Setting
	$wp_customize->add_section('vw_mobile_app_404_page',array(
		'title'	=> __('404 Page Settings','vw-mobile-app'),
		'panel' => 'vw_mobile_app_panel_id',
	));	

	$wp_customize->add_setting('vw_mobile_app_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_mobile_app_404_page_title',array(
		'label'	=> __('Add Title','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_mobile_app_404_page_content',array(
		'label'	=> __('Add Text','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to the home page', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_404_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_mobile_app_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-mobile-app'),
		'panel' => 'vw_mobile_app_panel_id',
	));	

	$wp_customize->add_setting('vw_mobile_app_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_social_icon_width',array(
		'label'	=> __('Icon Width','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_social_icon_height',array(
		'label'	=> __('Icon Height','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_mobile_app_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_mobile_app_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_mobile_app_responsive_media',array(
		'title'	=> __('Responsive Media','vw-mobile-app'),
		'panel' => 'vw_mobile_app_panel_id',
	));

    $wp_customize->add_setting( 'vw_mobile_app_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','vw-mobile-app' ),
      'section' => 'vw_mobile_app_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_mobile_app_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-mobile-app' ),
      'section' => 'vw_mobile_app_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_mobile_app_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-mobile-app' ),
      'section' => 'vw_mobile_app_responsive_media'
    )));

    $wp_customize->add_setting('vw_mobile_app_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Mobile_App_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_mobile_app_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-mobile-app'),
		'transport' => 'refresh',
		'section'	=> 'vw_mobile_app_responsive_media',
		'setting'	=> 'vw_mobile_app_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_mobile_app_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Mobile_App_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_mobile_app_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-mobile-app'),
		'transport' => 'refresh',
		'section'	=> 'vw_mobile_app_responsive_media',
		'setting'	=> 'vw_mobile_app_res_close_menus_icon',
		'type'		=> 'icon'
	)));
	
	//Footer Text
	$wp_customize->add_section('vw_mobile_app_footer',array(
		'title'	=> __('Footer','vw-mobile-app'),
		'description'=> __('This section will appear in the footer','vw-mobile-app'),
		'panel' => 'vw_mobile_app_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_mobile_app_footer_text', array( 
		'selector' => '#footer-2 .copyright p', 
		'render_callback' => 'vw_mobile_app_customize_partial_vw_mobile_app_footer_text', 
	));
	
	$wp_customize->add_setting('vw_mobile_app_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_mobile_app_footer_text',array(
		'label'	=> __('Copyright Text','vw-mobile-app'),
		'section'=> 'vw_mobile_app_footer',
		'setting'=> 'vw_mobile_app_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_mobile_app_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Mobile_App_Image_Radio_Control($wp_customize, 'vw_mobile_app_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-mobile-app'),
        'section' => 'vw_mobile_app_footer',
        'settings' => 'vw_mobile_app_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_mobile_app_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_mobile_app_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-mobile-app' ),
      	'section' => 'vw_mobile_app_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_mobile_app_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_mobile_app_customize_partial_vw_mobile_app_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_mobile_app_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Mobile_App_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_mobile_app_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-mobile-app'),
		'transport' => 'refresh',
		'section'	=> 'vw_mobile_app_footer',
		'setting'	=> 'vw_mobile_app_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_mobile_app_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_mobile_app_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_mobile_app_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_mobile_app_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Mobile_App_Image_Radio_Control($wp_customize, 'vw_mobile_app_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-mobile-app'),
        'section' => 'vw_mobile_app_footer',
        'settings' => 'vw_mobile_app_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/layout3.png'
    ))));

    //Woocommerce settings
	$wp_customize->add_section('vw_mobile_app_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-mobile-app'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	//Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_mobile_app_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','vw-mobile-app' ),
		'section' => 'vw_mobile_app_woocommerce_section'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_mobile_app_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_mobile_app_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Mobile_App_Toggle_Switch_Custom_Control( $wp_customize, 'vw_mobile_app_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','vw-mobile-app' ),
		'section' => 'vw_mobile_app_woocommerce_section'
    )));

    //Products per page
    $wp_customize->add_setting('vw_mobile_app_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'vw_mobile_app_sanitize_float'
	));
	$wp_customize->add_control('vw_mobile_app_products_per_page',array(
		'label'	=> __('Products Per Page','vw-mobile-app'),
		'description' => __('Display on shop page','vw-mobile-app'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'vw_mobile_app_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('vw_mobile_app_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_mobile_app_sanitize_choices'
	));
	$wp_customize->add_control('vw_mobile_app_products_per_row',array(
		'label'	=> __('Products Per Row','vw-mobile-app'),
		'description' => __('Display on shop page','vw-mobile-app'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'vw_mobile_app_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('vw_mobile_app_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_mobile_app_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_mobile_app_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','vw-mobile-app'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-mobile-app'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-mobile-app' ),
        ),
		'section'=> 'vw_mobile_app_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'vw_mobile_app_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_mobile_app_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'vw_mobile_app_products_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_mobile_app_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_mobile_app_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','vw-mobile-app' ),
		'section'     => 'vw_mobile_app_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    // new Panel
	$wp_customize->register_panel_type( 'VW_Mobile_App_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Mobile_App_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_mobile_app_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Mobile_App_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_mobile_app_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
	    }
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Mobile_App_WP_Customize_Section extends WP_Customize_Section {  	
	    public $section;
	    public $type = 'vw_mobile_app_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
	    }
  	}
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Mobile_App_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Mobile_App_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_Mobile_App_Customize_Section_Pro($manager,'vw_mobile_app_upgrade_pro_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Mobile App Pro', 'vw-mobile-app' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-mobile-app' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/wordpress-mobile-app-theme/'),
		)));

		$manager->add_section(new VW_Mobile_App_Customize_Section_Pro($manager,'vw_mobile_app_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-mobile-app' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-mobile-app' ),
			'pro_url'  => admin_url('themes.php?page=vw_mobile_app_guide'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-mobile-app-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-mobile-app-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Mobile_App_Customize::get_instance();