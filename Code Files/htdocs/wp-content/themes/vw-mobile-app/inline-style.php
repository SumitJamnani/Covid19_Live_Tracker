<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_mobile_app_first_color = get_theme_mod('vw_mobile_app_first_color');

	$vw_mobile_app_custom_css = '';

	if($vw_mobile_app_first_color != false){
		$vw_mobile_app_custom_css .='.error-btn a:hover, a.content-bttn:hover, .pagination .current, .pagination a:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce span.onsale, #sidebar a.custom_read_more:hover, #footer a.custom_read_more:hover, .nav-previous a:hover, .nav-next a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, #preloader{';
			$vw_mobile_app_custom_css .='background-color: '.esc_attr($vw_mobile_app_first_color).';';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_first_color != false){
		$vw_mobile_app_custom_css .=' .nav-previous a:hover, .nav-next a:hover{';
			$vw_mobile_app_custom_css .='background-color: '.esc_attr($vw_mobile_app_first_color).'!important;';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_first_color != false){
		$vw_mobile_app_custom_css .='a, #footer h3, .post-main-box:hover h3 a, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .entry-content a, .post-main-box:hover h2 a, .post-main-box:hover .entry-date a, .post-main-box:hover .entry-author a, .single-post .post-info:hover .entry-date a, .single-post .post-info:hover .entry-author a, #footer li a:hover, #sidebar li a:hover{';
			$vw_mobile_app_custom_css .='color: '.esc_attr($vw_mobile_app_first_color).';';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_first_color != false){
		$vw_mobile_app_custom_css .='{';
			$vw_mobile_app_custom_css .='border-color: '.esc_attr($vw_mobile_app_first_color).';';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_first_color != false){
		$vw_mobile_app_custom_css .='#about-us hr, .post-info hr{';
			$vw_mobile_app_custom_css .='border-top-color: '.esc_attr($vw_mobile_app_first_color).';';
		$vw_mobile_app_custom_css .='}';
	}

	/*---------------------------Second highlight color-------------------*/

	$vw_mobile_app_second_color = get_theme_mod('vw_mobile_app_second_color');

	if($vw_mobile_app_second_color != false){
		$vw_mobile_app_custom_css .='.pagination span, .pagination a, #comments a.comment-reply-link, .toggle-nav i, .nav-previous a:hover, .nav-next a:hover, .nav-previous a, .nav-next a, .woocommerce nav.woocommerce-pagination ul li a{';
			$vw_mobile_app_custom_css .='background-color: '.esc_attr($vw_mobile_app_second_color).';';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_second_color != false){
		$vw_mobile_app_custom_css .='.main-navigation ul.sub-menu a:hover, .page-template-custom-home-page .main-navigation a:hover, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, #footer .custom-social-icons i, #sidebar .custom-social-icons i, .page-template-custom-home-page .logo .site-title a:hover{';
			$vw_mobile_app_custom_css .='color: '.esc_attr($vw_mobile_app_second_color).';';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_second_color != false){
		$vw_mobile_app_custom_css .='#footer .custom-social-icons i, #sidebar .custom-social-icons i, #footer .custom-social-icons i:hover, #sidebar .custom-social-icons i:hover{';
			$vw_mobile_app_custom_css .='border-color: '.esc_attr($vw_mobile_app_second_color).';';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_second_color != false){
		$vw_mobile_app_custom_css .='.main-navigation ul ul{';
			$vw_mobile_app_custom_css .='border-top-color: '.esc_attr($vw_mobile_app_second_color).';';
		$vw_mobile_app_custom_css .='}';
	}
	if($vw_mobile_app_second_color != false){
		$vw_mobile_app_custom_css .='.main-navigation ul ul{';
			$vw_mobile_app_custom_css .='border-bottom-color: '.esc_attr($vw_mobile_app_second_color).';';
		$vw_mobile_app_custom_css .='}';
	}

	if($vw_mobile_app_second_color != false || $vw_mobile_app_first_color != false){
		$vw_mobile_app_custom_css .='.scrollup i, #footer .tagcloud a:hover, input[type="submit"], #footer-2, #sidebar input[type="submit"], #sidebar .tagcloud a:hover, .error-btn a, a.content-bttn, #header, #comments input[type="submit"].submit, nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, #footer a.custom_read_more, #sidebar a.custom_read_more, #header .header-fixed , .page-template-custom-home-page #header .header-fixed, #footer .custom-social-icons i:hover, #sidebar .custom-social-icons i:hover{
		background: linear-gradient(to right, '.esc_attr($vw_mobile_app_second_color).', '.esc_attr($vw_mobile_app_first_color).');
	 	}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_mobile_app_theme_lay = get_theme_mod( 'vw_mobile_app_width_option','Full Width');
    if($vw_mobile_app_theme_lay == 'Boxed'){
		$vw_mobile_app_custom_css .='body{';
			$vw_mobile_app_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.scrollup i{';
		  $vw_mobile_app_custom_css .='right: 100px;';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.scrollup.left i{';
		  $vw_mobile_app_custom_css .='left: 100px;';
		$vw_mobile_app_custom_css .='}';
	}else if($vw_mobile_app_theme_lay == 'Wide Width'){
		$vw_mobile_app_custom_css .='body{';
			$vw_mobile_app_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.scrollup i{';
		  $vw_mobile_app_custom_css .='right: 30px;';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.scrollup.left i{';
		  $vw_mobile_app_custom_css .='left: 30px;';
		$vw_mobile_app_custom_css .='}';
	}else if($vw_mobile_app_theme_lay == 'Full Width'){
		$vw_mobile_app_custom_css .='body{';
			$vw_mobile_app_custom_css .='max-width: 100%;';
		$vw_mobile_app_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_mobile_app_theme_lay = get_theme_mod( 'vw_mobile_app_slider_opacity_color','0.5');
	if($vw_mobile_app_theme_lay == '0'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.1'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.1';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.2'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.2';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.3'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.3';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.4'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.4';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.5'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.5';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.6'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.6';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.7'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.7';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.8'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.8';
		$vw_mobile_app_custom_css .='}';
		}else if($vw_mobile_app_theme_lay == '0.9'){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='opacity:0.9';
		$vw_mobile_app_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_mobile_app_theme_lay = get_theme_mod( 'vw_mobile_app_slider_content_option','Left');
    if($vw_mobile_app_theme_lay == 'Left'){
		$vw_mobile_app_custom_css .='.box-content, .box-content h1{';
			$vw_mobile_app_custom_css .='text-align:left; left:10%; right:55%;';
		$vw_mobile_app_custom_css .='}';
	}else if($vw_mobile_app_theme_lay == 'Center'){
		$vw_mobile_app_custom_css .='.box-content, .box-content h1{';
			$vw_mobile_app_custom_css .='text-align:center; left:30%; right:30%;';
		$vw_mobile_app_custom_css .='}';
	}else if($vw_mobile_app_theme_lay == 'Right'){
		$vw_mobile_app_custom_css .='.box-content, .box-content h1{';
			$vw_mobile_app_custom_css .='text-align:right; left:55%; right:10%;';
		$vw_mobile_app_custom_css .='}';
	}

	/*---------------------------Banner Height ------------*/

	$vw_mobile_app_banner_height = get_theme_mod('vw_mobile_app_banner_height');
	if($vw_mobile_app_banner_height != false){
		$vw_mobile_app_custom_css .='#banner img{';
			$vw_mobile_app_custom_css .='height: '.esc_attr($vw_mobile_app_banner_height).';';
		$vw_mobile_app_custom_css .='}';
	}

	/*--------------------------- Slider -------------------*/

	$vw_mobile_app_slider = get_theme_mod('vw_mobile_app_banner_settings');
	if($vw_mobile_app_slider == false){
		$vw_mobile_app_custom_css .='.page-template-custom-home-page #header{';
			$vw_mobile_app_custom_css .='position: static; background-image: linear-gradient(to right, #f94a5b , #fd6c4f);';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.page-template-custom-home-page .main-navigation a:hover{';
			$vw_mobile_app_custom_css .='color: #fff;';
		$vw_mobile_app_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_mobile_app_theme_lay = get_theme_mod( 'vw_mobile_app_blog_layout_option','Default');
    if($vw_mobile_app_theme_lay == 'Default'){
		$vw_mobile_app_custom_css .='.post-main-box{';
			$vw_mobile_app_custom_css .='';
		$vw_mobile_app_custom_css .='}';
	}else if($vw_mobile_app_theme_lay == 'Center'){
		$vw_mobile_app_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_mobile_app_custom_css .='text-align:center;';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.post-info{';
			$vw_mobile_app_custom_css .='margin-top:10px;';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.post-info hr{';
			$vw_mobile_app_custom_css .='margin:15px auto;';
		$vw_mobile_app_custom_css .='}';
	}else if($vw_mobile_app_theme_lay == 'Left'){
		$vw_mobile_app_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_mobile_app_custom_css .='text-align:Left;';
		$vw_mobile_app_custom_css .='}';
		$vw_mobile_app_custom_css .='.post-info{';
			$vw_mobile_app_custom_css .='margin-top:20px;';
		$vw_mobile_app_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$vw_mobile_app_resp_stickyheader = get_theme_mod( 'vw_mobile_app_stickyheader_hide_show',false);
	if($vw_mobile_app_resp_stickyheader == true && get_theme_mod( 'vw_mobile_app_sticky_header',false) != true){
    	$vw_mobile_app_custom_css .='.page-template-custom-home-page #header .header-fixed, #header .header-fixed{';
			$vw_mobile_app_custom_css .='position:static;';
		$vw_mobile_app_custom_css .='} ';
	}
    if($vw_mobile_app_resp_stickyheader == true){
    	$vw_mobile_app_custom_css .='@media screen and (max-width:575px) {';
		$vw_mobile_app_custom_css .='.page-template-custom-home-page #header .header-fixed, #header .header-fixed{';
			$vw_mobile_app_custom_css .='position:fixed;';
		$vw_mobile_app_custom_css .='} }';
	}else if($vw_mobile_app_resp_stickyheader == false){
		$vw_mobile_app_custom_css .='@media screen and (max-width:575px){';
		$vw_mobile_app_custom_css .='.page-template-custom-home-page #header .header-fixed, #header .header-fixed{';
			$vw_mobile_app_custom_css .='position:static;';
		$vw_mobile_app_custom_css .='} }';
	}

	$vw_mobile_app_sidebar = get_theme_mod( 'vw_mobile_app_sidebar_hide_show',true);
    if($vw_mobile_app_sidebar == true){
    	$vw_mobile_app_custom_css .='@media screen and (max-width:575px) {';
		$vw_mobile_app_custom_css .='#sidebar{';
			$vw_mobile_app_custom_css .='display:block;';
		$vw_mobile_app_custom_css .='} }';
	}else if($vw_mobile_app_sidebar == false){
		$vw_mobile_app_custom_css .='@media screen and (max-width:575px) {';
		$vw_mobile_app_custom_css .='#sidebar{';
			$vw_mobile_app_custom_css .='display:none;';
		$vw_mobile_app_custom_css .='} }';
	}

	$vw_mobile_app_resp_scroll_top = get_theme_mod( 'vw_mobile_app_resp_scroll_top_hide_show',true);
	if($vw_mobile_app_resp_scroll_top == true && get_theme_mod( 'vw_mobile_app_hide_show_scroll',true) != true){
    	$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='visibility:hidden !important;';
		$vw_mobile_app_custom_css .='} ';
	}
    if($vw_mobile_app_resp_scroll_top == true){
    	$vw_mobile_app_custom_css .='@media screen and (max-width:575px) {';
		$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='visibility:visible !important;';
		$vw_mobile_app_custom_css .='} }';
	}else if($vw_mobile_app_resp_scroll_top == false){
		$vw_mobile_app_custom_css .='@media screen and (max-width:575px){';
		$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='visibility:hidden !important;';
		$vw_mobile_app_custom_css .='} }';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_mobile_app_sticky_header_padding = get_theme_mod('vw_mobile_app_sticky_header_padding');
	if($vw_mobile_app_sticky_header_padding != false){
		$vw_mobile_app_custom_css .='.page-template-custom-home-page #header .header-fixed, #header .header-fixed{';
			$vw_mobile_app_custom_css .='padding: '.esc_attr($vw_mobile_app_sticky_header_padding).';';
		$vw_mobile_app_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_mobile_app_button_padding_top_bottom = get_theme_mod('vw_mobile_app_button_padding_top_bottom');
	$vw_mobile_app_button_padding_left_right = get_theme_mod('vw_mobile_app_button_padding_left_right');
	if($vw_mobile_app_button_padding_top_bottom != false || $vw_mobile_app_button_padding_left_right != false){
		$vw_mobile_app_custom_css .='a.content-bttn{';
			$vw_mobile_app_custom_css .='padding-top: '.esc_attr($vw_mobile_app_button_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_mobile_app_button_padding_top_bottom).';padding-left: '.esc_attr($vw_mobile_app_button_padding_left_right).';padding-right: '.esc_attr($vw_mobile_app_button_padding_left_right).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_button_border_radius = get_theme_mod('vw_mobile_app_button_border_radius');
	if($vw_mobile_app_button_border_radius != false){
		$vw_mobile_app_custom_css .='a.content-bttn{';
			$vw_mobile_app_custom_css .='border-radius: '.esc_attr($vw_mobile_app_button_border_radius).'px;';
		$vw_mobile_app_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$vw_mobile_app_single_blog_post_navigation_show_hide = get_theme_mod('vw_mobile_app_single_blog_post_navigation_show_hide',true);
	if($vw_mobile_app_single_blog_post_navigation_show_hide != true){
		$vw_mobile_app_custom_css .='.post-navigation{';
			$vw_mobile_app_custom_css .='display: none;';
		$vw_mobile_app_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_mobile_app_copyright_alingment = get_theme_mod('vw_mobile_app_copyright_alingment');
	if($vw_mobile_app_copyright_alingment != false){
		$vw_mobile_app_custom_css .='.copyright p{';
			$vw_mobile_app_custom_css .='text-align: '.esc_attr($vw_mobile_app_copyright_alingment).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_copyright_padding_top_bottom = get_theme_mod('vw_mobile_app_copyright_padding_top_bottom');
	if($vw_mobile_app_copyright_padding_top_bottom != false){
		$vw_mobile_app_custom_css .='#footer-2{';
			$vw_mobile_app_custom_css .='padding-top: '.esc_attr($vw_mobile_app_copyright_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_mobile_app_copyright_padding_top_bottom).';';
		$vw_mobile_app_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_mobile_app_scroll_to_top_font_size = get_theme_mod('vw_mobile_app_scroll_to_top_font_size');
	if($vw_mobile_app_scroll_to_top_font_size != false){
		$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='font-size: '.esc_attr($vw_mobile_app_scroll_to_top_font_size).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_scroll_to_top_padding = get_theme_mod('vw_mobile_app_scroll_to_top_padding');
	$vw_mobile_app_scroll_to_top_padding = get_theme_mod('vw_mobile_app_scroll_to_top_padding');
	if($vw_mobile_app_scroll_to_top_padding != false){
		$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='padding-top: '.esc_attr($vw_mobile_app_scroll_to_top_padding).';padding-bottom: '.esc_attr($vw_mobile_app_scroll_to_top_padding).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_scroll_to_top_width = get_theme_mod('vw_mobile_app_scroll_to_top_width');
	if($vw_mobile_app_scroll_to_top_width != false){
		$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='width: '.esc_attr($vw_mobile_app_scroll_to_top_width).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_scroll_to_top_height = get_theme_mod('vw_mobile_app_scroll_to_top_height');
	if($vw_mobile_app_scroll_to_top_height != false){
		$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='height: '.esc_attr($vw_mobile_app_scroll_to_top_height).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_scroll_to_top_border_radius = get_theme_mod('vw_mobile_app_scroll_to_top_border_radius');
	if($vw_mobile_app_scroll_to_top_border_radius != false){
		$vw_mobile_app_custom_css .='.scrollup i{';
			$vw_mobile_app_custom_css .='border-radius: '.esc_attr($vw_mobile_app_scroll_to_top_border_radius).'px;';
		$vw_mobile_app_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_mobile_app_social_icon_font_size = get_theme_mod('vw_mobile_app_social_icon_font_size');
	if($vw_mobile_app_social_icon_font_size != false){
		$vw_mobile_app_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_mobile_app_custom_css .='font-size: '.esc_attr($vw_mobile_app_social_icon_font_size).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_social_icon_padding = get_theme_mod('vw_mobile_app_social_icon_padding');
	if($vw_mobile_app_social_icon_padding != false){
		$vw_mobile_app_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_mobile_app_custom_css .='padding: '.esc_attr($vw_mobile_app_social_icon_padding).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_social_icon_width = get_theme_mod('vw_mobile_app_social_icon_width');
	if($vw_mobile_app_social_icon_width != false){
		$vw_mobile_app_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_mobile_app_custom_css .='width: '.esc_attr($vw_mobile_app_social_icon_width).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_social_icon_height = get_theme_mod('vw_mobile_app_social_icon_height');
	if($vw_mobile_app_social_icon_height != false){
		$vw_mobile_app_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_mobile_app_custom_css .='height: '.esc_attr($vw_mobile_app_social_icon_height).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_social_icon_border_radius = get_theme_mod('vw_mobile_app_social_icon_border_radius');
	if($vw_mobile_app_social_icon_border_radius != false){
		$vw_mobile_app_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_mobile_app_custom_css .='border-radius: '.esc_attr($vw_mobile_app_social_icon_border_radius).'px;';
		$vw_mobile_app_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_mobile_app_products_padding_top_bottom = get_theme_mod('vw_mobile_app_products_padding_top_bottom');
	if($vw_mobile_app_products_padding_top_bottom != false){
		$vw_mobile_app_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_mobile_app_custom_css .='padding-top: '.esc_attr($vw_mobile_app_products_padding_top_bottom).'!important; padding-bottom: '.esc_attr($vw_mobile_app_products_padding_top_bottom).'!important;';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_products_padding_left_right = get_theme_mod('vw_mobile_app_products_padding_left_right');
	if($vw_mobile_app_products_padding_left_right != false){
		$vw_mobile_app_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_mobile_app_custom_css .='padding-left: '.esc_attr($vw_mobile_app_products_padding_left_right).'!important; padding-right: '.esc_attr($vw_mobile_app_products_padding_left_right).'!important;';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_products_box_shadow = get_theme_mod('vw_mobile_app_products_box_shadow');
	if($vw_mobile_app_products_box_shadow != false){
		$vw_mobile_app_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_mobile_app_custom_css .='box-shadow: '.esc_attr($vw_mobile_app_products_box_shadow).'px '.esc_attr($vw_mobile_app_products_box_shadow).'px '.esc_attr($vw_mobile_app_products_box_shadow).'px #ddd;';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_products_border_radius = get_theme_mod('vw_mobile_app_products_border_radius');
	if($vw_mobile_app_products_border_radius != false){
		$vw_mobile_app_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_mobile_app_custom_css .='border-radius: '.esc_attr($vw_mobile_app_products_border_radius).'px;';
		$vw_mobile_app_custom_css .='}';
	}

	/*------------------ Preloader Background Color  -------------------*/

	$vw_mobile_app_preloader_bg_color = get_theme_mod('vw_mobile_app_preloader_bg_color');
	if($vw_mobile_app_preloader_bg_color != false){
		$vw_mobile_app_custom_css .='#preloader{';
			$vw_mobile_app_custom_css .='background-color: '.esc_attr($vw_mobile_app_preloader_bg_color).';';
		$vw_mobile_app_custom_css .='}';
	}

	$vw_mobile_app_preloader_border_color = get_theme_mod('vw_mobile_app_preloader_border_color');
	if($vw_mobile_app_preloader_border_color != false){
		$vw_mobile_app_custom_css .='.loader-line{';
			$vw_mobile_app_custom_css .='border-color: '.esc_attr($vw_mobile_app_preloader_border_color).'!important;';
		$vw_mobile_app_custom_css .='}';
	}