<?php 

namespace Braintum\Corona;
/**
 * Cron class
 */
class Cron
{
    function __construct(){
        $this->wp_parse_args();
		$this->braintumcDL();
    }

    		
    function wp_parse_args(){
        add_filter( 'cron_schedules', array( $this, 'add_wp_cron_schedule' ) );
        if ( ! wp_next_scheduled( 'wp_schedule_event' ) ) {
            $next_timestamp = wp_next_scheduled( 'wp_schedule_event' );
            if ( $next_timestamp ) {
                wp_unschedule_event( $next_timestamp, 'wp_schedule_event' );
            }
            wp_schedule_event( time(), 'every_10minute', 'wp_schedule_event' );
        }
        add_action( 'wp_schedule_event', array($this,'btncovGetA') );
    }
    
    function add_wp_cron_schedule( $schedules ) {
        $schedules['every_10minute'] = array(
            'interval' => 10*60,
            'display'  => esc_attr__( '10 min', 'btcorona' ),
        );
        return $schedules;
    }
    
    function btncovGetA() {
        $all = $this->btncovGen(false);
        $countries = $this->btncovGen(true);
        $story = $this->btncovGen(false, true);
        $braintumcAll = get_option('braintumcAL');
        $braintumcGC = get_option('braintumcCC');
        $braintumcGH = get_option('braintumcCH');

        if ($braintumcAll) {
            update_option( 'braintumcAL', $all );
        } else {
            add_option('braintumcAL', $all);
        }
        if ($braintumcGC) {
            update_option( 'braintumcCC', $countries );
        } else {
            add_option('braintumcCC', $countries);
        }
        if ($braintumcGH) {
            update_option( 'braintumcCH', $story );
        } else {
            add_option('braintumcCH', $story);
        }
    }
    
    function braintumcDL(){
        $braintumcAll = get_option('braintumcAL');
        $braintumcGC = get_option('braintumcCC');
        $braintumcGH = get_option('braintumcCH');
        if (!$braintumcGC) {
            $countries = $this->btncovGen(true);
            update_option( 'braintumcCC', $countries );
        }
        if (!$braintumcAll) {
            $all = $this->btncovGen(false);
            update_option( 'braintumcAL', $all );
        }
        if (!$braintumcGH) {
            $story = $this->btncovGen(false, true);
            update_option( 'braintumcCH', $story );
        }
    }
    
    function btncovGen($countries=false,$story=false){
        $btncovURI 	= 'https://api.caw.sh/';
        $btncovTrack = 'v2/all';
        
        if ($story) {
            $btncovTrack = 'v2/historical/all';
        }

        if ($countries && !$story) {
            $btncovTrack = 'v2/countries/?sort=cases';
        } else if ($story && $countries) {
            $btncovTrack = 'v2/historical/'.$countries.'?lastdays=60';
        }

        $btncovURI = $btncovURI.$btncovTrack;
        $args = array(
            'timeout' => 60
        ); 
        $request = wp_remote_get($btncovURI, $args);
        $body = wp_remote_retrieve_body( $request );
        $data = json_decode( $body );

        $btncovGen = current_time('timestamp');
        if (get_option('setUpd')) {
            update_option( 'setUpd', $btncovGen);
        } else {
            add_option( 'setUpd', $btncovGen );
        }

        return $data;
    }
}
