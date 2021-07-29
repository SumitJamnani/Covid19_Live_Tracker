<?php

namespace Braintum\Corona\Admin;

class Menu
{
    function __construct(){
        add_action( 'admin_menu', array( $this, 'menu_page' ) );
    }

    public function menu_page(){
		global $submenu;
		
		$current_user = wp_get_current_user();

        $menu_slug = 'btcorona';
        add_menu_page( esc_html__('Covid19 Options', 'btcorona'), esc_html__('Covid19 Options', 'btcorona'), 'manage_options', $menu_slug, array($this, 'option_page'), 'dashicons-chart-bar', 6 );

        add_submenu_page($menu_slug, esc_html__('Shortcodes', 'btcorona'), esc_html__('Shortcodes', 'btcorona'), 'manage_options', $menu_slug, array($this, 'option_page') );

        add_submenu_page($menu_slug, esc_html__('Settings', 'btcorona'), esc_html__('Settings', 'btcorona'), 'manage_options', 'btcorona-settings', array($this, 'settings_page'));
		
		$link_text = '<span class="qc-up-pro-link" style="font-weight: bold;color:yellow">'.esc_html('Upgrade to Pro').'</span>';
		if($current_user->roles[0]!='subscriber')
			$submenu["$menu_slug"][300] = array( $link_text, 'activate_plugins' , BT_CORONA_PRO_LINK );
		
		return $submenu;

    }


    /**
     * Menu page Callback
     * @return html
     */
    function option_page(){
        global $true_page;
        require_once('templates/shortcodes.php');
    }

    function settings_page(){
        global $true_page;
        require_once('templates/settings.php');
    }
    
}
