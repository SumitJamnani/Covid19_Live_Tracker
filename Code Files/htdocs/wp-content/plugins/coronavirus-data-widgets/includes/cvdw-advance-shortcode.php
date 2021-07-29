<?php
class CVDW_Advance_Shortcode
{
function __construct() {
    
    add_shortcode( 'cvct-advance', array($this, 'cvdw_tickers_shortcode' ));      
    add_action( 'wp_footer', array($this,'cvdw_ticker_in_footer') );
	
}

/*
|--------------------------------------------------------------------------
| Shows ticker in Footer
|--------------------------------------------------------------------------
*/
function cvdw_ticker_in_footer(){

    if (!wp_script_is('jquery', 'done')) {
        wp_enqueue_script('jquery');
    }
    
    $ids = array();
    $header_id = get_option('cvct-p-id');
    $footer_id = get_option('cvct-fp-id');
    
    if($header_id != $footer_id){
        $ids=[$header_id,$footer_id];
    }
    else{
        $ids=[$header_id];
    }    

    if(!empty($ids)){
        foreach($ids as $id){
            
            $type = 'ticker';
            //------------------------------------------------------------------
            $page_select = get_post_meta($id,'cvct_ticker_disable', true ) ;
            $ids_arr= explode(',',$page_select);
            global $wp_query;
            $ticker_position = get_post_meta($id,'cvct_ticker_position', true );
            if($ticker_position=="header"||$ticker_position=="footer"){
                if ( is_object($wp_query->post) && !in_array($wp_query->post->ID,$ids_arr)){
                    echo do_shortcode("[cvct-advance id=".$id."]");
                }
            }
        }
    }
    
}

public function get_ticker_data( $selected_countries){
   if(is_array($selected_countries)){
    $countries_data=[];
    if (false !== $key = array_search('World', $selected_countries)) {
        $global = CVDW_g_stats_data();
        $k='World';
        $active_case= $global['total_cases'] - ($global['total_deaths']+$global['total_recovered']);
        $flag=CVDW_URL.'/assets/images/cvdw-world.png';
        $countries_data[$k]['flag']=$flag;
        $countries_data[$k]['cases']=$global['total_cases'];
        $countries_data[$k]['deaths']=$global['total_deaths'];
        $countries_data[$k]['recovered']=$global['total_recovered'];
        $countries_data[$k]['active']=$active_case;
        unset($selected_countries[$key]);
    }
    $cvct_get_data = CVDW_get_all_country_data();
if(is_array($cvct_get_data)&& count($cvct_get_data)){
    /* echo'<pre>';
    var_dump($cvct_get_data);
    echo'<pre>'; */
    foreach($cvct_get_data as  $cvct_values){
        
        $country = $cvct_values['country'];
        if(!in_array($country,$selected_countries)){
             continue;
        }
     
        $countries_data[$country]['flag']=$cvct_values['flag'];
        $countries_data[$country]['cases']=$cvct_values['cases'];
        $countries_data[$country]['deaths']=$cvct_values['deaths'];
        $countries_data[$country]['recovered']=$cvct_values['recoverd'];
        $countries_data[$country]['active']=$cvct_values['active'];
            }
        }
   }
   return $countries_data;
}

function CVDW_register_frontend_assets(){

    /**
     * Ticker assets
    */
    wp_register_style("cvdw_tooltip_style",CVDW_URL.'assets/css/tooltipster.bundle.min.css',CVDW_VERSION,CVDW_VERSION);
    wp_register_script('cvdw-tooltip-js', CVDW_URL . 'assets/js/tooltipster.bundle.min.js', array('jquery', 'cvdw_bxslider_js'), CVDW_VERSION, true);
    wp_register_script('cvdw_bxslider_js', '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), CVDW_VERSION, true);
    wp_register_script('cvdw_ticker',CVDW_URL . 'assets/js/cvdw-ticker.min.js', array('jquery', 'cvdw_bxslider_js'),CVDW_VERSION, true);

		
}
function cvdw_tickers_shortcode($atts, $content = null){
    $atts = shortcode_atts( array(
        'id'=>'style-1'
    ), $atts, 'cvdw-ticker' );
    $post_id = $atts['id'];

    $post_status = get_post_status($post_id);
    $check_post_type = get_post_type($post_id);
   
    // make sure the post is already published!
    if( $check_post_type!='cvct' || $post_status != 'publish' ){
            return;
    }

    $ticker_position = get_post_meta($post_id,'cvct_ticker_position', true );
    $style = get_post_meta($post_id,'cvct_style', true );
    $style="style-1";
    $selected_countries = get_post_meta($post_id,'cvct_select_countries', true );    
    $ticker_speed = get_post_meta($post_id,'cvct_ticker_speed', true );
    $ticker_speed = isset($ticker_speed)&&!empty($ticker_speed)?$ticker_speed:'10';  
    $t_speed =  $ticker_speed*1000;   
    $ticker_heading = get_post_meta($post_id,'cvct_ticker_heading', true );    
    $ticker_heading = isset($ticker_heading)&&!empty($ticker_heading)?$ticker_heading:__("Live Updates COVID-19 CASES","cvct"); 
    $background_color = get_post_meta($post_id,'cvct_bg_color', true );
    $text_color = get_post_meta($post_id,'cvct_text_color', true );
    $text_bg_color = get_post_meta($post_id,'cvct_text_bg_color', true );
   
    $confirmed_label = get_post_meta($post_id,'cvct_confirmed_label', true );
    $confirmed_label = isset($confirmed_label)&&!empty($confirmed_label)?$confirmed_label:__("Confirmed","cvct");
        
    $active_label = get_post_meta($post_id,'cvct_active_label', true );
    $active_label = isset($active_label)&&!empty($active_label)?$active_label:__("Active","cvct"); 

    $death_label = get_post_meta($post_id,'cvct_death_label', true );
    $death_label = isset($death_label)&&!empty($death_label)?$death_label:__("Death","cvct"); 
    
    $recovered_label = get_post_meta($post_id,'cvct_recovered_label', true );
    $recovered_label = isset($recovered_label)&&!empty($recovered_label)?$recovered_label:__("Recovered","cvct"); 

    $dynamic_styles='';
    $bg_color=!empty($background_color)? "background-color:".$background_color."!important;":"background-color:#fff;";
    $fnt_color=!empty($text_color)? "color:".$text_color."!Important;":"color:#000;";
    $border_color=!empty($text_bg_color)? "border-color:".$text_bg_color."!important;":"border-color:red;";
    $text_bg_color=!empty($text_bg_color)? "background-color:".$text_bg_color."!important;":"background-color:red;";
    

    $custom_css = get_post_meta($post_id,'cvct_custom_css', true );
    
    $this->CVDW_register_frontend_assets();

    $total_count = 0;
    
    $output = '';
    $ticker_html = '';
    $ticker_id = "cvdw-ticker-widget-" . esc_attr($post_id);
    if($style=="style-1"){
       wp_enqueue_script('cvdw_ticker');
        wp_enqueue_script('cvdw-tooltip-js');
        wp_enqueue_style('cvdw_tooltip_style');    
        wp_enqueue_script('cvdw_bxslider_js');
        //wp_enqueue_style('cvdw_ticker_styles');
        wp_add_inline_script('cvdw_bxslider_js', 'jQuery(document).ready(function($){
            $(".cvdw-ticker #'.$ticker_id.'").each(function(index){
            var tickerCon=$(this);
            var ispeed=Number(tickerCon.attr("data-tickerspeed"));
        
            $(this).bxSlider({
                ticker:true,
                minSlides:1,
                maxSlides:12,
                slideWidth:"auto",
                tickerHover:true,
                wrapperClass:"cvdw-ticker-container",
                speed: ispeed,
                infiniteLoop:true
                });
            });
        });' ); 
    }
    

  
    $countries_data=$this->get_ticker_data( $selected_countries);
    
   if(is_array($countries_data)){
       foreach($countries_data as $country=> $all_info){
        $cases=$all_info['cases']? number_format($all_info['cases']):'N/A';
        $active=$all_info['active']? number_format($all_info['active']):'N/A';
        $recovered=$all_info['recovered']? number_format($all_info['recovered']):'N/A';
        $deaths=$all_info['deaths']? number_format($all_info['deaths']):'N/A';
        $flag=$all_info['flag']? $all_info['flag']:'N/A';
    
        
            
                $rpl_string=[' ','.'];
                $ticker_html .= '
                <li class="cvdw-tooltip ' . esc_attr(strtolower($country)) . '" data-tooltip-content="#tooltip_content_' . strtolower(str_replace($rpl_string, '', $country)).'">
                    <img src="' .$flag. '">
                    <span class="ticker-country">' . $country . '</span>
                    <span class="ticker-cases">' . $cases . '</span>
                    <div class="cvdw-ticker-tooltip-hidden">
                        <div id="tooltip_content_' .strtolower(str_replace($rpl_string, '', $country)). '">
                            <div class="tooltip-title">' . ucfirst($country) . '</div>
                            <div class="tooltip-cases"><b>'.$confirmed_label.':</b> ' .$cases. '</div>
                            <div class="tooltip-cases"><b>'.$active_label .':</b> ' .$active. '</div>
                            <div class="tooltip-cases"><b>'.$recovered_label .':</b> ' .$recovered. '</div>
                            <div class="tooltip-cases"><b>'.$death_label .':</b> ' .$deaths. '</div>
                        </div>
                    </div>
                </li>';
           

       
     }
  }

    $container_cls=''; $body_cls='';
    $id = "cvdw-ticker-widget-" . esc_attr($post_id);
   if($ticker_position=="footer"||$ticker_position=="header"){
        $cls='cvdw-sticky-ticker';
        if($ticker_position=="footer"){
            $container_cls='cvdw-ticker-footer';
            $body_cls ='cvdw-ticker-bottom';
        }else{
            $container_cls='cvdw-ticker-header';
            $body_cls ='cvdw-ticker-top';
        }					 
    }else{
         $cls='cvdw-ticker';
         $container_cls='';
    }

         
          
        $output .= '
        <div id="cvdw-ticker-'.$post_id.'" class="cvdw-ticker cvdw-ticker-'.$style.' '.esc_attr($container_cls).'" data-ticker-style="'.$style.'" data-ticker-position-cls="'.$body_cls.'">
            <div class="cvdw-ticker-heading">'.$ticker_heading.'</div>             
            <ul data-tickerspeed="'.$t_speed.'" id="'.$id.'">'.$ticker_html.'</ul>                   
        </div>';
    
    $dynamic_styles ='';
    $dynamic_styles .="
    #cvdw-ticker-$post_id.cvdw-ticker-style-1 {".$bg_color." ".$fnt_color."}
    #cvdw-ticker-$post_id.cvdw-ticker-style-1 .cvdw-ticker-heading {".$text_bg_color."}
    .tooltipster-sidetip .tooltipster-box {".$bg_color."}
    .tooltipster-sidetip .tooltipster-box .tooltipster-content {".$fnt_color."}
    .tooltipster-sidetip.tooltipster-top .tooltipster-arrow-border {border-top-color: ".$background_color." !important;}
    .tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-border {border-bottom-color: ".$background_color." !important;}";
    $dynamic_styles .= $custom_css;
    
    $css='<style>'. esc_html($this->cvdw_ticker_styles($dynamic_styles, $style)).'</style>';
    
   // wp_add_inline_style('cvdw_ticker_styles', $dynamic_styles.$custom_css);

    $cvct='<!-- COVID-19 Tracker - Version:- '.CVDW_VERSION.' By Cool Plugins (CoolPlugins.net) -->';	
    
     return $cvct.$output.$css;

}

function cvdw_ticker_styles($dynamic_styles, $style){
    $css='';
    if($style=="style-1") {
        $css .= "
        .cvdw-ticker-style-1 {
            display: table;
            width: 100%;
            padding: 0;
            margin: 0;
            z-index: 9999999;
            min-height: 35px;
        }
        .cvdw-ticker-style-1 .cvdw-ticker-heading,
        .cvdw-ticker-style-1 .cvdw-ticker-container {
            display: table-cell;
            vertical-align: middle;
        }
        .cvdw-ticker-style-1 .cvdw-ticker-heading {
            width: 175px;
            font-size: 14px;
            line-height: 16px;
            font-weight: bold;
            padding: 3px;
            text-align: center;
            text-shadow: 1px 0px 3px #000;
            color: #fff;
            background: #121d38;
        }
        .cvdw-ticker-style-1 ul {
            display: inline-block;
            padding: 0;
            margin: 0;
        }
        .cvdw-ticker-style-1 ul li {
            display: inline-block;
            padding: 3px;
            margin: 0 25px 0 0;
            font-size: 14px;
            line-height: 18px;
            cursor: pointer;
            vertical-align: middle;
            width: auto;
        }
        .cvdw-ticker-style-1 li img {
            display: inline-block;
            vertical-align: middle;
            width: 20px;
            padding: 0;
            margin: 0 5px 0 0;
        }
        .cvdw-ticker-style-1 li .ticker-cases {
            font-weight: bold;
            margin: 0 0 0 8px;
            vertical-align: middle;
        }
        .cvdw-ticker-style-1 li .ticker-country {
            vertical-align: middle;
        }
        .cvdw-ticker-tooltip-hidden {
            display: none;
        }
        .tooltipster-box {
            background-color: #eee;
            border-color: #eee;
            text-align: center;
        }
        .tooltip-title {
            margin: 7px 0;
            font-size: 18px;
            line-height: 22px;
        }
        .tooltip-cases {
            font-size: 14px;
            line-height: 20px;
            text-align: left;
        }
        .tooltipster-top .tooltipster-box {
            margin-bottom: 8px;
        }
        .tooltipster-sidetip.tooltipster-top .tooltipster-arrow-border {
            border-top-color: #eee;
        }
        .tooltipster-bottom .tooltipster-box {
            margin-top: 10px;
        }
        .tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-border {
            border-bottom-color: #eee;
        }
        body.cvdw-ticker-top {
            margin-top: 35px;
        }
        body.cvdw-ticker-bottom {
            margin-bottom: 35px;
        }
        ";
    }
    
    if(is_admin()){
        $css .= ".cvdw-ticker-footer, .cvdw-ticker-header{
            position: relative;
        }";
    }
    else{
        $css .= "
        .cvdw-ticker-footer,
        .cvdw-ticker-header {
            position: fixed;
            left: 0px;
        }
        .cvdw-ticker-header {
            top: 0;
            bottom: unset;
        }
        .cvdw-ticker-footer {
            bottom: 0;
            top: unset;
        }
        ";
    }
    
    return $css.$dynamic_styles;
}
}