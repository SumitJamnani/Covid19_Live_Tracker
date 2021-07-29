<?php 

namespace Braintum\Corona;

class Admin{
    
    function __construct(){
        $this->dispatch_actions();
        new Admin\Menu();
    }

    /**
     * Dispatch all actions
     * @return void
     */
    public function dispatch_actions(){
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );
        add_action( 'admin_init', array($this, 'option_settings') );
        add_filter('plugin_action_links_'.BT_CORONA_BASE_PATH, array($this, 'add_plugin_page_settings_link'));
       
    }

    public function admin_enqueue_assets() {
        wp_enqueue_script( 'covid-admin', BT_CORONA_URL . 'assets/js/admin-script.js', array( 'jquery' ), BT_CORONA_VER, true );
        wp_enqueue_style( 'covid-admin', BT_CORONA_URL . 'assets/admin-style.css', array(), BT_CORONA_VER );
    }

    /**
     * Callback for plugin action links
     * @param array $links
     * @return array $links
     */
    function add_plugin_page_settings_link( $links ) {

        $links[] = '<a href="' .
            admin_url( 'admin.php?page=btcorona-settings' ) .
            '">' . esc_html__('Settings') . '</a>';

        $links[] = '<a href="' .
            admin_url( 'admin.php?page=btcorona' ) .
            '">' . esc_html__('Shortcodes') . '</a>';
			
		$links[] = '<a href="' .
            BT_CORONA_PRO_LINK .
            '">' . esc_html__('Upgrade to Pro') . '</a>';
		
        return $links;
    }

    function option_settings() {
        global $true_page;
        register_setting( 'btncov_options', 'btncov_options', array($this, 'true_validate_settings') );
     
        // Add section
        add_settings_section( 'true_section_1', esc_html__( 'Customization', 'btcorona' ), '', $true_page );
	
		$true_field_params = array(
            'type'      => 'text',
            'id'        => 'cov_title',
            'default'	=> esc_html__( 'An interactive web-based dashboard to track COVID-19 in real time.', 'btcorona' ),
            'placeholder'		=> 'An interactive web-based dashboard to track COVID-19 in real time.',
            'desc'      => '**Pro version feature** <a href="'.BT_CORONA_PRO_LINK.'" target="_blank">Upgrade to Pro</a>',
            'label_for' => 'cov_title'
        );
        add_settings_field( 'my_text_field', esc_html__( 'Worldwide Map Title (*Pro Feature*)', 'btcorona' ), array($this, 'true_option_display_settings'), $true_page, 'true_section_1', $true_field_params );
     
        $true_field_params = array(
            'type'      => 'textarea',
            'id'        => 'cov_desc',
            'default'	=> esc_html__( 'To identify new cases, we monitor various twitter feeds, online news services, and direct communication sent through the dashboard.', 'btcorona' ),
            'desc'      => '**Pro version feature** <a href="'.BT_CORONA_PRO_LINK.'" target="_blank">Upgrade to Pro</a>',
            'label_for' => 'cov_desc'
        );
        add_settings_field( 'cov_desc_field', esc_html__( 'Worldwide Map Subtitle (*Pro Feature*)', 'btcorona' ), array($this, 'true_option_display_settings'), $true_page, 'true_section_1', $true_field_params );

        $true_field_params = array(
            'type'      => 'select',
            'id'        => 'cov_theme',
            'desc'      => '',
            'vals'		=> array( 'light_theme' => esc_html__( 'Light', 'btcorona' ), 'dark_theme' => esc_html__( 'Dark', 'btcorona' )),
            'label_for' => 'cov_theme'
        );
        add_settings_field( 'cov_theme_field', esc_html__( 'Theme', 'btcorona' ), array($this, 'true_option_display_settings'), $true_page, 'true_section_1', $true_field_params );
        
     
        $true_field_params = array(
            'type'      => 'textarea',
            'id'        => 'cov_css',
            'default'	=> null,
            'desc'      => esc_html__( 'Without &lt;style&gt; tags', 'btcorona' ),
            'label_for' => 'cov_css'
        );
        add_settings_field( 'cov_css_field', esc_html__( 'Custom CSS', 'btcorona' ), array($this, 'true_option_display_settings'), $true_page, 'true_section_1', $true_field_params );
        
        $true_field_params = array(
            'type'      => 'checkbox',
            'id'        => 'cov_rtl',
            'desc'      => esc_html__( 'Enable', 'btcorona' ),
            'label_for' => 'cov_rtl'
        );
        add_settings_field( 'cov_rtl_field', esc_html__( 'Right-to-Left support', 'btcorona' ), array($this, 'true_option_display_settings'), $true_page, 'true_section_1', $true_field_params );
        
    }

    /*
    * Show fields
    */
    function true_option_display_settings($args) {
        extract( $args );
        
        $option_name = 'btncov_options';
        
        $o = get_option( $option_name );
        
        switch ( $type ) {
            case 'text':  
                $title = esc_attr( stripslashes(isset($o[$id])?$o[$id]:'An interactive web-based dashboard to track COVID-19 in real time.') );
                echo "<input class='regular-text' type='text' id='$id' placeholder='$placeholder' name='" . $option_name . "[$id]' value='$title' />";  
                echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
            break;
            case 'textarea':  
                $description = esc_attr( stripslashes(isset($o[$id])?$o[$id]:'To identify new cases, we monitor various twitter feeds, online news services, and direct communication sent through the dashboard.') );
                echo "<textarea class='code regular-text' cols='12' rows='3' type='text' id='$id' name='" . $option_name . "[$id]'>$description</textarea>";    
                echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
            break;
            case 'checkbox':
                $checked = (isset($o[$id]) && $o[$id] == 'on') ? " checked='checked'" :  '';  
                echo "<label><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";  
                echo ($desc != '') ? $desc : "";
                echo "</label>";  
            break;
            case 'select':
                echo "<select id='$id' name='" . $option_name . "[$id]'>";
                foreach($vals as $v=>$l){
                    $selected = ($o[$id] == $v) ? "selected='selected'" : '';  
                    echo "<option value='$v' $selected>$l</option>";
                }
                echo ($desc != '') ? $desc : "";
                echo "</select>";  
            break;
            case 'radio':
                echo "<fieldset>";
                foreach($vals as $v=>$l){
                    $checked = ($o[$id] == $v) ? "checked='checked'" : '';  
                    echo "<label><input type='radio' name='" . $option_name . "[$id]' value='$v' $checked />$l</label><br />";
                }
                echo "</fieldset>";  
            break; 
        }
    }

    
    /*
    * Check fields
    */
    function true_validate_settings($input) {
        foreach($input as $k => $v) {
            $valid_input[$k] = trim($v);
        }
        return $valid_input;
    }

}