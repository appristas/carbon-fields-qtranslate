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
		<div id={{id}} class="cfq-multi-language-field">
			<# languages.forEach(function(code) { #>
				<button type="button" class="cfq-language-button" data-language={{code}}>{{languageNames[code]}}</button>
			<# }); #>

			<# languages.forEach(function(code) { #>
				<input type="text" data-language={{code}} name="{{name}}[{{code}}]" value="{{splitted_values[code]}}" class="cfq-field regular-text" />
			<# }); #>
		</div>
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
		wp_enqueue_style( 'carbon-fields-language-buttons', $dir . 'assets/language-buttons.css' );
		wp_enqueue_script( 'carbon-fields-Translatable_Text', $dir . 'assets/translatable_text_field.js', [ 'carbon-fields' ] );
	}

	public function save() {
		$this->value = qtranxf_join_b( $this->value );
		parent::save();
	}

}
