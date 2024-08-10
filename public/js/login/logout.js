(function ($) {
  "use strict";

  //  LOGOUT MODAL

  const BASEURL = window.location.origin;

  $(".logout_btn").on("click", function () {
    $("#logout-modal").modal("show");

    $("#logout_btn").on("click", function () {
      localStorage.clear();

      localStorage.removeItem("notification");

      localStorage.removeItem("token");

      window.location.href = BASEURL + "/logout";
    });
  });
})(jQuery);
