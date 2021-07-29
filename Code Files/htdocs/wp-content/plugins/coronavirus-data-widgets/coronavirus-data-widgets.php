<?php
/**
 * Plugin Name:Coronavirus (COVID-19) Outbreak Data
 * Description:Use shortcode [cvct] or [cvct-tbl] and display live corona data widgets & table inside your WordPress page/post or sidebar. You can also add a covid-19 ticker inside footer or header.
 * Author:khushwantsidhu
 * Author URI:https://pinkborder.com
 * Plugin URI:https://pinkborder.com
 * Version:1.1.1
 * License: GPL2
 * Text Domain:CVDW
 * Domain Path: languages*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( defined( 'CVDW_VERSION' ) ) {
	return;
}
/*
Defined constent for later use
*/
define( 'CVDW_VERSION', '1.1.1' );
define( 'CVDW_Cache_Timing', 30*MINUTE_IN_SECONDS );
define( 'CVDW_FILE', __FILE__ );
define( 'CVDW_DIR', plugin_dir_path( CVDW_FILE ) );
define( 'CVDW_URL', plugin_dir_url( CVDW_FILE ) );

/**
 * Class coronavirus_data_widgets
 */
final class coronavirus_data_widgets {

	/**
	 * Plugin instance.
	 *
	 * @var coronavirus_data_widgets
	 * @access private
	 */
	private static $instance = null;

	/**
	 * Get plugin instance.
	 *
	 * @return coronavirus_data_widgets  
	 * @static
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 * @access private
	 */
	private function __construct() {
		// register activation/ deactivation hooks
		register_activation_hook( CVDW_FILE, array( $this , 'CVDW_activate' ) );
		register_deactivation_hook(CVDW_FILE, array($this , 'CVDW_deactivate' ) );
		// load text domain for translation
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'plugins_loaded', array( $this, 'CVDW_includes' ) ); 
        //main plugin shortcode for list widget
         add_shortcode( 'cvct', array($this, 'CVDW_shortcode' ));
         add_shortcode('cvct-tbl',array($this,'CVDW_tbl_shortcode'));

         if(is_admin()){
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this,'cvdw_setting_panel_action_link'));       
		}

        if(!is_admin()){
            add_action('wp_enqueue_scripts','CVDW_load_assets' );
        }
    }
        
    /*
|--------------------------------------------------------------------------
| Load required files
|--------------------------------------------------------------------------
*/  
    public function CVDW_includes() {
        require_once CVDW_DIR .'includes/cvdw-functions.php';
        require_once CVDW_DIR .'includes/cvdw-advance-shortcode.php';
        new CVDW_Advance_Shortcode();

        if(is_admin()){
			require_once CVDW_DIR .'includes/cvdw-feedback-notice.php';
            new CVDWFreeFeedbackNotice();
            
            require_once CVDW_DIR .'admin/cvdw-post-type.php';
			new CVDWTPostType();
        }
        
       
    }

    // other shortcodes link in all plugins section
	function cvdw_setting_panel_action_link($link){
		$link[] = '<a style="font-weight:bold" href="'. esc_url( get_admin_url(null, 'edit.php?post_type=cvct&page=cvct_shortcodes') ) .'">Shortcodes</a>';
		return $link;
    }

/*
|--------------------------------------------------------------------------
| Crypto Widget Main Shortcode
|--------------------------------------------------------------------------
*/ 
public function  CVDW_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'title'=>'Global Stats',
        'country-code'=>'all',
        'label-total'=>'Total Cases',
        'label-deaths'=>'Deaths',
        'label-recovered'=>'Recovered',
        'bg-color'=>'#ddd',
        'font-color'=>'#000',
    ), $atts, 'cvct' );

    wp_enqueue_style('cvdw_cards_css');
    wp_enqueue_script('cvdw_resizer_sensor');
    wp_enqueue_script('cvdw_resizer_queries');

    $country=!empty($atts['country-code'])?$atts['country-code']:"all";
    $stats='';
    $output='';
    $tp_html='';
 	 $style='layout-1';
    $total_cases='';
    $total_recovered='';
    $total_deaths='';
   
    $title=!empty($atts['title'])?$atts['title']:"COVID-19 CASES";
    $label_total=!empty($atts['label-total'])?$atts['label-total']:"Total Cases";
    $label_deaths=!empty($atts['label-deaths'])?$atts['label-deaths']:"Deaths";
    $label_recovered=!empty($atts['label-recovered'])?$atts['label-recovered']:"Recovered";

    $style=!empty($atts['style'])?$atts['style']:"style-1";
    $bgColors=!empty($atts['bg-color'])?$atts['bg-color']:"#DDDDDD";
    $fontColors=!empty($atts['font-color'])?$atts['font-color']:"#000";
    $custom_style='';
    $custom_style .='background-color:'.$bgColors.';';
    $custom_style .='color:'.$fontColors.';';
    $stats_data='';
  
    
    if( $country=="all"){
        $stats_data=CVDW_g_stats_data();
        
        $last_updated=date("d M Y, G:i A",strtotime(get_option('CVDW_gs_updated'))).' (GMT)';
    }else{
       $stats_data= CVDW_c_stats_data($country);
        
        $last_updated=date("d M Y, G:i A",strtotime(get_option('CVDW_cs_updated'))).' (GMT)';
    }
  
   
   if(is_array($stats_data)&& count($stats_data)>0){
       $total=$stats_data['total_cases'];
       $recovered=$stats_data['total_recovered'];
       $deaths=$stats_data['total_deaths'];
        $total_cases=!empty($total)? number_format($total):"N/A";
        $total_recovered=!empty($recovered)?number_format($recovered):"N/A";
        $total_deaths=!empty($deaths)?number_format($deaths):"N/A";
   }
       
        $tp_html.='
        <div class="card-update-time CVDW-card-1"><i>'.esc_html($last_updated).'</i></div>
        <div class="coronatracker-card CVDW-card-1" style="'.esc_attr($custom_style).'"><!-- 
            --><h2 style="color:'.esc_attr($fontColors).'">'.html_entity_decode($title).'</h2><!-- 
            --><div class="CVDW-number">
                <span class="large-num">'.esc_html($total_cases).'</span>
                <span>'.esc_html($label_total).'</span>
                </div><!-- 
            --><div class="CVDW-number">
                <span class="large-num">'.esc_html($total_deaths).'</span>
                <span>'.esc_html($label_deaths).'</span>
                </div><!-- 
            --><div class="CVDW-number">
                <span class="large-num">'.esc_html($total_recovered).'</span>
                <span>'.esc_html($label_recovered).'</span>
                </div><!-- 
        --></div>
        ';
	
    $source= get_transient('api-source');
    $css='<style data-s="'.esc_attr($source).'">'. esc_html($this->CVDW_load_styles($style)).'</style>';
    $output.='<div id="CVDW-card-wrapper">'.$tp_html.'</div>';
    $CVDWv='<!-- Corona Virus Cases Tracker - Version:- '.CVDW_VERSION.' By Cool Plugins (CoolPlugins.net) -->';	
    return  $CVDWv.$output.$css;	
}



/**
 * Table shortcode
 */
public function CVDW_tbl_shortcode($atts, $content = null ){
    $atts = shortcode_atts( array(
        'id'  => '',
        'layout'=>'layout-1',
        'show' =>"10" ,
        'label-confirmed'=>"Confirmed",
        'label-deaths'=>"Death",
         'label-recovered'=>"Recovered",
         'label-active'=>'Active',
         'label-country'=>'Country',
        'bg-color'=>'#222222',
        'font-color'=>'#f9f9f9'
    ), $atts, 'cvct-tbl' );
    $style = !empty($atts['layout'])?$atts['layout']:'layout-1';
    $country = !empty($atts['label-country'])?$atts['label-country']:'Country';
    $confirmed = !empty($atts['label-confirmed'])?$atts['label-confirmed']:'Confirmed';
    $deaths = !empty($atts['label-deaths'])?$atts['label-deaths']:'Death';
    $recoverd = !empty($atts['label-recovered'])?$atts['label-recovered']:'Recovered';
    $active = !empty($atts['label-active'])?$atts['label-active']:'Active';
    $bgColors=!empty($atts['bg-color'])?$atts['bg-color']:"#222222";
    $fontColors=!empty($atts['font-color'])?$atts['font-color']:"#f9f9f9";
    $show_entry = !empty($atts['show'])?$atts['show']:'10';
    $CVDW_html = '';
    $stack_arr = array();
    $results = array();
    $count = 0;
  $CVDW_get_data = CVDW_get_all_country_data();
if(is_array($CVDW_get_data)&& count($CVDW_get_data)>0){
        $CVDW_html.= '<table id="CVDW_table_layout" class="table-layout-1">
        <thead><tr>
            <th>'.__($country,'CVDW').'</th>
            <th>'.__($confirmed,'CVDW').'</th>
            <th>'.__($recoverd,'CVDW').'</th>
            <th>'.__($deaths,'CVDW').'</th>
            </tr> </thead><tbody>';
    foreach($CVDW_get_data as $CVDW_stats_data){
            $total = $CVDW_stats_data['cases'];
            $country_name = isset($CVDW_stats_data['country'])?$CVDW_stats_data['country']:'';
            $confirmed = $CVDW_stats_data['confirmed'];
            $recoverd = $CVDW_stats_data['recoverd'];
            $death = $CVDW_stats_data['deaths'];
            $active = $CVDW_stats_data['active'];
        
            $total_cases = !empty($total)?number_format($total):'N/A';
            $confirmed_cases = !empty($confirmed)?number_format($confirmed):'N/A';
            $recoverd_cases = !empty($recoverd)?number_format($recoverd):'N/A';
            $death_cases = !empty($death)?number_format($death):'N/A';
            $total_count =  $count++;
            if ($total_count == $show_entry) break;
            $title=$country_name;
            $i=1;
            $CVDW_html.= '<tr class="CVDW-style1-stats">';
            $CVDW_html.= '<td class="CVDW-country-title">'.$country_name.'</td>';
            $CVDW_html.= '<td class="CVDW-confirm-case">'.$confirmed_cases.'</td>
            <td class="CVDW-recoverd-case">'.$recoverd_cases.'</td>
            <td class="CVDW-death-case">'.$death_cases.'</td>
            </tr>';
    }
    $CVDW_html.=  '</tbody>
    </table>';
  }else{
    $CVDW_html.='<div>'.__('Something wrong With API').'</div>'; 
  }

  $css='<style>
  table#CVDW_table_layout tr th, table#CVDW_table_id tr th {background-color:'.$bgColors.';color:'.$fontColors.';}
table#CVDW_table_layout tr td, table#CVDW_table_id tr td {background-color:'.$fontColors.';color:'.$bgColors.';}
  '.$this->CVDW_load_table_styles().'</style>';
  $CVDWv='<!-- Coronavirus Data Widgets - Version:- '.CVDW_VERSION.' By Cool Plugins (CoolPlugins.net) -->';
    return $CVDWv. '<div  class="CVDW-wrapper">' . $CVDW_html . '</div>' .$css;
  
  }

/*
|--------------------------------------------------------------------------
| loading required assets according to the widget type
|--------------------------------------------------------------------------
*/  
    function CVDW_load_styles($style){
        $css = "";
        $css="
        #CVDW-card-wrapper {
            width: 100%;
            display: block;
            overflow-x: auto;
            padding: 0;
            margin: 8px auto 16px;
            text-align: center;
        }
        #CVDW-card-wrapper * {
            box-sizing: border-box;
        }
        #CVDW-card-wrapper .coronatracker-card {
            display: inline-block;
            width: 100%;
            max-width: 750px;
            border: 1px solid rgba(0, 0, 0, 0.14);
            padding: 10px;
            border-radius: 8px;
            background: #ddd url(".CVDW_URL."/assets/corona-virus.png);
            background-size: 68px;
            background-position: right -20px top -18px;
            background-repeat: no-repeat;
            transition: background-position 1s;
        }
        #CVDW-card-wrapper .coronatracker-card:hover {
            background-position: right -7px top -5px;
            transition: background-position 1s;
        }
        #CVDW-card-wrapper h2 {
            margin: 5px 0 10px 0;
            padding: 0;
            font-size: 20px;
            line-height: 22px;
            font-weight: bold;
            display: inline-block;
            width: 100%;
            text-align:center;
        }
        #CVDW-card-wrapper h2 img {
            display: inline-block;
            margin: 0 4px 0 0;
            padding: 0;
        }
        #CVDW-card-wrapper .CVDW-number {
            width: 33.33%;
            display: inline-block;
            float: none;
            padding: 8px 4px 15px;
            text-align: center;
            vertical-align: top;
        }
        #CVDW-card-wrapper .CVDW-number span {
            width: 100%;
            display: inline-block;
            font-size: 14px;
            line-height: 16px;
            margin-bottom: 2px;
            word-break: keep-all;
            vertical-align: middle;
        }
        #CVDW-card-wrapper .CVDW-number span.large-num {
            font-size: 18px;
            line-height: 21px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        #CVDW-card-wrapper .CVDW-number span.large-num small {
            font-size: 0.7em !IMPORTANT;
        }
        tipp {
            width: 14px;
            height: 12px;
            border-radius: 3px;
            display: inline-block;
            background: #666;
            vertical-align: middle;
            margin-right: 3px;
        }
        tipp.red {
            background: #ff4141;
        }
        tipp.green {
            background: #3aa969;
        }
        tipp.orange {
            background: #f17822;
        }
        tipp.blue {
            background: #1877f2;
        }
        #CVDW-card-wrapper i {
            display: inline-block;
            margin: 0;
            padding: 5px;
            font-size: 12.5px;
            line-height: 1.3em;
            font-style: italic;
        }
        .card-update-time.CVDW-card-1 {
            max-width: 750px;
            display: inline-block;
            width: 100%;
            text-align: right;
        }
        ";
       
        return $css;
    }

/*  
|--------------------------------------------------------------------------
| loading required assets according to the widget type
|--------------------------------------------------------------------------
*/  
    function CVDW_load_table_styles(){
      $css = '';
          $css=' table#CVDW_table_layout,
            table#CVDW_states_table_id,
            table#CVDW_table_id {
            table-layout: fixed;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
            }
            table#CVDW_states_table_id tr th,
            table#CVDW_states_table_id tr td,
            table#CVDW_table_layout tr th,
            table#CVDW_table_layout tr td,
            table#CVDW_table_id tr th,
            table#CVDW_table_id tr td {
            text-align: center;
            vertical-align: middle;
            font-size:14px;
            line-height:16px;
            text-transform:capitalize;
            border: 1px solid rgba(0, 0, 0, 0.15);
            width: 110px;
            padding: 12px 4px;
            }
            table#CVDW_table_layout tr th:first-child,
            table#CVDW_table_layout tr td:first-child,
            table#CVDW_table_layout tr th:first-child,
            table#CVDW_table_layout tr td:first-child {
            text-align: left;
            }
            table#CVDW_table_layout tr td img {
            margin: 0 4px 2px 0;
            padding: 0;
            vertical-align: middle;
            }
            div#CVDW_table_id_wrapper input,
            div#CVDW_table_id_wrapper select {
            display: inline-block !IMPORTANT;
            vertical-align: top;
            margin: 0 2px 20px !IMPORTANT;
            width: auto !IMPORTANT;
            min-width: 60px;
            } ';
      return $css;
    }

	/**
	 * Code you want to run when all other plugins loaded.
	 */
	public function load_textdomain() {
		load_plugin_textdomain('CVDW', false, basename(dirname(__FILE__)) . '/languages/' );
    }
    
 
	/**
	 * Run when activate plugin.
	 */
	public function CVDW_activate() {
		update_option("CVDW-type","FREE");
		update_option("CVDW_activation_time",date('Y-m-d h:i:s') );
		update_option("CVDW-alreadyRated","no");
	}
	public function CVDW_deactivate(){
		delete_transient('cvct_gs');
    }
}

function coronavirus_data_widgets() {
	return coronavirus_data_widgets::get_instance();
}

coronavirus_data_widgets();
