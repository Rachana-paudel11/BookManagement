(function ($, Drupal) {
  Drupal.behaviors.bookManagementCopy = {
    attach: function (context, settings) {
      $('#bm-copy-trigger', context).once('bmCopy').on('click', function (e) {
        e.preventDefault();
        var copyText = document.getElementById("bm-shortcode-copy-target");
        
        // Select & Copy
        copyText.select();
        copyText.setSelectionRange(0, 99999);

        try {
          if (navigator.clipboard) {
            navigator.clipboard.writeText(copyText.value).then(() => {
              showSuccess($(this));
            });
          } else {
            document.execCommand("copy");
            showSuccess($(this));
          }
        } catch (err) {
          console.error('Failed to copy', err);
        }
      });

      function showSuccess($btn) {
        $btn.addClass('bm-copied-success');
        setTimeout(function() {
          $btn.removeClass('bm-copied-success');
        }, 1500);
      }
    }
  };
})(jQuery, Drupal);
