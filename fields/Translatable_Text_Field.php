<?php

namespace Carbon_Fields\Field;

/**
 * Text field class.
 */
class Translatable_Text_Field extends Field {

	/**
	 * to_json()
	 *
	 * You can use this method to modify the field properties that are added to the JSON object.
	 * The JSON object is used by the Backbone Model and the Underscore template.
	 *
	 * @param bool $load  Should the value be loaded from the database or use the value from the current instance.
	 * @return array
	 */
	function to_json( $load ) {
		global $q_config;
		$field_data = parent::to_json( $load );

		$language_current = apply_filters( 'acf_qtranslate_get_active_language', qtranxf_getLanguage() );
		$field_data = array_merge( $field_data, [
			'splitted_values' => \qtranxf_split( $field_data['value'], $quicktags = true ),
			'languages' => \qtranxf_getSortedLanguages(),
			'languageNames' => $q_config['language_name'],
			'languageCurrent' => $language_current,
		] );

		return $field_data;
	}

	/**
	 * Underscore template of this field.
	 */
	public function template() {
		?>
		<div class="cfq-multi-language-field"></div>
		<#
		jQuery(document).ready(function() {
			languages.forEach(function(code) {
				var className = 'cfq-language-button';
				if (code == languageCurrent) {
					className += ' is-current';
				}
				jQuery('.cfq-multi-language-field').append(
					'<button class="' + className + '" data-language="' + code + '">' + languageNames[code] + '</button>'
				);
			});

			languages.forEach(function(code) {
				var className = 'cfq-field-' + id + ' regular-text';
				if (code == languageCurrent) {
					className += ' is-current';
				}
				jQuery('.cfq-multi-language-field').append(
					'<input type="text" id="' + id + '" data-language="' + code + '" name="' + name + '[' + code + ']" value="' + splitted_values[code] + '" class="' + className + '">'
				);
			});

			jQuery('body').on('click', '.cfq-language-button', function(e) {
				e.preventDefault();
				jQuery('.cfq-language-button').removeClass('is-current');
				jQuery(this).addClass('is-current');
				var lang = jQuery(this).data('language');

				jQuery('.cfq-field-' + id).removeClass('is-current');
				jQuery('.cfq-field-' + id + '[data-language=' + lang + ']').addClass('is-current');
			});
		});
		#>
		<?php
	}

	/**
	 * admin_enqueue_scripts()
	 *
	 * This method is called in the admin_enqueue_scripts action. It is called once per field type.
	 * Use this method to enqueue CSS + JavaScript files.
	 *
	 */
	static function admin_enqueue_scripts() {
		$dir = plugin_dir_url( __DIR__ );
		wp_enqueue_style( 'carbon-fields-qtranslate', $dir . '/assets/qtranslate.css' );
	}

	public function save() {
		$this->value = qtranxf_join_b( $this->value );
		parent::save();
	}

}
