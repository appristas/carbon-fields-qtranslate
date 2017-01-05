# Carbon Fields: qTranslate

This plugin adds translatable fields for Carbon Fields using qTranslate-X.

## Installation

You can install this plugin in two ways:

1. Install the plugin from [Wordpress Plugins][wp-plugin].

2. To install the plugin using Composer and [wpackagist][wpackagist], add the following
line to composer.json:

		"wpackagist-plugin/carbon-fields-qtranslate": "1.0.1"


[wp-plugin]: https://wordpress.org/plugins/carbon-fields-qtranslate/
[wpackagist]: https://wpackagist.org/search?q=carbon-fields-qtranslate&type=any&search=

## Getting Started

### Text Field

For translatable text field, use `translatable_text` as field type.

#### Example

	namespace Example\Cpt;

	function create_fields() {
		if ( ! function_exists( 'carbon_get_post_meta' ) ) {
			return;
		}

		\Carbon_Fields\Container::make( 'post_meta', __( 'Post Data', 'some-domain' ) )
			->show_on_post_type( 'post' )
			->add_fields([
				\Carbon_Fields\Field::make( 'translatable_text', 'Additional Text' ),
			]);
	}

	add_action( 'carbon_register_fields', 'Example\Cpt\create_fields' );

## Contributing

This project adheres to the [Open Code of Conduct][code-of-conduct]. By participating, you are expected to honor this code.

[code-of-conduct]: http://todogroup.org/opencodeofconduct/

### Bugs
If you have encountered a bug, please use [Github Issues][github-issues] to submit a an issue.

[github-issues]: https://github.com/appristas/carbon-fields-qtranslate/issues

### Submitting a Pull Request

Before submitting pull request please conform to [Wordpress PHP Coding Standards][wp-php-coding-standards]. Naming class names and file names are an exception to these guidelines until we can find a better solution.

1. Fork this repository
2. Create a new branch from master
2. Commit your changes
3. Push to the newly created branch
4. Submit a pull request
5. Sit back, relax, and wait for a response :smiley:

[wp-php-coding-standards]: https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/

### TODO

- ~~Add plugin to wordpress.org~~
- ~~Add this package to wpackagist.org~~
- Add more translatable fields (TextArea, RichText)

## License

This project is licensed under GPLv3. Please read the LICENSE file for details.
