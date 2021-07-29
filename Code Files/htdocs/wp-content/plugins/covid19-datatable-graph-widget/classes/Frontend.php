<?php

namespace Braintum\Corona;
/**
 * Frontend class
 * handles all required actions
 */
class Frontend{

    function __construct(){
        //$this->register_assets();
        new Frontend\Shortcode();
        add_filter('wp_enqueue_scripts', array($this, 'insert_jquery'),1);
        add_action('wp_enqueue_scripts', array($this, 'register_assets'));
    }

    /**
     * Registering frontend assets
     * @return void
     */
    function register_assets() {
        $braintumcAll = get_option('braintumcAL');
        $braintumcGC = get_option('braintumcCC');
        $braintumcGS = get_option('braintumcUS');
        $braintumcGH = get_option('braintumcCH');
        wp_register_style( 'covid', BT_CORONA_URL . 'assets/css/styles.css', array(), BT_CORONA_VER );
        wp_register_script( 'jquery.datatables', BT_CORONA_URL . 'assets/js/jquery.dataTables.min.js', array( 'jquery' ), BT_CORONA_VER, true );
        wp_register_script( 'graph', BT_CORONA_URL . 'assets/js/jquery.chart.min.js', array( 'jquery' ), BT_CORONA_VER, true );			
        wp_register_script( 'covid', BT_CORONA_URL . 'assets/js/scripts.js', array( 'jquery' ), BT_CORONA_VER, true );
        $translation_array = array(
            'all' => $braintumcAll,
            'countries' => $braintumcGC,
            'story' => $braintumcGH
        );
        wp_localize_script( 'covid', 'covid', $translation_array );

        wp_register_script( 'covidsheet', BT_CORONA_URL . 'assets/js/sheet-scripts.js', array( 'jquery' ), BT_CORONA_VER, true );
        
    }

    function insert_jquery(){
        wp_enqueue_script('jquery', false, array(), false, false);
    }
    

}
    