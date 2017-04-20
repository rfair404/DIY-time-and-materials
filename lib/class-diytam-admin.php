<?php
/**
 * Class DIYTAM_Admin
 * Class naming convention due to php 5.3 compatability (no namespace)
 *
 * @package DIY-time-and-materials
 */

// if ( ! defined( ABSPATH ) ) { die(); }

/**
 * The admin class, contains admin specific functions.
 *
 * @since 0.1-alpha
 */
class DIYTAM_Admin extends DIYTAM_Common {
	/**
	 * Initializes the admin functions
	 *
	 * @since 0.1-alpha
	 */
	function init() {
		add_action( 'admin_init', array( $this, 'register_settings' ), 10 );
		add_action( 'admin_menu', array( $this, 'register_menu' ), 10 );
	}


	/**
	 * Registers our settings with the API
	 *
	 * @since 0.1-alpha
	 */
	function register_settings() {
		$settings = register_setting( $this->get_textdomain(), $this->get_textdomain(), array( $this, 'validate_settings' ) );

		add_settings_section( $this->get_textdomain() . '_main' ,          __( 'Adjust the time and materials appearance to your liking by configuring the options below.', 'diy-time-and-materials' ), array( $this, 'setting_section_callback' ) , $this->get_textdomain() );
		add_settings_field( $this->get_textdomain() . '_display_settings', __( 'Set the color of the text.',                           'diy-time-and-materials' ),  array( $this, 'display_fields_callback' ) ,    $this->get_textdomain() ,  $this->get_textdomain() . '_main' );
	}

	/**
	 * Registers our settings with the API
	 *
	 * @since 0.1-alpha
	 * @todo see if you can find a way to include unit test coverage here.
	 */
	function register_menu() {
		add_options_page( __( 'DIY Time and Materials', 'diy-time-and-materials' ), __( 'DIY Time and Materials', 'diy-time-and-materials' ), 'manage-options', $this->get_textdomain(), array( $this, 'page_display' ) );
	}

	/**
	 * Callback for displaying the admin page
	 *
	 * @since 0.1-alpha
	 */
	function page_display() {
			?><div class="wrap">
			<h1><?php esc_html_e( 'DIY Time and Materials Options', 'diy-time-and-materials' ); ?></h1>
			<form method="post" action="options.php" id="diy-time-and-material-form">
			<?php
				settings_fields( $this->get_textdomain() );
				do_settings_sections( $this->get_textdomain() );
				submit_button();
			?>
			</form>
		</div><?php
	}
	/**
	 * Call back function for setting_section_callback
	 *
	 * @since 0.1-alpha
	 */
	function setting_section_callback() {
		// there are way too many callbacks going on to do anything here.
		echo "<!-- you can't see this --!>";
	}
	/**
	 * Call back function for display_fields_callback
	 *
	 * @since 0.1-alpha
	 */
	function display_fields_callback() {
		$settings = self::get_settings();

		printf( '<input name="%s[color]" type="color" value="%s" />', 'diy-time-and-materials', ( isset( $settings['color'] ) ) ? esc_attr( $settings['color'] ) : '#4433dd' );
		printf( '<label>%s</label><br />' , esc_attr( __( 'Text Color', 'diy-time-and-materials' ) ) );
	}

	/**
	 * Validates the form settings
	 *
	 * @since 0.1-alpha
	 * @param array $settings the incoming data.
	 */
	function validate_settings( $settings = array() ) {
		$valid = array();

		// validate each setting!
		if ( isset( $settings['color'] ) ) {
			$valid['color'] = $settings['color'];
		}

		return $valid;

	}
}
