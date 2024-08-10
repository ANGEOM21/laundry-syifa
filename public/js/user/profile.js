(function ($) {
  "use strict";

  // EDIT PROFILE USER SIDEBAR TOGGLE

  $("#toggle-sidebar-user").on("click", function (e) {
    e.preventDefault();

    $(".sidebar-user").toggleClass("hide");

    $(".main-content").toggleClass("hide");

    $(".topbar-user, .topbar-sticky").toggleClass("hide");
  });

  // STICKY TOPBAR USER

  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $(".topbar-user").addClass("topbar-sticky");
    } else {
      $(".topbar-user").removeClass("topbar-sticky");
    }
  });

  // EDIT PROFILE USER SIDEBAR

  $(document).ready(function () {
    $("#toggleBtn").on("click", function () {
      var sidebar = $("#sidebar-edit-user");

      var content = $(".content-edit-user");

      var logout = $(".content-edit-user .logout-parrent");

      if (sidebar.css("left") === "0px") {
        sidebar.css("left", "-210px");

        content.css("margin-left", "0px");

        // Hide content-admin when media screen is max-width: 768px

        if (window.matchMedia("(max-width: 768px)").matches) {
          content.css("display", "block");
        }
      } else {
        sidebar.css("left", "0px");

        content.css("margin-left", "210px");

        // Show content-admin when media screen is max-width: 768px

        if (window.matchMedia("(max-width: 768px)").matches) {
          content.css("position", "absolute");
        }
      }
    });
  });
})(jQuery); // End of use strict
