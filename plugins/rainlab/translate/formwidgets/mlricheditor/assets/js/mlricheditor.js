/*
 * MLRichEditor plugin
 * 
 * Data attributes:
 * - data-control="mlricheditor" - enables the plugin on an element
 * - data-textarea-element="textarea#id" - an option with a value
 *
 * JavaScript API:
 * $('a#someElement').mlRichEditor({ option: 'value' })
 *
 */

+function ($) { "use strict";

    var Base = $.oc.foundation.base,
        BaseProto = Base.prototype

    // MLRICHEDITOR CLASS DEFINITION
    // ============================

    var MLRichEditor = function(element, options) {
        this.options   = options
        this.$el       = $(element)
        this.$textarea = $(options.textareaElement)
        this.$richeditor = $('[data-control=richeditor]:first', this.$el)

        $.oc.foundation.controlUtils.markDisposable(element)
        Base.call(this)

        // Init
        this.init()
    }

    MLRichEditor.prototype = Object.create(BaseProto)
    MLRichEditor.prototype.constructor = MLRichEditor

    MLRichEditor.DEFAULTS = {
        textareaElement: null,
        placeholderField: null,
        defaultLocale: 'en'
    }

    MLRichEditor.prototype.init = function() {
        this.$el.multiLingual()

        this.$el.on('setLocale.oc.multilingual', this.proxy(this.onSetLocale))
        this.$textarea.on('syncContent.oc.richeditor', this.proxy(this.onSyncContent))

        this.updateLayout()

        $(window).on('resize', this.proxy(this.updateLayout))
        $(window).on('oc.updateUi', this.proxy(this.updateLayout))
        this.$el.one('dispose-control', this.proxy(this.dispose))
    }

    MLRichEditor.prototype.dispose = function() {
        this.$el.off('setLocale.oc.multilingual', this.proxy(this.onSetLocale))
        this.$textarea.off('syncContent.oc.richeditor', this.proxy(this.onSyncContent))
        $(window).off('resize', this.proxy(this.updateLayout))
        $(window).off('oc.updateUi', this.proxy(this.updateLayout))

        this.$el.off('dispose-control', this.proxy(this.dispose))

        this.$el.removeData('oc.mlRichEditor')

        this.$textarea = null
        this.$richeditor = null
        this.$el = null

        this.options = null

        BaseProto.dispose.call(this)
    }

    MLRichEditor.prototype.onSetLocale = function(e, locale, localeValue) {
        if (typeof localeValue === 'string' && this.$richeditor.data('oc.richEditor')) {
            this.$richeditor.richEditor('setContent', localeValue);
        }
    }

    MLRichEditor.prototype.onSyncContent = function(ev, richeditor, value) {
        this.$el.multiLingual('setLocaleValue', value.html)
    }

    MLRichEditor.prototype.updateLayout = function() {
        var $toolbar = $('.fr-toolbar', this.$el),
            $btn = $('.ml-btn[data-active-locale]:first', this.$el),
            $dropdown = $('.ml-dropdown-menu[data-locale-dropdown]:first', this.$el)

        if (!$toolbar.length) {
            return
        }

        var height = $toolbar.outerHeight(true)
        $btn.css('top', height + 6)
        $dropdown.css('top', height + 40)
    }

    // MLRICHEDITOR PLUGIN DEFINITION
    // ============================

    var old = $.fn.mlRichEditor

    $.fn.mlRichEditor = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result
        this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.mlRichEditor')
            var options = $.extend({}, MLRichEditor.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.mlRichEditor', (data = new MLRichEditor(this, options)))
            if (typeof option == 'string') result = data[option].apply(data, args)
            if (typeof result != 'undefined') return false
        })

        return result ? result : this
    }

    $.fn.mlRichEditor.Constructor = MLRichEditor

    // MLRICHEDITOR NO CONFLICT
    // =================

    $.fn.mlRichEditor.noConflict = function () {
        $.fn.mlRichEditor = old
        return this
    }

    // MLRICHEDITOR DATA-API
    // ===============

    $(document).render(function () {
        $('[data-control="mlricheditor"]').mlRichEditor()
    })

}(window.jQuery);
