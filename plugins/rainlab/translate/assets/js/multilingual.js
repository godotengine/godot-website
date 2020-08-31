/*
 * Multi lingual control plugin
 * 
 * Data attributes:
 * - data-control="multilingual" - enables the plugin on an element
 * - data-default-locale="en" - default locale code
 * - data-placeholder-field="#placeholderField" - an element that contains the placeholder value
 *
 * JavaScript API:
 * $('a#someElement').multiLingual({ option: 'value' })
 *
 * Dependences:
 * - Nil
 */

+function ($) { "use strict";

    // MULTILINGUAL CLASS DEFINITION
    // ============================

    var MultiLingual = function(element, options) {
        var self          = this
        this.options      = options
        this.$el          = $(element)

        this.$activeField  = null
        this.$activeButton = $('[data-active-locale]', this.$el)
        this.$dropdown     = $('ul.ml-dropdown-menu', this.$el)
        this.$placeholder  = $(this.options.placeholderField)

        this.$dropdown.on('click', '[data-switch-locale]', function(event){
            var selectedLocale = $(this).data('switch-locale')
            self.setLocale(selectedLocale)

            /*
             * If Ctrl/Cmd key is pressed, find other instances and switch
             */
            if (event.ctrlKey || event.metaKey) {
                event.preventDefault();
                $('[data-switch-locale="'+selectedLocale+'"]').click()
            }
        })

        this.$placeholder.on('input', function(){
            self.$activeField.val(this.value)
        })

        /*
         * Init locale
         */
        this.activeLocale = this.options.defaultLocale
        this.$activeField = this.getLocaleElement(this.activeLocale)
        this.$activeButton.text(this.activeLocale)

        /*
         * Handle oc.inputPreset.beforeUpdate event
         */
        $('[data-input-preset]', this.$el).on('oc.inputPreset.beforeUpdate', function(event, src) {
            var sourceLocale = src.siblings('.ml-btn[data-active-locale]').text()
            var targetLocale = $(this).data('locale-value')
            var targetActiveLocale = $(this).siblings('.ml-btn[data-active-locale]').text()

            if (sourceLocale && targetLocale && targetActiveLocale) {
                if (targetActiveLocale !== sourceLocale)
                    self.setLocale(sourceLocale)
                $(this).data('update', sourceLocale === targetLocale)
            }
        })
    }

    MultiLingual.DEFAULTS = {
        defaultLocale: 'en',
        defaultField: null,
        placeholderField: null
    }

    MultiLingual.prototype.getLocaleElement = function(locale) {
        var el = this.$el.find('[data-locale-value="'+locale+'"]')
        return el.length ? el : null
    }

    MultiLingual.prototype.getLocaleValue = function(locale) {
        var value = this.getLocaleElement(locale)
        return value ? value.val() : null
    }

    MultiLingual.prototype.setLocaleValue = function(value, locale) {
        if (locale) {
            this.getLocaleElement(locale).val(value)
        }
        else {
            this.$activeField.val(value)
        }
    }

    MultiLingual.prototype.setLocale = function(locale) {
        this.activeLocale = locale
        this.$activeField = this.getLocaleElement(locale)
        this.$activeButton.text(locale)

        this.$placeholder.val(this.getLocaleValue(locale))
        this.$el.trigger('setLocale.oc.multilingual', [locale, this.getLocaleValue(locale)])
    }

    // MULTILINGUAL PLUGIN DEFINITION
    // ============================

    var old = $.fn.multiLingual

    $.fn.multiLingual = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result
        this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.multilingual')
            var options = $.extend({}, MultiLingual.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.multilingual', (data = new MultiLingual(this, options)))
            if (typeof option == 'string') result = data[option].apply(data, args)
            if (typeof result != 'undefined') return false
        })

        return result ? result : this
    }

    $.fn.multiLingual.Constructor = MultiLingual

    // MULTILINGUAL NO CONFLICT
    // =================

    $.fn.multiLingual.noConflict = function () {
        $.fn.multiLingual = old
        return this
    }

    // MULTILINGUAL DATA-API
    // ===============
    $(document).render(function () {
        $('[data-control="multilingual"]').multiLingual()
    })

}(window.jQuery);
