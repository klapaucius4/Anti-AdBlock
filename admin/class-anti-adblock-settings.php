<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Anti_AdBlock_Settings {
    private $dir;
    private $file;
	private $plugin_name;
	private $plugin_slug;
	private $options;
	private $settings;

	public function __construct( $plugin_name, $plugin_slug, $file ) {
		$this->file = $file;
		$this->plugin_name = $plugin_name;
		$this->plugin_slug = $plugin_slug;

		// Initialise settings
		add_action( 'admin_init', array( $this, 'init' ) );

		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->file ) , array( $this, 'add_settings_link' ) );
	}

	/**
	 * Initialise settings
	 * @return void
	 */
	public function init() {
		$this->settings = $this->settings_fields();
		$this->options = $this->get_options();
		$this->register_settings();
	}

	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item() {
		$page = add_options_page( $this->plugin_name, $this->plugin_name, 'manage_options' , $this->plugin_slug,  array( $this, 'settings_page' ) );
	}

	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public function add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page='.$this->plugin_slug.'">' . __( 'Settings', $this->plugin_slug ) . '</a>';
  		array_push( $links, $settings_link );
  		return $links;
	}

	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */
	private function settings_fields() {

		$settings['general'] = array(
			'title'					=> __( 'General', $this->plugin_slug ),
			'description'			=> __( 'These are fairly standard form input fields.', $this->plugin_slug ),
			'fields'				=> array(
				array(
					'id' 			=> 'text_field',
					'label'			=> __( 'Some Text' , $this->plugin_slug ),
					'description'	=> __( 'This is a standard text field.', $this->plugin_slug ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> __( 'Placeholder text', $this->plugin_slug )
				),
				array(
					'id' 			=> 'password_field',
					'label'			=> __( 'A Password' , $this->plugin_slug ),
					'description'	=> __( 'This is a standard password field.', $this->plugin_slug ),
					'type'			=> 'password',
					'default'		=> '',
					'placeholder'	=> __( 'Placeholder text', $this->plugin_slug )
				),
				array(
					'id' 			=> 'secret_text_field',
					'label'			=> __( 'Some Secret Text' , $this->plugin_slug ),
					'description'	=> __( 'This is a secret text field - any data saved here will not be displayed after the page has reloaded, but it will be saved.', $this->plugin_slug ),
					'type'			=> 'text_secret',
					'default'		=> '',
					'placeholder'	=> __( 'Placeholder text', $this->plugin_slug )
				),
				array(
					'id' 			=> 'text_block',
					'label'			=> __( 'A Text Block' , $this->plugin_slug ),
					'description'	=> __( 'This is a standard text area.', $this->plugin_slug ),
					'type'			=> 'textarea',
					'default'		=> '',
					'placeholder'	=> __( 'Placeholder text for this textarea', $this->plugin_slug )
				),
				array(
					'id' 			=> 'single_checkbox',
					'label'			=> __( 'An Option', $this->plugin_slug ),
					'description'	=> __( 'A standard checkbox - if you save this option as checked then it will store the option as \'on\', otherwise it will be an empty string.', $this->plugin_slug ),
					'type'			=> 'checkbox',
					'default'		=> 'on'
				),
				array(
					'id' 			=> 'select_box',
					'label'			=> __( 'A Select Box', $this->plugin_slug ),
					'description'	=> __( 'A standard select box.', $this->plugin_slug ),
					'type'			=> 'select',
					'options'		=> array( 'drupal' => 'Drupal', 'joomla' => 'Joomla', 'wordpress' => 'WordPress' ),
					'default'		=> 'wordpress'
				),
				array(
					'id' 			=> 'radio_buttons',
					'label'			=> __( 'Some Options', $this->plugin_slug ),
					'description'	=> __( 'A standard set of radio buttons.', $this->plugin_slug ),
					'type'			=> 'radio',
					'options'		=> array( 'superman' => 'Superman', 'batman' => 'Batman', 'ironman' => 'Iron Man' ),
					'default'		=> 'batman'
				),
				array(
					'id' 			=> 'file_field',
					'label'			=> __( 'Some File' , $this->plugin_slug ),
					'description'	=> __( 'This is a standard file field.', $this->plugin_slug ),
					'type'			=> 'file',
					'default'		=> ''
				),
				array(
					'id' 			=> 'file_field_2',
					'label'			=> __( 'Some File 2' , $this->plugin_slug ),
					'description'	=> __( 'This is a standard file field.', $this->plugin_slug ),
					'type'			=> 'file',
					'default'		=> ''
				),
			)
		);

		$settings['extra'] = array(
			'title'					=> __( 'Extra', $this->plugin_slug ),
			'description'			=> __( 'These are some extra input fields that maybe aren\'t as common as the others.', $this->plugin_slug ),
			'fields'				=> array(
				array(
					'id' 			=> 'multiple_checkboxes',
					'label'			=> __( 'Some Items', $this->plugin_slug ),
					'description'	=> __( 'You can select multiple items and they will be stored as an array.', $this->plugin_slug ),
					'type'			=> 'checkbox_multi',
					'options'		=> array( 'square' => 'Square', 'circle' => 'Circle', 'rectangle' => 'Rectangle', 'triangle' => 'Triangle' ),
					'default'		=> array( 'circle', 'triangle' )
				),
				array(
					'id' 			=> 'number_field',
					'label'			=> __( 'A Number' , $this->plugin_slug ),
					'description'	=> __( 'This is a standard number field - if this field contains anything other than numbers then the form will not be submitted.', $this->plugin_slug ),
					'type'			=> 'number',
					'default'		=> '',
					'placeholder'	=> __( '42', $this->plugin_slug )
				),
				array(
					'id' 			=> 'multi_select_box',
					'label'			=> __( 'A Multi-Select Box', $this->plugin_slug ),
					'description'	=> __( 'A standard multi-select box - the saved data is stored as an array.', $this->plugin_slug ),
					'type'			=> 'select_multi',
					'options'		=> array( 'linux' => 'Linux', 'mac' => 'Mac', 'windows' => 'Windows' ),
					'default'		=> array( 'linux' )
				)
			)
		);

		$settings = apply_filters( 'plugin_settings_fields', $settings );

		return $settings;
	}


	/**
	 * Options getter
	 * @return array Options, either saved or default ones.
	 */
	public function get_options() {
		$options = get_option($this->plugin_slug);

		if ( !$options && is_array( $this->settings ) ) {
			$options = Array();
			foreach( $this->settings as $section => $data ) {
				foreach( $data['fields'] as $field ) {
					$options[ $field['id'] ] = $field['default'];
				}
			}

			add_option( $this->plugin_slug, $options );
		}

		return $options;
	}

	/**
	 * Register plugin settings
	 * @return void
	 */
	public function register_settings() {
		if( is_array( $this->settings ) ) {

			register_setting( $this->plugin_slug, $this->plugin_slug, array( $this, 'validate_fields' ) );

			foreach( $this->settings as $section => $data ) {

				// Add section to page
				add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), $this->plugin_slug );

				foreach( $data['fields'] as $field ) {

					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this, 'display_field' ), $this->plugin_slug, $section, array( 'field' => $field ) );
				}
			}
		}
	}

	public function settings_section( $section ) {
		$html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
		echo $html;
	}

	/**
	 * Generate HTML for displaying fields
	 * @param  array $args Field data
	 * @return void
	 */
	public function display_field( $args ) {

		$field = $args['field'];

		$html = '';

		$option_name = $this->plugin_slug ."[". $field['id']. "]";

		$data = (isset($this->options[$field['id']])) ? $this->options[$field['id']] : '';

		switch( $field['type'] ) {

			case 'text':
			case 'password':
			case 'number':
				$html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . $data . '"/>' . "\n";
			break;

			case 'text_secret':
				$html .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value=""/>' . "\n";
			break;

			case 'textarea':
				$html .= '<textarea id="' . esc_attr( $field['id'] ) . '" rows="5" cols="50" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '">' . $data . '</textarea><br/>'. "\n";
			break;

			case 'checkbox':
				$checked = '';
				if( $data && 'on' == $data ){
					$checked = 'checked="checked"';
				}
				$html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" ' . $checked . '/>' . "\n";
			break;

			case 'checkbox_multi':
				foreach( $field['options'] as $k => $v ) {
					$checked = false;
					if( is_array($data) && in_array( $k, $data ) ) {
						$checked = true;
					}
					$html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
				}
			break;

			case 'radio':
				foreach( $field['options'] as $k => $v ) {
					$checked = false;
					if( $k == $data ) {
						$checked = true;
					}
					$html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
				}
			break;

			case 'select':
				$html .= '<select name="' . esc_attr( $option_name ) . '" id="' . esc_attr( $field['id'] ) . '">';
				foreach( $field['options'] as $k => $v ) {
					$selected = false;
					if( $k == $data ) {
						$selected = true;
					}
					$html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
				}
				$html .= '</select> ';
			break;

			case 'select_multi':
				$html .= '<select name="' . esc_attr( $option_name ) . '[]" id="' . esc_attr( $field['id'] ) . '" multiple="multiple">';
				foreach( $field['options'] as $k => $v ) {
					$selected = false;
					if( in_array( $k, $data ) ) {
						$selected = true;
					}
					$html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '" />' . $v . '</label> ';
				}
				$html .= '</select> ';
			break;

			case 'file':
				$html .= '<input id="' . esc_attr( $field['id'] ) . '_file" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" />' . "\n";
				$html .= '<input id="' . esc_attr( $field['id'] ) . '" type="hidden" name="' . esc_attr( $option_name ) . '" value="' . $data . '"  />' . "\n";
				$html .= '<img src="'.$data.'" alt="'.$field['id'].'" class="w-max-100" />';
			break;

		}

		switch( $field['type'] ) {

			case 'checkbox_multi':
			case 'radio':
			case 'select_multi':
				$html .= '<br/><span class="description">' . $field['description'] . '</span>';
			break;

			case 'file':
				$html .= '<br/><span class="description">' . $field['description'] . '</span>';
			break;

			default:
				$html .= '<label for="' . esc_attr( $field['id'] ) . '"><span class="description">' . $field['description'] . '</span></label>' . "\n";
			break;
		}

		echo $html;
	}

	/**
	 * Validate individual settings field
	 * @param  array $data Inputted value
	 * @return array       Validated value
	 */
	public function validate_fields( $data ) {
		// $data array contains values to be saved:
		// either sanitize/modify $data or return false
		// to prevent the new options to be saved

		// Sanitize fields, eg. cast number field to integer
		// $data['number_field'] = (int) $data['number_field'];

		// Validate fields, eg. don't save options if the password field is empty
		// if ( $data['password_field'] == '' ) {
		// 	add_settings_error( $this->plugin_slug, 'no-password', __('A password is required.', $this->plugin_slug), 'error' );
		// 	return false;
		// }

		// echo "<pre>";
		// print_r($_FILES); exit;
		

		$files = array();
		if(!empty($_FILES) && !empty($_FILES[$this->plugin_slug])){
			if(isset($_FILES[$this->plugin_slug]) && !empty($_FILES[$this->plugin_slug])) {
				foreach($_FILES[$this->plugin_slug]['name'] as $key => $fileName){
					$files[$key] = array(
						'name' => $_FILES[$this->plugin_slug]['name'][$key],
						'type' => $_FILES[$this->plugin_slug]['type'][$key],
						'tmp_name' => $_FILES[$this->plugin_slug]['tmp_name'][$key],
						'error' => $_FILES[$this->plugin_slug]['error'][$key],
						'size' => $_FILES[$this->plugin_slug]['size'][$key],
					);

				}


			}

			$i = 0;
			$keys = array_keys($files);

			foreach ($files as $image) {

				// if a files was upload
				if ($image['size']) {
					// if it is an image
					if (preg_match('/(jpg|jpeg|png|gif)$/', $image['type'])) {
						$override = array('test_form' => false);
						$file = wp_handle_upload($image, $override);

						$data[$keys[$i]] = $file['url'];
					} else {
						$options = get_option('data');
						$data[$keys[$i]] = $options[$logo];
						wp_die('No image was uploaded.');
					}
				}
			
				// else, retain the image that's already on file.
				// else {
				// 	$options = get_option('data');
				// 	$data[$keys[$i]] = $options[$keys[$i]];
				// }
				$i++;
			}
		}

		// var_dump($data); exit;

		return $data;
	}

	/**
	 * Load settings page content
	 * @return void
	 */
	public function settings_page() {
		// Build page HTML output
		// If you don't need tabbed navigation just strip out everything between the <!-- Tab navigation --> tags.
	?>
	  <div class="wrap" id="<?php echo $this->plugin_slug; ?>">
	  	<h2><?php _e('My Plugin Settings', $this->plugin_slug); ?></h2>
	  	<p><?php _e('Some infos about my plugin.', $this->plugin_slug); ?></p>

		<!-- Tab navigation starts -->
		<h2 class="nav-tab-wrapper settings-tabs hide-if-no-js">
			<?php
			foreach( $this->settings as $section => $data ) {
				echo '<a href="#' . $section . '" class="nav-tab">' . $data['title'] . '</a>';
			}
			?>
		</h2>
		<?php $this->do_script_for_tabbed_nav(); ?>
		<!-- Tab navigation ends -->

		<form action="options.php" method="POST" enctype="multipart/form-data">
	        <?php settings_fields( $this->plugin_slug ); ?>
	        <div class="settings-container">
	        <?php do_settings_sections( $this->plugin_slug ); ?>
	    	</div>
	        <?php submit_button(); ?>
		</form>
	</div>
	<?php
	}

	/**
	 * Print jQuery script for tabbed navigation
	 * @return void
	 */
	private function do_script_for_tabbed_nav() {
		// Very simple jQuery logic for the tabbed navigation.
		// Delete this function if you don't need it.
		// If you have other JS assets you may merge this there.
		?>
		<script>
		jQuery(document).ready(function($) {
			var headings = jQuery('.settings-container > h2, .settings-container > h3');
			var paragraphs  = jQuery('.settings-container > p');
			var tables = jQuery('.settings-container > table');
			var triggers = jQuery('.settings-tabs a');

			triggers.each(function(i){
				triggers.eq(i).on('click', function(e){
					e.preventDefault();
					triggers.removeClass('nav-tab-active');
					headings.hide();
					paragraphs.hide();
					tables.hide();

					triggers.eq(i).addClass('nav-tab-active');
					headings.eq(i).show();
					paragraphs.eq(i).show();
					tables.eq(i).show();
				});
			})

			triggers.eq(0).click();
		});
		</script>
	<?php
	}
}