(function ($, Drupal, once) {
  Drupal.behaviors.bookManagementCopy = {
    attach: function (context, settings) {
      // Modern Drupal 10+ 'once' implementation
      once('bmCopy', '#bm-copy-trigger', context).forEach(function (element) {
        $(element).on('click', function (e) {
          e.preventDefault();
          var copyTarget = document.getElementById("bm-shortcode-copy-target");
          
          if (copyTarget) {
            // Select and Copy
            copyTarget.select();
            copyTarget.setSelectionRange(0, 99999);

            try {
              if (navigator.clipboard) {
                navigator.clipboard.writeText(copyTarget.value).then(() => {
                  showSuccess($(this));
                });
              } else {
                document.execCommand("copy");
                showSuccess($(this));
              }
            } catch (err) {
              console.error('Failed to copy', err);
            }
          }
        });
      });

      function showSuccess($btn) {
        $btn.addClass('bm-copied-success');
        setTimeout(function() {
          $btn.removeClass('bm-copied-success');
        }, 1500);
      }
    }
  };
})(jQuery, Drupal, once);
