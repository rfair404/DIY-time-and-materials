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
		add_filter( 'the_content', array( $this, 'display_content' ), 10 );
		add_action( 'wp_print_scripts', array( $this, 'print_css' ), 10 );
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
		return sprintf( '<span class="diy-tam diy-tam-%s">%s: %s</span>', $taxonomy, ucfirst( $taxonomy_object->name ), self::link_terms( $terms ) );
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

		$inline_css = '<style type="text/css">';
		$inline_css .= '.diy-tam{';

		if ( $custom_color ) {
			$inline_css .= "color:$custom_color;";
		}

			$inline_css .= 'display:inline-block;';
			$inline_css .= 'margin-right:1em;';
			$inline_css .= 'margin-right:1em;';
		$inline_css .= '}';
		$inline_css .= '</style>';
		if ( true === $return ) {
			return esc_html( $inline_css );
		} else {
			echo esc_html( $inline_css );
		}
	}

	/**
	 * Gets the color for the terms
	 *
	 * @since 0.1-alpha
	 */
	function get_color() {
		return apply_filters( 'diy_tam_color', get_option( 'diy_tam_color' ) );
	}
}
