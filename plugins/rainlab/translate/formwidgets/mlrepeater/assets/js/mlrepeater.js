/*
 * MLRepeater plugin
 *
 * Data attributes:
 * - data-control="mlrepeater" - enables the plugin on an element
 *
 * JavaScript API:
 * $('a#someElement').mlRepeater({ option: 'value' })
 *
 */

+function ($) { "use strict";

    var Base = $.oc.foundation.base,
        BaseProto = Base.prototype

    // MLREPEATER CLASS DEFINITION
    // ============================

    var MLRepeater = function(element, options) {
        this.options   = options
        this.$el       = $(element)
        this.$selector = $('[data-locale-dropdown]', this.$el)
        this.$locale   = $('[data-repeater-active-locale]', this.$el)
        this.locale    = options.defaultLocale

        $.oc.foundation.controlUtils.markDisposable(element)
        Base.call(this)

        // Init
        this.init()
    }

    MLRepeater.prototype = Object.create(BaseProto)
    MLRepeater.prototype.constructor = MLRepeater

    MLRepeater.DEFAULTS = {
        switchHandler: null,
        defaultLocale: 'en'
    }

    MLRepeater.prototype.init = function() {
        this.$el.multiLingual()

        this.checkEmptyItems()

        $(document).on('render', this.proxy(this.checkEmptyItems))

        this.$el.on('setLocale.oc.multilingual', this.proxy(this.onSetLocale))

        this.$el.one('dispose-control', this.proxy(this.dispose))
    }

    MLRepeater.prototype.dispose = function() {

        $(document).off('render', this.proxy(this.checkEmptyItems))

        this.$el.off('setLocale.oc.multilingual', this.proxy(this.onSetLocale))

        this.$el.off('dispose-control', this.proxy(this.dispose))

        this.$el.removeData('oc.mlRepeater')

        this.$selector = null
        this.$locale = null
        this.locale = null
        this.$el = null

        this.options = null

        BaseProto.dispose.call(this)
    }

    MLRepeater.prototype.checkEmptyItems = function() {
        var isEmpty = !$('ul.field-repeater-items > li', this.$el).length
        this.$el.toggleClass('is-empty', isEmpty)
    }

    MLRepeater.prototype.onSetLocale = function(e, locale, localeValue) {
        var self = this,
            previousLocale = this.locale

        this.$el
            .addClass('loading-indicator-container size-form-field')
            .loadIndicator()

        this.locale = locale
        this.$locale.val(locale)

        this.$el.request(this.options.switchHandler, {
            data: {
                _repeater_previous_locale: previousLocale,
                _repeater_locale: locale
            },
            success: function(data) {
                self.$el.multiLingual('setLocaleValue', data.updateValue, data.updateLocale)
                self.$el.loadIndicator('hide')
                this.success(data)
            }
        })
    }

    // MLREPEATER PLUGIN DEFINITION
    // ============================

    var old = $.fn.mlRepeater

    $.fn.mlRepeater = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result
        this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.mlRepeater')
            var options = $.extend({}, MLRepeater.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.mlRepeater', (data = new MLRepeater(this, options)))
            if (typeof option == 'string') result = data[option].apply(data, args)
            if (typeof result != 'undefined') return false
        })

        return result ? result : this
    }

    $.fn.mlRepeater.Constructor = MLRepeater

    // MLREPEATER NO CONFLICT
    // =================

    $.fn.mlRepeater.noConflict = function () {
        $.fn.mlRepeater = old
        return this
    }

    // MLREPEATER DATA-API
    // ===============

    $(document).render(function () {
        $('[data-control="mlrepeater"]').mlRepeater()
    })

}(window.jQuery);
