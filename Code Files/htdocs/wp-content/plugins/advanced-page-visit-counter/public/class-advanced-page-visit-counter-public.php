<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://pagevisitcounter.com
 * @since      3.0.1
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/public
 */
// Load the classes.
// use GeoIp2\Database\Reader;
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Advanced_Visit_Counter
 * @subpackage Advanced_Visit_Counter/public
 * @author     Ankit Panchal <wptoolsdev@gmail.com>
 */
class Advanced_Visit_Counter_Public
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
    /**
     * Initialize the class and set its properties.
     *
     * @since    3.0.1
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    3.0.1
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/advanced-page-visit-counter-public.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    3.0.1
     */
    public function enqueue_scripts()
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
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/advanced-page-visit-counter-public.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_localize_script( $this->plugin_name, 'apvc_rest', array(
            'ap_rest_url' => get_rest_url(),
            'wp_rest'     => wp_create_nonce( "wp_rest" ),
            'ap_cpt'      => get_post_type(),
        ) );
    }
    
    public function avp_get_Browser( $is_rest = false, $user_agent = "" )
    {
        
        if ( $is_rest == true ) {
            $user_agent = $user_agent;
        } else {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
        }
        
        $browser_name = 'Unknown';
        $platform = 'Unknown';
        $version = "";
        $result = new WhichBrowser\Parser( $user_agent );
        return array(
            'userAgent'        => $user_agent,
            'full_name'        => ( isset( $result->browser->name ) ? $result->browser->name : _x( 'Unknown', 'Browser', 'apvc' ) ),
            'short_name'       => ( isset( $result->browser->name ) ? $result->browser->name : _x( 'Unknown', 'Browser', 'apvc' ) ),
            'version'          => ( isset( $result->os->version->value ) ? $result->os->version->value : _x( 'Unknown', 'Version', 'apvc' ) ),
            'operation_system' => ( isset( $result->os->name ) ? $result->os->name : _x( 'Unknown', 'Platform', 'apvc' ) ),
            'device_type'      => ( isset( $result->device->type ) ? $result->device->type : _x( 'Unknown', 'Platform', 'apvc' ) ),
        );
    }
    
    /**
     * Advanced Page Visit Counter Get referer url of the page
     *
     * @since    3.0.1
     */
    public function avp_get_HttpReferer()
    {
        $http_referer = ( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '' );
        return $http_referer;
    }
    
    /**
     * Advanced Page Visit Counter Checks current page is woocommerce template page or not.
     *
     * @since    3.0.1
     */
    public function AVP_isWooCommercePage()
    {
        $woocommerce_keys = array(
            "woocommerce_shop_page_id",
            "woocommerce_terms_page_id",
            "woocommerce_cart_page_id",
            "woocommerce_checkout_page_id",
            "woocommerce_pay_page_id",
            "woocommerce_thanks_page_id",
            "woocommerce_myaccount_page_id",
            "woocommerce_edit_address_page_id",
            "woocommerce_view_order_page_id",
            "woocommerce_change_password_page_id",
            "woocommerce_logout_page_id",
            "woocommerce_lost_password_page_id"
        );
        foreach ( $woocommerce_keys as $wc_page_id ) {
            if ( get_the_ID() == get_option( $wc_page_id, 0 ) ) {
                return true;
            }
        }
        return false;
    }
    
    public function apvc_get_user_ip_address()
    {
        
        if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        return $ip;
    }
    
    public function apvc_register_rest_route()
    {
        register_rest_route( 'apvc/v1', '/update_visit', array(
            'methods'             => \WP_REST_Server::READABLE,
            'permission_callback' => function () {
            return ( get_option( 'cache_active' ) == 'Yes' ? true : false );
        },
            'callback'            => array( $this, 'update_page_visit_stats_rest' ),
        ) );
    }
    
    public function update_page_visit_stats_rest( \WP_REST_Request $request )
    {
        global  $wpdb ;
        $url = $_GET['url'];
        $user_agent = $_GET['ua'];
        $referred = $_GET['referred'];
        $ap_cpt = $_GET['cpt'];
        $this->update_page_visit_stats(
            $url,
            $user_agent,
            $apvc_nonce,
            $referred,
            $ap_cpt,
            true
        );
    }
    
    /**
     * Advanced Page Visit Counter Count Update
     *
     * @since    3.0.1
     */
    public function update_page_visit_stats(
        $url = "",
        $user_agent = "",
        $apvc_nonce = "",
        $referred = "",
        $ap_cpt = "",
        $is_rest = false
    )
    {
        global  $wpdb ;
        
        if ( $is_rest == true ) {
            $article_id = url_to_postid( $url );
        } else {
            $article_id = get_the_ID();
        }
        
        if ( is_admin() ) {
            return false;
        }
        $active = get_post_meta( $article_id, "apvc_active_counter", true );
        if ( $active == "No" ) {
            return false;
        }
        $user = wp_get_current_user();
        $currentUserID = $user->ID;
        $tbl_history = APVC_DATA_TABLE;
        $avc_config = (object) get_option( "apvc_configurations", true );
        $date = current_time( 'mysql' );
        $last_date = current_time( 'mysql' );
        $ip_address = $this->apvc_get_user_ip_address();
        // $ip_address = "24.221.38.181";
        $locData = $this->ip_info( $ip_address );
        $country = $locData['country'];
        
        if ( $is_rest == true ) {
            $browser = $this->avp_get_Browser( true, $user_agent );
        } else {
            $browser = $this->avp_get_Browser();
        }
        
        
        if ( $is_rest == true ) {
            $article_type = $ap_cpt;
        } else {
            $article_type = get_post_type();
        }
        
        $br_fullname = $browser['full_name'];
        $br_shortname = ( $browser['short_name'] ? $browser['short_name'] : "-" );
        $version = $browser['version'];
        $os = $browser['operation_system'];
        $site_id = get_current_blog_id();
        
        if ( $is_rest == true ) {
            $HttpReferer = $referred;
        } else {
            $HttpReferer = $this->avp_get_HttpReferer();
        }
        
        $HttpReferer = ( empty($HttpReferer) ? "Direct" : $HttpReferer );
        $user_id = get_current_user_id();
        $device_type = $browser['device_type'];
        
        if ( is_user_logged_in() ) {
            $user_type = "Registered";
        } else {
            $user_type = "Guest";
        }
        
        $SpamControll = trim( $avc_config->apvc_spam_controller[0] );
        
        if ( $SpamControll == 'on' && !empty($article_id) ) {
            $sPamtime = $wpdb->get_var( "SELECT last_date FROM {$tbl_history} WHERE ip_address='{$ip_address}' AND article_id={$article_id} ORDER BY last_date DESC" );
            $differenceTime = round( abs( strtotime( $date ) - strtotime( $sPamtime ) ) / 60, 2 );
        } else {
            $differenceTime = 10;
        }
        
        
        if ( $is_rest == true ) {
            $currentPostType = $ap_cpt;
        } else {
            $currentPostType = get_post_type();
        }
        
        $ptypesTrack = array();
        
        if ( count( $avc_config->apvc_post_types ) == 0 || empty($avc_config->apvc_post_types) ) {
            $ptypesTrack = [ 'page', 'post' ];
        } else {
            $ptypesTrack = $avc_config->apvc_post_types;
        }
        
        
        if ( in_array( $currentPostType, $ptypesTrack ) ) {
            $ptExist = true;
        } else {
            $ptExist = false;
        }
        
        $allExUsers = array();
        
        if ( !empty($avc_config->apvc_exclude_users[0]) ) {
            $tempUsrCnt = explode( ",", $avc_config->apvc_exclude_users[0] );
            foreach ( $tempUsrCnt as $exUsrCnt ) {
                $allExUsers[] = $exUsrCnt;
            }
        }
        
        
        if ( $currentUserID != 0 ) {
            
            if ( in_array( $currentUserID, $allExUsers ) ) {
                $userExist = true;
            } else {
                $userExist = false;
            }
        
        } else {
            $userExist = false;
        }
        
        $allIPs = array();
        
        if ( !empty($avc_config->apvc_ip_address[0]) ) {
            $ips = explode( ",", $avc_config->apvc_ip_address[0] );
            foreach ( $ips as $ip ) {
                $ttIP = "";
                $tempIP = explode( ".", $ip );
                
                if ( is_array( $tempIP ) > 0 && strpos( $tempIP[3], "/" ) > 0 ) {
                    $ipRangeT = explode( "/", $tempIP[3] );
                    $ttIP = $tempIP[0] . "." . $tempIP[1] . "." . $tempIP[2];
                    if ( count( $ipRangeT ) > 0 ) {
                        for ( $tCnt = $ipRangeT[0] ;  $tCnt <= $ipRangeT[1] ;  $tCnt++ ) {
                            $allIPs[] = $ttIP . "." . $tCnt;
                        }
                    }
                } else {
                    
                    if ( is_array( $tempIP ) > 0 && $tempIP[3] == "*" ) {
                        $ttIP = $tempIP[0] . "." . $tempIP[1] . "." . $tempIP[2];
                        for ( $tCnt = 0 ;  $tCnt <= 255 ;  $tCnt++ ) {
                            $allIPs[] = $ttIP . "." . $tCnt;
                        }
                    } else {
                        $allIPs[] = $ip;
                    }
                
                }
            
            }
        }
        
        
        if ( in_array( $ip_address, $allIPs ) ) {
            $ipExist = true;
        } else {
            $ipExist = false;
        }
        
        $allEXCounts = array();
        
        if ( !empty($avc_config->apvc_exclude_counts[0]) ) {
            $tempCount = explode( ",", $avc_config->apvc_exclude_counts[0] );
            foreach ( $tempCount as $exCnt ) {
                $allEXCounts[] = $exCnt;
            }
        }
        
        $excludeArticles = $allEXCounts;
        if ( $differenceTime > 5 && $ipExist == false && $userExist == false && $ptExist == true && !in_array( $article_id, $excludeArticles ) ) {
            
            if ( $this->AVP_isWooCommercePage() == true && class_exists( 'WooCommerce' ) ) {
                if ( !empty($article_id) ) {
                    
                    if ( is_singular( 'product' ) ) {
                        $last_id = $wpdb->insert( $tbl_history, array(
                            'article_id'         => $article_id,
                            'date'               => $date,
                            'last_date'          => $last_date,
                            'article_type'       => 'product',
                            'user_type'          => $user_type,
                            'device_type'        => $device_type,
                            'ip_address'         => $ip_address,
                            'user_id'            => $user_id,
                            'browser_full_name'  => $br_fullname,
                            'browser_short_name' => $br_shortname,
                            'browser_version'    => $version,
                            'operating_system'   => $os,
                            'http_referer'       => $HttpReferer,
                            'site_id'            => $site_id,
                            'flag'               => 1,
                            'country'            => $country,
                        ), array(
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%d',
                            '%d',
                            '%s'
                        ) );
                        $last_id = $wpdb->insert_id;
                    } else {
                        $last_id = $wpdb->insert( $tbl_history, array(
                            'article_id'         => $article_id,
                            'date'               => $date,
                            'last_date'          => $last_date,
                            'article_type'       => 'cart',
                            'user_type'          => $user_type,
                            'device_type'        => $device_type,
                            'ip_address'         => $ip_address,
                            'user_id'            => $user_id,
                            'browser_full_name'  => $br_fullname,
                            'browser_short_name' => $br_shortname,
                            'browser_version'    => $version,
                            'operating_system'   => $os,
                            'http_referer'       => $HttpReferer,
                            'site_id'            => $site_id,
                            'flag'               => 1,
                            'country'            => $country,
                        ), array(
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%d',
                            '%d',
                            '%s'
                        ) );
                        $last_id = $wpdb->insert_id;
                    }
                
                }
            } else {
                
                if ( !empty($article_id) ) {
                    $last_id = $wpdb->insert( $tbl_history, array(
                        'article_id'         => $article_id,
                        'date'               => $date,
                        'last_date'          => $last_date,
                        'article_type'       => $article_type,
                        'user_type'          => $user_type,
                        'device_type'        => $device_type,
                        'ip_address'         => $ip_address,
                        'user_id'            => $user_id,
                        'browser_full_name'  => $br_fullname,
                        'browser_short_name' => $br_shortname,
                        'browser_version'    => $version,
                        'operating_system'   => $os,
                        'http_referer'       => $HttpReferer,
                        'site_id'            => $site_id,
                        'country'            => $country,
                    ), array(
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%d',
                        '%s'
                    ) );
                    $last_id = $wpdb->insert_id;
                }
            
            }
        
        }
        $differenceTime = 0;
        
        if ( apvc_fs()->is__premium_only() && $last_id != "" ) {
            $realtime_users = $wpdb->prefix . "apvc_realtime_users";
            $wpdb->insert( $realtime_users, array(
                'ref_id'     => $article_id,
                'date'       => date( 'Y-m-d H:i:s' ),
                'time'       => date( "H:i" ),
                'ip_address' => $ip_address,
                "country"    => $country,
            ), array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%s'
            ) );
            $user_loc = $wpdb->prefix . "apvc_user_locations";
            $wpdb->insert( $user_loc, array(
                'ent_id'         => $last_id,
                'city'           => $locData['city'],
                'state'          => $locData['state'],
                "country"        => $locData['country'],
                "country_code"   => $locData['country_code'],
                "continent"      => $locData['continent'],
                "continent_code" => $locData['continent_code'],
            ), array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            ) );
        }
    
    }
    
    public function ip_info( $ip = NULL, $purpose = "location", $deep_detect = TRUE )
    {
        $output = NULL;
        if ( filter_var( $ip, FILTER_VALIDATE_IP ) === FALSE ) {
            
            if ( $deep_detect ) {
                if ( filter_var( @$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP ) ) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                if ( filter_var( @$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP ) ) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
            }
        
        }
        $purpose = str_replace( array(
            "name",
            "\n",
            "\t",
            " ",
            "-",
            "_"
        ), NULL, strtolower( trim( $purpose ) ) );
        $support = array(
            "country",
            "countrycode",
            "state",
            "region",
            "city",
            "location",
            "address"
        );
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America",
        );
        
        if ( filter_var( $ip, FILTER_VALIDATE_IP ) && in_array( $purpose, $support ) ) {
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=" . $ip );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            $details = curl_exec( $ch );
            curl_close( $ch );
            $ipdat = @json_decode( $details );
            if ( @strlen( trim( $ipdat->geoplugin_countryCode ) ) == 2 ) {
                switch ( $purpose ) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper( $ipdat->geoplugin_continentCode )],
                            "continent_code" => @$ipdat->geoplugin_continentCode,
                        );
                        break;
                    case "address":
                        $address = array( $ipdat->geoplugin_countryName );
                        if ( @strlen( $ipdat->geoplugin_regionName ) >= 1 ) {
                            $address[] = $ipdat->geoplugin_regionName;
                        }
                        if ( @strlen( $ipdat->geoplugin_city ) >= 1 ) {
                            $address[] = $ipdat->geoplugin_city;
                        }
                        $output = implode( ", ", array_reverse( $address ) );
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        
        return $output;
    }
    
    public function apvc_get_html_with_icon( $class )
    {
        return '<div class="' . $class . '" {inline_style}><div>{current_visits_label}{current_visits_counts}</div><div>{today_visits_label}{today_visits_counts}</div><div>{total_visits_label}{total_visits_counts}</div></div>';
    }
    
    public function apvc_get_html_without_icon( $class )
    {
        return '<div class="' . $class . '" {inline_style}><div>{current_visits_label}{current_visits_counts}</div><div>{today_visits_label}{today_visits_counts}</div><div>{total_visits_label}{total_visits_counts}</div></div>';
    }
    
    /* THIS IS SHORTCODE METHOD*/
    public function public_avc_visit_counter( $atts = array(), $content = null, $tag = '' )
    {
        global  $wpdb ;
        $tbl_history = APVC_DATA_TABLE;
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
        if ( $atts['current'] == "false" && $atts['today'] == "false" && $atts['global'] == "false" ) {
            return false;
        }
        $type = $atts['type'];
        if ( isset( $atts['article_id'] ) ) {
            $article_id = $atts['article_id'];
        }
        if ( $atts['type'] !== 'individual' ) {
            if ( is_admin() ) {
                $article_id = 1;
            }
        }
        
        if ( $atts['type'] == 'individual' ) {
            $article_id = $atts['article_id'];
        } else {
            $article_id = 1;
        }
        
        
        if ( $type == 'individual' && !empty($article_id) ) {
            $pageCnt = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history} WHERE article_id={$article_id}" );
        } else {
            
            if ( $type == 'global' ) {
                $pageCnt = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history} WHERE `article_id` != '';" );
            } else {
                
                if ( is_admin() ) {
                    $article_id = 1;
                } else {
                    $article_id = get_the_ID();
                }
                
                $pageCnt = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history} WHERE article_id={$article_id}" );
            }
        
        }
        
        $active = get_post_meta( $article_id, "apvc_active_counter", true );
        if ( $active == "No" ) {
            return false;
        }
        $borderSize = ( !empty($atts['border_size']) ? $atts['border_size'] : 0 );
        $borderRadius = ( !empty($atts['border_radius']) ? 'border-radius:' . $atts['border_radius'] . 'px;' : '' );
        $borderStyle = ( !empty($atts['border_style']) ? $atts['border_style'] : 'solid' );
        $borderColor = ( !empty($atts['border_color']) ? $atts['border_color'] : '#000000' );
        
        if ( $borderSize != 0 ) {
            $borderCSS = "border: " . $borderSize . "px " . $borderStyle . " " . $borderColor . ";";
        } else {
            $borderCSS = '';
        }
        
        $bgColor = ( !empty($atts['background_color']) ? 'background-color: ' . $atts['background_color'] . ';' : '' );
        $font_size = ( !empty($atts['font_size']) ? 'font-size: ' . $atts['font_size'] . 'px;' : '' );
        
        if ( $atts['font_style'] == 'italic' ) {
            $font_style = ( !empty($atts['font_style']) ? 'font-style: ' . $atts['font_style'] . ';' : '' );
        } else {
            $font_style = ( !empty($atts['font_style']) ? 'font-weight: ' . $atts['font_style'] . ';' : '' );
        }
        
        $font_color = ( !empty($atts['font_color']) ? 'color:' . $atts['font_color'] . ';' : '' );
        $padding = ( !empty($atts['padding']) ? 'padding:' . $atts['padding'] . 'px;' : '' );
        $counter_label = ( empty($atts['counter_label']) ? " Visits: " : $atts['counter_label'] );
        $today_cnt_label = ( empty($atts['today_cnt_label']) ? $counter_label : $atts['today_cnt_label'] );
        $global_cnt_label = ( empty($atts['global_cnt_label']) ? $counter_label : $atts['global_cnt_label'] );
        $widget_label = get_post_meta( get_the_ID(), "widget_label", true );
        if ( empty($widget_label) ) {
            $widget_label = $counter_label;
        }
        $base_count = get_post_meta( $article_id, "count_start_from", true );
        if ( !empty($base_count) && $base_count > 0 ) {
            $pageCnt = $pageCnt + $base_count;
        }
        
        if ( !isset( $atts['current'] ) ) {
            $pageCnt = $widget_label . " " . $this->apvc_number_format( $pageCnt );
        } else {
            
            if ( $atts['current'] == "true" ) {
                $pageCnt = $widget_label . " " . $this->apvc_number_format( $pageCnt );
            } else {
                $pageCnt = '';
            }
        
        }
        
        $todayDate = date( 'Y-m-d' );
        
        if ( $atts['today'] == "true" ) {
            $TodaypageCnt = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history} WHERE article_id={$article_id} AND (`date` > DATE_SUB(now(), INTERVAL 1 DAY))" );
            $todaysCount = $today_cnt_label . " " . $this->apvc_number_format( $TodaypageCnt );
        } else {
            $todaysCount = "";
        }
        
        $existingAllCounts = $wpdb->get_var( "SELECT SUM(meta_value) FROM {$wpdb->postmeta} where meta_key='count_start_from'" );
        
        if ( $atts['global'] == "true" ) {
            $allTime = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history}" );
            $allTimeCount = $global_cnt_label . " " . $this->apvc_number_format( $allTime + $existingAllCounts );
        } else {
            $allTimeCount = "";
        }
        
        
        if ( !empty($atts['width']) ) {
            $shWidth = " width: 100%; max-width:" . $atts['width'] . "px; margin: 0 auto;";
        } else {
            $shWidth = "";
        }
        
        $wid_templated = $atts['widget_template'];
        
        if ( $wid_templated != 'None' && !empty($wid_templated) ) {
            $shortcodeData = json_decode( $this->apvc_get_shortcodes( $wid_templated ) );
            
            if ( $shortcodeData->icon == 'yes' ) {
                $shHTML = $this->apvc_get_html_with_icon( $wid_templated );
            } else {
                $shHTML = $this->apvc_get_html_without_icon( $wid_templated );
            }
            
            $crReplace = '<div>{current_visits_label}{current_visits_counts}</div>';
            $tdReplace = '<div>{today_visits_label}{today_visits_counts}</div>';
            $glReplace = '<div>{total_visits_label}{total_visits_counts}</div>';
            $iconCR = $iconGL = $iconTD = '';
            
            if ( !empty($pageCnt) ) {
                $shHTML = str_replace( $crReplace, '<div>' . $pageCnt . '</div>', $shHTML );
            } else {
                $shHTML = str_replace( $crReplace, '', $shHTML );
            }
            
            
            if ( !empty($todaysCount) ) {
                $shHTML = str_replace( $tdReplace, '<div>' . $todaysCount . '</div>', $shHTML );
            } else {
                $shHTML = str_replace( $tdReplace, '', $shHTML );
            }
            
            
            if ( !empty($allTimeCount) ) {
                $shHTML = str_replace( $glReplace, '<div>' . $allTimeCount . '</div>', $shHTML );
            } else {
                $shHTML = str_replace( $glReplace, '', $shHTML );
            }
            
            $shHTML = str_replace( "{inline_style}", 'style="' . $shWidth . $padding . '; margin-bottom :15px;"', $shHTML );
            $shHTML = '<style type="text/css">' . $shortcodeData->css . '</style>' . $shHTML;
        } else {
            $html = "<div class='avc_visit_counter_front' style='" . $borderCSS . $bgColor . $borderRadius . $font_size . $font_style . $font_color . "" . $shWidth . "" . $padding . "'>" . $pageCnt . " " . $todaysCount . " " . $allTimeCount . "</div>";
        }
        
        return $shHTML . $html;
    }
    
    public function public_add_counter_to_content( $content )
    {
        global  $wpdb ;
        global  $post ;
        $tbl_history = APVC_DATA_TABLE;
        $currentPostType = get_post_type();
        $article_id = get_the_ID();
        $avcConfig = (object) get_option( "apvc_configurations", true );
        $active = get_post_meta( $article_id, "apvc_active_counter", true );
        if ( $active == "No" ) {
            return $content;
        }
        $exShowCnt = array();
        
        if ( !empty($avcConfig->apvc_exclude_show_counter[0]) ) {
            $tempCntShow = explode( ",", $avcConfig->apvc_exclude_show_counter[0] );
            foreach ( $tempCntShow as $exShow ) {
                $exShowCnt[] = $exShow;
            }
        }
        
        if ( $avcConfig->apvc_atc_page_count[0] == "" && $avcConfig->apvc_show_global_count[0] == "" && $avcConfig->apvc_show_today_count[0] == "" ) {
            return $content;
        }
        
        if ( is_array( $avcConfig->apvc_post_types ) && in_array( $currentPostType, $avcConfig->apvc_post_types ) && !is_feed() && !is_home() && !in_array( $article_id, $exShowCnt ) && $this->AVP_isWooCommercePage() != 1 && $avcConfig->apvc_show_conter_on_front_side[0] != "disable" ) {
            $widget_label = get_post_meta( $article_id, "widget_label", true );
            
            if ( !empty($widget_label) ) {
                $label = $widget_label;
            } else {
                $label = ( $avcConfig->apvc_default_label[0] ? $avcConfig->apvc_default_label[0] : "" );
            }
            
            $TodaySlabel = ( $avcConfig->apvc_todays_label[0] ? $avcConfig->apvc_todays_label[0] : $label );
            $Globallabel = ( $avcConfig->apvc_global_label[0] ? $avcConfig->apvc_global_label[0] : $label );
            $bgColorBox = ( $avcConfig->apvc_default_background_color[0] ? $avcConfig->apvc_default_background_color[0] : "#FFF" );
            $article_id = $post->ID;
            $pageCnt = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history} WHERE article_id={$article_id}" );
            $widAlignment = ( isset( $avcConfig->apvc_wid_alignment[0] ) ? $avcConfig->apvc_wid_alignment[0] : "" );
            
            if ( $widAlignment == "center" ) {
                $widAlignmentCss = "margin: 0px auto;";
            } else {
                
                if ( $widAlignment == "right" ) {
                    $widAlignmentCss = "float: right;";
                } else {
                    $widAlignmentCss = "float: left;";
                }
            
            }
            
            $widget_width = $avcConfig->apvc_widget_width[0];
            
            if ( !empty($widget_width) ) {
                $widget_width = " width: 100%; max-width: " . $widget_width . "px;";
            } else {
                $widget_width = " width: auto;";
            }
            
            $padding = $avcConfig->apvc_widget_padding[0];
            
            if ( !empty($padding) ) {
                $padding = " padding: " . $padding . "px;";
            } else {
                $padding = " padding: 5px";
            }
            
            
            if ( $avcConfig->apvc_show_today_count[0] == "on" ) {
                $TodaypageCnt = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history} WHERE article_id={$article_id} AND (`date` > DATE_SUB(now(), INTERVAL 1 DAY))" );
                $todaysCount = " " . $TodaySlabel . " " . $TodaypageCnt;
            } else {
                $todaysCount = "";
            }
            
            $existingAllCounts = $wpdb->get_var( "SELECT SUM(meta_value) FROM {$wpdb->postmeta} where meta_key='count_start_from' AND meta_value != ''" );
            
            if ( $avcConfig->apvc_show_global_count[0] == "on" ) {
                $allTime = $wpdb->get_var( "SELECT COUNT(*) FROM {$tbl_history}" );
                $allTimeCount = " " . $Globallabel . " " . ($allTime + $existingAllCounts);
            } else {
                $allTimeCount = "";
            }
            
            $style = 'style="' . $widget_width . ' border: ' . $avcConfig->apvc_default_border_width[0] . 'px solid ' . $avcConfig->apvc_default_border_color[0] . '; color:' . $avcConfig->apvc_default_text_color[0] . '; background-color:' . $bgColorBox . '; border-radius: ' . $avcConfig->apvc_default_border_radius[0] . 'px; ' . $widAlignmentCss . $padding . '"';
            $base_count = get_post_meta( $article_id, "count_start_from", true );
            if ( !empty($base_count) && $base_count > 0 ) {
                $pageCnt = $pageCnt + $base_count;
            }
            
            if ( $avcConfig->apvc_atc_page_count[0] == "on" ) {
                $pageCnt = __( $label ) . $pageCnt;
            } else {
                $pageCnt = "";
            }
            
            $wid_templated = $avcConfig->apvc_widget_template[0];
            $iconcr = $avcConfig->apvc_cr_counter_icon[0];
            $icontd = $avcConfig->apvc_today_counter_icon[0];
            $icongl = $avcConfig->apvc_global_counter_icon[0];
            
            if ( $wid_templated != 'None' && !empty($wid_templated) ) {
                $shortcodeData = json_decode( $this->apvc_get_shortcodes( $wid_templated ) );
                
                if ( $shortcodeData->icon == 'yes' ) {
                    $shHTML = $this->apvc_get_html_with_icon( $wid_templated );
                } else {
                    $shHTML = $this->apvc_get_html_without_icon( $wid_templated );
                }
                
                $crReplace = '<div>{current_visits_label}{current_visits_counts}</div>';
                $tdReplace = '<div>{today_visits_label}{today_visits_counts}</div>';
                $glReplace = '<div>{total_visits_label}{total_visits_counts}</div>';
                $iconCR = $iconGL = $iconTD = '';
                
                if ( $avcConfig->apvc_atc_page_count[0] !== "on" ) {
                    $shHTML = str_replace( $crReplace, "", $shHTML );
                } else {
                    $shHTML = str_replace( $crReplace, '<div>' . $pageCnt . '</div>', $shHTML );
                }
                
                
                if ( $avcConfig->apvc_show_today_count[0] !== "on" ) {
                    $shHTML = str_replace( $tdReplace, '', $shHTML );
                } else {
                    $shHTML = str_replace( $tdReplace, '<div>' . $todaysCount . '</div>', $shHTML );
                }
                
                
                if ( $avcConfig->apvc_show_global_count[0] !== "on" ) {
                    $shHTML = str_replace( $glReplace, '', $shHTML );
                } else {
                    $shHTML = str_replace( $glReplace, '<div>' . $allTimeCount . '</div>', $shHTML );
                }
                
                $shHTML = str_replace( "{inline_style}", 'style="' . $widget_width . $padding . '' . $widAlignmentCss . '; margin-bottom :15px; color:' . $avcConfig->apvc_default_text_color[0] . '"', $shHTML );
                $shHTML = '<style type="text/css">' . $shortcodeData->css . '</style>' . $shHTML;
            } else {
                $ShortcodeHtml = "<div class='avc_visit_counter_front_simple' " . $style . ">" . $this->apvc_number_format( $pageCnt ) . " " . $this->apvc_number_format( $todaysCount ) . " " . $this->apvc_number_format( $allTimeCount ) . "</div>";
            }
            
            
            if ( $avcConfig->apvc_show_conter_on_front_side[0] == "disable" || $avcConfig->apvc_show_conter_on_front_side[0] == '' ) {
                return $content;
            } else {
                
                if ( $avcConfig->apvc_show_conter_on_front_side[0] == 'below_the_content' ) {
                    return $content . $shHTML . $ShortcodeHtml;
                } else {
                    if ( $avcConfig->apvc_show_conter_on_front_side[0] == 'above_the_content' ) {
                        return $shHTML . $ShortcodeHtml . $content;
                    }
                }
            
            }
        
        } else {
            return $content;
        }
    
    }
    
    /**
     * Advanced Page Visit Counter Shortcode Library.
     *
     * @since    3.0.1
     */
    public function apvc_get_shortcodes( $shortcode = '' )
    {
        $shortcodes = array();
        $shortcodes['template_3']['icon'] = 'yes';
        $shortcodes['template_3']['css'] = '.template_3{background:#1c8394;padding:15px;margin:15px;border-radius:50px;border:2px solid #1c8394;-webkit-box-shadow:3px 4px 12px -2px rgba(0,0,0,.68);-moz-box-shadow:3px 4px 12px -2px rgba(0,0,0,.68);box-shadow:3px 4px 12px -2px rgba(0,0,0,.68);font-family:calibri;font-size:13pt;text-align:center}.template_3>div{color:#fff;display:inline-block;margin:0 30px}.template_3>div>span{font-weight:700;margin-left:10px}.template_3 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_3>div{margin:0 10px}}@media (max-width:525px){.template_3>div{color:#fff;display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_3>div:last-child{border-bottom:none}}';
        $shortcodes['template_6']['icon'] = 'yes';
        $shortcodes['template_6']['class'] = 'effect2';
        $shortcodes['template_6']['css'] = '.template_6{background:#764ba2;background:linear-gradient(90deg,#667eea 0,#764ba2 100%);padding:15px;margin:15px;border-radius:40px;border:2px solid #764ba2;font-family:calibri;font-size:13pt;text-align:center}.effect2{position:relative}.effect2:after{z-index:-1;position:absolute;content:"";bottom:15px;right:10px;left:auto;width:50%;top:50%;max-width:300px;background:#777;-webkit-box-shadow:0 15px 10px #777;-moz-box-shadow:0 15px 10px #777;box-shadow:0 15px 10px #777;-webkit-transform:rotate(4deg);-moz-transform:rotate(4deg);-o-transform:rotate(4deg);-ms-transform:rotate(4deg);transform:rotate(4deg)}.template_6>div{color:#fff;display:inline-block;margin:0 30px}.template_6>div>span{font-weight:700;margin-left:10px}.template_6 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_6>div{margin:0 10px}}@media (max-width:525px){.template_6>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fcb8a1}.template_6>div:last-child{border-bottom:none}}';
        $shortcodes['template_7']['icon'] = 'yes';
        $shortcodes['template_7']['class'] = 'effect2';
        $shortcodes['template_7']['css'] = '.template_7{background:#dfa579;background:linear-gradient(90deg,#c79081 0,#dfa579 100%);padding:15px;margin:15px;border-radius:40px;border:2px solid #dfa579;font-family:calibri;font-size:13pt;text-align:center}.effect2{position:relative}.effect2:after,.effect2:before{z-index:-1;position:absolute;content:"";bottom:25px;left:10px;width:50%;top:35%;max-width:300px;background:#000;-webkit-box-shadow:0 35px 20px #000;-moz-box-shadow:0 35px 20px #000;box-shadow:0 35px 20px #000;-webkit-transform:rotate(-7deg);-moz-transform:rotate(-7deg);-o-transform:rotate(-7deg);-ms-transform:rotate(-7deg);transform:rotate(-7deg)}.effect2:after{-webkit-transform:rotate(7deg);-moz-transform:rotate(7deg);-o-transform:rotate(7deg);-ms-transform:rotate(7deg);transform:rotate(7deg);right:10px;left:auto}.template_7>div{color:#fff;display:inline-block;margin:0 30px}.template_7>div>span{font-weight:700;margin-left:10px}.template_7 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_7>div{margin:0 10px}}@media (max-width:525px){.template_7>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fcb8a1}.template_7>div:last-child{border-bottom:none}}';
        $shortcodes['template_8']['icon'] = 'yes';
        $shortcodes['template_8']['class'] = 'effect2';
        $shortcodes['template_8']['css'] = '.template_8{background:#5fc3e4;background:linear-gradient(90deg,#e55d87 0,#5fc3e4 100%);padding:15px;margin:15px;border:2px solid #5fc3e4;font-family:calibri;font-size:13pt;text-align:center}.effect2{position:relative;-webkit-box-shadow:0 1px 4px rgba(0,0,0,.3),0 0 40px rgba(0,0,0,.1) inset;-moz-box-shadow:0 1px 4px rgba(0,0,0,.3),0 0 40px rgba(0,0,0,.1) inset;box-shadow:0 1px 4px rgba(0,0,0,.3),0 0 40px rgba(0,0,0,.1) inset}.effect2:after,.effect2:before{content:"";position:absolute;z-index:-1;-webkit-box-shadow:0 0 20px rgba(0,0,0,.8);-moz-box-shadow:0 0 20px rgba(0,0,0,.8);box-shadow:0 0 20px rgba(0,0,0,.8);top:0;bottom:0;left:10px;right:10px;-moz-border-radius:100px/10px;border-radius:100px/10px}.effect2:after{right:10px;left:auto;-webkit-transform:skew(8deg) rotate(3deg);-moz-transform:skew(8deg) rotate(3deg);-ms-transform:skew(8deg) rotate(3deg);-o-transform:skew(8deg) rotate(3deg);transform:skew(8deg) rotate(3deg)}.template_8>div{color:#fff;display:inline-block;margin:0 30px}.template_8>div>span{font-weight:700;margin-left:10px}.template_8 .icons{color:#fff;margin-right:5px;font-weight:700}@media (max-width:644px){.template_8>div{margin:0 10px}}@media (max-width:525px){.template_8>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_8>div:last-child{border-bottom:none}}';
        $shortcodes['template_11']['icon'] = 'yes';
        $shortcodes['template_11']['css'] = '.template_11{background:#2980b9;background:linear-gradient(225deg,#2980b9 0,#6dd5fa 50%,#fff 100%);padding:15px;margin:15px;border-radius:40px;border:2px solid #2980b9;font-family:calibri;font-size:13pt;text-align:center}.template_11>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_11>div>span{font-weight:700;margin-left:10px}.template_11 .icons{color:#1a1a1a;margin-right:5px;font-weight:700}@media (max-width:644px){.template_11>div{margin:0 10px}}@media (max-width:525px){.template_11>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #2980b9}.template_11>div:last-child{border-bottom:none}}';
        $shortcodes['template_22']['icon'] = 'no';
        $shortcodes['template_22']['css'] = '.template_22{background:#355c7d;background:linear-gradient(90deg,#355c7d 0,#6c5b7b 50%,#c06c84 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_22>div{color:#fff;display:inline-block;margin:0 30px}.template_22>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_22>div{margin:0 10px}}@media (max-width:525px){.template_22>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #c06c84}.template_22>div:last-child{border-bottom:none}}';
        $shortcodes['template_23']['icon'] = 'no';
        $shortcodes['template_23']['css'] = '.template_23{background:#fc5c7d;background:linear-gradient(90deg,#fc5c7d 0,#6c5b7b 50%,#6a82fb 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_23>div{color:#fff;display:inline-block;margin:0 30px}.template_23>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_23>div{margin:0 10px}}@media (max-width:525px){.template_23>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #c06c84}.template_23>div:last-child{border-bottom:none}}';
        $shortcodes['template_24']['icon'] = 'no';
        $shortcodes['template_24']['css'] = '.template_24{background:#fffbd5;background:linear-gradient(90deg,#fffbd5 0,#b20a2c 50%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_24>div{color:#fff;display:inline-block;margin:0 30px}.template_24>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_24>div{margin:0 10px}}@media (max-width:525px){.template_24>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fffbd5}.template_24>div:last-child{border-bottom:none}}';
        $shortcodes['template_25']['icon'] = 'no';
        $shortcodes['template_25']['css'] = '.template_25{background:#302b63;background:linear-gradient(90deg,#0f0c29 0,#7365ff 50%,#24243e 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_25>div{color:#fff;display:inline-block;margin:0 30px}.template_25>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_25>div{margin:0 10px}}@media (max-width:525px){.template_25>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #0f0c29}.template_25>div:last-child{border-bottom:none}}';
        $shortcodes['template_26']['icon'] = 'no';
        $shortcodes['template_26']['css'] = '.template_26{background:#d3cce3;background:linear-gradient(90deg,#d3cce3 0,#e9e4f0 50%,#d3cce3 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.1);box-shadow:0 10px 14px 0 rgba(0,0,0,.1)}.template_26>div{color:#6a6279;display:inline-block;margin:0 30px}.template_26>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_26>div{margin:0 10px}}@media (max-width:525px){.template_26>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #7f7a8a}.template_26>div:last-child{border-bottom:none}}';
        $shortcodes['template_29']['icon'] = 'no';
        $shortcodes['template_29']['css'] = '.template_29{background:#6d6027;background:linear-gradient(90deg,#6d6027 0,#d3cbb8 80%,#3c3b3f 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_29>div{color:#fff;display:inline-block;margin:0 30px}.template_29>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_29>div{margin:0 10px}}@media (max-width:525px){.template_29>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #00f260}.template_29>div:last-child{border-bottom:none}}';
        $shortcodes['template_31']['icon'] = 'no';
        $shortcodes['template_31']['css'] = '.template_31{background:#3a1c71;background:linear-gradient(90deg,#3a1c71 0,#d76d77 25%,#ffaf7b 50%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_31>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_31>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_31>div{margin:0 10px}}@media (max-width:525px){.template_31>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_31>div:last-child{border-bottom:none}}';
        $shortcodes['template_34']['icon'] = 'no';
        $shortcodes['template_34']['css'] = '.template_34{background:#f7971e;background:linear-gradient(90deg,#f7971e 0,#ffd200 50%,#f7971e 1%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_34>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_34>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_34>div{margin:0 10px}}@media (max-width:525px){.template_34>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_34>div:last-child{border-bottom:none}}';
        $shortcodes['template_39']['icon'] = 'no';
        $shortcodes['template_39']['css'] = '.template_39{background:#000;background:linear-gradient(90deg,#000 0,#b3cc2c 50%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_39>div{color:#fff;display:inline-block;margin:0 30px}.template_39>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_39>div{margin:0 10px}}@media (max-width:525px){.template_39>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_39>div:last-child{border-bottom:none}}';
        $shortcodes['template_40']['icon'] = 'no';
        $shortcodes['template_40']['css'] = '.template_40{background:#ba8b02;background:linear-gradient(90deg,#ba8b02 0,#ffd65d 80%,#ba8b02 100%);padding:15px;margin:15px;font-family:calibri;font-size:13pt;text-align:center;-webkit-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);-moz-box-shadow:0 10px 14px 0 rgba(0,0,0,.2);box-shadow:0 10px 14px 0 rgba(0,0,0,.2)}.template_40>div{color:#1a1a1a;display:inline-block;margin:0 30px}.template_40>div>span{font-weight:700;margin-left:10px}@media (max-width:644px){.template_40>div{margin:0 10px}}@media (max-width:525px){.template_40>div{display:block;margin:0;padding:10px 0;border-bottom:1px solid #fff}.template_40>div:last-child{border-bottom:none}}';
        
        if ( !empty($shortcode) ) {
            return wp_json_encode( $shortcodes[$shortcode] );
        } else {
            return wp_json_encode( $shortcodes );
        }
    
    }
    
    public function apvc_number_format( $num )
    {
        $op = get_option( 'numbers_in_k' );
        if ( $op == 'Yes' ) {
            
            if ( $num > 1000 ) {
                $x = round( $num );
                $x_number_format = number_format( $x );
                $x_array = explode( ',', $x_number_format );
                $x_parts = array(
                    'k',
                    'm',
                    'b',
                    't'
                );
                $x_count_parts = count( $x_array ) - 1;
                $x_display = $x;
                $x_display = $x_array[0] . (( (int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '' ));
                $x_display .= $x_parts[$x_count_parts - 1];
                return $x_display;
            }
        
        }
        return $num;
    }

}