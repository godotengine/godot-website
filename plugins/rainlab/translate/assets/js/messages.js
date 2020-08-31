/*
 * Scripts for the Messages controller.
 */
+function ($) { "use strict";

    var TranslateMessages = function() {
        var self = this

        this.$form = null

        /*
         * Table toolbar
         */
        this.tableToolbar = null

        /*
         * Input with the "from" locale value
         */
        this.fromInput = null

        /*
         * Template for the "from" header (title)
         */
        this.fromHeader = null

        /*
         * Input with the "to" locale value
         */
        this.toInput = null

        /*
         * Template for the "to" header (title)
         */
        this.toHeader = null

        /*
         * The table widget element
         */
        this.tableElement = null

        /*
         * Hide translated strings (show only from the empty data set)
         */
        this.hideTranslated = false

        /*
         * Data sets, complete and untranslated (empty)
         */
        this.emptyDataSet = null
        this.dataSet = null

        $(document).on('change', '#hideTranslated', function(){
            self.toggleTranslated($(this).is(':checked'))
            self.refreshTable()
        });

        $(document).on('keyup', '.control-table input.string-input', function(ev) {
            self.onApplyValue(ev)
        });

        this.toggleTranslated = function(isHide) {
            this.hideTranslated = isHide
            this.setTitleContents()
        }

        this.setToolbarContents = function(tableToolbar) {
            if (tableToolbar) this.tableToolbar = $(tableToolbar)
            if (!this.tableElement) return

            var $toolbar = $('.toolbar', this.tableElement)
            if ($toolbar.hasClass('message-buttons-added')) {
                return
            }

            $toolbar.addClass('message-buttons-added')
            $toolbar.prepend(Mustache.render(this.tableToolbar.html()))
        }

        this.setTitleContents = function(fromEl, toEl) {
            if (fromEl) this.fromHeader = $(fromEl)
            if (toEl) this.toHeader = $(toEl)
            if (!this.tableElement) return

            var $headers = $('table.headers th', this.tableElement)
            $headers.eq(0).html(this.fromHeader.html())
            $headers.eq(1).html(Mustache.render(this.toHeader.html(), { hideTranslated: this.hideTranslated } ))
        }

        this.setTableElement = function(el) {
            this.tableElement = $(el)
            this.$form = $('#messagesForm')
            this.fromInput = this.$form.find('input[name=locale_from]')
            this.toInput = this.$form.find('input[name=locale_to]')

            this.tableElement.one('oc.tableUpdateData', $.proxy(this.updateTableData, this))
        }

        this.onApplyValue = function(ev) {
            if (ev.keyCode == 13) {
                var $table = $(ev.currentTarget).closest('[data-control=table]')

                if (!$table.length) {
                    return
                }

                var tableObj = $table.data('oc.table')
                if (tableObj) {
                    tableObj.setCellValue($(ev.currentTarget).closest('td').get(0), ev.currentTarget.value)
                    tableObj.commitEditedRow()
                }
            }
        }

        this.updateTableData = function(event, records) {
            if (this.hideTranslated && !records.length) {
                self.toggleTranslated($(this).is(':checked'))
                self.refreshTable()
            }
        }

        this.toggleDropdown = function(el) {
            setTimeout(function(){ $(el).dropdown('toggle') }, 1)
            return false
        }

        this.setLanguage = function(type, code) {
            if (type == 'to')
                this.toInput.val(code)
            else if (type == 'from')
                this.fromInput.val(code)

            this.refreshGrid()
            return false
        }

        this.swapLanguages = function() {
            var from = this.fromInput.val(),
                to  = this.toInput.val()

            this.toggleTranslated(false)
            this.fromInput.val(to)
            this.toInput.val(from)
            this.refreshGrid()
        }

        this.refreshGrid = function() {
            this.$form.request('onRefresh')
        }

        this.refreshTable = function() {
            this.tableElement.table('updateDataTable')
        }

    }

    $.translateMessages = new TranslateMessages;

}(window.jQuery);