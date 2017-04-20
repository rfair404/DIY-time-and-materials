<?php
/**
 * Class DIYTAM_Base
 * Class naming convention due to php 5.3 compatability (no namespace)
 *
 * @package DIY-time-and-materials
 */

if ( ! defined( ABSPATH ) ) { die(); }

/**
 * The base class, contains helper functions used everywhere.
 *
 * @since 0.1-alpha
 */
class DIYTAM_Base {

	/** The version number
	 *
	 * @var $version double
	 */
	public $version = 0.1;

	/** The textdomain
	 *
	 * @var $textdomain string
	 */
	public $textdomain = 'diy-time-and-materials';

	/**
	 * Gets the version number
	 *
	 * @return float $version
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Gets the textdomain
	 *
	 * @return string $textdomain
	 */
	public function get_textdomain() {
		return $this->textdomain;
	}
}
