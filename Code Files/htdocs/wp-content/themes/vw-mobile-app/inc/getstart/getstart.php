<?php
//about theme info
add_action( 'admin_menu', 'vw_mobile_app_gettingstarted' );
function vw_mobile_app_gettingstarted() {    	
	add_theme_page( esc_html__('About VW Mobile App', 'vw-mobile-app'), esc_html__('About VW Mobile App', 'vw-mobile-app'), 'edit_theme_options', 'vw_mobile_app_guide', 'vw_mobile_app_mostrar_guide');   
}

function vw_mobile_app_admin_theme_style() {
   wp_enqueue_style('vw-mobile-app-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstart/getstart.css');
   wp_enqueue_script('vw-mobile-app-tabs', esc_url(get_template_directory_uri()) . '/inc/getstart/js/tab.js');
   wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'vw_mobile_app_admin_theme_style');

//guidline for about theme
function vw_mobile_app_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'vw-mobile-app' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to VW Mobile App Theme', 'vw-mobile-app' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','vw-mobile-app'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy VW Mobile App at 20% Discount','vw-mobile-app'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','vw-mobile-app'); ?> ( <span><?php esc_html_e('vwpro20','vw-mobile-app'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( VW_MOBILE_APP_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'vw-mobile-app' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
		<div class="tab">
			<button class="tablinks" onclick="vw_mobile_app_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'vw-mobile-app' ); ?></button>
			<button class="tablinks" onclick="vw_mobile_app_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'vw-mobile-app' ); ?></button>
			<button class="tablinks" onclick="vw_mobile_app_open_tab(event, 'gutenberg_editor')"><?php esc_html_e( 'Setup With Gutunberg Block', 'vw-mobile-app' ); ?></button>  
			<button class="tablinks" onclick="vw_mobile_app_open_tab(event, 'product_addons_editor')"><?php esc_html_e( 'Woocommerce Product Addons', 'vw-mobile-app' ); ?></button>
		  	<button class="tablinks" onclick="vw_mobile_app_open_tab(event, 'pro_theme')"><?php esc_html_e( 'Get Premium', 'vw-mobile-app' ); ?></button>
		  	<button class="tablinks" onclick="vw_mobile_app_open_tab(event, 'free_pro')"><?php esc_html_e( 'Support', 'vw-mobile-app' ); ?></button>
		</div>

		<!-- Tab content -->
		<?php
			$vw_mobile_app_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$vw_mobile_app_plugin_custom_css ='display: block';
			}
		?>
		<div id="lite_theme" class="tabcontent open">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = vw_mobile_app_Plugin_Activation_Settings::get_instance();
				$vw_mobile_app_actions = $plugin_ins->recommended_actions;
				?>
				<div class="vw-mobile-app-recommended-plugins">
				    <div class="vw-mobile-app-action-list">
				        <?php if ($vw_mobile_app_actions): foreach ($vw_mobile_app_actions as $key => $vw_mobile_app_actionValue): ?>
				                <div class="vw-mobile-app-action" id="<?php echo esc_attr($vw_mobile_app_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($vw_mobile_app_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_mobile_app_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_mobile_app_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" get-start-tab-id="lite-theme-tab" href="javascript:void(0);"><?php esc_html_e('Skip','vw-mobile-app'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="lite-theme-tab" style="<?php echo esc_attr($vw_mobile_app_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Lite Theme Information', 'vw-mobile-app' ); ?></h3>
				<hr class="h3hr">
			  	<p><?php esc_html_e('VW Mobile App is a powerful, versatile, robust and clean WordPress theme for promoting mobile apps, app pages, creating landing pages, exhibiting products, introducing and showcasing app details, selling mobiles, tablets and gadgets online, displaying tech-savvy products and applications and similar businesses and websites. It is an easily manageable theme with unique design and amazing features to create a performance focused website. The theme offers so many layout options for pages and blogs with eye-catching styles for header, footer and gallery that you will never be out of ideas to design an outstanding website. Its easy to understand backend interface and customization options make it extremely handy for a person with no coding knowledge. VW Mobile App has a responsive layout that helps loading harmoniously on all devices, screen sizes and browsers. It can be translated into various different languages. It is optimized for search engines and loads really fast. With banners , you can showcase the qualities of your mobile app in an impressive manner. The call to action button can bring you a real deal as it can take customers to proper place. Social media icons are important to make the app popular.','vw-mobile-app'); ?></p>
			  	<div class="col-left-inner">
			  		<h4><?php esc_html_e( 'Theme Documentation', 'vw-mobile-app' ); ?></h4>
					<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'vw-mobile-app' ); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_MOBILE_APP_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'vw-mobile-app' ); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Theme Customizer', 'vw-mobile-app'); ?></h4>
					<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'vw-mobile-app'); ?></p>
					<div class="info-link">
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'vw-mobile-app'); ?></a>
					</div>
					<hr>				
					<h4><?php esc_html_e('Having Trouble, Need Support?', 'vw-mobile-app'); ?></h4>
					<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'vw-mobile-app'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_MOBILE_APP_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'vw-mobile-app'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Reviews & Testimonials', 'vw-mobile-app'); ?></h4>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'vw-mobile-app'); ?>  </p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_MOBILE_APP_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'vw-mobile-app'); ?></a>
					</div>
			  		<div class="link-customizer">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-mobile-app' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-mobile-app'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_banner_section') ); ?>" target="_blank"><?php esc_html_e('Banner Settings','vw-mobile-app'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-editor-table"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_category_section') ); ?>" target="_blank"><?php esc_html_e('About Us Section','vw-mobile-app'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-mobile-app'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-mobile-app'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-mobile-app'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-mobile-app'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-mobile-app'); ?></a>
								</div>
							</div>
						</div>
					</div>
			  	</div>
				<div class="col-right-inner">
					<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','vw-mobile-app'); ?></h3>
				  	<hr class="h3hr">
					<p><?php esc_html_e('Follow these instructions to setup Home page.','vw-mobile-app'); ?></p>
	                <ul>
	                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','vw-mobile-app'); ?></span><?php esc_html_e(' Go to ','vw-mobile-app'); ?>
					  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','vw-mobile-app'); ?></b></p>

	                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','vw-mobile-app'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
	                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','vw-mobile-app'); ?></span><?php esc_html_e(' Go to ','vw-mobile-app'); ?>
					  	<b><?php esc_html_e(' Settings >> Reading ','vw-mobile-app'); ?></b></p>
					  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','vw-mobile-app'); ?></p>
	                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
	                  	<p><?php esc_html_e(' Once you are done with this, then follow the','vw-mobile-app'); ?> <a class="doc-links" href="https://www.vwthemesdemo.com/docs/free-vw-mobile-app/" target="_blank"><?php esc_html_e('Documentation','vw-mobile-app'); ?></a></p>
	                </ul>
			  	</div>
			</div>
		</div>	

		<div id="block_pattern" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = VW_Mobile_App_Plugin_Activation_Settings::get_instance();
				$vw_mobile_app_actions = $plugin_ins->recommended_actions;
				?>
				<div class="vw-mobile-app-recommended-plugins">
				    <div class="vw-mobile-app-action-list">
				        <?php if ($vw_mobile_app_actions): foreach ($vw_mobile_app_actions as $key => $vw_mobile_app_actionValue): ?>
				                <div class="vw-mobile-app-action" id="<?php echo esc_attr($vw_mobile_app_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($vw_mobile_app_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_mobile_app_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_mobile_app_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" href="javascript:void(0);" get-start-tab-id="gutenberg-editor-tab"><?php esc_html_e('Skip','vw-mobile-app'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="gutenberg-editor-tab" style="<?php echo esc_attr($vw_mobile_app_plugin_custom_css); ?>">
				<div class="block-pattern-img">
				  	<h3><?php esc_html_e( 'Block Patterns', 'vw-mobile-app' ); ?></h3>
					<hr class="h3hr">
					<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','vw-mobile-app'); ?></p>
	              	<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon >> Click Pattern Tab >> Click on homepage sections >> Publish.','vw-mobile-app'); ?></span></b></p>
	              	<div class="vw-mobile-app-pattern-page">
				    	<a href="javascript:void(0)" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','vw-mobile-app'); ?></a>
				    </div>
	              	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/block-pattern.png" alt="" />
	            </div>

	            <div class="block-pattern-link-customizer">
	              	<div class="link-customizer-with-block-pattern">
							<h3><?php esc_html_e( 'Link to customizer', 'vw-mobile-app' ); ?></h3>
							<hr class="h3hr">
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-mobile-app'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','vw-mobile-app'); ?></a>
									</div>
								</div>
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-mobile-app'); ?></a>
									</div>
									
									<div class="row-box2">
										<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-mobile-app'); ?></a>
									</div>
								</div>

								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-mobile-app'); ?></a>
									</div>
									 <div class="row-box2">
										<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-mobile-app'); ?></a>
									</div> 
								</div>
								
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-mobile-app'); ?></a>
									</div>
									 <div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-mobile-app'); ?></a>
									</div> 
								</div>
							</div>
					</div>	
				</div>			
	        </div>
		</div>

		<div id="gutenberg_editor" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = VW_Mobile_App_Plugin_Activation_Settings::get_instance();
			$vw_mobile_app_actions = $plugin_ins->recommended_actions;
			?>
				<div class="vw-mobile-app-recommended-plugins">
				    <div class="vw-mobile-app-action-list">
				        <?php if ($vw_mobile_app_actions): foreach ($vw_mobile_app_actions as $key => $vw_mobile_app_actionValue): ?>
				                <div class="vw-mobile-app-action" id="<?php echo esc_attr($vw_mobile_app_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($vw_mobile_app_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_mobile_app_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_mobile_app_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Gutunberg Blocks', 'vw-mobile-app' ); ?></h3>
				<hr class="h3hr">
				<div class="vw-mobile-app-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Ibtana Settings','vw-mobile-app'); ?></a>
			    </div>

			    <div class="link-customizer-with-guternberg-ibtana">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-mobile-app' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-mobile-app'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','vw-mobile-app'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-mobile-app'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-mobile-app'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-mobile-app'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','vw-mobile-app'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_mobile_app_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-mobile-app'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-mobile-app'); ?></a>
								</div> 
							</div>
						</div>
				</div>
			<?php } ?>
		</div>

		<div id="product_addons_editor" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = VW_Mobile_App_Plugin_Activation_Settings::get_instance();
			$vw_mobile_app_actions = $plugin_ins->recommended_actions;
			?>
				<div class="vw-mobile-app-recommended-plugins">
				    <div class="vw-mobile-app-action-list">
				        <?php if ($vw_mobile_app_actions): foreach ($vw_mobile_app_actions as $key => $vw_mobile_app_actionValue): ?>
				                <div class="vw-mobile-app-action" id="<?php echo esc_attr($vw_mobile_app_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($vw_mobile_app_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_mobile_app_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_mobile_app_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Woocommerce Products Blocks', 'vw-mobile-app' ); ?></h3>
				<hr class="h3hr">
				<div class="vw-mobile-app-pattern-page">
					<p><?php esc_html_e('Follow the below instructions to setup Products Templates.','vw-mobile-app'); ?></p>
					<p><b><?php esc_html_e('1. First you need to activate these plugins','vw-mobile-app'); ?></b></p>
						<p><?php esc_html_e('1. Ibtana - WordPress Website Builder ','vw-mobile-app'); ?></p>
						<p><?php esc_html_e('2. Ibtana - Ecommerce Product Addons.','vw-mobile-app'); ?></p>
						<p><?php esc_html_e('3. Woocommerce','vw-mobile-app'); ?></p>

	              	<div class="vw-mobile-app-pattern-page">
			    			<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates&woo=true&ive_wizard_view=parent' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Woocommerce Templates','vw-mobile-app'); ?></a>
			    		</div>
	              	
			    </div>
			<?php } ?>
		</div>

		<div id="pro_theme" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'vw-mobile-app' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('A highly intuitive, powerful, robust, dynamic and stunning WordPress mobile app theme is here to take the popularity of your mobile app to new heights. It is made for websites to promote mobile apps, app pages, display features, create landing page, showcase tech-savvy products and gadgets, sell mobiles and other gadgets online and other relevant websites and businesses. It has an eye-catching design with pleasing colours and smart typography for enhanced readability. The present design of this WordPress mobile app theme can be changed as it offers so many layout options for blogs, pages, header, footer, sidebars and gallery that you can every time come up with new design by trying various combinations among these. Its friendly interface of front end and smooth navigation gives a pleasant site using experience. It has banners, sliders and call to action buttons that you can use to your own benefit.','vw-mobile-app'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( VW_MOBILE_APP_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'vw-mobile-app'); ?></a>
					<a href="<?php echo esc_url( VW_MOBILE_APP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'vw-mobile-app'); ?></a>
					<a href="<?php echo esc_url( VW_MOBILE_APP_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'vw-mobile-app'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/responsive.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'vw-mobile-app' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'vw-mobile-app'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'vw-mobile-app'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'vw-mobile-app'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'vw-mobile-app'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-mobile-app'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'vw-mobile-app'); ?></td>
								<td class="table-img"><?php esc_html_e('12', 'vw-mobile-app'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'vw-mobile-app'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'vw-mobile-app'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'vw-mobile-app'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'vw-mobile-app'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'vw-mobile-app'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'vw-mobile-app'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'vw-mobile-app'); ?></td>
								<td class="table-img"><i class="fas fa-times"></i></td>
								<td class="table-img"><i class="fas fa-check"></i></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( VW_MOBILE_APP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'vw-mobile-app'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'vw-mobile-app'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'vw-mobile-app'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_MOBILE_APP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'vw-mobile-app'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'vw-mobile-app'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'vw-mobile-app'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_MOBILE_APP_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'vw-mobile-app'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'vw-mobile-app'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'vw-mobile-app'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_MOBILE_APP_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'vw-mobile-app'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'vw-mobile-app'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'vw-mobile-app'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_MOBILE_APP_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','vw-mobile-app'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'vw-mobile-app'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'vw-mobile-app'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_MOBILE_APP_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'vw-mobile-app'); ?></a>
				</div>
		  	</div>

		</div>
	</div>
</div>
<?php } ?>