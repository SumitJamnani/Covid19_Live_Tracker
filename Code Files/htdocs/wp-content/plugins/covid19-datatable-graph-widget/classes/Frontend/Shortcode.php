<?php

namespace Braintum\Corona\Frontend;

class Shortcode
{
    function __construct(){
        add_shortcode( 'BTCORONA-WIDGET', array($this, 'braintumc_shortcode') );
        add_shortcode( 'BTCORONA-LINE', array($this, 'braintumc_short_line') );
        add_shortcode( 'BTCORONA-TICKER', array($this, 'braintumc_short_ticker') );
        add_shortcode( 'BTCORONA-SHEET', array($this, 'braintumc_short_sheet') );
        add_shortcode( 'BTCORONA-ROLL', array($this, 'braintumc_short_roll') );
        add_shortcode( 'BTCORONA-GRAPH', array($this, 'braintumc_short_graph') );
        add_action( 'wp_enqueue_scripts', array( $this, 'braintumc_enqueues' ) );
    }

    // ISO 3166-1 UN Geoscheme regional codes
	// https://github.com/lukes/ISO-3166-Countries-with-Regional-Codes
    public $lands = array(
        'NorthAmerica' => 'AIAATGABWBHSBRBBLZBMUBESVGBCANCYMCRICUBCUWDMADOMSLVGRLGRDGLPGTMHTIHNDJAMMTQMEXSPMMSRANTKNANICPANPRIBESBESSXMKNALCASPMVCTTTOTCAUSAVIR','SouthAmerica' => 'ARGBOLBRACHLCOLECUFLKGUFGUYPRYPERSURURYVEN','Africa' => 'DZAAGOSHNBENBWABFABDICMRCPVCAFTCDCOMCOGCODDJIEGYGNQERISWZETHGABGMBGHAGINGNBCIVKENLSOLBRLBYMDGMWIMLIMRTMUSMYTMARMOZNAMNERNGASTPREURWASTPSENSYCSLESOMZAFSSDSHNSDNSWZTZATGOTUNUGACODZMBTZAZWE','Asia' => 'AFGARMAZEBHRBGDBTNBRNKHMCHNCXRCCKIOTGEOHKGINDIDNIRNIRQISRJPNJORKAZKWTKGZLAOLBNMACMYSMDVMNGMMRNPLPRKOMNPAKPSEPHLQATSAUSGPKORLKASYRTWNTJKTHATURTKMAREUZBVNMYEM','Europe' => 'ALBANDAUTBLRBELBIHBGRHRVCYPCZEDNKESTFROFINFRADEUGIBGRCHUNISLIRLIMNITAXKXLVALIELTULUXMKDMLTMDAMCOMNENLDNORPOLPRTROURUSSMRSRBSVKSVNESPSWECHEUKRGBRVATRSB','Oceania' => 'ASMAUSNZLCOKTLSFSMFJIPYFGUMKIRMNPMHLUMINRUNCLNZLNIUNFKPLWPNGMNPWSMSLBTKLTONTUVVUTUMIWLF'
    );

    /**
     * Callback for BTCORONA-WIDGET shortcode
     * @return html
     */
    function braintumc_shortcode( $atts ){
        $params = shortcode_atts( array(
            'title_widget' => esc_attr__( 'Worldwide', 'btcorona' ),
            'country' => null,
            'land' => '',
            'confirmed_title' => esc_attr__( 'Cases', 'btcorona' ),
            'today_cases' => esc_attr__( '24h', 'btcorona' ),
            'deaths_title' => esc_attr__( 'Deaths', 'btcorona' ),
            'today_deaths' => esc_attr__( '24h', 'btcorona' ),
            'recovered_title' => esc_attr__( 'Recovered', 'btcorona' ),
            'active_title' => esc_attr__( 'Active', 'btcorona' ),
            'total_title' => esc_attr__( 'Total', 'btcorona' ),
            'format' => 'default'
        ), $atts );

        if ($params['format'] === 'full') {
            $params['format'] = true;
        }

        $data = get_option('braintumcAL');
        if ($params['country'] || $params['format'] == 'card' ) {
            $data = get_option('braintumcCC');
            if ($params['country'] && $params['format'] !== 'card' ) {
                $new_array = array_filter($data, function($obj) use($params) {
                    if ($obj->country === $params['country']) {
                        return true;
                    }
                    return false;
                });
                if ($new_array) {
                    $data = reset($new_array);
                }
            }
        }
        
        if ($params['land']) {
            $countries = $this->lands[$params['land']];
            $countries = str_split($countries, 3);
            $new_array = array_filter($data, function($obj) use($countries) {
                if (in_array($obj->countryInfo->iso3, $countries)) {
                    return true;
                }
                return false;
            });

            if ($new_array) {
                $data = $new_array;
            }
        }
        
        ob_start();
        if ($params['format'] == 'full') {
            echo $this->render_card($params, $data);
        } else {
            echo $this->render_widget($params, $data);
        }
        return ob_get_clean();
    }

    function render_card($params, $data){
        ob_start();
        include( BT_CORONA_PATH .'templates/render_card.php');
        return ob_get_clean();
    }

    function render_widget($params, $data){
        wp_enqueue_style( 'covid' );
        $all_options = get_option( 'btncov_options' );
        ob_start();
        include( BT_CORONA_PATH .'templates/render_widget.php');
        return ob_get_clean();
    }

    /**
     * Callback for BTCORONA-LINE shortcode
     * @return html
     */
    function braintumc_short_line( $atts ){
        $params = shortcode_atts( array(
            'country' => null,
            'confirmed_title' => esc_attr__( 'Cases', 'btcorona' ),
            'deaths_title' => esc_attr__( 'Deaths', 'btcorona' ),
            'recovered_title' => esc_attr__( 'Recovered', 'btcorona' ),
            'today_title' => esc_attr__( 'Today', 'btcorona' ),
        ), $atts );
        $data = get_option('braintumcAL');
        if ($params['country']) {
            $data = get_option('braintumcCC');
            if ($params['country']) {
                $new_array = array_filter($data, function($obj) use($params) {
                    if ($obj->country === $params['country']) {
                        return true;
                    }
                    return false;
                });
                if ($new_array) {
                    $data = reset($new_array);
                }
            }
        }
        ob_start();
        echo $this->render_line($params, $data);
        return ob_get_clean();
    }

    function render_line($params, $data){
        wp_enqueue_style( 'covid' );
        $all_options = get_option( 'btncov_options' );
        ob_start();
        ?>
        <span class="covid19-value">
            <?php echo esc_html($params['confirmed_title']); ?> <?php echo number_format($data->cases); ?>, <?php echo esc_html($params['deaths_title']); ?> <?php echo number_format($data->deaths); ?>, <?php echo esc_html($params['recovered_title']); ?> <?php echo number_format($data->recovered); ?>
        </span>
        <?php
        return ob_get_clean();
    }

    /**
     * Callback for BTCORONA-TICKER shortcode
     * @return html
     */
    function braintumc_short_ticker( $atts ){
        $params = shortcode_atts( array(
            'country' => null,
            'confirmed_title' => esc_attr__( 'Cases', 'btcorona' ),
            'deaths_title' => esc_attr__( 'Deaths', 'btcorona' ),
            'recovered_title' => esc_attr__( 'Recovered', 'btcorona' ),
            'ticker_title' => esc_attr__( 'World', 'btcorona' ),
            'style' => 'vertical'
        ), $atts );
        $data = get_option('braintumcAL');
        if ($params['country']) {
            $data = get_option('braintumcCC');
            if ($params['country']) {
                $new_array = array_filter($data, function($obj) use($params) {
                    if ($obj->country === $params['country']) {
                        return true;
                    }
                    return false;
                });
                if ($new_array) {
                    $data = reset($new_array);
                }
            }
        }
    
        if ($params['style'] === 'vertical') {
            $params['style'] = 'vertical';
        } else {
            $params['style'] = 'horizontal';
        }

        ob_start();
        echo $this->render_ticker($params, $data);
        return ob_get_clean();
    }

    function render_ticker($params, $data){
        wp_enqueue_style( 'covid' );
        $dataAll = get_option('braintumcAL');
        $all_options = get_option( 'btncov_options' );
        ob_start();
        include( BT_CORONA_PATH .'templates/render_ticker.php');
        return ob_get_clean();
    }


    /**
     * Callback for BTCORONA-SHEET shortcode
     * @return html
     */
    function braintumc_short_sheet( $atts ){
        $params = shortcode_atts( array(
            'confirmed_title' => esc_attr__( 'Total Cases', 'btcorona' ),
            'today_cases' => esc_attr__( '24h', 'btcorona' ),
            'deaths_title' => esc_attr__( 'Total Deaths', 'btcorona' ),
            'today_deaths' => esc_attr__( '24h', 'btcorona' ),
            'recovered_title' => esc_attr__( 'Recovered', 'btcorona' ),
            'active_title' => esc_attr__( 'Active', 'btcorona' ),
            'country_title' => esc_attr__( 'Country', 'btcorona' ),
            'lang_url' => '',
            'search' =>  esc_attr__( 'Search by Country...', 'btcorona' ),
            'country' => false,
            'land' => '',
            'rows' => 20
        ), $atts );
        $data = get_option('braintumcCC');
        
        if ($params['land']) {
            $countries = $this->lands[$params['land']];
            $countries = str_split($countries, 3);
            $new_array = array_filter($data, function($obj) use($countries) {
                if (in_array($obj->countryInfo->iso3, $countries)) {
                    return true;
                }
                return false;
            });

            if ($new_array) {
                $data = $new_array;
            }
        }
        
        ob_start();
        echo $this->render_sheet($params, $data);
        return ob_get_clean();
    }

    function render_sheet($params, $data){

        wp_enqueue_style( 'covid' );
        wp_enqueue_style( 'jquery.datatables' );
        wp_enqueue_script( 'jquery.datatables' );

        $uniqId = 'covid_table_'.md5(uniqid(rand(),1));
        $all_options = get_option( 'btncov_options' );


        $js = 'jQuery(\'#'.$uniqId.'\').DataTable({
            "scrollX": false,
            "responsive": true,
            "fixedColumns": true,
            "bInfo" : false,
            "lengthMenu": [[10, 20, 50, 100], [10, 20, 50, 100]],
            "order": [[ 1, "desc" ]],
            "searching": true,
            "language": {
                "url": "'. $params['lang_url'] .'",
                "search": "_INPUT_",
                "sLengthMenu": "_MENU_",
                "searchPlaceholder": "'.$params['search'].'",
                "paginate": {
                    "next": "»",
                    "previous": "«"
                }
            }
        });';

        wp_enqueue_script( 'covidsheet' );

        wp_add_inline_script( 'covidsheet', $js );

        ob_start();
        include( BT_CORONA_PATH .'templates/render_sheet.php');
        return ob_get_clean();

    }


    /**
     * Callback for BTCORONA-ROLL shortcode
     * @return html
     */
    function braintumc_short_roll( $atts ){
        $params = shortcode_atts( array(
            'title_widget' => esc_attr__( 'Worldwide Stat', 'btcorona' ),
            'confirmed_title' => esc_attr__( 'Cases', 'btcorona' ),
            'deaths_title' => esc_attr__( 'Deaths', 'btcorona' ),
            'recovered_title' => esc_attr__( 'Recovered', 'btcorona' ),
            'country_title' => esc_attr__( 'Country', 'btcorona' ),
            'total_title' => esc_attr__( 'Total', 'btcorona' ),
        ), $atts );
        $data = get_option('braintumcCC');

        ob_start();
        echo $this->render_roll($params, $data);
        return ob_get_clean();
    }
    		
    function render_roll($params, $data){
        wp_enqueue_style( 'covid' );
        $dataAll = get_option('braintumcAL');
        $all_options = get_option( 'btncov_options' );
        ob_start();
        include( BT_CORONA_PATH .'templates/render_roll.php');
        return ob_get_clean();
    }

    /**
     * Callback for BTCORONA-GRAPH shortcode
     * @return html
     */
    function braintumc_short_graph( $atts ){
        $params = shortcode_atts( array(
            'title' => esc_attr__( 'Worldwide', 'btcorona' ),
            'country' => null,
            'confirmed_title' => esc_attr__( 'Cases', 'btcorona' ),
            'deaths_title' => esc_attr__( 'Deaths', 'btcorona' ),
            'recovered_title' => esc_attr__( 'Recovered', 'btcorona' ),
            'updated_title' => esc_attr__( 'Updated: ', 'btcorona' )
        ), $atts );
        $data = get_option('braintumcAL');
        if ($params['country']) {
            $cron = new \Braintum\Corona\Cron();
            $data = $cron->btncovGen($params['country'], true);
        }
        ob_start();
        echo $this->render_graph($params, $data);
        return ob_get_clean();
    }
    
    function render_graph($params, $data){
        wp_enqueue_style( 'covid' );
        wp_enqueue_script( 'covid' );
        wp_enqueue_script( 'graph' );
        $uniqId = 'covid_graph_'.md5(uniqid(rand(),1));
        $all_options = get_option( 'btncov_options' );
        ob_start();
        include( BT_CORONA_PATH .'templates/render_graph.php');
        return ob_get_clean();
    }



    /**
     * Callback for Enqueue script
     * @return void
     */
    function braintumc_enqueues(){
        $btncov_options = get_option('btncov_options');
        wp_enqueue_style('braintumc_style', BT_CORONA_URL . 'assets/style.css', array(), BT_CORONA_VER );
        if(isset($btncov_options['cov_css'])){
			$custom_css = $btncov_options['cov_css'];
		}else{
			$custom_css = '';
		}
		$braintumc_custom_css = "{$custom_css}";
        wp_add_inline_style('braintumc_style', $braintumc_custom_css);
    }
}
