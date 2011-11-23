<?php

/**
 * The general plugin class
 */
class Cursorial {

	// CONSTANTS
	const POST_TYPE = 'cursorial';
	const TAXONOMY = 'cursorial_area';

	// PUBLIC PROPERTIES

	/**
	 * Object with Wordpress pages Cursorial_Pages
	 */
	public $pages;

	// CONSTRUCTOR

	/**
	 * Constructs Cursorial plugin object
	 */
	function __construct() {
		$this->pages = new Cursorial_Pages();
	}

	// PUBLIC METHODS

	/**
	 * Initiates the Cursorial plugin.
	 * @see add_action
	 * @return void
	 */
	public function init() {
		$this->register_post_type();
		load_theme_textdomain( 'cursorial', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Initiates the administration
	 * @see add_action
	 * @return void
	 */
	public function admin_init() {
	}

	/**
	 * Add administration pages
	 */
	public function admin_menu() {
		add_menu_page(
			'Cursorial',
			'Cursorial',
			'manage_options',
			'cursorial',
			array( $this->pages, 'admin' )
		);
	}

	// PRIVATE METHODS

	/**
	 * Registers the post-type we use to store all content and a taxonomy
	 * used to locate areas.
	 * @return void
	 */
	private function register_post_type() {
		/**
		 * All content is saved as posts in a plugin-defined post-type.
		 */
		register_post_type(
			self::POST_TYPE,
			array(
				'public' => false
			)
		);

		/**
		 * Every post is connected to a specific area with it's own loop. 
		 * These areas are stored as a taxonomy.
		 */
		register_taxonomy(
			self::TAXONOMY,
			self::POST_TYPE,
			array(
				'labels' => array(
					'name' => __( 'Area', 'cursorial' )
				),
				'public' => false
			)
		);
	}

}
