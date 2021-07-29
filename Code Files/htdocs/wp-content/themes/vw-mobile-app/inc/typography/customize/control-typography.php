<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Mobile_App_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-mobile-app' ),
				'family'      => esc_html__( 'Font Family', 'vw-mobile-app' ),
				'size'        => esc_html__( 'Font Size',   'vw-mobile-app' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-mobile-app' ),
				'style'       => esc_html__( 'Font Style',  'vw-mobile-app' ),
				'line_height' => esc_html__( 'Line Height', 'vw-mobile-app' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-mobile-app' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-mobile-app-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-mobile-app-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-mobile-app' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-mobile-app' ),
        'Acme' => __( 'Acme', 'vw-mobile-app' ),
        'Anton' => __( 'Anton', 'vw-mobile-app' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-mobile-app' ),
        'Arimo' => __( 'Arimo', 'vw-mobile-app' ),
        'Arsenal' => __( 'Arsenal', 'vw-mobile-app' ),
        'Arvo' => __( 'Arvo', 'vw-mobile-app' ),
        'Alegreya' => __( 'Alegreya', 'vw-mobile-app' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-mobile-app' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-mobile-app' ),
        'Bangers' => __( 'Bangers', 'vw-mobile-app' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-mobile-app' ),
        'Bad Script' => __( 'Bad Script', 'vw-mobile-app' ),
        'Bitter' => __( 'Bitter', 'vw-mobile-app' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-mobile-app' ),
        'BenchNine' => __( 'BenchNine', 'vw-mobile-app' ),
        'Cabin' => __( 'Cabin', 'vw-mobile-app' ),
        'Cardo' => __( 'Cardo', 'vw-mobile-app' ),
        'Courgette' => __( 'Courgette', 'vw-mobile-app' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-mobile-app' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-mobile-app' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-mobile-app' ),
        'Cuprum' => __( 'Cuprum', 'vw-mobile-app' ),
        'Cookie' => __( 'Cookie', 'vw-mobile-app' ),
        'Chewy' => __( 'Chewy', 'vw-mobile-app' ),
        'Days One' => __( 'Days One', 'vw-mobile-app' ),
        'Dosis' => __( 'Dosis', 'vw-mobile-app' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-mobile-app' ),
        'Economica' => __( 'Economica', 'vw-mobile-app' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-mobile-app' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-mobile-app' ),
        'Francois One' => __( 'Francois One', 'vw-mobile-app' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-mobile-app' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-mobile-app' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-mobile-app' ),
        'Handlee' => __( 'Handlee', 'vw-mobile-app' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-mobile-app' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-mobile-app' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-mobile-app' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-mobile-app' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-mobile-app' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-mobile-app' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-mobile-app' ),
        'Kanit' => __( 'Kanit', 'vw-mobile-app' ),
        'Lobster' => __( 'Lobster', 'vw-mobile-app' ),
        'Lato' => __( 'Lato', 'vw-mobile-app' ),
        'Lora' => __( 'Lora', 'vw-mobile-app' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-mobile-app' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-mobile-app' ),
        'Merriweather' => __( 'Merriweather', 'vw-mobile-app' ),
        'Monda' => __( 'Monda', 'vw-mobile-app' ),
        'Montserrat' => __( 'Montserrat', 'vw-mobile-app' ),
        'Muli' => __( 'Muli', 'vw-mobile-app' ),
        'Marck Script' => __( 'Marck Script', 'vw-mobile-app' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-mobile-app' ),
        'Open Sans' => __( 'Open Sans', 'vw-mobile-app' ),
        'Overpass' => __( 'Overpass', 'vw-mobile-app' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-mobile-app' ),
        'Oxygen' => __( 'Oxygen', 'vw-mobile-app' ),
        'Orbitron' => __( 'Orbitron', 'vw-mobile-app' ),
        'Patua One' => __( 'Patua One', 'vw-mobile-app' ),
        'Pacifico' => __( 'Pacifico', 'vw-mobile-app' ),
        'Padauk' => __( 'Padauk', 'vw-mobile-app' ),
        'Playball' => __( 'Playball', 'vw-mobile-app' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-mobile-app' ),
        'PT Sans' => __( 'PT Sans', 'vw-mobile-app' ),
        'Philosopher' => __( 'Philosopher', 'vw-mobile-app' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-mobile-app' ),
        'Poiret One' => __( 'Poiret One', 'vw-mobile-app' ),
        'Quicksand' => __( 'Quicksand', 'vw-mobile-app' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-mobile-app' ),
        'Raleway' => __( 'Raleway', 'vw-mobile-app' ),
        'Rubik' => __( 'Rubik', 'vw-mobile-app' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-mobile-app' ),
        'Russo One' => __( 'Russo One', 'vw-mobile-app' ),
        'Righteous' => __( 'Righteous', 'vw-mobile-app' ),
        'Slabo' => __( 'Slabo', 'vw-mobile-app' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-mobile-app' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-mobile-app'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-mobile-app' ),
        'Sacramento' => __( 'Sacramento', 'vw-mobile-app' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-mobile-app' ),
        'Tangerine' => __( 'Tangerine', 'vw-mobile-app' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-mobile-app' ),
        'VT323' => __( 'VT323', 'vw-mobile-app' ),
        'Varela Round' => __( 'Varela Round', 'vw-mobile-app' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-mobile-app' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-mobile-app' ),
        'Volkhov' => __( 'Volkhov', 'vw-mobile-app' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-mobile-app' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-mobile-app' ),
			'100' => esc_html__( 'Thin',       'vw-mobile-app' ),
			'300' => esc_html__( 'Light',      'vw-mobile-app' ),
			'400' => esc_html__( 'Normal',     'vw-mobile-app' ),
			'500' => esc_html__( 'Medium',     'vw-mobile-app' ),
			'700' => esc_html__( 'Bold',       'vw-mobile-app' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-mobile-app' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-mobile-app' ),
			'italic'  => esc_html__( 'Italic', 'vw-mobile-app' ),
			'oblique' => esc_html__( 'Oblique', 'vw-mobile-app' )
		);
	}
}
