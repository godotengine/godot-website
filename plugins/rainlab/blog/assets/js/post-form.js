+function ($) { "use strict";
    var PostForm = function () {
        this.$form = $('#post-form')
        this.$markdownEditor = $('[data-field-name=content] [data-control=markdowneditor]:first', this.$form)
        this.$preview = $('.editor-preview', this.$markdownEditor)

        this.formAction = this.$form.attr('action')
        this.sessionKey = $('input[name=_session_key]', this.$form).val()

        if (this.$markdownEditor.length > 0) {
            this.codeEditor = this.$markdownEditor.markdownEditor('getEditorObject')

            this.$markdownEditor.on('initPreview.oc.markdowneditor', $.proxy(this.initPreview, this))

            this.initDropzones()
            this.initFormEvents()
            this.addToolbarButton()
        }

        this.initLayout()
    }

    PostForm.prototype.addToolbarButton = function() {
        this.buttonClickCount = 1

        var self = this,
            $button = this.$markdownEditor.markdownEditor('findToolbarButton', 'image')

        if (!$button.length) return

        $button.data('button-action', 'insertLine')
        $button.data('button-template', '\n\n![1](image)\n')

        $button.on('click', function() {
            $button.data('button-template', '\n\n!['+self.buttonClickCount+'](image)\n')
            self.buttonClickCount++
        })
    }

    PostForm.prototype.initPreview = function() {
        this.initImageUploaders()
    }

    PostForm.prototype.updateScroll = function() {
        // Reserved in case MarkdownEditor uses scrollbar plugin
        // this.$preview.data('oc.scrollbar').update()
    }

    PostForm.prototype.initImageUploaders = function() {
        var self = this
        $('span.image-placeholder .upload-dropzone', this.$preview).each(function(){
            var
                $placeholder = $(this).parent(),
                $link = $('span.label', $placeholder),
                placeholderIndex = $placeholder.data('index')

            var uploaderOptions = {
                url: self.formAction,
                clickable: [$(this).get(0), $link.get(0)],
                previewsContainer: $('<div />').get(0),
                paramName: 'file',
                headers: {}
            }

            /*
             * Add CSRF token to headers
             */
            var token = $('meta[name="csrf-token"]').attr('content')
            if (token) {
                uploaderOptions.headers['X-CSRF-TOKEN'] = token
            }

            var dropzone = new Dropzone($(this).get(0), uploaderOptions)

            dropzone.on('error', function(file, error) {
                alert('Error uploading file: ' + error)
            })
            dropzone.on('success', function(file, data){
                if (data.error)
                    alert(data.error)
                else {
                    self.pauseUpdates()
                    var $img = $('<img src="'+data.path+'">')
                    $img.load(function(){
                        self.updateScroll()
                    })

                    $placeholder.replaceWith($img)

                    self.codeEditor.replace('!['+data.file+']('+data.path+')', {
                        needle: '!['+placeholderIndex+'](image)'
                    })
                    self.resumeUpdates()
                }
            })
            dropzone.on('complete', function(){
                $placeholder.removeClass('loading')
            })
            dropzone.on('sending', function(file, xhr, formData) {
                formData.append('X_BLOG_IMAGE_UPLOAD', 1)
                formData.append('_session_key', self.sessionKey)
                $placeholder.addClass('loading')
            })
        })
    }

    PostForm.prototype.pauseUpdates = function() {
        this.$markdownEditor.markdownEditor('pauseUpdates')
    }

    PostForm.prototype.resumeUpdates = function() {
        this.$markdownEditor.markdownEditor('resumeUpdates')
    }

    PostForm.prototype.initDropzones = function() {
        $(document).bind('dragover', function (e) {
            var dropZone = $('span.image-placeholder .upload-dropzone'),
                foundDropzone,
                timeout = window.dropZoneTimeout

            if (!timeout)
                dropZone.addClass('in');
            else
                clearTimeout(timeout);

            var found = false,
                node = e.target

            do {
                if ($(node).hasClass('dropzone')) {
                    found = true
                    foundDropzone = $(node)
                    break
                }

                node = node.parentNode;

            } while (node != null);

            dropZone.removeClass('in hover')

            if (found)
                foundDropzone.addClass('hover')

            window.dropZoneTimeout = setTimeout(function () {
                window.dropZoneTimeout = null
                dropZone.removeClass('in hover')
            }, 100)
        })
    }

    PostForm.prototype.initFormEvents = function() {
        $(document).on('ajaxSuccess', '#post-form', function(event, context, data){
            if (context.handler == 'onSave' && !data.X_OCTOBER_ERROR_FIELDS) {
                $(this).trigger('unchange.oc.changeMonitor')
            }
        })
    }

    PostForm.prototype.initLayout = function() {
        $('#Form-secondaryTabs .tab-pane.layout-cell:not(:first-child)').addClass('padded-pane')
    }

    PostForm.prototype.replacePlaceholder = function(placeholder, placeholderHtmlReplacement, mdCodePlaceholder, mdCodeReplacement) {
        this.pauseUpdates()
        placeholder.replaceWith(placeholderHtmlReplacement)

        this.codeEditor.replace(mdCodeReplacement, {
            needle: mdCodePlaceholder
        })
        this.updateScroll()
        this.resumeUpdates()
    }

    $(document).ready(function(){
        var form = new PostForm()

        if ($.oc === undefined)
            $.oc = {}

        $.oc.blogPostForm = form
    })

}(window.jQuery);