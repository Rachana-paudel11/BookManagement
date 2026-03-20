(function ($, Drupal, once) {
  Drupal.behaviors.bookManagementValidation = {
    attach: function (context, settings) {
      
      // Modern Drupal 10+ 'once' implementation for standard inputs
      once('bmValidationInit', 'input[name="title[0][value]"]', context).forEach(function (element) {
        var $title = $(element);
        var $form = $title.closest('form');
        var $saveButton = $form.find('#edit-submit');

        var validateForm = function () {
          var $desc = $form.find('textarea[name="description[0][value]"]');
          var $img = $form.find('input[name^="image[0][fids]"]');
          var $pdf = $form.find('input[name^="pdf[0][fids]"]');

          var titleOk = $title.val().trim() !== '';
          var descOk = $desc.val() && $desc.val().trim() !== '';
          var imgOk = $img.val() && $img.val() !== '';
          var pdfOk = $pdf.val() && $pdf.val() !== '';

          if (titleOk && descOk && imgOk && pdfOk) {
            $saveButton.prop('disabled', false).css('opacity', '1').css('pointer-events', 'auto');
          } else {
            $saveButton.prop('disabled', true).css('opacity', '0.5').css('pointer-events', 'none');
          }
        };

        // Initial check and listeners
        validateForm();
        
        $form.on('input keyup change focusout', 'input, textarea', function() {
          validateForm();
        });

        // Listen for AJAX completion (file uploads)
        $(document).ajaxComplete(function(event, xhr, settings) {
          if (settings.url && settings.url.match(/file\/ajax/)) {
            setTimeout(validateForm, 600);
          }
        });
      });
    }
  };
})(jQuery, Drupal, once);
