<?php
/*
   check admin side post type page
*/
function cvdw_get_post_type_page() {
    global $post, $typenow, $current_screen;
    
    if ( $post && $post->post_type ){
        return $post->post_type;
    }elseif( $typenow ){
        return $typenow;
    }elseif( $current_screen && $current_screen->post_type ){
        return $current_screen->post_type;
    }
    elseif( isset( $_REQUEST['post_type'] ) ){
        return sanitize_key( $_REQUEST['post_type'] );
    }
    elseif ( isset( $_REQUEST['post'] ) ) {
    return get_post_type( $_REQUEST['post'] );
    }
    return null;
}

   /*
|--------------------------------------------------------------------------
| fetches covid-19 all countries stats data
|--------------------------------------------------------------------------
*/ 
function CVDW_get_all_country_data(){
    $cache_name='cvct_countries_data';
   $cache=get_transient($cache_name);

    $country_stats_data = array();
    $data_arr = array();
      if($cache==false){
       $api_url = 'https://9kzzzfwgnwgef8dc.disease.sh/v2/countries?sort=cases';
       $api_req = wp_remote_get($api_url,array('timeout' => 120));
       if (is_wp_error($api_req)) {
        return false; // Bail early
    }
    $body = wp_remote_retrieve_body($api_req);
    $cs_data = json_decode($body);

     if(isset($cs_data)&& !empty($cs_data)){
    foreach($cs_data as  $all_country_data){
        $country_info = $all_country_data->countryInfo;
        $data_arr['cases'] = $all_country_data->cases;
        $data_arr['active'] = $all_country_data->active;
        $data_arr['country'] =  $all_country_data->country;
        $data_arr['confirmed'] = $all_country_data->cases;
        $data_arr['recoverd'] = $all_country_data->recovered;
        $data_arr['deaths'] = $all_country_data->deaths;
        $data_arr['flag'] = $country_info->flag;

       $country_stats_data[] = $data_arr;
      }
    set_transient($cache_name,
    $country_stats_data,
    CVDW_Cache_Timing);
   return $country_stats_data;
  }
 else{
     return false;
 }
  }
  else{
    return $country_stats_data =get_transient($cache_name);
  }
}


/*
|--------------------------------------------------------------------------
| fetch global stats
|--------------------------------------------------------------------------
*/  
function CVDW_g_stats_data(){
    $cache_name='cvct_gs';
     $cache=get_transient($cache_name);
     $cache=false;
    $gstats_data='';
    $save_arr=array();
if($cache==false){
         $api_url ='https://9kzzzfwgnwgef8dc.disease.sh/v2/all';
         $request = wp_remote_get($api_url, array('timeout' => 120));
         if (is_wp_error($request)) {
             return false; // Bail early
         }
         $body = wp_remote_retrieve_body($request);
         $gt_data = json_decode($body,true);
         if(is_array($gt_data ) && isset($gt_data['cases'])){
            $save_arr['total_cases']=$gt_data['cases'];
            $save_arr['total_recovered']=$gt_data['recovered'];
            $save_arr['total_deaths']=$gt_data['deaths'];
            set_transient($cache_name,
            $save_arr,CVDW_Cache_Timing
             ); 
            update_option("CVDW_gs_updated",date('Y-m-d h:i:s') );   
            $gstats_data=$save_arr;
                 return $gstats_data;
         }else{
         	return false;
         }
     }else{
     return $gstats_data=get_transient($cache_name);
     }
}


/*
|--------------------------------------------------------------------------
| fetch country stats
|--------------------------------------------------------------------------
*/  
function CVDW_c_stats_data($country_code){
    $cache_name='cvct_cs_'.$country_code;
    $cache=get_transient($cache_name);
    $cstats_data='';
    $save_arr=[];
   if($cache==false){
         $api_url = 'https://9kzzzfwgnwgef8dc.disease.sh/v2/countries/'.$country_code;
         $request = wp_remote_get($api_url, array('timeout' => 120));
         if (is_wp_error($request)) {
             return false; // Bail early
         }
         $body = wp_remote_retrieve_body($request);
         $cs_data = json_decode($body);
         if(isset($cs_data)&& !empty($cs_data)){
                $save_arr['total_cases']=$cs_data->cases;
               $save_arr['total_recovered']=$cs_data->recovered;
               $save_arr['total_deaths']=$cs_data->deaths;
               $save_arr['country']=$cs_data->country;
           set_transient($cache_name,
           $save_arr,CVDW_Cache_Timing);
            set_transient('api-source',
            'cvct-paid', CVDW_Cache_Timing);
             update_option("CVDW_cs_updated",date('Y-m-d h:i:s') );   
             $cstats_data= $save_arr;
                 return $cstats_data;
         }else{
             return false;
         }
     }else{
       return $cstats_data=get_transient($cache_name);
     }
   }
   

   function CVDW_load_assets(){
    wp_register_script("cvdw_resizer_sensor",CVDW_URL.'assets/js/css-resizer/ResizeSensor.min.js',array('jquery'),CVDW_VERSION,true);
    wp_register_script("cvdw_resizer_queries",CVDW_URL.'assets/js/css-resizer/ElementQueries.min.js',array('jquery'),CVDW_VERSION,true);

    wp_register_style("cvdw_cards_css",CVDW_URL.'assets/css/cvdw-cards.min.css');
   }