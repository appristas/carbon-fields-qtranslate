<?php
/**
 * Plugin Name: Carbon Fields: qTranslate
 * Description: Extends Carbon Fields with translatable fields using qTranslate
 * Author: Gasim Gasimzada
 * Author URI: gasim@appristas.io
 * Version: 1.0.0
 */

class Carbon_Fields_QTranslate {

	public function __construct() {
		/**
		 * Set text domain
		 * @see https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
		 */
		load_plugin_textdomain( 'cfq', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		/**
		 * Hook field initialization
		 */
		add_action( 'after_setup_theme', [ $this, 'init' ] );
	}

	public function init() {
		if ( $this->carbon_fields_activated() && $this->qtranslate_installed() ) {
			include_once( __DIR__ . '/fields/Translatable_Text_Field.php' );
		} else {
			add_action( 'admin_notices', [ $this, 'admin_notices' ] );
		}
	}

	public function admin_notices() {
		?>
		<div class="notice notice-error is-dismissible">
			<h4 style="margin: 10px 0 0 0;">Carbon Fields: qTranslate</h4>
			<p>
				<?php esc_html_e( 'You need to have both Carbon Fields and qTranslate installed and activated.', 'cfq' ); ?>
			</p>
		</div>
		<?php
	}

	public function carbon_fields_activated() {
		return class_exists( 'Carbon_Fields\\Field\\Field' );
	}

	public function qtranslate_installed() {
		return function_exists( 'qtranxf_getLanguage' );
	}

}

new Carbon_Fields_QTranslate();
