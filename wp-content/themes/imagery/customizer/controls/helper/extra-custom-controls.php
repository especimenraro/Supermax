<?php
	/**
	 * 	Helper/Sanitize for sortable multi-check boxes custom control.
	 * 	choice items
	 */
	if ( ! function_exists( 'imagery_front_elements' ) ) {
		/**
		 * Returns front-page sections for the customizer
		 */
		function imagery_front_elements() {

			// Default elements
			$elements = apply_filters( 'imagery_front_elements', array(
					'page_content'      => esc_html__( 'Page Content', 'imagery' ),
					'front_blog' 		=> esc_html__( 'Blog Posts', 'imagery' ),
					'front_portfolio' 	=> esc_html__( 'Portfolio Posts', 'imagery' ),
			) );

			// Return elements
			return $elements;

		}

	}

	if ( ! function_exists( 'imagery_front_elements_positioning' ) ) {
		/**
		 * Returns front-page sections positioning
		 */
		function imagery_front_elements_positioning() {

			// Default sections
			$sections = array( 'page_content', 'front_blog', 'front_portfolio' );

			// Get sections from Customizer
			$sections = get_theme_mod( 'front_sortable', $sections );

			// Turn into array if string
			if ( $sections && ! is_array( $sections ) ) {
				$sections = explode( ',', $sections );
			}

			// Apply filters for easy modification
			$sections = apply_filters( 'front_sortable', $sections );

			// Return sections
			return $sections;

		}

	}



	if ( ! function_exists( 'imagery_entry_elements' ) ) {
		/**
		 * Returns blog entry elements for the customizer
		 */
		function imagery_entry_elements() {

			// Default elements
			$elements = apply_filters( 'imagery_entry_elements', array(
				'featured_image'    => esc_html__( 'Featured Image', 'imagery' ),
				'title'       		=> esc_html__( 'Title', 'imagery' ),
				'meta' 				=> esc_html__( 'Meta', 'imagery' ),
				'content' 			=> esc_html__( 'Content', 'imagery' ),
				'read_more'   		=> esc_html__( 'Read More', 'imagery' ),
			) );

			// Return elements
			return $elements;

		}

	}


	if ( ! function_exists( 'imagery_entry_elements_positioning' ) ) {
		/**
		 * Returns blog entry elements positioning
		 */
		function imagery_entry_elements_positioning() {

			// Default sections
			$sections = array( 'featured_image', 'title', 'meta', 'content', 'read_more' );

			// Get sections from Customizer
			$sections = get_theme_mod( 'sample_imagery_sortable', $sections );

			// Turn into array if string
			if ( $sections && ! is_array( $sections ) ) {
				$sections = explode( ',', $sections );
			}

			// Apply filters for easy modification
			$sections = apply_filters( 'sample_imagery_sortable', $sections );

			// Return sections
			return $sections;

		}

	}

	/**
	 * Switch sanitization
	 *
	 * @param  string		Switch value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'imagery_switch_sanitization' ) ) {
		function imagery_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	/**
	 * Radio Button and Select sanitization
	 *
	 * @since Ephemeris 1.0
	 *
	 * @param  string		Radio Button value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'imagery_radio_sanitization' ) ) {
		function imagery_radio_sanitization( $input, $setting ) {
			//get the list of possible radio box or select options
         $choices = $setting->manager->get_control( $setting->id )->choices;

			if ( array_key_exists( $input, $choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}
	}

	/**
	 * Integer sanitization
	 *
	 * @param  string		Input value to check
	 * @return integer	Returned integer value
	 */
	if ( ! function_exists( 'imagery_sanitize_integer' ) ) {
		function imagery_sanitize_integer( $input ) {
			return (int) $input;
		}
	}

	/**
	 * Text sanitization
	 *
	 * @param  string	Input to be sanitized (either a string containing a single string or multiple, separated by commas)
	 * @return string	Sanitized input
	 */
	if ( ! function_exists( 'imagery_text_sanitization' ) ) {
		function imagery_text_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false) {
				$input = explode( ',', $input );
			}
			if( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[$key] = sanitize_text_field( $value );
				}
				$input = implode( ',', $input );
			}
			else {
				$input = sanitize_text_field( $input );
			}
			return $input;
		}
	}

	/**
	 * Only allow values between a certain minimum & maxmium range
	 *
	 * @param  number	Input to be sanitized
	 * @return number	Sanitized input
	 */
	if ( ! function_exists( 'imagery_in_range' ) ) {
		function imagery_in_range( $input, $min, $max ){
			if ( $input < $min ) {
				$input = $min;
			}
			if ( $input > $max ) {
				$input = $max;
			}
		    return $input;
		}
	}