/*
 * MLMediaFinder plugin
 *
 * Data attributes:
 * - data-control="mlmediafinder" - enables the plugin on an element
 * - data-option="value" - an option with a value
 *
 * JavaScript API:
 * $('a#someElement').mlMediaFinder({ option: 'value' })
 *
 * Dependences:
 * - mediafinder (mediafinder.js)
 */

+function($) { "use strict";
    var Base = $.oc.foundation.base,
        BaseProto = Base.prototype

    // MLMEDIAFINDER CLASS DEFINITION
    // ============================

    var MLMediaFinder = function(element, options) {
        this.options   = options
        this.$el       = $(element)
        this.$mediafinder = $('[data-control=mediafinder]', this.$el)
        this.$findValue = $('[data-find-value]', this.$el)

        $.oc.foundation.controlUtils.markDisposable(element)
        Base.call(this)
        this.init()
    }

    MLMediaFinder.prototype = Object.create(BaseProto)
    MLMediaFinder.prototype.constructor = MLMediaFinder

    MLMediaFinder.DEFAULTS = {
        placeholderField: null,
        defaultLocale: 'en',
        mediaPath: '/',
    }

    MLMediaFinder.prototype.init = function() {

        this.$el.multiLingual()
        this.$el.on('setLocale.oc.multilingual', this.proxy(this.onSetLocale))
        this.$el.one('dispose-control', this.proxy(this.dispose))
        // Listen for change event from mediafinder
        this.$findValue.on('change', this.proxy(this.setValue))

        // Stop here for preview mode
        if (this.options.isPreview)
            return
    }

    // Simplify setPath
    MLMediaFinder.prototype.setValue = function(e) {
        this.setPath($(e.target).val())
    }

    MLMediaFinder.prototype.dispose = function() {
        this.$el.off('setLocale.oc.multilingual', this.proxy(this.onSetLocale))
        this.$el.off('dispose-control', this.proxy(this.dispose))
        this.$findValue.off('change', this.proxy(this.setValue))

        this.$el.removeData('oc.mlMediaFinder')

        this.$findValue = null
        this.$mediafinder = null;
        this.$el = null

        // In some cases options could contain callbacks,
        // so it's better to clean them up too.
        this.options = null

        BaseProto.dispose.call(this)
    }


    MLMediaFinder.prototype.onSetLocale = function(e, locale, localeValue) {
        this.setPath(localeValue)
    }

    MLMediaFinder.prototype.setPath = function(localeValue) {
        if (typeof localeValue === 'string') {
            this.$findValue = localeValue;

            var path = localeValue ? this.options.mediaPath + localeValue : ''

            $('[data-find-image]', this.$mediafinder).attr('src', path)
            $('[data-find-file-name]', this.$mediafinder).text(localeValue.substring(1))

            // if value is present display image/file, else display open icon for media manager
            this.$mediafinder.toggleClass('is-populated', !!localeValue)

            this.$el.multiLingual('setLocaleValue', localeValue);
        }
    }

    // MLMEDIAFINDER PLUGIN DEFINITION
    // ============================

    var old = $.fn.mlMediaFinder

    $.fn.mlMediaFinder = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result
        this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.mlMediaFinder')
            var options = $.extend({}, MLMediaFinder.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.mlMediaFinder', (data = new MLMediaFinder(this, options)))
            if (typeof option === 'string') result = data[option].apply(data, args)
            if (typeof result !== 'undefined') return false
        })

        return result ? result : this
    }

    $.fn.mlMediaFinder.Constructor = MLMediaFinder

    // MLMEDIAFINDER NO CONFLICT
    // =================

    $.fn.mlMediaFinder.noConflict = function () {
        $.fn.mlMediaFinder = old
        return this
    }

    // MLMEDIAFINDER DATA-API
    // ===============

    $(document).render(function () {
        $('[data-control="mlmediafinder"]').mlMediaFinder()
    })


}(window.jQuery);
