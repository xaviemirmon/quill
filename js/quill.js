(function ($, Drupal) {
  'use strict';

  Drupal.editors.quill = {
    attach: function (element, format) {

      var $element = $('#' + element.id);
      var $form = $element.parents('form');
      var settings = format.editorSettings;

      $element.wrap('<div class="ql-wrapper"/>');
      var $parent = $element.parent();
      $parent.prepend('<div class="ql-editable ql-' + element.id + '">' + $element.val() +'</div>');
      $element.addClass('ql-field');
      $element.hide();

      $form.submit(function(){
        $('.editable-wrapper').each(function(){
          var editorText = $(this).find('.ql-editor').html();
          var textArea = $(this).find('.ql-field');
          textArea.attr('data-editor-value-is-changed', 'true');
          textArea.val(editorText);
        });
      });

      var quill = new Quill('.ql-' + element.id, {
        placeholder: settings.placeholder,
        theme: settings.theme
      });

    },
    detach: function (element, format, trigger) {
      var $field = $('#' + element.id);
      $('.ql-wrapper').each(function(){
        var quillText = $(this).find('.ql-editor').html();
        var textArea = $(this).find('textarea');
        textArea.attr( 'data-editor-value-is-changed', 'true' );
        textArea.val(quillText);
      });
      $field.show();
      $('.editable-wrapper > div').unwrap();
      $('.ql-editable').remove();
      $('.ql-toolbar').remove();
    },
    onChange: function (element, callback) {
    }
  };

})(jQuery, Drupal);
