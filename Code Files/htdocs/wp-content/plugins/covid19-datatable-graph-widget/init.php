<?php
/**
*  Plugin Name: Covid19 Dataticker Graph & Widget
*  Plugin URI: https://covid19.braintum.com
*  Description: This plugin allows adding Covid19 outbreak live datatable, statistics, widgets, graph via shortcode to inform site visitors about changes in the situation about Coronavirus pandemic.
*  Version: 1.0.5
*  Author: Braintum
*  Author URI: https://braintum.com
*  Requires at least: 4.6
*  Tested up to: 5.5.1
*  License: GPL2
*  Domain Path: /languages/
*  Text Domain: btcorona
**/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/class-plugin-deactivate-feedback.php';

if ( ! class_exists( 'BtCoronadatatable' ) ) {
	final class BtCoronadatatable {


		/**
		 * Plugin Version
		 */
		const version = '1.0.5';

		private function __construct() {

			$this->define_constant();
			add_action( 'plugins_loaded', array($this, 'init_plugin'));
			$deactivation_feedback = new BT_Usage_Feedback(
				__FILE__,
				'',
				false,
				true

			);

		}

		/*
		* Initializes a singleton instance
		* @return \BtCoronadatatable
		*/

		public static function init(){
			static $instance = false;
			if(!$instance){
				$instance = new self();
			}
			return $instance;
		}

		/**
		 * Define required constant
		 * @return void
		 */
		public function define_constant(){
			define( 'BT_CORONA_VER', self::version );
			if ( ! defined( 'BT_CORONA_URL' ) ) {
				define( 'BT_CORONA_URL', plugin_dir_url( __FILE__ ) );
			}
			if ( ! defined( 'BT_CORONA_PATH' ) ) {
				define( 'BT_CORONA_PATH', plugin_dir_path( __FILE__ ) );
			}
			if ( ! defined( 'BT_CORONA_BASE_PATH' ) ) {
				define( 'BT_CORONA_BASE_PATH', plugin_basename(__FILE__) );
			}
			if ( ! defined( 'BT_CORONA_PRO_LINK' ) ) {
				define( 'BT_CORONA_PRO_LINK', 'https://www.braintum.com/product/covid19-datatable-graph-widget-pro/' );
			}

		}

		/**
		 * initialize the plugin
		 * @return void
		 */
		public function init_plugin(){

			load_plugin_textdomain( 'btcorona', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
			if(is_admin()){
				new Braintum\Corona\Admin();
			}else{
				new Braintum\Corona\Frontend();
			}
			new Braintum\Corona\Cron();
			
		}
		
	}
					
}

if(!function_exists( 'BtCoronadatatable' )){
	function BtCoronadatatable(){
		return BtCoronadatatable::init();
	}
}

//kick off the plugin
BtCoronadatatable();