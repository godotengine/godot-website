/*
 * MLMarkdownEditor plugin
 *
 * Data attributes:
 * - data-control="mlmarkdowneditor" - enables the plugin on an element
 * - data-textarea-element="textarea#id" - an option with a value
 *
 * JavaScript API:
 * $('a#someElement').mlMarkdownEditor({ option: 'value' })
 *
 */

+function ($) { "use strict";

    var Base = $.oc.foundation.base,
        BaseProto = Base.prototype

    // MLMARKDOWNEDITOR CLASS DEFINITION
    // ============================

    var MLMarkdownEditor = function(element, options) {
        this.options   = options
        this.$el       = $(element)
        this.$textarea = $(options.textareaElement)
        this.$markdownEditor = $('[data-control=markdowneditor]:first', this.$el)

        $.oc.foundation.controlUtils.markDisposable(element)
        Base.call(this)

        // Init
        this.init()
    }

    MLMarkdownEditor.prototype = Object.create(BaseProto)
    MLMarkdownEditor.prototype.constructor = MLMarkdownEditor

    MLMarkdownEditor.DEFAULTS = {
        textareaElement: null,
        placeholderField: null,
        defaultLocale: 'en'
    }

    MLMarkdownEditor.prototype.init = function() {
        this.$el.multiLingual()

        this.$el.on('setLocale.oc.multilingual', this.proxy(this.onSetLocale))
        this.$textarea.on('changeContent.oc.markdowneditor', this.proxy(this.onChangeContent))

        this.$el.one('dispose-control', this.proxy(this.dispose))
    }

    MLMarkdownEditor.prototype.dispose = function() {
        this.$el.off('setLocale.oc.multilingual', this.proxy(this.onSetLocale))
        this.$textarea.off('changeContent.oc.markdowneditor', this.proxy(this.onChangeContent))
        this.$el.off('dispose-control', this.proxy(this.dispose))

        this.$el.removeData('oc.mlMarkdownEditor')

        this.$textarea = null
        this.$markdownEditor = null
        this.$el = null

        this.options = null

        BaseProto.dispose.call(this)
    }

    MLMarkdownEditor.prototype.onSetLocale = function(e, locale, localeValue) {
        if (typeof localeValue === 'string' && this.$markdownEditor.data('oc.markdownEditor')) {
            this.$markdownEditor.markdownEditor('setContent', localeValue);
        }
    }

    MLMarkdownEditor.prototype.onChangeContent = function(ev, markdowneditor, value) {
        this.$el.multiLingual('setLocaleValue', value)
    }

    var old = $.fn.mlMarkdownEditor

    $.fn.mlMarkdownEditor = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result

        this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.mlMarkdownEditor')
            var options = $.extend({}, MLMarkdownEditor.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.mlMarkdownEditor', (data = new MLMarkdownEditor(this, options)))
            if (typeof option == 'string') result = data[option].apply(data, args)
            if (typeof result != 'undefined') return false
        })

        return result ? result : this
    }

    $.fn.mlMarkdownEditor.Constructor = MLMarkdownEditor;

    $.fn.mlMarkdownEditor.noConflict = function () {
        $.fn.mlMarkdownEditor = old
        return this
    }

    $(document).render(function (){
        $('[data-control="mlmarkdowneditor"]').mlMarkdownEditor()
    })


}(window.jQuery);
