(function ($, Drupal) {
  'use strict';

  Drupal.editors.quill = {
    attach: function (element, format) {
      var $element = $('#' + element.id);
      var $form = $element.parents('form');

      $element.wrap('<div class="editable-wrapper"/>');
      var $parent = $element.parent();
      $parent.prepend('<div class="quill-editable quill-' + element.id + '">' + $element.val() +'</div>');
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

      var quill = new Quill('.quill-' + element.id, {
        placeholder: 'Compose an epic...',
        theme: 'snow'
      });

    },
    detach: function (element, format, trigger) {
      var $field = $('#' + element.id);
      $('.editable-wrapper').each(function(){
        var quillText = $(this).find('.ql-editor').html();
        var textArea = $(this).find('textarea');
        textArea.attr( 'data-editor-value-is-changed', 'true' );
        textArea.val(quillText);
      });
      $field.show();
      $('.editable-wrapper > div').unwrap();
      $('.quill-editable').remove();
      $('.ql-toolbar').remove();
    },
    onChange: function (element, callback) {
    }
  };

})(jQuery, Drupal);

