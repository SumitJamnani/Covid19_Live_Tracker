<?php
/**
 * VW Mobile App: Block Patterns
 *
 * @package VW Mobile App
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'vw-mobile-app',
		array( 'label' => __( 'VW Mobile App', 'vw-mobile-app' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'vw-mobile-app/banner-section',
		array(
			'title'      => __( 'Banner Section', 'vw-mobile-app' ),
			'categories' => array( 'vw-mobile-app' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png\",\"id\":8954,\"dimRatio\":0,\"minHeight\":700,\"align\":\"full\",\"className\":\"banner-section\"} -->\n<div class=\"wp-block-cover alignfull banner-section\" style=\"background-image:url(" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png);min-height:700px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"wide\",\"className\":\"mx-5 px-lg-5\"} -->\n<div class=\"wp-block-columns alignwide mx-5 px-lg-5\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"45%\",\"className\":\"ps-lg-4\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center ps-lg-4\" style=\"flex-basis:45%\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":4,\"className\":\"m-0\",\"style\":{\"typography\":{\"fontSize\":30}}} -->\n<h4 class=\"has-text-align-left m-0\" style=\"font-size:30px\">LOREM IPSUM IS</h4>\n<!-- /wp:heading -->\n\n<!-- wp:heading {\"textAlign\":\"left\",\"level\":1,\"className\":\"pt-0\",\"style\":{\"typography\":{\"fontSize\":40}}} -->\n<h1 class=\"has-text-align-left pt-0\" style=\"font-size:40px\">SIMPLY DUMMY</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"left\",\"className\":\"mb-2 text-left\",\"style\":{\"typography\":{\"fontSize\":14}}} -->\n<p class=\"has-text-align-left mb-2 text-left\" style=\"font-size:14px\">Lorem Ipsum has been the industrys standard.&nbsp;Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:search {\"label\":\"Search\",\"showLabel\":false,\"placeholder\":\"Search\",\"buttonText\":\"Search\",\"buttonPosition\":\"button-inside\",\"buttonUseIcon\":true,\"align\":\"left\",\"className\":\"m-0\"} /--></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'vw-mobile-app/about-section',
		array(
			'title'      => __( 'About Section', 'vw-mobile-app' ),
			'categories' => array( 'vw-mobile-app' ),
			'content'    => "<!-- wp:cover {\"overlayColor\":\"white\",\"align\":\"wide\",\"className\":\"about-section m-0\"} -->\n<div class=\"wp-block-cover alignwide has-white-background-color has-background-dim about-section m-0\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"wide\",\"className\":\"m-0\"} -->\n<div class=\"wp-block-columns alignwide m-0\"><!-- wp:column {\"width\":\"25%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:25%\"></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"50%\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:50%\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"text\":\"#2d313d\"},\"typography\":{\"fontSize\":35}}} -->\n<h2 class=\"has-text-align-center has-text-color\" style=\"color:#2d313d;font-size:35px\">ABOUT US</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"color\":{\"text\":\"#7f858d\"},\"typography\":{\"fontSize\":14}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" style=\"color:#7f858d;font-size:14px\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"25%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:25%\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:columns {\"align\":\"wide\",\"className\":\"content-boxes m-0 px-lg-4\"} -->\n<div class=\"wp-block-columns alignwide content-boxes m-0 px-lg-4\"><!-- wp:column {\"className\":\"about-box p-2\"} -->\n<div class=\"wp-block-column about-box p-2\"><!-- wp:image {\"align\":\"center\",\"id\":8902,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/about-1.png\" alt=\"\" class=\"wp-image-8902\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"color\":{\"text\":\"#2d313d\"},\"typography\":{\"fontSize\":22}}} -->\n<h3 class=\"has-text-align-center has-text-color\" style=\"color:#2d313d;font-size:22px\">ABOUT US TITLE 1</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#7f858d\"}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" style=\"color:#7f858d;font-size:14px\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"about-box p-2\"} -->\n<div class=\"wp-block-column about-box p-2\"><!-- wp:image {\"align\":\"center\",\"id\":8925,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/about-2.png\" alt=\"\" class=\"wp-image-8925\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"color\":{\"text\":\"#2d313d\"},\"typography\":{\"fontSize\":22}}} -->\n<h3 class=\"has-text-align-center has-text-color\" style=\"color:#2d313d;font-size:22px\">ABOUT US TITLE 2</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#7f858d\"}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" style=\"color:#7f858d;font-size:14px\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"about-box p-2\"} -->\n<div class=\"wp-block-column about-box p-2\"><!-- wp:image {\"align\":\"center\",\"id\":8926,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/about-3.png\" alt=\"\" class=\"wp-image-8926\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"color\":{\"text\":\"#2d313d\"},\"typography\":{\"fontSize\":22}}} -->\n<h3 class=\"has-text-align-center has-text-color\" style=\"color:#2d313d;font-size:22px\">ABOUT US TITLE 3</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#7f858d\"}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" style=\"color:#7f858d;font-size:14px\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);
}