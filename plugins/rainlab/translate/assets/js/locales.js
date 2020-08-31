/*
 * Scripts for the Locales controller.
 */
+function ($) { "use strict";

    var TranslateLocales = function() {

        this.clickRecord = function(recordId) {
            var newPopup = $('<a />')

            newPopup.popup({
                handler: 'onUpdateForm',
                extraData: {
                    'record_id': recordId,
                }
            })
        }

        this.createRecord = function() {
            var newPopup = $('<a />')
            newPopup.popup({ handler: 'onCreateForm' })
        }

    }

    $.translateLocales = new TranslateLocales;

}(window.jQuery);