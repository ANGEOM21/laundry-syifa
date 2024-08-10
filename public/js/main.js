(function ($) {
  "use strict";

  // INITIALIZATION OF WOW

  new WOW().init();

  // PRE LOADER

  var loader = function () {
    setTimeout(function () {
      if ($("#loader").length > 0) {
        $("#loader").removeClass("show");
      }
    }, 1);
  };

  loader();

  // SCROLL TO TOP

  $(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });

  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");

    return false;
  });

  // STICKY NAVBAR

  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $(".navbar").addClass("nav-sticky");
    } else {
      $(".navbar").removeClass("nav-sticky");
    }
  });

  // SMOOTH SCROLL

  $(".navbar-nav a").on("click", function (event) {
    if (this.hash !== "") {
      event.preventDefault();

      $("html, body").animate(
        {
          scrollTop: $(this.hash).offset().top - 45,
        },

        1500,

        "easeInOutExpo",
      );

      if ($(this).parents(".navbar-nav").length) {
        $(".navbar-nav .active").removeClass("active");

        $(this).closest("a").addClass("active");
      }
    }
  });

  // INITIALIZATION OF DATATABLE

  new DataTable("#example");

  // SHOW/HIDE PASSWORD LOGIN

  $(".showPass input#checkPasswd_login").on("change", function () {
    if ($(this).is(":checked")) {
      $("#password_user").attr("type", "text");

      $(".showPass i").attr("class", "bi bi-eye-slash");
    } else {
      $("#password_user").attr("type", "password");

      $(".showPass i").attr("class", "bi bi-eye");
    }
  });

  // SHOW/HIDE PASSWORD REGISTER

  $(".showPass input#checkPasswd_register").on("change", function () {
    if ($(this).is(":checked")) {
      $("#password").attr("type", "text");

      $(".showPass i").attr("class", "bi bi-eye-slash");
    } else {
      $("#password").attr("type", "password");

      $(".showPass i").attr("class", "bi bi-eye");
    }
  });

  // SHOW/HIDE PASSWORD RE

  $(".showPass_re input#checkPasswd_register_re").on("change", function () {
    if ($(this).is(":checked")) {
      $("#re_password").attr("type", "text");

      $(".showPass_re i").attr("class", "bi bi-eye-slash");
    } else {
      $("#re_password").attr("type", "password");

      $(".showPass_re i").attr("class", "bi bi-eye");
    }
  });

  // SHOW/HIDE PASSWORD FORGET PASSWORD

  $(".showPass input#checkPasswd_frgt").on("change", function () {
    if ($(this).is(":checked")) {
      $("#password_user").attr("type", "text");

      $(".showPass i").attr("class", "bi bi-eye-slash");
    } else {
      $("#password_user").attr("type", "password");

      $(".showPass i").attr("class", "bi bi-eye");
    }
  });

  $(".showPass_re input#checkPasswd_frgt_re").on("change", function () {
    if ($(this).is(":checked")) {
      $("#re_password_user").attr("type", "text");

      $(".showPass_re i").attr("class", "bi bi-eye-slash");
    } else {
      $("#re_password_user").attr("type", "password");

      $(".showPass_re i").attr("class", "bi bi-eye");
    }
  });
})(jQuery);
