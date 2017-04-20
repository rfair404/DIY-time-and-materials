<?php
/**
 * Class DIYTAM_Display does all of the front end output.
 * Class naming convention due to php 5.3 compatability (no namespace)
 *
 * @package DIY-time-and-materials
 */

/**
 * Front End Functionality.
 *
 * @since 0.1-alpha
 */
class DIYTAM_Display extends DIYTAM_Common {

	/**
	 * Initializes the other class functions
	 * Adds actions and filters to WordPress api.
	 *
	 * @since 0.1-alpha
	 */
	public function init() {
		$options = self::get_settings();

		add_filter( 'the_content', array( $this, 'display_content' ), 10 );
		add_action( 'wp_print_scripts', array( $this, 'print_css' ), 10 );

		// Only enqueue scripts if Font Awesome enabled.
		if ( isset( $options['enable_font_awesome'] ) && true === $options['enable_font_awesome'] ) {
			add_action( 'wp_print_scripts', array( $this, 'enqueue_scripts' ), 10 );
		}

		// Add a filter for each taxonomy.
		foreach ( self::get_taxonomy_list() as $taxonomy ) {
			add_filter( "diy_tam_taxonomy_classes_{$taxonomy}", array( $this, 'default_classes' ), 10, 2 );
			if ( isset( $options['enable_font_awesome'] ) && true === $options['enable_font_awesome'] ) {
				add_filter( "diy_tam_taxonomy_before_{$taxonomy}", array( $this, 'font_awesome_icons' ), 10, 2 );
			}
		}
	}

	/**
	 * Function checks if a post has terms within a taxonomy
	 *
	 * @since 0.1-alpha
	 * @param string $taxonomy the taxonomy for which to check if terms exist.
	 */
	function has_terms( $taxonomy = false ) {
		if ( ! $taxonomy ) {
			return false;
		}

		if ( ! get_taxonomy( $taxonomy ) ) {
			return false;
		}

		if ( ! is_singular( 'post' ) ) {
			return false;
		}

		return (bool) get_the_terms( get_the_ID(), $taxonomy );

	}

	 /**
	  * Function gets terms within a taxonomy for a given post
	  *
	  * @since 0.1-alpha
	  * @param string $taxonomy the taxonomy for which to get terms.
	  */
	function get_terms( $taxonomy = false ) {
		if ( ! self::has_terms( $taxonomy ) ) {
			return false;
		}

		return get_the_terms( get_the_ID(), $taxonomy );
	}

	/**
	 * Function lists the terms associated with a taxonomy
	 *
	 * @since 0.1-alpha
	 * @param string $taxonomy the taxonomy for which to list terms.
	 */
	function list_terms( $taxonomy = false ) {
		if ( ! self::has_terms( $taxonomy ) ) {
			return;
		}

		return self::markup_terms( $taxonomy, self::get_terms( $taxonomy ) );
	}

	/**
	 * Function creates the markup for the term lists.
	 *
	 * @since 0.1-alpha
	 * @param string $taxonomy the taxonomy for which to generate markup.
	 * @param array  $terms the list of terms to display.
	 */
	function markup_terms( $taxonomy, $terms ) {
		$taxonomy_object = get_taxonomy( $taxonomy );
		return sprintf( '<span class="%s">%s%s: %s</span>', implode( ' ', apply_filters( "diy_tam_taxonomy_classes_{$taxonomy}", array(), $taxonomy ) ), apply_filters( "diy_tam_taxonomy_before_{$taxonomy}", '', $taxonomy ), apply_filters( "diy_tam_taxonomy_name_{$taxonomy}", ucfirst( $taxonomy_object->name ) ), self::link_terms( $terms ) );
	}

	/**
	 * The Default classes built into to the taxonomy
	 *
	 * @since 0.1-alpha
	 * @param array  $classes the incoming classes to append.
	 * @param string $taxonomy the taxonomy to filter.
	 * @return array $classes the filtered classes.
	 */
	function default_classes( $classes = array(), $taxonomy = false ) {
	 	$classes = array( 'diy-tam', 'diy-tam-' . $taxonomy );
	 	return $classes;
	}

	/**
	 * The Font Awesome classes built into to the taxonomy
	 *
	 * @since 0.1-alpha
	 * @param string $markup the incoming markup if any.
	 * @param string $taxonomy the taxonomy to filter.
	 * @return array $classes the filtered classes.
	 */
	function font_awesome_icons( $markup = '', $taxonomy = false ) {

	 	switch ( $taxonomy ) {
	 		case 'difficulty':
	 			$markup .= '<i class="fa fa-line-chart"></i>';
	 			break;
	 		case 'time':
	 			$markup .= '<i class="fa fa-clock-o"></i>';
	 			break;
	 		case 'materials':
	 			$markup .= '<i class="fa fa-list"></i>';
	 			break;
	 	}
	 	return $markup;
	}

	/**
	 * Takes an array of term names and creates a list, with links.
	 *
	 * @param array $terms the terms to link.
	 */
	function link_terms( $terms = false ) {
		if ( ! $terms ) {
			return;
		}

		if ( 1 === count( $terms ) ) {
			return $terms[0]->name;
		}

		if ( is_array( $terms ) ) {
			return implode( ', ', wp_list_pluck( $terms, 'name' ) );
		}
	}

	/**
	 * Function displays the content, with terms if they exist.
	 *
	 * @since 0.1-alpha
	 * @param string $content the post content.
	 * @return string $content the new content.
	 */
	function display_content( $content = false ) {
		$taxonomies = self::get_taxonomy_list();
		$return_content = '';

		foreach ( $taxonomies as $taxonomy ) {
			if ( self::has_terms( $taxonomy ) ) {
				$return_content .= self::list_terms( $taxonomy );
			}
		}
		return $return_content . $content;
	}

	/**
	 * Prints the css for the terms
	 *
	 * @since 0.1-alpha
	 * @param bool $return if the function should return or echo the output.
	 */
	function print_css( $return = false ) {
		$custom_color = self::get_color();

		$inline_css = '.diy-tam{';

		if ( $custom_color ) {
			$inline_css .= sprintf( 'color:%s;', esc_attr( $custom_color ) );
		}

		$inline_css .= 'display:inline-block;';
		$inline_css .= 'margin-right:1em;';
		$inline_css .= 'margin-right:1em;';

		$inline_css .= '}';
		$inline_css .= '.diy-tam i{';
		$inline_css .= 'margin-right:0.5em;';
		$inline_css .= '}';
		if ( true === $return ) {
			return sprintf( '<style type="text/css">%s</style>', esc_html( $inline_css ) );
		} else {
			printf( '<style type="text/css">%s</style>', esc_html( $inline_css ) );
		}
	}

	/**
	 * Gets the color for the terms
	 *
	 * @since 0.1-alpha
	 */
	function get_color() {
		$option = get_option( self::get_textdomain() );
		return apply_filters( 'diy_tam_color', ( isset( $option['color'] ) ) ? $option['color'] : false );
	}

	/**
	 * Enques the scripts and styles used by the plugin
	 *
	 * @since 0.1-alpha
	 */
	function enqueue_scripts() {
		wp_enqueue_style( 'font-awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), 'screen' );
	}
}
