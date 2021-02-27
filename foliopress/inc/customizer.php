<?php
/**
 * FolioPress Theme Customizer
 *
 * @package FolioPress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( ! class_exists( 'WP_Customize_Section' ) ) {
	return null;
}
function foliopress_support_register($wp_customize){
	class FolioPress_Customize_FolioPress_Support extends WP_Customize_Control {
		public function render_content() { ?>
		<div class="theme-info">
			<a title="<?php esc_attr_e( 'Review FolioPress', 'foliopress' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/foliopress' ); ?>" target="_blank">
				<?php esc_html_e( 'Rate FolioPress', 'foliopress' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/theme-instruction/foliopress/' ); ?>" title="<?php esc_attr_e( 'FolioPress Theme Instructions', 'foliopress' ); ?>" target="_blank">
			<?php esc_html_e( 'Theme Instructions', 'foliopress' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/support-forum/' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'foliopress' ); ?>" target="_blank">
			<?php esc_html_e( 'Support Forum', 'foliopress' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://www.themehorse.com/preview/foliopress' ); ?>" title="<?php esc_attr_e( 'FolioPress Demo', 'foliopress' ); ?>" target="_blank">
			<?php esc_html_e( 'View Demo', 'foliopress' ); ?>
			</a>
		</div>
		<?php
		}
	}
}
add_action('customize_register', 'foliopress_support_register');

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class FolioPress_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	* The type of customize section being rendered.
	*
	* @since  1.0.0
	* @access public
	* @var    string
	*/
	public $type = 'upsell';

	/**
	* Custom button text to output.
	*
	* @since  1.0.0
	* @access public
	* @var    string
	*/
	public $pro_text = '';

	/**
	* Custom pro button URL.
	*
	* @since  1.0.0
	* @access public
	* @var    string
	*/
	public $pro_url = '';

	/**
	* Add custom parameters to pass to the JS via JSON.
	*
	* @since  1.0.0
	* @access public
	* @return void
	*/
	public function json() {
	$json = parent::json();

	$json['pro_text'] = $this->pro_text;
	$json['pro_url']  = esc_url( $this->pro_url );

	return $json;
	}

	/**
	* Outputs the Underscore.js template.
	*
	* @since  1.0.0
	* @access public
	* @return void
	*/
	protected function render_template() { ?>

	<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
		<h3 class="accordion-section-title">
			{{ data.title }}

			<# if ( data.pro_text && data.pro_url ) { #>
			<a href="{{ data.pro_url }}" class="upgrade-to-pro" target="_blank">{{ data.pro_text }}</a>
			<# } #>
		</h3>
	</li>
	<?php }
}

function foliopress_customize_custom_sections( $wp_customize ) {
	// Register custom section types.
	$wp_customize->register_section_type( 'FolioPress_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section( new FolioPress_Customize_Section_Upsell( $wp_customize, 'theme_upsell', array(
		'title'					=> esc_html__( 'FolioPress Pro', 'foliopress' ),
		'pro_text'				=> esc_html__( 'Upgrade to Pro', 'foliopress' ),
		'pro_url'				=> 'https://www.themehorse.com/themes/foliopress',
		'priority'				=> 1,
	) ) );
}
add_action( 'customize_register', 'foliopress_customize_custom_sections');

function foliopress_customize_register( $wp_customize ) {
	$foliopress_settings = foliopress_get_option_defaults();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'foliopress_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'foliopress_customize_partial_blogdescription',
		) );
	}

	$wp_customize->get_control( 'background_color' )->active_callback = 'foliopress_is_sitelayout_is_narrow';
	$wp_customize->get_section( 'background_image' )->active_callback = 'foliopress_is_sitelayout_is_narrow';

	// Section => FolioPress Support
	$wp_customize->add_section('foliopress_support', array(
		'title'					=> __('FolioPress Support', 'foliopress'),
	));
	$wp_customize->add_setting('foliopress_support', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control( new FolioPress_Customize_FolioPress_Support( $wp_customize, 'foliopress_support', array(
		'label'					=> __('FolioPress Support','foliopress'),
		'section'				=> 'foliopress_support'
	) ) );

	// Panel => Layout
	$wp_customize->add_panel('foliopress_layout_options', array(
		'title'					=> __('Layout', 'foliopress'),
		'priority'				=> 121,
	) );

	// Section => Site Layout
	$wp_customize->add_section( 'foliopress_site_layout_section', array(
		'title' 					=> __('Site Layout','foliopress'),
		'panel'					=> 'foliopress_layout_options'
	) );
	$wp_customize->add_setting('foliopress_site_layout', array(
		'default'				=> 'wide',
		'sanitize_callback'	=> 'foliopress_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('foliopress_site_layout', array(
		'section'				=> 'foliopress_site_layout_section',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'wide'					=> __('Fluid','foliopress'),
			'narrow'					=> __('Boxed','foliopress'),
		),
	) );
	// Section => Content Layout
	$wp_customize->add_section( 'foliopress_content_layout_section', array(
		'title' 					=> __('Content Layout','foliopress'),
		'panel'					=> 'foliopress_layout_options'
	) );
	$wp_customize->add_setting('foliopress_content_layout', array(
		'default'				=> 'right',
		'sanitize_callback'	=> 'foliopress_sanitize_choices',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control('foliopress_content_layout', array(
		'description'			=> __('Below options are global setting. Set individual layout from specific page/ post.','foliopress'),
		'section'				=> 'foliopress_content_layout_section',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'right'					=> __('Right Sidebar','foliopress'),
			'left'					=> __('Left Sidebar','foliopress'),
			'nosidebar'				=> __('No Sidebar','foliopress'),
			'fullwidth'				=> __('No Sidebar Full Width','foliopress'),
		),
	) );
	// Section => Post Layout
	$wp_customize->add_section( 'foliopress_post_layout_section', array(
		'title' 					=> __('Post Layout','foliopress'),
		'panel'					=> 'foliopress_layout_options'
	) );
	$wp_customize->add_setting( 'foliopress_post_layout', array(
		'default'				=> 'grid_view',
		'capability' 			=> 'edit_theme_options',
		'sanitize_callback'	=> 'foliopress_sanitize_choices'
	) );
	$wp_customize->add_control( 'foliopress_post_layout', array(
		'section'				=> 'foliopress_post_layout_section',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'list_view'				=> __('List','foliopress'),
			'grid_view'				=> __('Grid','foliopress')

		),
	) );
	// Featured Image on Page/Single Post
	$wp_customize->add_setting( 'foliopress_featured_image', array(
		'default'				=> 1,
		'sanitize_callback'		=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_featured_image', array(
		'label'					=> __('Show Featured Image on Page/Single Post', 'foliopress'),
		'section'				=> 'foliopress_post_layout_section',
		'type'					=> 'checkbox'
	) );

	// Section => Header
	$wp_customize->add_section('foliopress_custom_header_setting', array(
		'title'					=> __('Header', 'foliopress'),
		'priority'				=> 122,
	) );
	$wp_customize->add_setting('foliopress_hide_search', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_hide_search', array(
		'priority'				=> 70,
		'label'					=> __('Hide Search', 'foliopress'),
		'section'				=> 'foliopress_custom_header_setting',
		'type'					=> 'checkbox'
	) );
	$wp_customize->add_setting( 'foliopress_header_fixed', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_header_fixed', array(
		'priority'				=> 70,
		'label'					=> __('Navigation Fixed', 'foliopress'),
		'section'				=> 'foliopress_custom_header_setting',
		'type'					=> 'checkbox'
	) );
	$wp_customize->add_setting( 'foliopress_header_fluid', array(
		'default'				=> 1,
		'sanitize_callback'	=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_header_fluid', array(
		'priority'				=> 70,
		'label'					=> __('Navigation Section Fluid', 'foliopress'),
		'section'				=> 'foliopress_custom_header_setting',
		'type'					=> 'checkbox',
		'active_callback'		=> 'foliopress_is_sitelayout_is_wide'
	) );

	// Section => My Info
	$wp_customize->add_section('foliopress_my_info_setting', array(
		'title'					=> __('My Info', 'foliopress'),
		'description' 			=> __('Below options will display only in post view layout.','foliopress'),
		'priority'				=> 124,
	) );
	$wp_customize->add_setting('foliopress_my_info_title', array(
		'default'				=> '',
		'sanitize_callback'	=> 'sanitize_textarea_field',
		'transport'				=> 'postMessage',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_my_info_title', array(
		'label'					=> __('Title', 'foliopress'),
		'section'				=> 'foliopress_my_info_setting',
		'type'					=> 'textarea'
	) );
	$wp_customize->add_setting('foliopress_my_desc', array(
		'default'				=> '',
		'sanitize_callback'	=> 'sanitize_textarea_field',
		'transport'				=> 'postMessage',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_my_desc', array(
		'label'					=> __('Description', 'foliopress'),
		'section'				=> 'foliopress_my_info_setting',
		'type'					=> 'textarea'
	) );
	$wp_customize->add_setting( 'foliopress_my_avatar',array(
		'sanitize_callback'	=> 'esc_url_raw',
		'capability' 			=> 'edit_theme_options'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'foliopress_my_avatar', array(
		'label'				=> __('Upload your Avatar', 'foliopress'),
		'section'			=> 'foliopress_my_info_setting',
	) ) );
	$wp_customize->add_setting('foliopress_my_info_social', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_my_info_social', array(
		'label'					=> __('Hide Social Profiles', 'foliopress'),
		'section'				=> 'foliopress_my_info_setting',
		'type'					=> 'checkbox',
		'active_callback'		=> 'foliopress_is_social_profiles_set'
	) );

	// Section => Social Profiles
	$wp_customize->add_section('foliopress_social_profiles_setting', array(
		'title'					=> __('Social Profiles', 'foliopress'),
		'priority'				=> 123,
	) );
	$wp_customize->add_setting('foliopress_social_profiles', array(
		'default'				=> '',
		'sanitize_callback'	=> 'foliopress_sanitize_social_links',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_social_profiles', array(
		'priority'				=> 70,
		'description' 			=> __('Add the full link to your Social Profiles. Seperate with comma ,','foliopress'),
		'section'				=> 'foliopress_social_profiles_setting',
		'type'					=> 'textarea'
	) );

	// Section => Footer
	$wp_customize->add_section( 'foliopress_footer_section', array(
		'title'					=> __('Footer', 'foliopress'),
		'priority'				=> 128,
	) );
	$wp_customize->add_setting('foliopress_footer_social', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_footer_social', array(
		'priority'				=> 170,
		'label'					=> __('Hide Social Profiles', 'foliopress'),
		'section'				=> 'foliopress_footer_section',
		'type'					=> 'checkbox',
		'active_callback'		=> 'foliopress_is_social_profiles_set'
	) );
	$wp_customize->add_setting( 'foliopress_footer_info_center', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_footer_info_center', array(
		'priority'				=> 170,
		'label'					=> __('Display Footer Info at center', 'foliopress'),
		'section'				=> 'foliopress_footer_section',
		'type'					=> 'checkbox'
	) );
	$wp_customize->add_setting( 'foliopress_footer_fluid', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'foliopress_sanitize_integer',
		'capability' 			=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'foliopress_footer_fluid', array(
		'priority'				=> 170,
		'label'					=> __('Footer Fluid', 'foliopress'),
		'section'				=> 'foliopress_footer_section',
		'type'					=> 'checkbox',
		'active_callback'		=> 'foliopress_is_sitelayout_is_wide'
	) );
}
add_action( 'customize_register', 'foliopress_customize_register' );

/**
 * Sanitize the values
 */
if ( ! function_exists( 'foliopress_sanitize_choices' ) ) {
	/**
	* Sanitization: select
	*
	* @since 1.1.1
	*
	* @param WP_Customize_Setting $setting Setting instance.
	*
	* @return mixed Sanitized value.
	*/
	function foliopress_sanitize_choices($input, $setting) {

		// Ensure input is a slug.
		$input = sanitize_key($input);

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control($setting->id)->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
}

if ( ! function_exists( 'foliopress_sanitize_integer' ) ) {
	/**
	 * Sanitization: number_absint
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return int Sanitized number.
	 */
	function foliopress_sanitize_integer($input) {
		return absint($input);
	}
}

if ( ! function_exists( 'foliopress_sanitize_social_links' ) ) {
	/**
	 * Sanitization: html
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string Sanitized content.
	 */
	function foliopress_sanitize_social_links($input) {
		$input = trim(trim($input), ',');
		$explodedInput = explode(',', $input);

		$output = '';
		foreach ($explodedInput as $key => $inputX) {
			$inputX = trim($inputX);
			if (!empty($inputX)) {
				if ($key === 0) {
					$output .= $inputX;
				} else {
					$output .= ', ' . $inputX;
				}
			}
		}
		return sanitize_textarea_field($output);
	}
}

function foliopress_customizer_control_scripts() {
	wp_enqueue_style( 'foliopress-customize-controls', get_template_directory_uri() . '/inc/customize-controls.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'foliopress_customizer_control_scripts', 0 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function foliopress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function foliopress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 */
function foliopress_customize_control_js() {
	wp_enqueue_script( 'foliopress-customizer-control', get_template_directory_uri() . '/js/customizer-control.js', array( 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'foliopress_customize_control_js' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function foliopress_customize_preview_js() {
	wp_enqueue_script( 'foliopress-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'foliopress_customize_preview_js' );

if ( ! function_exists( 'foliopress_is_sitelayout_is_wide' ) ) {
	/**
	 * Check if sitelayout is wide.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function foliopress_is_sitelayout_is_wide($control) {

		if ( 'narrow' !== $control->manager->get_setting('foliopress_site_layout')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'foliopress_is_social_profiles_set' ) ) {
	/**
	 * Check if social profiles is set.
	 *
	 * @since 1.1.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function foliopress_is_social_profiles_set($control) {

		if ( '' !== $control->manager->get_setting('foliopress_social_profiles')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'foliopress_is_sitelayout_is_narrow' ) ) {
	/**
	* Check if sitelayout is narrow.
	*
	* @since 1.1.1
	*
	* @param WP_Customize_Control $control WP_Customize_Control instance.
	*
	* @return bool Whether the control is active to the current preview.
	*/
	function foliopress_is_sitelayout_is_narrow($control) {

		if ( 'wide' !== $control->manager->get_setting('foliopress_site_layout')->value() ) {
			return true;
		} else {
			return false;
		}

	}
}
