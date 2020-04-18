<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://michalkowalik.pl
 * @since      1.0.0
 *
 * @package    Anti_AdBlock
 * @subpackage Anti_AdBlock/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Anti_AdBlock
 * @subpackage Anti_AdBlock/admin
 * @author     Michał Kowalik <kontakt@michalkowalik.pl>
 */
class Anti_AdBlock_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'anti_adblock';

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
		 * defined in Anti_AdBlock_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Anti_AdBlock_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/anti-adblock-admin.css', array(), $this->version, 'all' );

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
		 * defined in Anti_AdBlock_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Anti_AdBlock_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/anti-adblock-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'_ads', plugin_dir_url( __FILE__ ) . 'js/ads.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Anti AdBlock Settings', 'anti-adblock' ),
			__( 'Anti AdBlock', 'anti-adblock' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);

	}


	public function admin_plugin_settings_link( $links ) {
		$settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=anti-adblock">'.__('Settings', 'anti-adblock').'</a>';
		array_unshift( $links, $settings_link ); 
		return $links; 
	}

	
	  

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		require_once plugin_dir_path( __FILE__ ) . 'partials/anti-adblock-admin-display.php';
	}









	/**
	 * SETTINGS BEGIN
	 *
	 * @since  1.0.0
	 */
	public function add_settings_sections(){
		// General settings
		add_settings_section(
			$this->option_name . '_general',
			__( 'General settings', 'anti-adblock' ),
			function(){
				echo '<p>' . __( 'Please change the settings accordingly.', 'anti-adblock' ) . '</p>';
			},
			$this->plugin_name
		);

		// Files settings
		add_settings_section(
			$this->option_name . '_files',
			__( 'Files', 'anti-adblock' ),
			function(){
				echo '<p>' . __( 'You can change default files displayed in a popup window.', 'anti-adblock' ) . '</p>';
			},
			$this->plugin_name
		);
	}



	public function add_settings_fields(){

		add_settings_field(
			$this->option_name . '_enabled',
			__( 'Plugin enabled', 'anti-adblock' ),
			array( $this, $this->option_name . '_enabled' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_enabled' )
		);
		add_settings_field(
			$this->option_name . '_position',
			__( 'Text position', 'anti-adblock' ),
			array( $this, $this->option_name . '_position' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_position' )
		);
		add_settings_field(
			$this->option_name . '_day',
			__( 'Post is outdated after', 'anti-adblock' ),
			array( $this, $this->option_name . '_day' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_day' )
		);


		
		add_settings_field(
			$this->option_name . '_image_1',
			__( 'Image 1', 'anti-adblock' ),
			array( $this, $this->option_name . '_image_1' ),
			$this->plugin_name,
			$this->option_name . '_files',
			array( 'label_for' => $this->option_name . '_image_1' )
		);
		

	}

	public function register_settings(){

		register_setting( $this->plugin_name, $this->option_name . '_enabled', 'boolean' );
		register_setting( $this->plugin_name, $this->option_name . '_position', function($position){
			if ( in_array( $position, array( 'before', 'after' ), true ) ) {
				return $position;
			}
		});
		register_setting( $this->plugin_name, $this->option_name . '_day', 'intval' );


		register_setting( $this->plugin_name, $this->option_name . '_image_1', 'text' );
	}





	


	// General settings fields begin
	public function anti_adblock_enabled() {
		$enabled = get_option( $this->option_name . '_enabled' );
		?>
			<fieldset>
				<label>
					<input type="checkbox" name="<?php echo $this->option_name . '_enabled' ?>" id="<?php echo $this->option_name . '_enabled' ?>" value="1" <?php checked( $enabled, 1 ); ?>>
					<?php _e( 'Plugin enabled', 'anti-adblock' ); ?>
				</label>
			</fieldset>
		<?php
	}
	public function anti_adblock_position() {
		$position = get_option( $this->option_name . '_position' );
		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" id="<?php echo $this->option_name . '_position' ?>" value="before" <?php checked( $position, 'before' ); ?>>
					<?php _e( 'Before the content', 'anti-adblock' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" value="after" <?php checked( $position, 'after' ); ?>>
					<?php _e( 'After the content', 'anti-adblock' ); ?>
				</label>
			</fieldset>
		<?php
	}
	public function anti_adblock_day() {
		$day = get_option( $this->option_name . '_day' );
		echo '<input type="text" name="' . $this->option_name . '_day' . '" id="' . $this->option_name . '_day' . '" value="' . $day . '"> ' . __( 'days', 'anti-adblock' );
	}
	// General settings fields end


	// Files settings fields begin
	public function anti_adblock_image_1() {
		$image = get_option( $this->option_name . '_image_1' );
		?>
			<fieldset>
				<label>
					<input type="number" name="<?php echo $this->option_name . '_image_1' ?>" id="<?php echo $this->option_name . '_image_1' ?>" value="<?= $image; ?>">
				</label>
			</fieldset>
		<?php
	}
	// Files settings field end



	//SETTINGS END


}
