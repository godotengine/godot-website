+function ($) { "use strict";

    /**
     * Constructor
     */
    var tagbox = function (el, config) {
        this.$el        = $(el)

        this.alias      = this.$el.data('alias')
        this.config     = this.$el.data('config')
        this.$tags      = this.$el.find('[data-control="tags"]')
        this.$list      = this.$el.find('[data-control="list"]')
        this.$last      = this.$el.find('[data-control="last"]')
        this.$input     = this.$el.find('[data-control="tagbox-input"]')
        this.$template  = this.$el.find('[data-control="template"]')

        this.init()
    }

    /**
     * Listen for editor events
     */
    tagbox.prototype.init = function () {
        var self = this

        // Listen for break keys
        this.$input.unbind().on('keydown', function(e) {
            var code = e.keyCode || e.which
            if ($.inArray(code, self.config.breakCodes) !== -1) {
                e.preventDefault()
                self.addTag($(this).val())
            }

            // Listen for backspace removals
            if (code == 8 && $(this).val() === '') {
                self.backspaceRemove()
                return false
            }

            // Remove any pre-delete classes
            self.$list.find('.pre-delete').removeClass('pre-delete')
        })

        // Filter input
        this.$input.on('change keydown keyup paste', function() {
            self.filterInput()
        })

        // Listen for tag removals through X button
        this.$list.on('click', '[data-control="remove"]', function() {
            $(this).closest('li').remove()
        })

        // Focus the cursor in the input box
        if (this.config.autofocus) {
            this.$list.on('click', function() {
                self.$input.focus()
            })
            this.$input.on('focus', function() {
                self.$list.addClass('focused')
            })
            this.$input.on('blur', function() {
                self.$list.removeClass('focused')
            })
        }
    }

    /**
     * Removes invalid characters from input
     */
    tagbox.prototype.filterInput = function() {
        var filter = new RegExp(this.config.filter, 'g'),
            original = this.$input.val()

        this.$input.val(original.replace(filter, ''))
    }

    /**
     * Add tag to list
     */
    tagbox.prototype.addTag = function(tag) {
        this.filterInput()

        if (typeof tag != 'undefined' && !tag.length) {
            return false
        }

        // Validate the tag
        if (this.config.validation && this.validation(tag) == false) {
            $.oc.flashMsg({
                text: this.config.validationMessage,
                'class': 'error',
                'interval': 3
            })
            this.$input.focus()
            return false
        }

        // Sluggify the tag
        if (this.config.slugify) {
            tag = tag.toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with hyphens
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple hyphens
                .replace(/^-+/, '')             // Trim hyphens from start of text
                .replace(/-+$/, '')             // Trim hyphens from end of text
        }

        var cleanTag = tag
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;"),
            $exists = this.$list.find('[data-tag="' + cleanTag + '"]'),
            $newTag = $(this.$template.html())

        // Make sure the tag doesn't already exist
        if ($exists.length) {
            this.flash($exists)
            return false
        }

        // Add the new tag and clear the input box
        $newTag.attr('data-tag', cleanTag)
        $newTag.find('input').val(tag)
        $newTag.find('[data-control="display"]').html(cleanTag)

        this.$last.before($newTag)
        this.$input.val('')
    }

    /**
     * Removes a tag with the backspace key
     */
    tagbox.prototype.backspaceRemove = function() {
        var $target = this.$list.find('li:nth-last-child(2)')

        if ($target.hasClass('pre-delete')) {
            $target.remove()
        } else {
            $target.addClass('pre-delete')
        }
    }

    /**
     * Temporarily adds the flash class to a tag
     * @param  element  $tag
     */
    tagbox.prototype.flash = function($tag) {
        $tag.addClass('flash');
        setTimeout(function() {
            $tag.removeClass('flash');
        }, 300)
    }

    /**
     * Validates a tag
     * @return  boolean
     */
    tagbox.prototype.validation = function(tag) {
        var expression = new RegExp(this.config.validation)
        return expression.test(tag)
    }

    /*
     * Bind and construct non-conflicting tagbox
     */
    var old = $.fn.tagbox

    $.fn.tagbox = function (config) {
        return new tagbox($(this), config)
    }

    $.fn.tagbox.Constructor = tagbox

    $.fn.tagbox.noConflict = function () {
        $.fn.tagbox = old
        return this
    }

}(window.jQuery);
