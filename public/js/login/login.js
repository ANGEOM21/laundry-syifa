(function ($) {
  "use strict";

  // LOGIN SHOW MODAL

  $(document).ready(function () {
    $(".signIn").on("click", function () {
      $("#signInModal").modal("show");
    });
  });
})(jQuery);
