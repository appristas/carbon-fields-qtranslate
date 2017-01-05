	window.carbon = window.carbon || {};

	(function($) {
		var carbon = window.carbon;

		if (typeof carbon.fields === 'undefined') {
			return false;
		}

		carbon.fields.Model.TranslatableText = carbon.fields.Model.extend({
			initialize: function() {
				carbon.fields.Model.prototype.initialize.apply(this);  // do not delete
			}
		});

		carbon.fields.View.TranslatableText = carbon.fields.View.extend({
			events: function() {
				return _.extend({}, carbon.fields.View.prototype.events, {
					'click .cfq-language-button': 'changeLanguage',
				});
			},

			initialize: function() {
				carbon.fields.View.prototype.initialize.apply(this); // do not delete
				this.on('field:rendered', this.initField);
			},

			initField: function() {
				var lang = this.templateVariables.languageCurrent;
				this.$el.find('.cfq-language-button[data-language=' + lang + ']').addClass('is-current');
				this.$el.find('.cfq-field[data-language=' + lang + ']').addClass('is-current');
			},

			changeLanguage: function(e) {
				var lang = e.currentTarget.getAttribute('data-language');
				this.$el.find('.cfq-language-button, .cfq-field').removeClass('is-current');
				this.$el.find('.cfq-language-button[data-language=' + lang + ']').addClass('is-current');
				this.$el.find('.cfq-field[data-language=' + lang + ']').addClass('is-current');
			}
		});

	}(jQuery));
