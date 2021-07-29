<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pagevisitcounter.com
 * @since      3.0.1
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/admin
 * @author     Ankit Panchal <wptoolsdev@gmail.com>
 */
class Advanced_Visit_Counter_Admin extends Advanced_Visit_Counter_Queries
{
    /**
     * The ID of this plugin.
     *
     * @since    3.0.1
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    3.0.1
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    private  $transients = array(
        "apvc_yearly_data",
        "apvc_monthly_data",
        "apvc_weekly_data",
        "apvc_daily_data",
        "apvc_browser_traffic_stats_data",
        "apvc_browser_traffic_data",
        "apvc_ref_traffic_data",
        "apvc_os_data",
        "apvc_orders_total",
        "apvc_total_orders_data",
        "apvc_total_products_sales",
        "apvc_mvp_month_data",
        "apvc_mvp_daily_data",
        "apvc_fv_30_td",
        "apvc_fv_30_past",
        "apvc_fv_td",
        "apvc_fv_past",
        "apvc_get_visitors_mn_data",
        "apvc_get_visitors_data",
        "apvc_pvp_30_data",
        "apvc_pvp_ip_30_data",
        "apvc_pvp_daily_data",
        "apvc_pvp_ip_daily_data",
        "apvc_get_visit_stats"
    ) ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    3.0.1
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the admin area.
     *
     * @since    3.0.1
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Advanced_Visit_Counter_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Advanced_Visit_Counter_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        if ( isset( $_GET['page'] ) && ($_GET['page'] === 'apvc-dashboard-page' || $_GET['page'] === 'apvc-smart-notifications-page') ) {
            wp_enqueue_style(
                'apvc_material_icons',
                plugin_dir_url( __FILE__ ) . 'css/mdi/css/materialdesignicons.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_base',
                plugin_dir_url( __FILE__ ) . 'css/vendor.bundle.base.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_base',
                plugin_dir_url( __FILE__ ) . 'css/vendor.bundle.base.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_dataTables_bootstrap4',
                plugin_dir_url( __FILE__ ) . 'assets/datatables/dataTables.bootstrap4.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_icheck',
                plugin_dir_url( __FILE__ ) . 'css/icheck/all.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_select',
                plugin_dir_url( __FILE__ ) . 'css/select2.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_tags',
                plugin_dir_url( __FILE__ ) . 'css/jquery.tagsinput.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_colorPicker',
                plugin_dir_url( __FILE__ ) . 'css/asColorPicker.min.css',
                array(),
                $this->version,
                'all'
            );
            wp_enqueue_style(
                'apvc_style_base',
                plugin_dir_url( __FILE__ ) . 'css/style.css',
                array(),
                filemtime( plugin_dir_path( __FILE__ ) . 'css/style.css' ),
                'all'
            );
            wp_enqueue_style(
                'apvc_style_main',
                plugin_dir_url( __FILE__ ) . 'css/main/style.css',
                array(),
                filemtime( plugin_dir_path( __FILE__ ) . 'css/main/style.css' ),
                'all'
            );
            wp_enqueue_style(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'css/advanced-page-visit-counter-admin.css',
                array(),
                filemtime( plugin_dir_path( __FILE__ ) . 'css/advanced-page-visit-counter-admin.css' ),
                'all'
            );
        }
    
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    3.0.1
     */
    public function enqueue_scripts()
    {
        global  $wpdb ;
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Advanced_Visit_Counter_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Advanced_Visit_Counter_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script(
            'apvc-menu',
            plugin_dir_url( __FILE__ ) . 'js/apvc-menu.js',
            array( 'jquery' ),
            filemtime( plugin_dir_path( __FILE__ ) . 'js/apvc-menu.js' ),
            true
        );
        
        if ( isset( $_GET['page'] ) && ($_GET['page'] === 'apvc-dashboard-page' || $_GET['page'] === 'apvc-smart-notifications-page') ) {
            wp_enqueue_script(
                'apvc_js_base',
                plugin_dir_url( __FILE__ ) . 'js/vendor.bundle.base.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_chart_js',
                plugin_dir_url( __FILE__ ) . 'js/Chart.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_datatables_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_datatables4_js',
                plugin_dir_url( __FILE__ ) . 'assets/datatables/dataTables.bootstrap4.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_hover_js',
                plugin_dir_url( __FILE__ ) . 'js/hoverable-collapse.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_misc_js',
                plugin_dir_url( __FILE__ ) . 'js/misc.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_settings_js',
                plugin_dir_url( __FILE__ ) . 'js/settings.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_icheck_js',
                plugin_dir_url( __FILE__ ) . 'js/icheck.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_select_js',
                plugin_dir_url( __FILE__ ) . 'js/select2.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_alert_js',
                plugin_dir_url( __FILE__ ) . 'js/sweetalert.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_asColor_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery-asColor.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_color_picker_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery-asColorPicker.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_tags_js',
                plugin_dir_url( __FILE__ ) . 'js/jquery.tagsinput.min.js',
                array( 'jquery' ),
                $this->version,
                false
            );
            wp_enqueue_script(
                'apvc_dashboard_js',
                plugin_dir_url( __FILE__ ) . 'js/dashboard.js',
                array( 'jquery' ),
                filemtime( plugin_dir_path( __FILE__ ) . 'js/dashboard.js' ),
                false
            );
            wp_enqueue_script(
                'apvc_script_js',
                plugin_dir_url( __FILE__ ) . 'js/script.js',
                array( 'jquery' ),
                filemtime( plugin_dir_path( __FILE__ ) . 'js/script.js' ),
                false
            );
            wp_enqueue_script(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'js/advanced-page-visit-counter-admin.js',
                array( 'jquery' ),
                filemtime( plugin_dir_path( __FILE__ ) . 'js/advanced-page-visit-counter-admin.js' ),
                true
            );
            $translations = array(
                "search_lable"      => __( "Search By :", "apvc" ),
                "shortcode_copied"  => __( "Shortcode Copied to clipboard.", "apvc" ),
                "import_completed"  => __( "Data Imported successfully.", "apvc" ),
                "import_failed"     => __( "File format is not supported.", "apvc" ),
                "shortcode_delete"  => __( "Shortcode Deleted successfully.", "apvc" ),
                "file_delete"       => __( "File Deleted successfully.", "apvc" ),
                "success"           => __( "Success", "apvc" ),
                "failed"            => __( "Failed", "apvc" ),
                "are_you_sure"      => __( "Are you sure?", "apvc" ),
                "are_you_sure_text" => __( "You won't be able to revert this!", "apvc" ),
                "cancel_btn"        => __( "Cancel", "apvc" ),
                "okay_btn"          => __( "OK", "apvc" ),
                "confirm_btn"       => __( "Great ", "apvc" ),
                "valid_date"        => __( "Please select valid date range.", "apvc" ),
                "valid_file"        => __( "Please upload valid file. (xls,xlsx,csv)", "apvc" ),
                "date_warning"      => __( "Please enter valid date.", "apvc" ),
                "data_warning"      => __( "Please enter valid data.", "apvc" ),
                "open"              => __( "Open", "apvc" ),
                "export_completed"  => __( "File Export Completed", "apvc" ),
                "shortcode_save"    => __( "Please Enter Shortcode Name", "apvc" ),
                "cleanup_completed" => __( "Clean Up Process Completed", "apvc" ),
                "refresh_dashboard" => __( "Dashboard is reloading now...", "apvc" ),
            );
            $table = APVC_DATA_TABLE;
            $sYear = $wpdb->get_var( "SELECT YEAR(date) FROM {$table} ORDER BY date ASC LIMIT 1" );
            $eYear = date( 'Y' );
            wp_localize_script( $this->plugin_name, 'apvc_ajax', array(
                'ajax_url'     => admin_url( 'admin-ajax.php' ),
                'apvc_url'     => 'https://pagevisitcounter.com/',
                "search_lable" => __( "Search By :", "apvc" ),
                'admin_d_url'  => admin_url( 'admin.php?page=apvc-dashboard-page' ),
                'post_url'     => get_home_url() . "/?p=",
                'ap_rest_url'  => get_rest_url(),
                'wp_rest'      => wp_create_nonce( "wp_rest" ),
                'show_in_k'    => get_option( 'numbers_in_k' ),
            ) );
            wp_localize_script( 'apvc_script_js', 'apvc_translation', $translations );
            wp_localize_script( $this->plugin_name, 'apvc_translation', $translations );
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Settings Page Init
     *
     * @since    3.0.1
     */
    public function avc_settings_page_init()
    {
        global  $wpdb ;
        add_menu_page(
            __( 'Advanced Page Visit Counter', 'apvc' ),
            __( 'Advanced Page Visit Counter', 'apvc' ),
            'manage_options',
            'apvc-dashboard-page',
            array( $this, 'apvc_dashboard_page' ),
            plugin_dir_url( __FILE__ ) . "images/a-logo-1.png"
        );
        $history_table = $wpdb->prefix . "avc_page_visit_history";
        $rows = $wpdb->get_results( "SHOW COLUMNS FROM {$history_table} LIKE 'article_title'" );
        
        if ( count( $rows ) == 0 ) {
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Dashboard', 'apvc' ),
                __( 'Dashboard', 'apvc' ),
                'manage_options',
                'apvc-dashboard-page',
                array( $this, 'apvc_dashboard_page' )
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Trending', 'apvc' ),
                __( 'Trending', 'apvc' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Reports', 'apvc' ),
                __( 'Reports', 'apvc' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Shortcode Generator', 'apvc' ),
                __( 'Shortcode Generator', 'apvc' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Shortcode Templates', 'apvc' ),
                __( 'Shortcode Templates', 'apvc' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
            add_submenu_page(
                'apvc-dashboard-page',
                __( 'Settings', 'apvc' ),
                __( 'Settings', 'apvc' ),
                'manage_options',
                'apvc-visits-page',
                'Advanced_Visit_Counter_Admin::apvc_dashboard_page'
            );
        }
    
    }
    
    public function apvc_admin_head()
    {
        global  $wpdb ;
        if ( isset( $_GET['page'] ) && $_GET['page'] === 'apvc-dashboard-page' ) {
        }
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the year.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_of_the_year_data()
    {
        global  $wpdb ;
        $yearTotalCounts = get_transient( "apvc_yearly_data" );
        
        if ( empty($yearTotalCounts) ) {
            $yearTotalCounts = json_decode( $this->get_total_counts_of_the_year() );
            set_transient( "apvc_yearly_data", $yearTotalCounts, HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        echo  __( "Total Visits (Last 1 Year)", "apvc" ) ;
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  $this->apvc_number_format( $yearTotalCounts->total_counts ) ;
        ?></h4>
			</div>
			
		</div>
		<canvas class="mt-2" height="60" months="<?php 
        echo  implode( ",", $yearTotalCounts->months_wise ) ;
        ?>" id="apvc_total_visits_yearly"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the month.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_of_the_month_data()
    {
        global  $wpdb ;
        $monthTotalCounts = get_transient( "apvc_monthly_data" );
        
        if ( empty($monthTotalCounts) ) {
            $monthTotalCounts = json_decode( $this->get_total_counts_of_last_month() );
            set_transient( "apvc_monthly_data", $monthTotalCounts, HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        echo  __( "Total Visits (Month)", "apvc" ) ;
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  $this->apvc_number_format( $monthTotalCounts->lastMonth ) ;
        ?></h4>
				<h6 class="<?php 
        echo  $monthTotalCounts->class ;
        ?> font-weight-semibold ml-2"><?php 
        echo  $monthTotalCounts->countDiff ;
        ?></h6>
			</div>
		</div>
		<canvas class="mt-2" month="<?php 
        echo  implode( ",", $monthTotalCounts->months_wise ) ;
        ?>" height="60" id="apvc_total_visits_monthly"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the week.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_of_the_week_data()
    {
        global  $wpdb ;
        $weeksTotalCounts = get_transient( "apvc_weekly_data" );
        
        if ( empty($weeksTotalCounts) ) {
            $weeksTotalCounts = json_decode( $this->get_total_counts_of_last_week() );
            set_transient( "apvc_weekly_data", $weeksTotalCounts, HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        echo  __( "Total Visits (Week)", "apvc" ) ;
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  $this->apvc_number_format( $weeksTotalCounts->lastWeek ) ;
        ?></h4>
				<h6 class="<?php 
        echo  $weeksTotalCounts->class ;
        ?> font-weight-semibold ml-2"><?php 
        echo  $weeksTotalCounts->countDiff ;
        ?></h6>
			</div>
		</div>
		<canvas class="mt-2" height="60" weeks="<?php 
        echo  implode( ",", $weeksTotalCounts->weeks_wise ) ;
        ?>" id="apvc_total_visits_weekly"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts of the day.
     *
     * @since    3.0.1
     */
    public function apvc_get_total_counts_daily_data()
    {
        global  $wpdb ;
        $dailyTotalCounts = get_transient( "apvc_daily_data" );
        
        if ( empty($dailyTotalCounts) ) {
            $dailyTotalCounts = json_decode( $this->get_total_counts_of_last_daily() );
            set_transient( "apvc_daily_data", $dailyTotalCounts, HOURLY_REFRESH );
        }
        
        ?>
		<div class="card-body pb-0">
			<p class="text-muted"><?php 
        echo  __( "Total Visits (Today)", "apvc" ) ;
        ?></p>
			<div class="d-flex align-items-center">
				<h4 class="font-weight-semibold"><?php 
        echo  $this->apvc_number_format( $dailyTotalCounts->todaysCounts ) ;
        ?></h4>
				<h6 class="<?php 
        echo  $dailyTotalCounts->class ;
        ?> font-weight-semibold ml-2"><?php 
        echo  $dailyTotalCounts->countDiff ;
        ?></h6>
			</div>
		</div>
		<canvas class="mt-2" height="60" days="<?php 
        echo  implode( ",", $dailyTotalCounts->day_wise ) ;
        ?>" id="apvc_total_visits_daily"></canvas>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get stats by browser.
     *
     * @since    3.0.1
     */
    public function apvc_get_browsers_stats_data()
    {
        global  $wpdb ;
        $browserTrafficStatsList = get_transient( "apvc_browser_traffic_stats_data" );
        
        if ( empty($browserTrafficStatsList) ) {
            $browserTrafficStatsList = json_decode( $this->get_browser_traffic_stats_list() );
            set_transient( "apvc_browser_traffic_stats_data", $browserTrafficStatsList, HOURLY_REFRESH );
        }
        
        $browserTrafficStats = get_transient( "apvc_browser_traffic_data" );
        
        if ( empty($browserTrafficStats) ) {
            $browserTrafficStats = json_decode( $this->get_browser_traffic_stats() );
            set_transient( "apvc_browser_traffic_data", $browserTrafficStats, HOURLY_REFRESH );
        }
        
        $browserLogos = (array) json_decode( $this->get_browsers_logos() );
        $browsersChartDataV = array();
        $browsersChartDataK = array();
        foreach ( $browserTrafficStatsList as $bChartList ) {
            array_push( $browsersChartDataV, $bChartList->total_count );
            array_push( $browsersChartDataK, $bChartList->browser_full_name );
        }
        ?>
		<div class="d-flex align-items-center mb-0 mb-lg-5">
	      <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" role="tablist">
	        <li class="nav-item">
	        </li>
	      </ul>
	      <ul class="ml-auto d-none d-lg-block" id="sourceLineChartLegend">
	      	<?php 
        $classColors = array(
            'bg-primary',
            'bg-success',
            'bg-secondary',
            'bg-danger',
            'bg-warning',
            'bg-pink'
        );
        $bsCnt = 0;
        foreach ( $browserTrafficStats as $bStats ) {
            echo  '<li>
				          <span class="chart-color ' . $classColors[$bsCnt] . '"></span>
				          <span class="chart-label">' . __( " " . $bStats->device_type . " ", "apvc" ) . number_format_i18n( $bStats->percentage, 2 ) . '%</span>
				        </li>' ;
            $bsCnt++;
        }
        ?>
	      </ul>
	    </div>
	    <div class="tab-content tab-content-solid">
	      <div class="tab-pane fade show active" id="daily-traffic" role="tabpanel" aria-labelledby="daily-traffic-tab">
	        <div class="row">
	          <div class="col-lg-12 order-lg-first">
	            <div class="data-list">
				<?php 
        foreach ( $browserTrafficStatsList as $statsList ) {
            ?>
	              <div class="list-item row">
	                <div class="thumb col">
	                  <img class="rounded-circle img-xs" src="<?php 
            echo  ( $browserLogos[$statsList->browser_short_name] != '' ? plugin_dir_url( __FILE__ ) . "/images/" . $browserLogos[$statsList->browser_short_name] : plugin_dir_url( __FILE__ ) . "/images/" . $browserLogos['default'] ) ;
            ?>" alt="thumb"> </div>
	                <div class="browser col"><?php 
            echo  __( $statsList->browser_full_name, "apvc" ) ;
            ?></div>
	                <div class="visits col"><?php 
            echo  $this->apvc_number_format( $statsList->total_count ) ;
            ?></div>
	              </div>
	            <?php 
        }
        ?>
				</div>
	          </div>
	        </div>
	      </div>
	    </div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total counts by referrers.
     *
     * @since    3.0.1
     */
    public function apvc_get_referral_stats_data()
    {
        global  $wpdb ;
        $referralTrafficStats = get_transient( "apvc_ref_traffic_data" );
        
        if ( empty($referralTrafficStats) ) {
            $referralTrafficStats = json_decode( $this->get_referral_websites_stats() );
            set_transient( "apvc_ref_traffic_data", $referralTrafficStats, HOURLY_REFRESH );
        }
        
        $refChartDataV = array();
        $refChartDataK = array();
        foreach ( $referralTrafficStats as $refChartList ) {
            array_push( $refChartDataV, $refChartList->total_count );
            array_push( $refChartDataK, ucfirst( $refChartList->http_referer ) );
        }
        ?>
		<div class="col-md-12 legend-wrapper">
			<?php 
        $classColors = array(
            'bg-primary',
            'bg-success',
            'bg-secondary',
            'bg-danger',
            'bg-warning',
            'bg-pink'
        );
        $bsCnt = 0;
        echo  '<div class="data-list">' ;
        foreach ( $referralTrafficStats as $refStats ) {
            ?>
					<div class="list-item row">
						<div class="dot-indicator <?php 
            echo  $classColors[$bsCnt] ;
            ?> mt-1 mr-2" style="height: 30px; width: 5px;"></div>
		                <div class="browser col"><?php 
            _e( $refStats->http_referer, 'apvc' );
            ?></div>
		                <div class="visits col"><?php 
            echo  $this->apvc_number_format( $refStats->total_count ) . ' (' . number_format_i18n( $refStats->percentage, 2 ) . '%)' ;
            ?></div>
		              </div>
		              <?php 
            $bsCnt++;
        }
        echo  '</div>' ;
        ?>
		</div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get stats by Operating Systems.
     *
     * @since    3.0.1
     */
    public function apvc_get_os_stats_data()
    {
        global  $wpdb ;
        $osTrafficStats = get_transient( "apvc_os_data" );
        
        if ( empty($osTrafficStats) ) {
            $osTrafficStats = json_decode( $this->get_stats_by_operating_systems() );
            set_transient( "apvc_os_data", $osTrafficStats, HOURLY_REFRESH );
            update_option( "avpc_recent_execution", date( "Y-m-d H:i:s" ) );
        }
        
        $osChartDataV = array();
        $osChartDataK = array();
        foreach ( $osTrafficStats as $osChartList ) {
            array_push( $osChartDataV, $osChartList->total_count );
            array_push( $osChartDataK, ucfirst( $osChartList->operating_system ) );
        }
        ?>
		<div class="col-md-12 legend-wrapper">
		<?php 
        $classColors = array(
            'bg-primary',
            'bg-success',
            'bg-secondary',
            'bg-danger',
            'bg-warning',
            'bg-pink'
        );
        $bsCnt = 0;
        echo  '<div class="data-list">' ;
        foreach ( $osTrafficStats as $osStats ) {
            ?>
					<div class="list-item row">
						<div class="dot-indicator <?php 
            echo  $classColors[$bsCnt] ;
            ?> mt-1 mr-2" style="height: 30px; width: 5px;"></div>
		                <div class="browser col"><?php 
            _e( ucfirst( $osStats->operating_system ), 'apvc' );
            ?></div>
		                <div class="visits col"><?php 
            echo  $this->apvc_number_format( $osStats->total_count ) . ' (' . number_format_i18n( $osStats->percentage, 2 ) . '%)' ;
            ?></div>
		              </div>
		           <?php 
            $bsCnt++;
        }
        echo  '</div>' ;
        ?>
		</div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get Most visited article.
     *
     * @since    3.0.1
     */
    public function apvc_most_visited_article()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $sdate = date( 'Y-m-d 00:00:00' );
        $pedate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -31 day' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $visits = get_transient( "apvc_mvp_month_data" );
            
            if ( empty($visits) ) {
                $visits = $wpdb->get_results( "SELECT COUNT(*) as ar_count, article_id, (SELECT post_title FROM {$wpdb->posts} WHERE ID = article_id ) as title FROM " . APVC_DATA_TABLE . "  WHERE article_id != '' AND `date` > '{$pedate}' GROUP BY article_id ORDER BY ar_count DESC LIMIT 1" );
                set_transient( "apvc_mvp_month_data", $visits, HOURLY_REFRESH );
            }
        
        } else {
            $visits = get_transient( "apvc_mvp_daily_data" );
            
            if ( empty($visits) ) {
                $visits = $wpdb->get_results( "SELECT COUNT(*) as ar_count, article_id, (SELECT post_title FROM {$wpdb->posts} WHERE ID = article_id ) as title FROM " . APVC_DATA_TABLE . "  WHERE article_id != '' AND `date` > '{$sdate}' GROUP BY article_id ORDER BY ar_count DESC LIMIT 1" );
                set_transient( "apvc_mvp_daily_data", $visits, HOURLY_REFRESH );
            }
        
        }
        
        ?>
		<div class="card-body">
		    <div class="d-flex justify-content-center">
		      <i class="mdi mdi-clock icon-lg text-primary d-flex align-items-center"></i>
		      <div class="d-flex flex-column ml-4">
		        <span class="d-flex flex-column">
		          <p class="mb-0"><?php 
        _e( "Most Visited Article", "apvc" );
        ?></p>
		          <h5 class="font-weight-bold"><?php 
        echo  $visits[0]->title ;
        ?>
		          <span class="text-muted"><a style="font-weight: normal; font-size: 14px !important;" href="<?php 
        echo  get_the_permalink( $visits[0]->article_id ) ;
        ?>" target="_blank"><?php 
        _e( "Link", "apvc" );
        ?></a></span></h5>
		        </span>
		      </div>
		    </div>
		</div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get first time visitors.
     *
     * @since    3.0.1
     */
    public function apvc_get_first_time_visitors()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $sdate = date( 'Y-m-d 00:00:00' );
        $edate = date( 'Y-m-d 23:59:59' );
        $pedate = date( 'Y-m-d 00:00:00', strtotime( date( 'Y-m-d 0:0:0' ) . ' -30 day' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $ipsToday = get_transient( "apvc_fv_30_td" );
            
            if ( empty($ipsToday) ) {
                $ipsToday = $wpdb->get_results( "SELECT ip_address FROM " . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$sdate}' GROUP BY ip_address", ARRAY_N );
                set_transient( "apvc_fv_30_td", $ipsToday, HOURLY_REFRESH );
            }
            
            $ipsPast = get_transient( "apvc_fv_30_past" );
            
            if ( empty($ipsPast) ) {
                $ipsPast = $wpdb->get_results( "SELECT ip_address FROM " . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$pedate}' AND `date` < '{$sdate}' GROUP BY ip_address", ARRAY_N );
                set_transient( "apvc_fv_30_past", $ipsPast, HOURLY_REFRESH );
            }
        
        } else {
            $ipsToday = get_transient( "apvc_fv_td" );
            
            if ( empty($ipsToday) ) {
                $ipsToday = $wpdb->get_results( "SELECT ip_address FROM " . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$sdate}' AND `date` <= '{$edate}' GROUP BY ip_address", ARRAY_N );
                set_transient( "apvc_fv_td", $ipsToday, HOURLY_REFRESH );
            }
            
            $ipsPast = get_transient( "apvc_fv_past" );
            
            if ( empty($ipsPast) ) {
                $ipsPast = $wpdb->get_results( "SELECT ip_address FROM " . APVC_DATA_TABLE . " WHERE article_id != '' AND `date` >= '{$pedate}' AND `date` <= '{$sdate}'\t GROUP BY ip_address", ARRAY_N );
                set_transient( "apvc_fv_past", $ipsPast, HOURLY_REFRESH );
            }
        
        }
        
        $ipsToday = call_user_func_array( 'array_merge', $ipsToday );
        $ipsPast = call_user_func_array( 'array_merge', $ipsPast );
        
        if ( count( $ipsPast ) <= 0 ) {
            $fnCount = count( $ipsToday );
        } else {
            $fnCount = count( array_diff( $ipsToday, $ipsPast ) );
        }
        
        ?>
		<div class="card-body">
            <div class="d-flex justify-content-center">
              <i class="mdi mdi-human-greeting icon-lg text-success d-flex align-items-center"></i>
              <div class="d-flex flex-column ml-4">
                <span class="d-flex flex-column">
                  <p class="mb-0"><?php 
        _e( "First Time Visitors", "apvc" );
        ?></p>
                  <h4 class="font-weight-bold"><?php 
        echo  $fnCount ;
        ?></h4>
                </span>
              </div>
            </div>
          </div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get total visitors.
     *
     * @since    3.0.1
     */
    public function apvc_get_visitors()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $sdate = date( 'Y-m-d 00:00:00' );
        $pedate = date( 'Y-m-d H:i:s', strtotime( date( 'Y-m-d 0:0:0' ) . ' -30 day' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $q = " AND `date` >= '{$pedate}' AND `date` <= '{$sdate}' ";
            $visitors = get_transient( "apvc_get_visitors_mn_data" );
            
            if ( empty($visitors) ) {
                $visitors = count( $wpdb->get_results( "SELECT DISTINCT ip_address FROM " . APVC_DATA_TABLE . " WHERE article_id != '' " . $q ) );
                set_transient( "apvc_get_visitors_mn_data", $visitors, HOURLY_REFRESH );
            }
        
        } else {
            $q = " AND `date` >= '{$sdate}' ";
            $visitors = get_transient( "apvc_get_visitors_data" );
            
            if ( empty($visitors) ) {
                $visitors = count( $wpdb->get_results( "SELECT DISTINCT ip_address FROM " . APVC_DATA_TABLE . " WHERE article_id != '' " . $q ) );
                set_transient( "apvc_get_visitors_data", $visitors, HOURLY_REFRESH );
            }
        
        }
        
        ?>
		<div class="card-body">
	        <div class="d-flex justify-content-center">
	          <i class="mdi mdi-laptop icon-lg text-warning d-flex align-items-center"></i>
	          <div class="d-flex flex-column ml-4">
	            <span class="d-flex flex-column">
	              <p class="mb-0"><?php 
        _e( "Total Visitors", "apvc" );
        ?></p>
	              <h4 class="font-weight-bold"><?php 
        echo  $visitors ;
        ?></h4>
	            </span>
	          </div>
	        </div>
	      </div>
		<?php 
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get page views per visitor.
     *
     * @since    3.0.1
     */
    public function apvc_get_page_views_per_visitor()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $today = date( 'Y-m-d 00:00:01' );
        $lstDate = date( 'Y-m-d 00:00:01', strtotime( date( 'Y-m-d 00:00:01' ) . ' -30 days' ) );
        
        if ( isset( $_REQUEST['day'] ) && !empty($_REQUEST['day']) ) {
            $q = " AND `date` >= '{$lstDate}' AND `date` <= '{$today}' ";
            $totalCounts = get_transient( "apvc_pvp_30_data" );
            
            if ( empty($totalCounts) ) {
                $totalCounts = count( $wpdb->get_results( "SELECT * FROM " . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . " " ) );
                set_transient( "apvc_pvp_30_data", $totalCounts, HOURLY_REFRESH );
            }
            
            $ipCounts = get_transient( "apvc_pvp_ip_30_data" );
            
            if ( empty($ipCounts) ) {
                $ipCounts = count( $wpdb->get_results( "SELECT * FROM " . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . "  GROUP BY ip_address" ) );
                set_transient( "apvc_pvp_ip_30_data", $ipCounts, HOURLY_REFRESH );
            }
        
        } else {
            $q = " AND `date` >= '{$today}' ";
            $totalCounts = get_transient( "apvc_pvp_daily_data" );
            
            if ( empty($totalCounts) ) {
                $totalCounts = count( $wpdb->get_results( "SELECT * FROM " . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . " " ) );
                set_transient( "apvc_pvp_daily_data", $totalCounts, HOURLY_REFRESH );
            }
            
            $ipCounts = get_transient( "apvc_pvp_ip_daily_data" );
            
            if ( empty($ipCounts) ) {
                $ipCounts = count( $wpdb->get_results( "SELECT * FROM " . APVC_DATA_TABLE . " WHERE article_id != '' " . $q . "  GROUP BY ip_address" ) );
                set_transient( "apvc_pvp_ip_daily_data", $ipCounts, HOURLY_REFRESH );
            }
        
        }
        
        
        if ( $totalCounts > 0 && $ipCounts > 0 ) {
            $count = ( ceil( $totalCounts / $ipCounts ) !== 'NAN' ? ceil( $totalCounts / $ipCounts ) : "0" );
        } else {
            $count = 0;
        }
        
        ?>
		 <div class="card-body">
            <div class="d-flex justify-content-center">
              <i class="mdi mdi-earth icon-lg text-danger d-flex align-items-center"></i>
              <div class="d-flex flex-column ml-4">
                <span class="d-flex flex-column">
                  <p class="mb-0"><?php 
        _e( "Page Views Per Visitor", "apvc" );
        ?></p>
                  <h4 class="font-weight-bold"><?php 
        echo  $count ;
        ?></h4>
                </span>
              </div>
            </div>
          </div>
		<?php 
        wp_die();
    }
    
    /*
     * Advanced Page Visit Counter update the dashboard data.
     *
     * @since    3.0.6
     */
    public function apvc_dashboard_updated()
    {
        $recentUpdated = get_option( "avpc_recent_execution", true );
        echo  $this->apvc_get_human_time_diff( $recentUpdated ) ;
        wp_die();
    }
    
    /*
     * Advanced Page Visit Counter Refresh the dashboard with latest data.
     *
     * @since    3.0.6
     */
    public function apvc_refresh_dashboard()
    {
        foreach ( $this->transients as $transient ) {
            delete_transient( $transient );
        }
        $this->apvc_get_total_counts_of_the_year_data();
        $this->apvc_get_total_counts_of_the_month_data();
        $this->apvc_get_total_counts_of_the_week_data();
        $this->apvc_get_total_counts_daily_data();
        $this->apvc_get_browsers_stats_data();
        $this->apvc_get_referral_stats_data();
        $this->apvc_get_os_stats_data();
        $this->apvc_most_visited_article();
        $this->apvc_get_first_time_visitors();
        $this->apvc_get_visitors();
        $this->apvc_get_page_views_per_visitor();
        $this->apvc_get_visit_stats();
    }
    
    /**
     * Advanced Page Visit Counter Get settings page data.
     *
     * @since    3.0.1
     */
    public function apvc_settings_page_content()
    {
        global  $wpdb ;
        $recentUpdated = get_option( "avpc_recent_execution", true );
        ?>
		<input type="hidden" id="current_page" value="dashboard">
	    <div class="container-fluid page-body-wrapper">
		    <div class="main-panel container">
			      <div class="content-wrapper">
			        <div class="row">
			        	<div class="col-lg-12">
							<div class="hm_dash_heading">
								<h5 class="text-right"><?php 
        _e( "Dashboard Updated: <span id='apvc_dash_updated'>" . $this->apvc_get_human_time_diff( $recentUpdated ) . '</span>', "apvc" );
        ?><button type="button" id="apvc_update_dash" class="btn btn-primary btn-fw"><i class="mdi mdi-dna"></i><?php 
        echo  _e( "Update Now", "apvc" ) ;
        ?></button></h5>

							</div>
						</div>	
			          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
			            <div class="card card-statistics" id="total_counts_year_data">
			             <?php 
        $this->apvc_loader_control();
        ?>
			            </div>
			          </div>
			          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
			            <div class="card card-statistics" id="total_counts_month_data">
			            	<?php 
        $this->apvc_loader_control();
        ?>
			            </div>
			          </div>
			          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
			            <div class="card card-statistics" id="total_counts_weeks_data">
			            	<?php 
        $this->apvc_loader_control();
        ?>
			            </div>
			          </div>
			          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card">
			            <div class="card card-statistics" id="total_counts_daily_data">
			            	<?php 
        $this->apvc_loader_control();
        ?>
			            </div>
			          </div>

					<div class="col-lg-12">
						<div class="hm_heading">
							<h4 class="font-weight-semibold"><?php 
        _e( "Today", "apvc" );
        ?></h4>
						</div>
					</div>	
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_visit_length">
						  	<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_total_visitors">
		                  	<?php 
        $this->apvc_loader_control();
        ?>
		                </div>
		            </div>

		            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
			            <div class="card" id="apvc_first_time_visitors">
		                 	<?php 
        $this->apvc_loader_control();
        ?>
		                </div>
		            </div>

		            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
			            <div class="card" id="apvc_post_views_per_user">
		                 	<?php 
        $this->apvc_loader_control();
        ?>
		                </div>
		            </div>

		            <div class="col-lg-12">
						<div class="hm_heading">
							<h4 class="font-weight-semibold"><?php 
        _e( "Last 30 Days", "apvc" );
        ?></h4>
						</div>
					</div>	
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_visit_length_t">
						  	<?php 
        $this->apvc_loader_control();
        ?>
						</div>
					</div>

					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
						<div class="card" id="apvc_total_visitors_t">
		                  	<?php 
        $this->apvc_loader_control();
        ?>
		                </div>
		            </div>

		            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
			            <div class="card" id="apvc_first_time_visitors_t">
		                 	<?php 
        $this->apvc_loader_control();
        ?>
		                </div>
		            </div>

		            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 stretch-card adv_sts">
			            <div class="card" id="apvc_post_views_per_user_t">
		                 	<?php 
        $this->apvc_loader_control();
        ?>
		                </div>
		            </div>

		            <div class="col-lg-12 grid-margin stretch-card">
		                <div class="card">
		                  <div class="p-4 border-bottom">
		                  	<div class="col-lg-8 float-left">
		                    	<h4 class="card-title mb-0"><?php 
        _e( "Visit Statistics - <span id='duration_change'>Last 20 Days Statistics</span>", "apvc" );
        ?></h4>
		                    	<span style="font-size: 10px; color: red; font-style: italic;">*It can take some time to render chart based on size of the data.</span>
		                	</div>
		                	<div class="col-lg-4 float-right">
		                		<?php 
        ?>
		                    	<select class="float-right" id="apvc_filter_chart_dash">
		                    		<option selected="selected"><?php 
        _e( "Filter Data", "apvc" );
        ?></option>
		                    		<option value="7_days"><?php 
        _e( "1 Week", "apvc" );
        ?></option>
		                    		<option value="1_month"><?php 
        _e( "1 Month", "apvc" );
        ?></option>
		                    		<option value="3_months"><?php 
        _e( "3 Months", "apvc" );
        ?></option>
		                    		<option value="6_month"><?php 
        _e( "6 Months", "apvc" );
        ?></option>
		                    	</select>
		                  	</div>
		                  </div>

		                  <div class="card-body visitStatsChart">
		                    <canvas id="visitStatsChart" style="position: relative; height:50vh; width:80vw"></canvas>
		                 	<div class="c-loader"><?php 
        $this->apvc_loader_control();
        ?></div>
		                  </div>
		                </div>
		              </div>
					<?php 
        ?>
					
					<div class="col-md-6 stretch-card">
						<div class="card">
						  <div class="card-header header-sm">
						    <div class="d-flex align-items-center">
						      <h4 class="card-title mb-0"><?php 
        echo  __( "Browser Traffic", "apvc" ) ;
        ?></h4>
						    </div>
						  </div>
						  <div class="card-body" id="apvc_browser_stats_data">
						  	<?php 
        $this->apvc_loader_control();
        ?>
						  </div>
						</div>
					</div>

					<div class="col-md-6 grid-margin stretch-card">
						<div class="card">
						  <div class="card-body">
						    <h4 class="card-title mb-4"><?php 
        echo  __( "Traffic source (Referral Websites)", "apvc" ) ;
        ?></h4>
						    <hr>
						    <div class="row" id="apvc_referral_stats_data">
						    	<?php 
        $this->apvc_loader_control();
        ?>	
						    </div>


						  </div>
						</div>
					</div>
					<div class="col-md-6 grid-margin stretch-card">
						<div class="card">
						  <div class="card-body">
						    <h4 class="card-title mb-4"><?php 
        echo  __( "Traffic by Operating Systems", "apvc" ) ;
        ?></h4>
						    <hr>
						    <div class="row" id="apvc_os_stats_data">
						      <?php 
        $this->apvc_loader_control();
        ?>
						    </div>
						  </div>
						</div>
					</div>
			      </div>
			    </div>
		  	</div>
    	</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get version info block.
     *
     * @since    3.0.1
     */
    public function apvc_get_version_info_block()
    {
        global  $wpdb ;
        $current_user = wp_get_current_user();
        if ( isset( $_GET['apvc_page'] ) ) {
            return;
        }
        ?>
		
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get date is valid or not.
     *
     * @since    3.0.1
     */
    public function apvc_is_date( $str )
    {
        $str = str_replace( '/', '-', $str );
        //see explanation below for this replacement
        return is_numeric( strtotime( $str ) );
    }
    
    /**
     * Advanced Page Visit Counter Get loader.
     *
     * @since    3.0.1
     */
    public function apvc_loader_control()
    {
        ?>
		<div class="loader-demo-box" style="border: none !important;">
          <div class="square-box-loader">
            <div class="square-box-loader-container">
              <div class="square-box-loader-corner-top"></div>
              <div class="square-box-loader-corner-bottom"></div>
            </div>
            <div class="square-box-loader-square"></div>
          </div>
        </div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get top pages data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_pages_data()
    {
        global  $wpdb ;
        $top10Pages = json_decode( $this->apvc_get_top_10_page_data() );
        ?>
		  <div class="d-flex justify-content-between">
              <h4 class="card-title"><?php 
        echo  __( 'Top 10 Pages', 'apvc' ) ;
        ?></h4>
          </div>
            <?php 
        $count = 1;
        $count = 1;
        
        if ( count( $top10Pages ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( "No Pages Found", "apvc" ) . '</h5>' ;
        } else {
            foreach ( $top10Pages as $pages ) {
                ?>
            <div class="list d-flex align-items-center border-bottom py-3">
              <div class="wrapper w-100 ml-3">
                <p class="mb-0"><b><?php 
                echo  $count++ ;
                ?>.</b> <?php 
                echo  __( $pages->title, "apvc" ) ;
                ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <i class="mdi mdi-clock text-muted mr-1"></i>
                  	<small class="text-muted ml-auto"><?php 
                echo  __( 'Recent Visit:', "apvc" ) ;
                ?> <b><?php 
                echo  $this->get_recent_visit( $pages->article_id ) ;
                ?></b></small>&nbsp;
                  	<small class="text-muted ml-auto"> <?php 
                echo  __( 'Total Visits:', 'apvc' ) ;
                ?> <b><?php 
                echo  __( $pages->count, "apvc" ) ;
                ?></b></small>
                  	<small class="text-muted ml-auto"><a href="<?php 
                echo  get_permalink( $pages->article_id ) ;
                ?>" target="_blank"><b>&nbsp;&nbsp;<?php 
                echo  __( 'Link', 'apvc' ) ;
                ?></b></a></small>

                  </div>
                </div>
              </div>
            </div>
       	<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get top posts data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_posts_data()
    {
        global  $wpdb ;
        $top10Posts = json_decode( $this->apvc_get_top_10_posts_data() );
        ?>
		<div class="d-flex justify-content-between">
          <h4 class="card-title"><?php 
        echo  __( 'Top 10 Posts', 'apvc' ) ;
        ?></h4>
        </div>
        <?php 
        $count = 1;
        
        if ( count( $top10Posts ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( "No Posts Found", "apvc" ) . '</h5>' ;
        } else {
            foreach ( $top10Posts as $posts ) {
                ?>
        <div class="list d-flex align-items-center border-bottom py-3">
          <div class="wrapper w-100 ml-3">
            <p class="mb-0"><b><?php 
                echo  $count++ ;
                ?>.</b> <?php 
                echo  __( $posts->title, "apvc" ) ;
                ?></p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-clock text-muted mr-1"></i>
              	<small class="text-muted ml-auto"><?php 
                echo  __( 'Recent Visit:', "apvc" ) ;
                ?> <b><?php 
                echo  $this->get_recent_visit( $posts->article_id ) ;
                ?></b></small>&nbsp;
              	<small class="text-muted ml-auto"> <?php 
                echo  __( 'Total Visits:', 'apvc' ) ;
                ?> <b><?php 
                echo  __( $this->apvc_number_format( $posts->count ), "apvc" ) ;
                ?></b></small>
              	<small class="text-muted ml-auto"><a href="<?php 
                echo  get_permalink( $posts->article_id ) ;
                ?>" target="_blank"><b>&nbsp;&nbsp;<?php 
                echo  __( 'Link', 'apvc' ) ;
                ?></b></a></small>

              </div>
            </div>
          </div>
        </div>
    	<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get top countries data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_countries_data()
    {
        global  $wpdb ;
        $top10Country = json_decode( $this->apvc_get_top_10_contries_data() );
        ?>
		<div class="d-flex justify-content-between">
          <h4 class="card-title"><?php 
        echo  __( 'Top 10 Country', 'apvc' ) ;
        ?></h4>
        </div>
        <?php 
        $count = 1;
        
        if ( count( $top10Country ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( "No Countries Found", "apvc" ) . '</h5>' ;
        } else {
            foreach ( $top10Country as $country ) {
                ?>
        <div class="list d-flex align-items-center border-bottom py-3">
          <div class="wrapper w-100 ml-3">
            <p class="mb-0"><b><?php 
                echo  $count++ ;
                ?>.</b> <?php 
                echo  __( $country->country, "apvc" ) ;
                ?>
            	
            <img width="20px" src="<?php 
                echo  plugin_dir_url( __FILE__ ) . "/images/flags/" . strtolower( $this->get_country_name( $country->country ) ) ;
                ?>.svg" alt="<?php 
                echo  $country->country ;
                ?>" title="<?php 
                echo  $country->country ;
                ?>">
        	</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-clock text-muted mr-1"></i>
              	<small class="text-muted ml-auto"><?php 
                echo  __( 'Recent Visit:', "apvc" ) ;
                ?> <b><?php 
                echo  $this->get_recent_visit( $country->article_id ) ;
                ?></b></small>&nbsp;
              	<small class="text-muted ml-auto"> <?php 
                echo  __( 'Total Visits:', 'apvc' ) ;
                ?> <b><?php 
                echo  __( $this->apvc_number_format( $country->count ), "apvc" ) ;
                ?></b></small>
              	<small class="text-muted ml-auto"><a href="<?php 
                echo  get_permalink( $country->article_id ) ;
                ?>" target="_blank"><b>&nbsp;&nbsp;<?php 
                echo  __( 'Link', 'apvc' ) ;
                ?></b></a></small>

              </div>
            </div>
          </div>
        </div>
    	<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get top ip address data.
     *
     * @since    3.0.1
     */
    public function apvc_get_top_ip_address_data()
    {
        global  $wpdb ;
        $top10IPAddress = json_decode( $this->apvc_get_top_10_ip_address_data() );
        ?>
		<div class="d-flex justify-content-between">
          <h4 class="card-title"><?php 
        echo  __( 'Top 10 IP Addresses', 'apvc' ) ;
        ?></h4>
        </div>
        <?php 
        $count = 1;
        
        if ( count( $top10IPAddress ) <= 0 ) {
            echo  '<h5 class="text-center">' . __( "No IP Address Data Found", "apvc" ) . '</h5>' ;
        } else {
            foreach ( $top10IPAddress as $ip_address ) {
                ?>
        <div class="list d-flex align-items-center border-bottom py-3">
          <div class="wrapper w-100 ml-3">
            <p class="mb-0"><b><?php 
                echo  $count++ ;
                ?>.</b> <?php 
                echo  __( $ip_address->ip_address, "apvc" ) ;
                ?>
            <img width="20px" src="<?php 
                echo  plugin_dir_url( __FILE__ ) . "/images/flags/" . strtolower( $this->get_country_name( $ip_address->country ) ) ;
                ?>.svg" alt="<?php 
                echo  $this->get_country_name( $ip_address->country ) ;
                ?>" title="<?php 
                echo  $this->get_country_name( $ip_address->country ) ;
                ?>">
            </p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-clock text-muted mr-1"></i>
              	<small class="text-muted ml-auto"><?php 
                echo  __( 'Recent Visit:', "apvc" ) ;
                ?> <b><?php 
                echo  $this->get_recent_visit( $ip_address->ip_address, "ip_address" ) ;
                ?></b></small>&nbsp;
              	<small class="text-muted ml-auto"> <?php 
                echo  __( 'Total Visits:', 'apvc' ) ;
                ?> <b><?php 
                echo  __( $this->apvc_number_format( $ip_address->count ), "apvc" ) ;
                ?></b></small>
              	<small class="text-muted ml-auto"><a href="<?php 
                echo  get_permalink( $ip_address->article_id ) ;
                ?>" target="_blank"><b>&nbsp;&nbsp;<?php 
                echo  __( 'Link', 'apvc' ) ;
                ?></b></a></small>
              	
              </div>
            </div>
          </div>
        </div>
    	<?php 
            }
        }
        
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get trending pages data.
     *
     * @since    3.0.1
     */
    public function apvc_top_trending_content()
    {
        global  $wpdb ;
        ?>
		<input type="hidden" id="current_page" value="trending">
		<div class="container-fluid page-body-wrapper trending">
			<div class="main-panel container">
				<div class="content-wrapper">
					<div class="row">
						<?php 
        ?>
						
						<div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
							<div class="card">
					          <div class="card-body" id="apvc_top_pages_data">
					          	<?php 
        $this->apvc_loader_control();
        ?>
					          </div>
       						</div>
				        </div>
				        <div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
				            <div class="card">
				              <div class="card-body" id="apvc_top_posts_data">
				                <?php 
        $this->apvc_loader_control();
        ?>
				              </div>
				            </div>
				        </div>
				        <div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
				            <div class="card">
				              <div class="card-body" id="apvc_top_countries_data">
				              	<?php 
        $this->apvc_loader_control();
        ?>
				              </div>
				            </div>
				        </div>
				        <div class="col-12 col-md-12 col-lg-6 grid-margin stretch-card">
				            <div class="card">
				              <div class="card-body" id="apvc_top_ip_address_data">
				                <?php 
        $this->apvc_loader_control();
        ?>
				              </div>
				            </div>
				        </div>
          			</div>
          		</div>
          	</div>
          </div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get reports page data.
     *
     * @since    3.0.0
     */
    public function apvc_reports_page_content()
    {
        global  $wpdb ;
        
        if ( isset( $_GET['pageno'] ) ) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        
        $per_page = ( $_GET['per_page'] ? $_GET['per_page'] : 10 );
        $offset = ($pageno - 1) * $per_page;
        $apvcReports = json_decode( $this->get_the_reports( $offset, $per_page ) );
        $total_pages = ceil( $apvcReports->totalCount / $per_page );
        $dropDown = "";
        
        if ( $pageno == 0 ) {
            $rCnt = 1;
        } else {
            $rCnt = intval( $per_page ) * intval( $pageno - 1 ) + 1;
        }
        
        ?>
		<div class="container-fluid page-body-wrapper general-reports">
			<div class="main-panel container">
			  <div class="content-wrapper">
			  	<div class="row grid-margin">
			  		<?php 
        ?>
			  	</div>
			    <div class="card report_card col-md-12">
			      <div class="card-body">
			        <div class="row">
			          <div class=" table-responsive">
			          	<div class="apvc-detailed-filters">
				        	<div class="dropdown">
		                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php 
        echo  __( 'Articles Per Page - ' . $per_page, "apvc" ) ;
        ?></button>
		                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=10<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "10", "apvc" ) ;
        ?></a>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=20<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "20", "apvc" ) ;
        ?></a>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=50<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "50", "apvc" ) ;
        ?></a>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=100<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "100", "apvc" ) ;
        ?></a>
		                          <div class="dropdown-divider"></div>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=500<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "500", "apvc" ) ;
        ?></a>
		                        </div>
		                    </div>
	                    </div>
			            <table id="reports-listinga" class="table">
			              <thead>
			                <tr>
			                  <th><?php 
        echo  __( "No.", "apvc" ) ;
        ?></th>
			                  <th><?php 
        echo  __( "Article ID", "apvc" ) ;
        ?></th>
			                  <th><?php 
        echo  __( "Article Title", "apvc" ) ;
        ?></th>
			                  <th><?php 
        echo  __( "Total Visits Count", "apvc" ) ;
        ?></th>
			                  <th><?php 
        echo  __( "Detailed Report", "apvc" ) ;
        ?></th>
			                  <th><?php 
        echo  __( "Chart", "apvc" ) ;
        ?></th>
			                  <th><?php 
        echo  __( "Set Starting Count", "apvc" ) ;
        ?></th>
			                  <th><?php 
        echo  __( "Reset Count", "apvc" ) ;
        ?></th>
			                </tr>
			              </thead>
			              <tbody>
			              	<?php 
        foreach ( $apvcReports->list as $reports ) {
            echo  '<tr>
			              				  <td>' . $rCnt++ . '</td>
						                  <td>' . $reports->article_id . '</td>
						                  <td><div class="apvc_title">' . __( $reports->title, "apvc" ) . '</div></td>
						                  <td>' . $this->apvc_number_format( $reports->count ) . '</td>
						                  <td>
						                    <a href="' . get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=" . $reports->article_id . $dropDown . "" ) . '" class="btn btn-outline-primary">' . __( 'View', "apvc" ) . '</a>
						                  </td>
						                  <td>
						                    <a href="' . get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page&apvc_page=detailed-reports-chart&article_id=" . $reports->article_id . $dropDown . "" ) . '" class="btn btn-outline-primary">' . __( 'View Chart', "apvc" ) . '</a>
						                  </td>
						                  <td>
						                    <a href="javascript:void(0);" art_id="' . $reports->article_id . '" class="btn btn-outline-primary set_start_cnt" data-toggle="modal" data-target="#setCnt"><i class="link-icon mdi mdi-clock"></i></a>
						                  </td>
						                  <td>
						                    <a href="javascript:void(0);" art_id="' . $reports->article_id . '" class="btn btn-outline-primary btn-red reset_cnt" data-toggle="modal" data-target="#resetCnt">X</a>
						                  </td>
						                </tr>' ;
        }
        ?>
			                
			              </tbody>
			            </table>

			            <nav>
							<ul class="pagination d-flex justify-content-center">
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=1<?php 
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'First', "apvc" ) ;
        ?></a></li>
								<li class="page-item <?php 
        if ( $pageno <= 1 ) {
            echo  'disabled' ;
        }
        ?>">
								    <a class="page-link" href="<?php 
        
        if ( $pageno <= 1 ) {
            echo  '#' ;
        } else {
            echo  "?page=apvc-dashboard-page&apvc_page=reports&pageno=" . ($pageno - 1) ;
        }
        
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'Prev', "apvc" ) ;
        ?></a>
								</li>
								<li class="page-item <?php 
        if ( $pageno >= $total_pages ) {
            echo  'disabled' ;
        }
        ?>">
								    <a class="page-link" href="<?php 
        
        if ( $pageno >= $total_pages ) {
            echo  '#' ;
        } else {
            echo  "?page=apvc-dashboard-page&apvc_page=reports&pageno=" . ($pageno + 1) ;
        }
        
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'Next', "apvc" ) ;
        ?></a>
								</li>
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=reports&pageno=<?php 
        echo  $total_pages ;
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'Last', "apvc" ) ;
        ?> (<?php 
        echo  $total_pages ;
        ?>)</a></li>
							</ul>
                    	</nav>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>


		<div class="modal fade" id="setCnt" style="top:10%;" tabindex="-1" role="dialog" aria-labelledby="setCnt" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h5 class="modal-title"><?php 
        _e( "Set Starting Count", "apvc" );
        ?></h5>
              </div>
              <div class="modal-body setCntPreview" style="padding: 10px 25px;">
              	<?php 
        $this->apvc_loader_control();
        ?>
              </div>
              <div class="modal-footer text-center">
              	<button type="button" class="btn btn-primary setCntSaveBtn"><?php 
        _e( "Save Changes", "apvc" );
        ?></button>
                <button type="button" class="setCntCloseBtn btn btn-warning"><?php 
        _e( "Cancel", "apvc" );
        ?></button>
              </div>
              
            </div>
          </div>
        </div>

        <div class="modal fade" id="resetCnt" style="top:10%;" tabindex="-1" role="dialog" aria-labelledby="resetCnt" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body text-center" style="padding: 50px">

              	<?php 
        _e( "Are you sure to delete/reset count for this article? <Br />(This is impossible to revert.)", "apvc" );
        ?><Br /><Br />
              	<button type="button" id="art_id_btn" art_id="" class="btn btn-primary resetCnt"><?php 
        _e( "Yes", "apvc" );
        ?></button>
                <button type="button" class="resetCloseBtn btn btn-warning"><?php 
        _e( "No", "apvc" );
        ?></button>
                <Br />
              </div>
            </div>
          </div>
        </div>


		<?php 
    }
    
    public function apvc_reset_count_art()
    {
        global  $wpdb ;
        $history_table = $wpdb->prefix . "avc_page_visit_history";
        $art_id = $_REQUEST["artID"];
        
        if ( $wpdb->query( "DELETE FROM {$history_table} WHERE article_id={$art_id}" ) ) {
            echo  wp_send_json_success( "success" ) ;
        } else {
            echo  wp_send_json_error() ;
        }
        
        wp_die();
    }
    
    public function apvc_show_counter_options()
    {
        global  $wpdb ;
        $art_id = $_REQUEST['artID'];
        $active = get_post_meta( $art_id, "apvc_active_counter", true );
        $base_count = get_post_meta( $art_id, "count_start_from", true );
        $widget_label = get_post_meta( $art_id, "widget_label", true );
        ?>
		<style>p{ margin: 15px 0px 10px 0px; }</style>
      	<div class="apvc_meta_box_fields">
      		<input type="hidden" name="art_id" value="<?php 
        echo  $art_id ;
        ?>">
	        <div class="apvc_start_cnt">
	            <p><?php 
        echo  __( "Active Page Visit Counter for this Article?" ) ;
        ?></p>
	            <input type="radio" value="Yes" <?php 
        if ( $active == "Yes" ) {
            echo  "checked" ;
        }
        ?> name="apvc_active_counter"><?php 
        echo  __( "Yes" ) ;
        ?>
	            <input type="radio" value="No" <?php 
        if ( $active == "No" ) {
            echo  "checked" ;
        }
        ?> name="apvc_active_counter"><?php 
        echo  __( "No" ) ;
        ?>
	        </div>
	        <div class="apvc_base_count">
	            <p><?php 
        echo  __( "Start Counting from. Enter any number from where you want to start counting." ) ;
        ?></p>
	            <input style="width: 100%" type="number" name="count_start_from" value="<?php 
        echo  $base_count ;
        ?>" placeholder="Enter Base Count to start">
	        </div>
	        <div class="apvc_label">
	            <p><?php 
        echo  __( "Widget Label" ) ;
        ?></p>
	            <input style="width: 100%" type="text" name="widget_label" value="<?php 
        echo  $widget_label ;
        ?>" placeholder="Enter Label for Widget">
	        </div>
	    </div>
		<?php 
        wp_die();
    }
    
    public function apvc_save_start_counter_op()
    {
        global  $wpdb ;
        $post_id = $_REQUEST['art_id'];
        $apvc_active_counter = ( $_REQUEST['cnt_act'] ? $_REQUEST['cnt_act'] : "Yes" );
        $count_start_from = $_REQUEST['start_from'];
        $widget_label = $_REQUEST['wid_label'];
        update_post_meta( $post_id, "apvc_active_counter", $apvc_active_counter );
        update_post_meta( $post_id, "count_start_from", $count_start_from );
        update_post_meta( $post_id, "widget_label", $widget_label );
        echo  wp_send_json_success( "success" ) ;
        wp_die();
    }
    
    /**
     * Advanced Page Visit Counter Get detailed reports.
     *
     * @since    3.0.1
     */
    public function apvc_detailed_reports_page_content()
    {
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        $dropDown = "";
        $g_checked = ( $_REQUEST['u_g'] == 'on' ? "checked" : "" );
        $rg_checked = ( $_REQUEST['u_r'] == 'on' ? "checked" : "" );
        
        if ( isset( $_GET['pageno'] ) ) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        
        $per_page = ( $_GET['per_page'] ? $_GET['per_page'] : 20 );
        $offset = ($pageno - 1) * $per_page;
        $article_id = ( $_GET['article_id'] ? $_GET['article_id'] : "" );
        $apvcDetailed = json_decode( $this->get_the_detailed_reports( $article_id, $offset, $per_page ) );
        $total_pages = ceil( $apvcDetailed->totalCount / $per_page );
        
        if ( $pageno == 0 ) {
            $cnt = 1;
        } else {
            $cnt = intval( $per_page ) * intval( $pageno - 1 ) + 1;
        }
        
        ?>
		<input type="hidden" id="current_page" value="detailed-reports">
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel container">
			  <div class="content-wrapper">
			  	
			  	<?php 
        ?>
				
			    <div class="card report_card col-md-12">
			      <div class="card-body">
			        <div class="row">
			        	<div class="apvc-detailed-filters">
				        	<div class="dropdown">
		                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php 
        echo  __( 'Articles Per Page - ' . $per_page, "apvc" ) ;
        ?></button>
		                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start">
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  $article_id ;
        ?>&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=10<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "10", "apvc" ) ;
        ?></a>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  $article_id ;
        ?>&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=20<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "20", "apvc" ) ;
        ?></a>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  $article_id ;
        ?>&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=50<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "50", "apvc" ) ;
        ?></a>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  $article_id ;
        ?>&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=100<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "100", "apvc" ) ;
        ?></a>
		                          <div class="dropdown-divider"></div>
		                          <a class="dropdown-item" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  $article_id ;
        ?>&pageno=<?php 
        echo  $pageno ;
        ?>&per_page=500<?php 
        echo  $dropDown ;
        ?>"><?php 
        echo  __( "500", "apvc" ) ;
        ?></a>
		                        </div>
		                    </div>
		                     <a type="button" href="?page=apvc-dashboard-page&apvc_page=reports" class="btn btn-primary btn-fw buttona"><i class="mdi mdi-arrow-left-bold-circle"></i><?php 
        echo  __( "Back To Reports", "apvc" ) ;
        ?></a>
	                    </div>
			          <div class=" table-responsive">
			            <table id="reports-listing-detailed" class="table">
			              <thead>
			                <tr>
			                  <th><?php 
        _e( "No.", "apvc" );
        ?></th>
			                  <th><?php 
        _e( "Article Title", "apvc" );
        ?></th>
			                  <th><?php 
        _e( "Article Type", "apvc" );
        ?></th>
			                  <th><?php 
        _e( "User Type", "apvc" );
        ?></th>
			                  <th><?php 
        _e( "Visited Date", "apvc" );
        ?></th>
			                  <th><?php 
        _e( "IP Address", "apvc" );
        ?></th>
			                  <th><?php 
        _e( "Browser Info", "apvc" );
        ?></th>
			                  <th><?php 
        _e( "Referrer URL", "apvc" );
        ?></th>
			                </tr>
			              </thead>
			              <tbody>
			              	<?php 
        
        if ( count( $apvcDetailed->list ) > 0 ) {
            foreach ( $apvcDetailed->list as $reports ) {
                $preBlock = "";
                $preBlock = '<br/><span style="color:red;">' . __( "State: ", "apvc" ) . '</span><span>Premium</span><br/><span style="color:red;">' . __( "City: ", "apvc" ) . '</span><span>Premium</span>';
                echo  '<tr>
						                  <td>' . $cnt++ . '</td>
						                  <td><div class="ap_width">' . __( $reports->title, "apvc" ) . '</div></td>
						                  <td>' . ucfirst( __( $reports->article_type, "apvc" ) ) . '</td>
						                  <td>' . __( $reports->user_type, "apvc" ) . '</td>
						                  <td>' . __( $reports->date, "apvc" ) . '</td>
						                  <td><div class="ap_width">' . __( $reports->ip_address, "apvc" ) . '</div></td>
						                  <td class="apvc_geo_stats"><span style="color:#007bff;">' . __( "Browser: ", "apvc" ) . '</span>' . ucwords( $reports->browser_short_name ) . '<br /><span style="color:#d84545;">' . __( "OS: ", "apvc" ) . '</span>' . ucwords( $reports->operating_system ) . '<br /><span style="color:#b93db5;">' . __( "Device: ", "apvc" ) . '</span>' . ucwords( $reports->device_type ) . '<br /><span style="color:#d84545;">' . __( "Country: ", "apvc" ) . '</span>' . ucwords( $reports->country ) . '' . $preBlock . '</td>
						                  <td><div class="ap_width">' . __( $reports->http_referer_clean, "apvc" ) . '<br/><a href="' . $reports->http_referer . '" target="_blank"><small class="text-muted" styword-break: break-word;">' . __( $reports->http_referer, "apvc" ) . '</small></a></div></td>
						                </tr>' ;
            }
        } else {
            echo  '<tr><td colspan="8" class="text-center">No Records Found</td></tr>' ;
        }
        
        ?>
			                
			              </tbody>
			            </table>

			            <nav>
							<ul class="pagination d-flex justify-content-center">
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  $article_id ;
        ?>&pageno=1<?php 
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'First', "apvc" ) ;
        ?></a></li>
								<li class="page-item <?php 
        if ( $pageno <= 1 ) {
            echo  'disabled' ;
        }
        ?>">
								    <a class="page-link" href="<?php 
        
        if ( $pageno <= 1 ) {
            echo  '#' ;
        } else {
            echo  "?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=" . $article_id . "&pageno=" . ($pageno - 1) ;
        }
        
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'Prev', "apvc" ) ;
        ?></a>
								</li>
								<li class="page-item <?php 
        if ( $pageno >= $total_pages ) {
            echo  'disabled' ;
        }
        ?>">
								    <a class="page-link" href="<?php 
        
        if ( $pageno >= $total_pages ) {
            echo  '#' ;
        } else {
            echo  "?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=" . $article_id . "&pageno=" . ($pageno + 1) ;
        }
        
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'Next', "apvc" ) ;
        ?></a>
								</li>
								<li class="page-item"><a class="page-link" href="?page=apvc-dashboard-page&apvc_page=detailed-reports&article_id=<?php 
        echo  $article_id ;
        ?>&pageno=<?php 
        echo  $total_pages ;
        echo  $per_page_var ;
        ?>"><?php 
        echo  __( 'Last', "apvc" ) ;
        ?> (<?php 
        echo  $total_pages ;
        ?>)</a></li>
							</ul>
	                    </nav>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Get dashboard page.
     *
     * @since    3.0.1
     */
    public function apvc_dashboard_page()
    {
        global  $wpdb ;
        $noticeBoard = trim( get_option( "apvc_notice" ) );
        $history_table = $wpdb->prefix . "avc_page_visit_history";
        $rows = $wpdb->get_results( "SHOW COLUMNS FROM {$history_table} LIKE 'article_title'" );
        
        if ( count( $rows ) > 0 ) {
            ?>
		<div class="content-wrapper">
			<div class="row">
				<div class="col-lg-8 grid-margin stretch-card">
					<div class="card"  style="border: 2px solid #2196f3; border-radius: 5px;">
						<div class="card-body">
							<h4 style="color: red;">Database Upgrade required...</h4>
							<h6>Click on below button to upgrade the database.</h6>
							<button id="apvc_update_db" class="btn btn-icons btn-primary float-left" style="width: 200px">Click to upgrade...</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
        } else {
            if ( isset( $_GET['clr'] ) && $_GET['clr'] == 'yes' ) {
                update_option( 'apvc_notice', 'yes' );
            }
            ?>
			<div class="container-scroller hidden-xs">
				<nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
			        <div class="container d-flex flex-row nav-top">
			          <div class="text-center navbar-brand-wrapper d-flex align-items-top">
			            <a class="navbar-brand brand-logo" href="admin.php?page=apvc-dashboard-page">
			              <img src="<?php 
            echo  plugin_dir_url( __FILE__ ) . "/images/apvc-logo.svg" ;
            ?>" alt="logo"> </a>
			          </div>
			        </div>
			        <div class="nav-bottom">
			          <div class="container">
			            <ul class="nav page-navigation">
			              <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && $_GET['apvc_page'] == '' ? "menu-active" : "" ) ;
            ?>">
			                <a href="<?php 
            echo  get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page" ) ;
            ?>" class="nav-link">
			                  <i class="link-icon mdi mdi-airplay"></i>
			                  <span class="menu-title"><?php 
            echo  __( "Dashboard", "apvc" ) ;
            ?></span>
			                </a>
			              </li>
			              <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && $_GET['apvc_page'] == 'trending' ? "menu-active" : "" ) ;
            ?>">
			                <a href="<?php 
            echo  get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page&apvc_page=trending" ) ;
            ?>" class="nav-link">
			                  <i class="link-icon mdi mdi-chart-line"></i>
			                  <span class="menu-title"><?php 
            echo  __( "Trending", "apvc" ) ;
            ?></span>
			                </a>
			              </li>
			              <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && $_GET['apvc_page'] == 'reports' || $_GET['apvc_page'] == 'detailed-reports' ? "menu-active" : "" ) ;
            ?>">
			                <a href="<?php 
            echo  get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page&apvc_page=reports" ) ;
            ?>" class="nav-link">
			                  <i class="link-icon mdi mdi-content-copy"></i>
			                  <span class="menu-title"><?php 
            echo  __( "Reports", "apvc" ) ;
            ?></span>
			                </a>
			                <?php 
            ?>
			            	<div class="submenu ">
			                  <ul class="submenu-item ">
				                    <li class="nav-item ">
				                      	<a href="#" class="nav-link">
					                  		<?php 
            echo  __( "Reports Country Wise <Br /><span style='color:red;'>Premium Only</span>", "apvc" ) ;
            ?>
					                	</a>
				                    </li>
			                  </ul>
			                </div>
			            	<?php 
            ?>
			            	
			              </li>
			              <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && $_GET['apvc_page'] == 'shortcode_generator' || $_GET['apvc_page'] == 'shortcode_library' ? "menu-active" : "" ) ;
            ?>">
			                <a href="<?php 
            echo  get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page&apvc_page=shortcode_generator" ) ;
            ?>" class="nav-link">
			                  <i class="link-icon mdi mdi-palette"></i>
			                  <span class="menu-title"><?php 
            echo  __( "Shortcode Generator", "apvc" ) ;
            ?></span>
			                </a>
			                <div class="submenu ">
			                  <ul class="submenu-item ">
			                    <li class="nav-item ">
			                      <a href="<?php 
            echo  get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page&apvc_page=shortcode_library" ) ;
            ?>" class="nav-link">
				                  <?php 
            echo  __( "Shortcode Library", "apvc" ) ;
            ?>
				                </a>
			                    </li>
			                  </ul>
			                </div>
			              </li>
			              <li class="nav-item <?php 
            echo  ( $_GET['page'] == 'apvc-dashboard-page' && $_GET['apvc_page'] == 'settings' ? "menu-active" : "" ) ;
            ?>">
			                <a href="<?php 
            echo  get_admin_url( get_current_blog_id(), "admin.php?page=apvc-dashboard-page&apvc_page=settings" ) ;
            ?>" class="nav-link">
			                  <i class="link-icon mdi mdi-settings-box"></i>
			                  <span class="menu-title"><?php 
            echo  __( "Settings", "apvc" ) ;
            ?></span>
			                </a>
			              </li>
			              <?php 
            ?>
			            </ul>
			          </div>
			        </div>
			      </nav>
			</div>
			<?php 
            
            if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'trending' ) {
                $this->apvc_top_trending_content();
            } else {
                
                if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'reports' && !isset( $_GET['article_id'] ) ) {
                    $this->apvc_reports_page_content();
                } else {
                    
                    if ( isset( $_GET['apvc_page'] ) && isset( $_GET['article_id'] ) && $_GET['apvc_page'] === 'detailed-reports' && $_GET['article_id'] != '' ) {
                        $this->apvc_detailed_reports_page_content();
                    } else {
                        
                        if ( isset( $_GET['apvc_page'] ) && isset( $_GET['article_id'] ) && $_GET['apvc_page'] === 'detailed-reports-chart' && $_GET['article_id'] != '' ) {
                            $this->apvc_detailed_reports_on_chart();
                        } else {
                            
                            if ( isset( $_GET['apvc_page'] ) && isset( $_GET['article_id'] ) && $_GET['apvc_page'] === 'country_reports-detailed' && $_GET['article_id'] != '' ) {
                                $this->apvc_detailed_reports_for_the_country_content__premium_only();
                            } else {
                                
                                if ( isset( $_GET['apvc_page'] ) && isset( $_GET['country'] ) && $_GET['apvc_page'] === 'country_reports-list' && $_GET['country'] != '' ) {
                                    $this->country_reports_in_detailed__premium_only();
                                } else {
                                    
                                    if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'settings' ) {
                                        $this->apvc_reports_settings_page();
                                    } else {
                                        
                                        if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'country_reports' ) {
                                            $this->country_reports__premium_only();
                                        } else {
                                            
                                            if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'shortcode_generator' ) {
                                                $this->apvc_shortcode_generator_page();
                                            } else {
                                                
                                                if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'export_data' ) {
                                                    $this->apvc_export_data_page__premium_only();
                                                } else {
                                                    
                                                    if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'import_data' ) {
                                                        $this->apvc_import_data_page__premium_only();
                                                    } else {
                                                        
                                                        if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'cleanup_data' ) {
                                                            $this->apvc_cleanup_data_page__premium_only();
                                                        } else {
                                                            
                                                            if ( isset( $_GET['apvc_page'] ) && $_GET['apvc_page'] === 'shortcode_library' ) {
                                                                $this->apvc_shortcode_library();
                                                            } else {
                                                                $this->apvc_settings_page_content();
                                                            }
                                                        
                                                        }
                                                    
                                                    }
                                                
                                                }
                                            
                                            }
                                        
                                        }
                                    
                                    }
                                
                                }
                            
                            }
                        
                        }
                    
                    }
                
                }
            
            }
            
            ?>
		<footer class="footer">
	        <div class="container clearfix">
	          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><?php 
            echo  __( "Hand-crafted & made with", "apvc" ) ;
            ?> <i class="mdi mdi-heart text-danger"></i>&nbsp; <a class="text-danger" href="https://pagevisitcounter.com" target="_blank"><?php 
            echo  __( "Page Visit Counter", "apvc" ) ;
            ?></a>
	          </span>
	        </div>
	    </footer>
		<?php 
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Get Premier Features.
     *
     * @since    3.0.1
     */
    public function apvc_get_premium_features_block()
    {
        echo  '<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body"><h4 class="text-center">' . __( 'OUR GREAT PLUGINS', 'apvc' ) . '</h4>' ;
        ?>
					<ul>
						<li>
							<strong>1.</strong> <a href="https://wordpress.org/plugins/hide-admin-bar-based-on-user-roles/" target="_blank"><?php 
        _e( "Hide Admin Bar Based on User Roles", "apvc" );
        ?></a><br /><p class="text-muted">This plugin is very useful to hide admin bar based on selected user roles and user capabilities.</p>
						</li>
						<li>
							<strong>2.</strong> <a href="https://wordpress.org/plugins/disable-block-editor-fullscreen-mode/" target="_blank"><?php 
        _e( "Disable Block Editor FullScreen mode", "apvc" );
        ?></a><br /><p class="text-muted">This plugin is useful to Disable Block Editor default FullScreen mode in Latest WordPress 5.4+</p>
						</li>
						<li>
							<strong>3.</strong> <a href="https://wordpress.org/plugins/blog-security-auditor/" target="_blank"><?php 
        _e( "Blog Security Auditor", "apvc" );
        ?></a><br /><p class="text-muted">This plugin audits your site for specific security related checkpoints.</p>
						</li>
					</ul>
					<div class="text-center">
						<h5 class="text-center">Checkout our website for special promo offers and discounts.</h5>
						<a href="https://pagevisitcounter.com" target="_blank" class="btn btn-primary btn-fw"><i class="mdi mdi-heart-outline"></i>Visit Now</a>
					</div>
					<?php 
        echo  '
	    			</div>
				</div>
			</div>' ;
    }
    
    /**
     * Advanced Page Visit Counter Get reports settings data.
     *
     * @since    3.0.1
     */
    public function apvc_reports_settings_page()
    {
        global  $wpdb, $post ;
        $avc_config = (object) get_option( "apvc_configurations", true );
        ?>
		<div class="container page-body-wrapper avpc-settings-page">
		    <div class="main-panel container"><br />
		      <div class="content-wrapper">
			        <div class="col-lg-12 grid-margin stretch-card">
		                <div class="card">
		                  <div class="card-body">
		                  	<ul class="nav nav-tabs tab-basic" role="tablist">
					          <li class="nav-item">
					            <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basicSettings" role="tab" aria-controls="basicSettings" aria-selected="true"><?php 
        echo  _e( "Basic Settings", "apvc" ) ;
        ?></a>
					          </li>
					          
					          <li class="nav-item">
					            <a class="nav-link" id="widget-tab" data-toggle="tab" href="#widgetTab" role="tab" aria-controls="widgetTab" aria-selected="false"><?php 
        echo  _e( "Widget Settings", "apvc" ) ;
        ?></a>
					          </li>
					          <li class="nav-item">
					            <a class="nav-link" id="widget-v-tab" data-toggle="tab" href="#widgetVTab" role="tab" aria-controls="widgetVTab" aria-selected="false"><?php 
        echo  _e( "Widget Visibility Settings", "apvc" ) ;
        ?></a>
					          </li>
					          <li class="nav-item">
					            <a class="nav-link" id="premium-tab" data-toggle="tab" href="#premiumSettings" role="tab" aria-controls="premiumSettings" aria-selected="false"><?php 
        echo  _e( "Premium Settings", "apvc" ) ;
        ?></a>
					          </li>
					          <li class="nav-item">
					            <a class="nav-link" id="widget_templates-tab" data-toggle="tab" href="#widTemplates" role="tab" aria-controls="widTemplates" aria-selected="false"><?php 
        echo  _e( "Widget Templates", "apvc" ) ;
        ?></a>
					          </li>
					          <li class="nav-item">
					            <a class="nav-link" id="advancedSettings-tab" data-toggle="tab" href="#adSettings" role="tab" aria-controls="adSettings" aria-selected="false"><?php 
        echo  _e( "Advanced Settings", "apvc" ) ;
        ?></a>
					          </li>


					        </ul>

		                  	<?php 
        
        if ( isset( $_GET['m'] ) && $_GET['m'] === 'success' && !isset( $_GET['t'] ) ) {
            echo  '<div class="alert alert-success mt-5" role="alert">' . __( "Settings have been saved successfully", "apvc" ) . '</div>' ;
        } else {
            if ( isset( $_GET['m'] ) && $_GET['m'] === 'success' && isset( $_GET['t'] ) && $_GET['t'] === 'reset' ) {
                echo  '<div class="alert alert-success mt-5" role="alert">' . __( "Settings reset successfully.", "apvc" ) . '</div>' ;
            }
        }
        
        ?>

		                 <div class="mt-5 tab-content tab-content-basic"><!--- Simple Div End -->
		                    <form class="form-sample" id="apvc_settings_form">
		                      <div class="row tab-pane fade show active" id="basicSettings" role="tabpanel" aria-labelledby="basic-tab" aria-selected="true">
		                        <div class="row">
			                        <div class="col-md-6">
			                          <div class="form-group card-body">
				                          <label><?php 
        echo  __( "Post Types", "apvc" ) ;
        ?></label>
				                          <select id="apvc_post_types" name="apvc_post_types" class="apvc-post-types-select" multiple="multiple" style="width:100%">
				                          <?php 
        $avc_post_types = get_post_types();
        foreach ( $avc_post_types as $avc_pt ) {
            
            if ( in_array( $avc_pt, $avc_config->apvc_post_types ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = "";
            }
            
            echo  '<option value="' . esc_html( $avc_pt ) . '" ' . $selected . '>' . esc_html( $avc_pt ) . '</option>' ;
        }
        ?>
				                          </select>
				                        </div>
			                        </div>

			                        <div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
				                          	<label><?php 
        echo  __( "Exclude User", "apvc" ) ;
        ?></label>
					                         <select id="apvc_exclude_users" name="apvc_exclude_users" class="apvc-post-types-select" multiple="multiple" style="width:100%">
				                          <?php 
        $avc_users = get_users();
        foreach ( $avc_users as $avc_usr ) {
            
            if ( in_array( $avc_usr->ID, $avc_config->apvc_exclude_users ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = "";
            }
            
            echo  '<option value="' . esc_html( $avc_usr->ID ) . '" ' . $selected . '>' . esc_html( $avc_usr->display_name ) . '</option>' ;
        }
        ?>
				                          </select>
					                      </div>
					                  </div>
			                        </div>



			                        
		                        </div>
		                        <div class="row">
			                        <div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
				                          	<label><?php 
        echo  __( "Exclude Post/Pages Counts", "apvc" ) ;
        ?></label>
					                        <input name="apvc_exclude_counts" id="apvc_exclude_counts" value="<?php 
        echo  ( !empty($avc_config->apvc_exclude_counts) ? implode( ",", $avc_config->apvc_exclude_counts ) : '' ) ;
        ?>" />

					                      </div>
					                  </div>
			                        </div>
			                        <div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
				                          	<label><?php 
        echo  __( "Exclude Showing Counter Widget on Pages/Posts", "apvc" ) ;
        ?></label>
					                        <input name="apvc_exclude_show_counter" id="apvc_exclude_show_counter" value="<?php 
        echo  ( !empty($avc_config->apvc_exclude_show_counter) ? implode( ",", $avc_config->apvc_exclude_show_counter ) : '' ) ;
        ?>" />
					                      </div>
					                  </div>
			                        </div>
			                    </div>
			                    <div class="row">

			                    	<div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
				                          	<label><?php 
        echo  __( "Exclude IP Addresses", "apvc" ) ;
        ?></label>
					                        <input name="apvc_ip_address" id="apvc_ip_address" value="<?php 
        echo  ( !empty($avc_config->apvc_ip_address) ? implode( ",", $avc_config->apvc_ip_address ) : '' ) ;
        ?>" />
					                        <small class="text-muted">
					                        	<?php 
        _e( "Now exclude ip address by adding ranges.\n\t\t\t\t\t                        \t<br /><b>1.</b> 192.168.0.* (This exclude ip address range from 192.168.0.0 to 192.168.0.255)<br /><b>2.</b> 192.168.0.10/20 (This exclude ip address range from 192.168.0.10 to 192.168.0.20) <br />", "apvc" );
        ?>
					                        </small>
					                      </div>
					                  </div>
			                        </div>

			                        
			                        <div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
					                        <div class="icheck-square"><br/>
					                          <input tabindex="6" type="checkbox" id="apvc_spam_controller" name="apvc_spam_controller" <?php 
        if ( $avc_config->apvc_spam_controller[0] == "on" ) {
            echo  "checked" ;
        }
        ?>><label for="square-checkbox-2"><?php 
        echo  __( "Spam Controller", "apvc" ) ;
        ?></label>
					                          <br />
					                          <small class="text-muted"><?php 
        echo  __( "*This setting will ignore visit counts comes from spammers or continues refresh browser windows. ( by enabling this settings we count 1 visit in every 5 minutes from each ip address )", "apvc" ) ;
        ?></small>
					                        </div>
					                      </div>
					                	</div>
					            	</div>
					            </div>
		                      </div>
		                     
		                      <div class="row tab-pane" id="widgetTab" role="tabpanel" aria-labelledby="widget-tab" aria-selected="false">
		                      	<div class="col-md-12">
			                      	<div class="row">
				                      	<div class="col-md-6 col-lg-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label for="show_conter_on_front_side">
							                      	<?php 
        echo  __( "Show Counter on Front End", "apvc" ) ;
        ?>
							                      	</label><Br />
							                      <select class="form-control" id="apvc_show_conter_on_front_side" name="apvc_show_conter_on_front_side">
											      	<option value="" disabled selected><?php 
        echo  __( "Choose your option", "apvc" ) ;
        ?></option>
													<option value="disable" selected=""><?php 
        echo  __( "Hide", "apvc" ) ;
        ?></option>
											        <option value="above_the_content" <?php 
        if ( $avc_config->apvc_show_conter_on_front_side[0] == "above_the_content" ) {
            echo  "selected" ;
        }
        ?>><?php 
        echo  __( "Above the content", "apvc" ) ;
        ?></option>
											        <option value="below_the_content" <?php 
        if ( $avc_config->apvc_show_conter_on_front_side[0] == "below_the_content" ) {
            echo  "selected" ;
        }
        ?>><?php 
        echo  __( "Below the content", "apvc" ) ;
        ?></option>
											    </select>
							                    </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label for="apvc_default_text_color"><?php 
        echo  __( "Default Counter Text Color", "apvc" ) ;
        ?></label>
		                        					<input type='text' class="color-picker" id="apvc_default_text_color" name="apvc_default_text_color" value="<?php 
        echo  $avc_config->apvc_default_text_color[0] ;
        ?>" />
							                    </div>
						                    </div>
						                </div>
					                </div>
					                <div class="row">
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Default Counter Border Color", "apvc" ) ;
        ?></label>
		                        					<input id="apvc_default_border_color" name="apvc_default_border_color" type='text' class="color-picker" value="<?php 
        echo  $avc_config->apvc_default_border_color[0] ;
        ?>" id="apvc_default_border_color" />
							                    </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Default Background Color", "apvc" ) ;
        ?></label>
							                      <input id="apvc_default_background_color" name="apvc_default_background_color" value="<?php 
        echo  $avc_config->apvc_default_background_color[0] ;
        ?>" type="text" class="color-picker">
							                    </div>
						                    </div>
						                </div>
						            </div>
						            <div class="row">
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Default Border Radius", "apvc" ) ;
        ?></label>
							                      <input id="apvc_default_border_radius" name="apvc_default_border_radius" value="<?php 
        echo  $avc_config->apvc_default_border_radius[0] ;
        ?>" min="0" value="0" type="number" class="form-control">
							                    </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Default Border Width", "apvc" ) ;
        ?></label>
							                      <input id="apvc_default_border_width" name="apvc_default_border_width" min="0" value="<?php 
        echo  $avc_config->apvc_default_border_width[0] ;
        ?>" value="2" type="number" class="form-control">
							                    </div>
						                    </div>
						                </div>
						            </div>
						            <div class="row">
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Widget Alignment", "apvc" ) ;
        ?></label>
							                      <Br />
							                      <select name="apvc_wid_alignment" class="form-control" id="apvc_wid_alignment">
												      <option value="" disabled><?php 
        echo  __( "Choose your option", "apvc" ) ;
        ?></option>
														<option value="left" <?php 
        if ( $avc_config->apvc_wid_alignment[0] == "left" ) {
            echo  "selected" ;
        }
        ?> selected=""><?php 
        echo  __( "Left - Default", "apvc" ) ;
        ?></option>
												        <option value="right" <?php 
        if ( $avc_config->apvc_wid_alignment[0] == "right" ) {
            echo  "selected" ;
        }
        ?>><?php 
        echo  __( "Right", "apvc" ) ;
        ?></option>
												        <option value="center" <?php 
        if ( $avc_config->apvc_wid_alignment[0] == "center" ) {
            echo  "selected" ;
        }
        ?>><?php 
        echo  __( "Center", "apvc" ) ;
        ?></option>
												  </select>
							                    </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
												<?php 
        $width = 0;
        
        if ( !empty($avc_config->apvc_widget_width[0]) ) {
            $width = $avc_config->apvc_widget_width[0];
        } else {
            $width = 300;
        }
        
        ?>
							                      <label><?php 
        echo  __( "Width of the Widget (In Pixels)", "apvc" ) ;
        ?></label>
							                      <input id="apvc_widget_width" name="apvc_widget_width" value="<?php 
        echo  $width ;
        ?>" placeholder="Width:" type="number" min="100" step="10" class="form-control">
							                    </div>
						                    </div>
						                </div>
						            </div>
						            <div class="row">
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
												<?php 
        $padding = 0;
        
        if ( !empty($avc_config->apvc_widget_padding[0]) ) {
            $padding = $avc_config->apvc_widget_padding[0];
        } else {
            $padding = 10;
        }
        
        ?>
							                      <label><?php 
        echo  __( "Padding of the Widget (In Pixels)", "apvc" ) ;
        ?></label>
							                      <input id="apvc_widget_padding" name="apvc_widget_padding" value="<?php 
        echo  $padding ;
        ?>" placeholder="Padding:" type="number" min="1" step="1" class="form-control">
							                    </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Default Label (Total Visits of Current Page)", "apvc" ) ;
        ?></label>
							                      <input id="apvc_default_label" name="apvc_default_label" value="<?php 
        echo  $avc_config->apvc_default_label[0] ;
        ?>" placeholder="<?php 
        echo  __( "Visits:", "apvc" ) ;
        ?>" type="text" value="Visits:" class="form-control">
							                    </div>
						                    </div>
						                </div>
						            </div>	
						            <div class="row">
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Today's Count Label", "apvc" ) ;
        ?></label>
							                      <input id="apvc_todays_label" name="apvc_todays_label" value="<?php 
        echo  $avc_config->apvc_todays_label[0] ;
        ?>" placeholder="<?php 
        echo  __( "Today's Visits:", "apvc" ) ;
        ?>" type="text" value="Today:" class="form-control">
							                    </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
					                      	<div class="card-body">
												<div class="form-group">
							                      <label><?php 
        echo  __( "Total Counts Label (Global)", "apvc" ) ;
        ?></label>
							                      <input id="apvc_global_label" name="apvc_global_label" value="<?php 
        echo  $avc_config->apvc_global_label[0] ;
        ?>" placeholder="<?php 
        echo  __( "Total Visits:", "apvc" ) ;
        ?>" type="text" value="Total:" class="form-control">
							                    </div>
						                    </div>
						                </div>
						            </div>
				            	</div>
				            </div>
				            <div class="row tab-pane" id="widgetVTab" role="tabpanel" aria-labelledby="widget-v-tab" aria-selected="false">
				            	<div class="row">
					                <div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
					                        <div class="icheck-square">
					                          <input tabindex="6" type="checkbox" id="apvc_atc_page_count" name="apvc_atc_page_count" <?php 
        if ( $avc_config->apvc_atc_page_count[0] == "on" ) {
            echo  "checked" ;
        }
        ?>><label for="square-checkbox-2"><?php 
        echo  __( "Total Visits of Current Page", "apvc" ) ;
        ?></label>
					                          <br />
					                          <small class="text-muted"><?php 
        echo  __( "*This will show total counts the current page.", "apvc" ) ;
        ?></small>
					                        </div>
					                      </div>
					                	</div>
					            	</div>
					            	<div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
					                        <div class="icheck-square">
					                          <input tabindex="6" type="checkbox" id="apvc_show_global_count" name="apvc_show_global_count" <?php 
        if ( $avc_config->apvc_show_global_count[0] == "on" ) {
            echo  "checked" ;
        }
        ?>><label><?php 
        echo  __( "Show Global Total Counts", "apvc" ) ;
        ?></label>
					                          <br />
					                          <small class="text-muted"><?php 
        echo  __( "*This will show total counts for whole website.", "apvc" ) ;
        ?></small>
					                        </div>
					                      </div>
					                	</div>
					            	</div>
				            	</div>
				            	<div class="row">
					            	<div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
					                        <div class="icheck-square">
					                          <input tabindex="6" type="checkbox" id="apvc_show_today_count" name="apvc_show_today_count" <?php 
        if ( $avc_config->apvc_show_today_count[0] == "on" ) {
            echo  "checked" ;
        }
        ?>><label><?php 
        echo  __( "Show Today's Counts", "apvc" ) ;
        ?></label>
					                          <br />
					                          <small class="text-muted"><?php 
        echo  __( "*This will show total counts for whole website.", "apvc" ) ;
        ?></small>
					                        </div>
					                      </div>
					                	</div>
					            	</div>
					            </div>
				            </div>

			            	<?php 
        ?>
							<div class="row tab-pane" id="widTemplates" role="tabpanel" aria-labelledby="widget_templates-tab" aria-selected="false">
								<div class="col-md-12">
									<div class="form-group card-body">
			                          <label><?php 
        echo  __( "Widget Templates", "apvc" ) ;
        ?></label>
			                          <select id="apvc_widget_template" name="apvc_widget_template" class="apvc-counter-icon" style="width:100%">
			                          <?php 
        $shortcodes = json_decode( $this->apvc_get_shortcodes() );
        echo  '<option value="">' . __( "None", "apvc" ) . '</option>' ;
        foreach ( $shortcodes as $key => $value ) {
            
            if ( in_array( $key, $avc_config->apvc_widget_template ) ) {
                $selected = 'selected="selected"';
            } else {
                $selected = "";
            }
            
            echo  '<option value="' . esc_html( $key ) . '" ' . $selected . '> ' . ucfirst( str_replace( "_", " ", $key ) ) . '</option>' ;
        }
        ?>
			                          </select>
			                          <br />
				                      <small class="text-muted"><?php 
        echo  __( "*Check the Shortcode Library page to check the demo of all the shortcodes.<Br />*All color properties ignored if any template selected.<Br />*More than 40 templates available in the Premium version of the plugin.", "apvc" ) ;
        ?></small>
			                        </div>
								</div>
							</div>

							<div class="row tab-pane" id="adSettings" role="tabpanel" aria-labelledby="advancedSettings-tab" aria-selected="false">
								<div class="row">
					            	<div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
				                          	<label><?php 
        echo  __( "Use Cache Plugin:", "apvc" ) ;
        ?></label>
					                        <div class="icheck-square">
					                          <input tabindex="6" type="checkbox" name="cache_active" <?php 
        if ( $avc_config->cache_active[0] == "on" ) {
            echo  "checked" ;
        }
        ?>><label><?php 
        _e( "Yes", "apvc" );
        ?></label>
					                        </div>
					                        <small class="text-muted"><?php 
        echo  __( "*If you use WordPress Cache Plugins, enable this setting. <Br />*Update the permalink with press Save Changes. Don't forget to clear cache from your enabled plugin.", "apvc" ) ;
        ?></small>
					                        
					                      </div>
					                	</div>
					            	</div>
					            	<div class="col-md-6">
			                        	<div class="form-group">
				                          <div class="card-body">
				                          	<label><?php 
        echo  __( "Show number in Short Version eg: 1000 -> 1k:", "apvc" ) ;
        ?></label>
					                        <div class="icheck-square">
					                          <input tabindex="6" type="checkbox" name="numbers_in_k" <?php 
        if ( $avc_config->numbers_in_k[0] == "on" ) {
            echo  "checked" ;
        }
        ?>><label><?php 
        _e( "Yes", "apvc" );
        ?></label>
					                        </div>
					                      </div>
					                	</div>
					            	</div>

					            	<?php 
        /* ?>
        					            	<div class="col-md-6">
        			                        	<div class="form-group">
        				                          <div class="card-body">
        				                          	<label><?php echo __("Delete Older Records","apvc");?></label>
        					                        <div class="icheck-square">
        
        					                          <input tabindex="6" type="number" id="apvc_delete_rc" name="apvc_delete_rc" value="<?php echo $avc_config->apvc_delete_rc[0];?>" min="1" step="5">
        					                          <br />
        					                          <small class="text-muted"><?php echo __("*If you enter 365 days then records older than 365 days will be deleted automatically.","apvc");?></small>
        					                        </div>
        					                      </div>
        					                	</div>
        					            	</div>
        					            	<?php */
        ?>

					            </div>
					        </div>

	                      </div><!-- card-body -->
	                      <div class="row" style="float: left;">
								<div class="col-md-12">
					            	<div class="apvc-save-btns">
						            	<button type="button" id="apvc_save_settings" class="btn btn-primary btn-fw"><i class="mdi mdi-heart-outline"></i><?php 
        echo  __( "Save Changes", "apvc" ) ;
        ?></button>
						            	<button type="button" id="apvc_reset_button" class="btn btn-outline-danger btn-fw"><i class="mdi mdi-refresh"></i><?php 
        echo  __( "Reset Settings", "apvc" ) ;
        ?></button>
						            	<button type="button" id="apvc_reset_data_button" class="btn btn-danger btn-fw"><i class="mdi mdi-alert-outline"></i><?php 
        echo  __( "Reset All Data/Counters", "apvc" ) ;
        ?></button>
						            </div>
					            </div>
				            </div>
	                    </form>
	                	</div> <!--- Simple Div End -->
	                  </div>
	              </div>
		    </div>
    	</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Shortcode Generator Form.
     *
     * @since    3.0.1
     */
    public function apvc_shortcode_generator_page()
    {
        global  $wpdb ;
        ?>
		<input type="hidden" id="current_page" value="shortcode">
		<div class="container-fluid page-body-wrapper avpc-settings-page shortcodeG">
			<div class="main-panel container">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-lg-5 grid-margin stretch-card">
							<div class="card">
			                  <div class="card-body">
			                    <h4 class="card-title text-center text-black"><?php 
        echo  __( "Shortcode Preview", "apvc" ) ;
        ?></h4>
									<div id="shortcode_output">
										<div class="col-md-12 shLoader col-sm-12 grid-margin stretch-card">
											<div class="loader-demo-box" style="border:none !important;">
												<div class="square-box-loader">
													<div class="square-box-loader-container">
														<div class="square-box-loader-corner-top"></div>
														<div class="square-box-loader-corner-bottom"></div>
													</div>
													<div class="square-box-loader-square"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 grid-margin stretch-card">
							<div class="card">
								<ul class="nav nav-tabs tab-basic mt-3 ml-4" role="tablist">
		                          <li class="nav-item">
		                            <a class="nav-link active" id="txt-tab" data-toggle="tab" href="#txtSettings" role="tab" aria-controls="txtSettings" aria-selected="true"><?php 
        echo  _e( "Text Settings", "apvc" ) ;
        ?></a>
		                          </li>
		                          <li class="nav-item">
		                            <a class="nav-link" id="visib-tab" data-toggle="tab" href="#visib_tab" role="tab" aria-controls="visib_tab" aria-selected="false"><?php 
        echo  _e( "Visibility Options", "apvc" ) ;
        ?></a>
		                          </li>
		                          <li class="nav-item">
		                            <a class="nav-link" id="labels-tab" data-toggle="tab" href="#labels" role="tab" aria-controls="labels" aria-selected="false"><?php 
        echo  _e( "Labels & Icons", "apvc" ) ;
        ?></a>
		                          </li>
		                          <li class="nav-item">
		                            <a class="nav-link" id="sh-temp-tab" data-toggle="tab" href="#sh_temp" role="tab" aria-controls="sh_temp" aria-selected="false"><?php 
        echo  _e( "Shortcode Template", "apvc" ) ;
        ?></a>
		                          </li>
		                        </ul>

								<div class="card-body tab-content tab-content-basic">

									<form class="form-sample" id="apvc_generate_shortcode">
										<div class="apvc-save-btns text-right">
							            	<button type="button" class="apvc_generate_shortcode btn btn-primary btn-rounded  btn-fw"><i class="mdi mdi-format-paint"></i><?php 
        echo  __( "Generate Shortcode", "apvc" ) ;
        ?></button>
							            </div>

							            <div class="tab-pane fade show active" id="txtSettings" role="tabpanel" aria-labelledby="txt-tab" aria-selected="false">

											<div class="row">
												<div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Border Size (in pixels)", "apvc" ) ;
        ?></label>
									                      <Br />
									                      <input type="number" class="form-control" name="border_size" value="2">
									                    </div>
									                </div>
												</div>	
												<div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Border Radius (in pixels)", "apvc" ) ;
        ?></label>
									                      <Br />
									                      <input type="number" class="form-control" name="border_radius" value="5">
									                    </div>
									                </div>
												</div>	
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Border Style", "apvc" ) ;
        ?></label>
									                      <Br />
									                      <select name="border_style" class="form-control">
														    <option value="" disabled selected><?php 
        echo  __( "Choose your option", "apvc" ) ;
        ?></option>
															<option value="none"><?php 
        echo  __( "None", "apvc" ) ;
        ?></option>
															<option value="dotted"><?php 
        echo  __( "Dotted", "apvc" ) ;
        ?></option>
															<option value="dashed"><?php 
        echo  __( "Dashed", "apvc" ) ;
        ?></option>
															<option value="solid" selected=""><?php 
        echo  __( "Solid", "apvc" ) ;
        ?></option>
															<option value="double"><?php 
        echo  __( "Double", "apvc" ) ;
        ?></option>
														  </select>
									                    </div>
									                </div>
												</div>
												<div class="col-md-6">
							                      	<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Border Color", "apvc" ) ;
        ?></label>
									                      <input name="border_color" type="text" class="color-picker">
									                    </div>
								                    </div>
								                </div>
											</div>
											<div class="row">
												<div class="col-md-6">
							                      	<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Font Color", "apvc" ) ;
        ?></label>
									                      <input name="font_color" type="text" class="color-picker">
									                    </div>
								                    </div>
								                </div>
								                <div class="col-md-6">
							                      	<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Background Color", "apvc" ) ;
        ?></label>
									                      <input name="background_color" type="text" class="color-picker">
									                    </div>
								                    </div>
								                </div>
											</div>
											<div class="row">
												<div class="col-md-6">
							                      	<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Font Size", "apvc" ) ;
        ?></label>
									                      <input name="font_size" type="number" class="form-control" value="14" min="7">
									                    </div>
								                    </div>
								                </div>
								                <div class="col-md-6">
													<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Font Style", "apvc" ) ;
        ?></label>
									                      <Br />
									                      <select name="font_style" class="form-control" name="font_style">
														    <option value="" disabled selected><?php 
        echo  __( "Choose your option", "apvc" ) ;
        ?></option>
															<option value=""><?php 
        echo  __( "Please Select", "apvc" ) ;
        ?></option>
															<option value="normal"><?php 
        echo  __( "Normal", "apvc" ) ;
        ?></option>
															<option value="bold"><?php 
        echo  __( "Bold", "apvc" ) ;
        ?></option>
															<option value="italic"><?php 
        echo  __( "Italic", "apvc" ) ;
        ?></option>
														  </select>
									                    </div>
									                </div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
							                      	<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Padding", "apvc" ) ;
        ?></label>
									                      <input class="form-control" value="5" name="padding" type="number" min="0">
									                    </div>
								                    </div>
								                </div>
								                <div class="col-md-6">
							                      	<div class="card-body">
														<div class="form-group">
									                      <label><?php 
        echo  __( "Width", "apvc" ) ;
        ?></label>
									                      <input class="form-control" placeholder="Width in pixels" value="200" name="width" type="number" min="100">
									                    </div>
								                    </div>
								                </div>
								            </div>

							            </div>

							            <div class="tab-pane fade" id="visib_tab" role="tabpanel" aria-labelledby="visib-tab" aria-selected="false">
								            <div class="row">
								            	<div class="col-md-6">
						                        	<div class="form-group">
							                          <div class="card-body">
								                        <div class="icheck-square">
								                          <input tabindex="6" type="checkbox" name="show_today_count"><label><?php 
        echo  __( "Show Today's Visit Counts", "apvc" ) ;
        ?></label>
								                          <br />
								                          <small class="text-muted"><?php 
        echo  __( "*This will show today's count for individual post/page.", "apvc" ) ;
        ?></small>
								                        </div>
								                      </div>
								                	</div>
								            	</div>
								            	<div class="col-md-6">
						                        	<div class="form-group">
							                          <div class="card-body">
								                        <div class="icheck-square">
								                          <input tabindex="6" type="checkbox" name="show_global_count"><label><?php 
        echo  __( "Show Global Total Counts", "apvc" ) ;
        ?></label>
								                          <br />
								                          <small class="text-muted"><?php 
        echo  __( "*This will show total counts for whole website.", "apvc" ) ;
        ?></small>
								                        </div>
								                      </div>
								                	</div>
								            	</div>
								            	<div class="col-md-6">
						                        	<div class="form-group">
							                          <div class="card-body">
								                        <div class="icheck-square">
								                          <input tabindex="6" checked="checked" type="checkbox" name="show_cr_pg_count"><label><?php 
        echo  __( "Show Current Page Total", "apvc" ) ;
        ?></label>
								                          <br />
								                          <small class="text-muted"><?php 
        echo  __( "*This will show total counts the current page.", "apvc" ) ;
        ?></small>
								                        </div>
								                      </div>
								                	</div>
								            	</div>
								            </div>
								            
								        </div>

								       	<div class="tab-pane fade" id="labels" role="tabpanel" aria-labelledby="labels-tab" aria-selected="false">
								       		
								       		<div class="row">
								            	<div class="col-md-6">
						                        	<div class="form-group">
							                          <div class="card-body">
							                          	<label><?php 
        echo  __( "Counter Label", "apvc" ) ;
        ?></label>
									                      <input class="form-control" value="Visits:" name="counter_label" type="text">
							                          </div>
							                        </div>
							                    </div>
							                    <div class="col-md-6">
						                        	<div class="form-group">
							                          <div class="card-body">
							                          	<label><?php 
        echo  __( "Today's Counter Label", "apvc" ) ;
        ?></label>
									                      <input class="form-control" value="Today:" name="today_counter_label" type="text">
							                          </div>
							                        </div>
							                    </div>
							                    <div class="col-md-6">
						                        	<div class="form-group">
							                          <div class="card-body">
							                          	<label><?php 
        echo  __( "Global Counter Label", "apvc" ) ;
        ?></label>
									                      <input class="form-control" value="Total:" name="global_counter_label" type="text">
							                          </div>
							                        </div>
							                    </div>
							                    <div class="col-md-6">
								            		<div class="form-group">
							                          <div class="card-body">
							                          	<label><?php 
        echo  __( "Shortcode Type", "apvc" ) ;
        ?></label>
							                          	<select name="shortcode_type" id="shortcode_type" class="form-control">
													      <option value="" disabled selected><?php 
        echo  __( "Choose your option", "apvc" ) ;
        ?></option>
															<option value="customized" selected><?php 
        echo  __( "Customized", "apvc" ) ;
        ?></option>
															<option value="individual"><?php 
        echo  __( "For Specific Post/Page", "apvc" ) ;
        ?></option>
													    </select>
							                          </div>
							                        </div>
								            	</div>
								            </div>

								            <div class="row shArticles">
								            	<div class="col-md-12">
								            		<div class="form-group">
								            			<div class="card-body">
								                          <label><?php 
        echo  __( "Articles", "apvc" ) ;
        ?></label>
								                          <select class="apvc_articles_list" name="apvc_articles_list" style="width:100%">
								                            
								                          </select>
								                        </div>
							                        </div>
							                    </div>
								            </div>

								            <?php 
        ?>

										</div>

										<div class="tab-pane fade" id="sh_temp" role="tabpanel" aria-labelledby="sh-temp-tab" aria-selected="false">
											<div class="col-md-12">
												<div class="form-group">
						                          <label><?php 
        echo  __( "Widget Templates", "apvc" ) ;
        ?></label>
						                          <select id="apvc_widget_template" name="apvc_widget_template" class="apvc-counter-icon" style="width:100%">
						                          <?php 
        $shortcodes = json_decode( $this->apvc_get_shortcodes() );
        echo  '<option>' . __( "None", "apvc" ) . '</option>' ;
        foreach ( $shortcodes as $key => $value ) {
            echo  '<option value="' . esc_html( $key ) . '"> ' . ucfirst( str_replace( "_", " ", $key ) ) . '</option>' ;
        }
        ?>
						                          </select>
						                          <br />
							                      <small class="text-muted"><?php 
        echo  __( "*Check the Shortcode Library page to check the demo of all the shortcodes.<Br />*All color properties ignored if any template selected.<Br />*More than 40 templates available in the Premium version of the plugin.", "apvc" ) ;
        ?></small>
						                        </div>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
						<?php 
        ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
    }
    
    /**
     * Advanced Page Visit Counter Shortcode Generator Method.
     *
     * @since    3.0.1
     */
    public function apvc_generate_shortcode()
    {
        global  $wpdb ;
        ob_start();
        $formData = $_POST['formData'];
        $formData = explode( "&", $formData );
        $finalFormData = array();
        foreach ( $formData as $key => $value ) {
            $rawFormData = explode( "=", $value );
            if ( isset( $rawFormData[0] ) ) {
                $finalFormData[$rawFormData[0]][] = urldecode( trim( $rawFormData[1] ) );
            }
        }
        $border_size = $finalFormData['border_size'][0];
        $border_radius = $finalFormData['border_radius'][0];
        $bg_color = $finalFormData['background_color'][0];
        $font_size = $finalFormData['font_size'][0];
        $font_style = $finalFormData['font_style'][0];
        $font_color = $finalFormData['font_color'][0];
        $border_style = $finalFormData['border_style'][0];
        $border_color = $finalFormData['border_color'][0];
        $counter_label = $finalFormData['counter_label'][0];
        $today_counter_label = $finalFormData['today_counter_label'][0];
        $global_counter_label = $finalFormData['global_counter_label'][0];
        $padding = $finalFormData['padding'][0];
        $width = $finalFormData['width'][0];
        $shType = $finalFormData['shortcode_type'][0];
        $shArticleID = $finalFormData['apvc_articles_list'][0];
        $show_global_count = $finalFormData['show_global_count'][0];
        $show_today_count = $finalFormData['show_today_count'][0];
        $show_cr_pg_count = $finalFormData['show_cr_pg_count'][0];
        $widget_template = $finalFormData['apvc_widget_template'][0];
        if ( empty($shArticleID) ) {
            $shArticleID = 1;
        }
        
        if ( $show_global_count == 'on' ) {
            $show_global_countVar = ' global="true" ';
        } else {
            $show_global_countVar = ' global="false" ';
        }
        
        
        if ( $show_today_count == 'on' ) {
            $show_today_countVar = ' today="true" ';
        } else {
            $show_today_countVar = ' today="false" ';
        }
        
        
        if ( $show_cr_pg_count == 'on' ) {
            $show_cr_pg_countVar = ' current="true" ';
        } else {
            $show_cr_pg_countVar = ' current="false" ';
        }
        
        $shArgs = "";
        
        if ( $shType == 'individual' && !empty($shArticleID) ) {
            $shArgs = 'type="individual" article_id="' . $shArticleID . '"';
        } else {
            
            if ( $shType == 'global' ) {
                $shArgs = 'type="global"';
            } else {
                $shArgs = 'type="customized"';
            }
        
        }
        
        $counter_label = ( !empty($counter_label) ? $counter_label : "Visits: " );
        $today_counter_label = ( !empty($today_counter_label) ? $today_counter_label : $counter_label );
        $global_counter_label = ( !empty($global_counter_label) ? $global_counter_label : $counter_label );
        $shortcode = '[apvc_embed ' . $shArgs . ' border_size="' . $border_size . '" border_radius="' . $border_radius . '" background_color="' . $bg_color . '" font_size="' . $font_size . '" font_style="' . $font_style . '" font_color="' . $font_color . '" counter_label="' . $counter_label . '" today_cnt_label="' . $today_counter_label . '" global_cnt_label="' . $global_counter_label . '" border_color="' . $border_color . '" border_style="' . $border_style . '" padding="' . $padding . '" width="' . $width . '" ' . $show_global_countVar . ' ' . $show_today_countVar . ' ' . $show_cr_pg_countVar . ' ' . $iconCR . ' ' . $iconGL . ' ' . $iconTD . ' icon_position="' . $apvc_icon_position . '" widget_template="' . $widget_template . '" ]';
        ?>
		<style>
			 .avc_visit_counter_front{
			 	width: <?php 
        echo  $width ;
        ?>px;
			 	max-width: <?php 
        echo  $width ;
        ?>px;
			    padding: <?php 
        echo  $padding ;
        ?>px;
			    text-align: center;	
			    margin: 15px 0px 15px 0px;
			    margin: 20px auto;
			 }
			 .shortcode_copy{ text-align: center; } .shortcode_copy a{ color: #fff !important; cursor: pointer; }
		</style>
        <div class="shortcodeBlock col-md-12">
			<div class="shortcode_text grid-margin" id="shortcode_text">
				<?php 
        echo  $shortcode ;
        ?>
			</div>
			<div class="col-md-12 shortcode_output center-align" id="shortcode_output">
				<?php 
        echo  do_shortcode( $shortcode ) ;
        ?>
			</div>
			<div class="col-md-12 shortcode_copy grid-margin">
				<a class="btn btn-primary btn-rounded btn-fw text-center" id="shortcode_copy"><?php 
        echo  __( "Copy Shortcode", "apvc" ) ;
        ?></a>
			</div>

			<?php 
        ?>
		</div>
		<?php 
        echo  ob_get_clean() ;
        wp_die();
    }
    
    public function apvc_shortcode_library()
    {
        global  $wpdb ;
        $shortcodes = json_decode( $this->apvc_get_shortcodes() );
        ?>
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel container">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-lg-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
								<h5 class="text-center grid-margin"><b><?php 
        echo  __( "Shortcodes Library", "apvc" ) ;
        ?></b></h5>
									<div class="row">
									<?php 
        foreach ( $shortcodes as $key => $value ) {
            $addClass = ( $value->class != '' ? $value->class : '' );
            ?>
										<div class="col-lg-4 grid-margin">
											<h4 class="card-title text-center">
												<?php 
            echo  str_replace( "_", " ", $key ) ;
            ?>
											</h4>
											<style type="text/css">
												<?php 
            echo  $value->css ;
            ?>
											</style>
											<?php 
            echo  ( $value->icon == 'yes' ? $this->apvc_get_html_with_icon( $key . " " . $addClass ) : $this->apvc_get_html_without_icon( $key . " " . $addClass ) ) ;
            ?>
										</div>
									<?php 
        }
        ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
    }
    
    public function apvc_daily_cleanup_method()
    {
        global  $wpdb ;
        $table = APVC_DATA_TABLE;
        $avc_config = (object) get_option( "apvc_configurations", true );
        $dd = $avc_config->apvc_delete_rc[0];
        
        if ( !empty($dd) ) {
            $dDate = date( "Y-m-d 00:00:00", strtotime( '-' . $dd . ' days' ) );
            return $wpdb->get_results( "DELETE FROM {$table} WHERE date<='{$dt}' " );
        }
    
    }
    
    public function apvc_upgrade_database()
    {
        global  $wpdb ;
        $history_table = $wpdb->prefix . "avc_page_visit_history";
        $article_title = $wpdb->get_results( "SELECT article_title FROM {$history_table} WHERE article_title != ''" );
        
        if ( empty($article_title) ) {
            $sqlAlter = "ALTER TABLE {$history_table} DROP COLUMN article_title";
            $wpdb->query( $sqlAlter );
        }
        
        $addColumn = $wpdb->get_results( "SELECT country FROM {$history_table} WHERE country != ''" );
        
        if ( empty($addColumn) ) {
            $addColumn = "ALTER TABLE {$history_table} ADD country TEXT AFTER flag";
            $wpdb->query( $addColumn );
        }
        
        return wp_send_json_success();
        wp_die();
    }
    
    public function apvc_detailed_reports_on_chart()
    {
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        ?>
		<input type="hidden" id="current_page" value="detailed-reports-chart">
		<input type="hidden" id="current_article" value="<?php 
        echo  sanitize_text_field( $_GET["article_id"] ) ;
        ?>">

		<div class="container-fluid page-body-wrapper">
			<div class="main-panel container">
			  <div class="content-wrapper">
			  	
			  	<?php 
        ?>
					<div class="row grid-margin">
						<div class="col-12 col-md-12 col-lg-12 stretch-card">
							<div class="card">
								<h6>In premium version only.</h6>
								<img src="<?php 
        echo  plugin_dir_url( __FILE__ ) ;
        ?>images/filters-premium.png">
							</div>
						</div>
					</div>
				<?php 
        ?>
				
			    <div class="card report_card col-md-12">
			      <div class="card-body">
			        <div class="row">
	                    <canvas id="detailed_chart_single" style="position: relative; height:65vh; width:80vw"></canvas>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		<?php 
    }

}