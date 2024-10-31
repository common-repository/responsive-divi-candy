<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       divicandy
 * @since      1.0.0
 *
 * @package    Diviresponsive
 * @subpackage Diviresponsive/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Diviresponsive
 * @subpackage Diviresponsive/admin
 * @author     DiviCandy <hey@divicandy.com>
 */
class Diviresponsive_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Diviresponsive_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Diviresponsive_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/diviresponsive-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Diviresponsive_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Diviresponsive_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/diviresponsive-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Extends the configuration fields of a Divi ROW.
	 *
	 * @filter et_pb_all_fields_unprocessed_et_pb_row
	 *
	 * @since  1.0.0
	 *
	 * @param array $fields_unprocessed Field definitions of the module.
	 *
	 * @return array The modified configuration fields.
	 */
	public function add_row_config( $fields_unprocessed ) {
		$fields = [];

		// "Number of column On Tablet" toggle.
		$fields['dr_row_number_column_tablet']   = [
			'label'           => esc_html__( 'Number of Columns on Tablet', $this->plugin_name ),
			'type'            => 'select',
			'option_category' => 'configuration',
			'options'         => [
				'none' => esc_html__( 'Default', $this->plugin_name ),
				'two'  => esc_html__( '2', $this->plugin_name ),
				'three'  => esc_html__( '3', $this->plugin_name ),
				'four'  => esc_html__( '4', $this->plugin_name )
			],
			'default'         => 'none',
			'description'     => esc_html__( 'Choose the number of columns you wish to have on Tablet devices', $this->plugin_name ),
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
		];

		// "Number of column On Mobile" toggle.
		$fields['dr_row_number_column_mobile']   = [
			'label'           => esc_html__( 'Number of Columns on Mobile', $this->plugin_name ),
			'type'            => 'select',
			'option_category' => 'configuration',
			'options'         => [
				'none' => esc_html__( 'Default', $this->plugin_name ),
				'two'  => esc_html__( '2', $this->plugin_name ),
				'three'  => esc_html__( '3', $this->plugin_name ),
				'four'  => esc_html__( '4', $this->plugin_name )
			],
			'default'         => 'none',
			'description'     => esc_html__( 'Choose the number of columns you wish to have on Mobile devices', $this->plugin_name ),
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
		];

		// "Stacking Order On Tablet" toggle.
		$fields['dr_row_stacking_order_tablet']   = [
			'label'           => esc_html__( 'Activate Stacking Order on Tablet?', $this->plugin_name ),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => [
				'off' => esc_html__( 'No', $this->plugin_name ),
				'on'  => esc_html__( 'Yes', $this->plugin_name ),
			],
			'default'         => 'off',
			'description'     => esc_html__( 'Activate the Stacking Order just on Tablet devices', $this->plugin_name ),
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
		];

		// "Stacking Order On Mobile" toggle.
		$fields['dr_row_stacking_order_mobile']   = [
			'label'           => esc_html__( 'Activate Stacking Order on Mobile?', $this->plugin_name ),
			'type'            => 'yes_no_button',
			'option_category' => 'configuration',
			'options'         => [
				'off' => esc_html__( 'No', $this->plugin_name ),
				'on'  => esc_html__( 'Yes', $this->plugin_name ),
			],
			'default'         => 'off',
			'description'     => esc_html__( 'Activate the Stacking Order just on Mobile devices', $this->plugin_name ),
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
		];

		return array_merge( $fields_unprocessed, $fields );
	}

	/**
	 * Extends the configuration fields of a Divi COLUMN.
	 *
	 * @filter et_pb_all_fields_unprocessed_et_pb_column
	 *
	 * @since  1.0.0
	 *
	 * @param array $fields_unprocessed Field definitions of the module.
	 *
	 * @return array The modified configuration fields.
	 */
	public function add_column_config( $fields_unprocessed ) {
		$fields = [];

		// "Stacking Order On Tablet" toggle.
		$fields['dr_column_stacking_order_tablet']   = [
			'label'           => esc_html__( 'Stacking Order on Tablet', $this->plugin_name ),
			'type'            => 'select',
			'option_category' => 'configuration',
			'options'         => [
				'none' => esc_html__( 'Select order', $this->plugin_name ),
				'one'  => esc_html__( '1st', $this->plugin_name ),
				'two'  => esc_html__( '2nd', $this->plugin_name ),
				'three'  => esc_html__( '3rd', $this->plugin_name ),
				'four'  => esc_html__( '4th', $this->plugin_name ),
				'five'  => esc_html__( '5th', $this->plugin_name ),
				'six'  => esc_html__( '6th', $this->plugin_name ),
			],
			'default'         => 'none',
			'description'     => esc_html__( 'Choose the stacking order for this column on Tablet devices', $this->plugin_name ),
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
		];

		// "Stacking Order On Mobile" toggle.
		$fields['dr_column_stacking_order_mobile']   = [
			'label'           => esc_html__( 'Stacking Order on Mobile', $this->plugin_name ),
			'type'            => 'select',
			'option_category' => 'configuration',
			'options'         => [
				'none' => esc_html__( 'Select order', $this->plugin_name ),
				'one'  => esc_html__( '1st', $this->plugin_name ),
				'two'  => esc_html__( '2nd', $this->plugin_name ),
				'three'  => esc_html__( '3rd', $this->plugin_name ),
				'four'  => esc_html__( '4th', $this->plugin_name ),
				'five'  => esc_html__( '5th', $this->plugin_name ),
				'six'  => esc_html__( '6th', $this->plugin_name ),
			],
			'default'         => 'none',
			'description'     => esc_html__( 'Choose the stacking order for this column on Mobile devices', $this->plugin_name ),
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
		];

		return array_merge( $fields_unprocessed, $fields );
	}

	/**
	 * Add a custom RESPONSIVE toggle to the ROW module.
	 *
	 * @filter et_builder_get_parent_modules
	 *
	 * @since  1.0.0
	 *
	 * @param array  $parent_modules List of all parents elements.
	 * @param string $post_type      The post type in editor.
	 *
	 * @return array Modified parent element definition.
	 */
	public function add_toggles_to_parent_tab( $parent_modules, $post_type ) {

		if ( isset( $parent_modules['et_pb_row'] ) ) {
			$row = $parent_modules['et_pb_row'];

			/*
			This custom field actually supports the Visual Builder:
			VB support is provided in builder.js by observing the React state object.
			*/
			unset( $row->fields_unprocessed['dr_row_stacking_order_tablet']['vb_support'] );
			unset( $row->fields_unprocessed['dr_row_stacking_order_mobile']['vb_support'] );
			unset( $row->fields_unprocessed['dr_row_number_column_tablet']['vb_support'] );
			unset( $row->fields_unprocessed['dr_row_number_column_mobile']['vb_support'] );
		}

		return $parent_modules;
	}

	/**
	 * Add a custom RESPONSIVE toggle to the COLUMN module.
	 *
	 * @filter et_builder_get_child_modules
	 *
	 * @since  1.0.0
	 *
	 * @param array  $child_modules List of all childs elements.
	 * @param string $post_type      The post type in editor.
	 *
	 * @return array Modified child element definition.
	 */
	public function add_toggles_to_child_tab( $child_modules, $post_type ) {

		if ( isset( $child_modules['et_pb_column'] ) ) {
			$column = $child_modules['et_pb_column'];

			/*
			This custom field actually supports the Visual Builder:
			VB support is provided in builder.js by observing the React state object.
			*/
			unset( $column->fields_unprocessed['dr_column_stacking_order_tablet']['vb_support'] );
			unset( $column->fields_unprocessed['dr_column_stacking_order_mobile']['vb_support'] );
		}

		return $child_modules;
	}

}
