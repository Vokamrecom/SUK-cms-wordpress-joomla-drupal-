/**
 * @file
 * JavaScript behaviors for jquery.inputmask integration.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Initialize input masks.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.webformInputMask = {
    attach: function (context) {
      if (!$.fn.inputmask) {
        return;
      }

      $(context).find('input.js-webform-input-mask').once('webform-input-mask').inputmask();
    }
  };

})(jQuery, Drupal);
;
/**
 * @file
 * JavaScript behaviors for color element integration.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Enhance HTML5 color element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.webformColor = {
    attach: function (context) {
      $(context).find('.form-color:not(.form-color-output)').once('webform-color').each(function () {
        var $element = $(this);
        // Handle browser that don't support the HTML5 color input.
        if (Modernizr.inputtypes.color === false) {
          // Remove swatch sizes.
          $element.removeClass('form-color-small')
            .removeClass('form-color-medium')
            .removeClass('form-color-large');
        }
        else {
          // Display color input's output w/ visually-hidden label to
          // the end user.
          var $output = $('<input class="form-color-output ' + $element.attr('class') + ' js-webform-input-mask" data-inputmask-mask="\\#######" />').uniqueId();
          var $label = $element.parent('.js-form-type-color').find('label').clone();
          $label.attr({
            for: $output.attr('id'),
            class: 'visually-hidden'
          });
          if ($.fn.inputmask) {
            $output.inputmask();
          }
          $output[0].value = $element[0].value;
          $element
            .after($output)
            .after($label)
            .css({float: 'left'});

          // Sync $element and $output.
          $element.on('input', function () {
            $output[0].value = $element[0].value;
          });
          $output.on('input', function () {
            $element[0].value = $output[0].value;
          });
        }
      });
    }
  };

})(jQuery, Drupal);
;
/**
 * @file
 * JavaScript behaviors for Text format integration.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Enhance text format element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.webformTextFormat = {
    attach: function (context) {
      $(context).find('.js-text-format-wrapper textarea').once('webform-text-format').each(function () {
        if (!window.CKEDITOR) {
          return;
        }

        var $textarea = $(this);
        // Update the CKEDITOR when the textarea's value has changed.
        // @see webform.states.js
        $textarea.on('change', function () {
          if (CKEDITOR.instances[$textarea.attr('id')]) {
            var editor = CKEDITOR.instances[$textarea.attr('id')];
            editor.setData($textarea.val());
          }
        });

        // Set CKEDITOR to be readonly when the textarea is disabled.
        // @see webform.states.js
        $textarea.on('webform:disabled', function () {
          if (CKEDITOR.instances[$textarea.attr('id')]) {
            var editor = CKEDITOR.instances[$textarea.attr('id')];
            editor.setReadOnly($textarea.is(':disabled'));
          }
        });

      });
    }
  };

})(jQuery, Drupal);
;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal) {
  Drupal.behaviors.filterGuidelines = {
    attach: function attach(context) {
      function updateFilterGuidelines(event) {
        var $this = $(event.target);
        var value = $this.val();
        $this.closest('.filter-wrapper').find('.filter-guidelines-item').hide().filter('.filter-guidelines-' + value).show();
      }

      $(context).find('.filter-guidelines').once('filter-guidelines').find(':header').hide().closest('.filter-wrapper').find('select.filter-list').on('change.filterGuidelines', updateFilterGuidelines).trigger('change.filterGuidelines');
    }
  };
})(jQuery, Drupal);;