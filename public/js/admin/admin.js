(function ($) {
  "use strict"; // Start of use strict
  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $(".sidebar .collapse").collapse("hide");
    }
  });
  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $(".sidebar .collapse").collapse("hide");
    }
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $(".sidebar .collapse").collapse("hide");
    }
  });
  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $("body.fixed-nav .sidebar").on(
    "mousewheel DOMMouseScroll wheel",
    function (e) {
      if ($(window).width() > 768) {
        var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    }
  );
  // Smooth scrolling using jQuery easing
  $(document).on("click", "a.scroll-to-top", function (e) {
    var $anchor = $(this);
    $("html, body")
      .stop()
      .animate(
        {
          scrollTop: $($anchor.attr("href")).offset().top,
        },
        1000,
        "easeInOutExpo"
      );
    e.preventDefault();
  });
  // toggle sidebar
  $(document).ready(function () {
    $("#toggleBtn").on("click", function () {
      var sidebar = $("#sidebar-admin");
      var content = $(".content-admin");
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
  // dropdown sidebar
  $(document).ready(function () {
    // data_custumer
    $("#dropdown-sidebar a.button-dropdown-item").on("click", function () {
      $(this).toggleClass("active");
      if ($(this).hasClass("active")) {
        $(this)
          .find("i")
          .removeClass("fa-chevron-right")
          .addClass("fa-chevron-down");
        $(".item-dropdown-menu").css("display", "block");
      } else {
        $(this)
          .find("i")
          .removeClass("fa-chevron-down")
          .addClass("fa-chevron-right");
        $(".item-dropdown-menu").css("display", "none");
      }
    });
    // link data custumer
    var link_active_data_ctm = $(".item-dropdown-menu a.active").length;
    if (link_active_data_ctm == 1) {
      $(".item-dropdown-menu").css("display", "block");
      $("#dropdown-sidebar a.button-dropdown-item").addClass("active");
      $("#dropdown-sidebar a.button-dropdown-item")
        .find("i")
        .removeClass("fa-chevron-right")
        .addClass("fa-chevron-down");
    } else {
      $(".item-dropdown-menu").css("display", "none");
      $("#dropdown-sidebar a.button-dropdown-item").removeClass("active");
      $("#dropdown-sidebar a.button-dropdown-item")
        .find("i")
        .removeClass("fa-chevron-down")
        .addClass("fa-chevron-right");
    }

    // data customer pembayaran
    $("#dropdown-sidebar a.button-dropdown-item-pembayaran").on(
      "click",
      function () {
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
          $(this)
            .find("i")
            .removeClass("fa-chevron-right")
            .addClass("fa-chevron-down");
          $(".item-dropdown-menu-pembayaran").css("display", "block");
        } else {
          $(this)
            .find("i")
            .removeClass("fa-chevron-down")
            .addClass("fa-chevron-right");
          $(".item-dropdown-menu-pembayaran").css("display", "none");
        }
      }
    );
    // // link data custumer pembayaran
    var link_data_pembayaran = $(
      ".item-dropdown-menu-pembayaran a.active"
    ).length;
    if (link_data_pembayaran == 1) {
      $(".item-dropdown-menu-pembayaran").css("display", "block");
      $("#dropdown-sidebar a.button-dropdown-item-pembayaran").addClass(
        "active"
      );
      $("#dropdown-sidebar a.button-dropdown-item-pembayaran")
        .find("i")
        .removeClass("fa-chevron-right")
        .addClass("fa-chevron-down");
    } else {
      $(".item-dropdown-menu-pembayaran").css("display", "none");
      $("#dropdown-sidebar a.button-dropdown-item-pembayaran").removeClass(
        "active"
      );
      $("#dropdown-sidebar a.button-dropdown-item-pembayaran")
        .find("i")
        .removeClass("fa-chevron-down")
        .addClass("fa-chevron-right");
    }

    // data customer kategori
    $("#dropdown-sidebar a.button-dropdown-item-kategori").on(
      "click",
      function () {
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
          $(this)
            .find("i")
            .removeClass("fa-chevron-right")
            .addClass("fa-chevron-down");
          $(".item-dropdown-menu-kategori").css("display", "block");
        } else {
          $(this)
            .find("i")
            .removeClass("fa-chevron-down")
            .addClass("fa-chevron-right");
          $(".item-dropdown-menu-kategori").css("display", "none");
        }
      }
    );
    // // link data custumer kategori
    var link_data_kategori = $(
      ".item-dropdown-menu-kategori a.active"
    ).length;
    if (link_data_kategori == 1) {
      $(".item-dropdown-menu-kategori").css("display", "block");
      $("#dropdown-sidebar a.button-dropdown-item-kategori").addClass(
        "active"
      );
      $("#dropdown-sidebar a.button-dropdown-item-kategori")
        .find("i")
        .removeClass("fa-chevron-right")
        .addClass("fa-chevron-down");
    } else {
      $(".item-dropdown-menu-kategori").css("display", "none");
      $("#dropdown-sidebar a.button-dropdown-item-kategori").removeClass(
        "active"
      );
      $("#dropdown-sidebar a.button-dropdown-item-kategori")
        .find("i")
        .removeClass("fa-chevron-down")
        .addClass("fa-chevron-right");
    }

  });
  // new Datatable("#table-admin");
  $("#TableAdmin").DataTable({
    lengthMenu: [5, 10, 20, 50, 100],
    language: {
      paginate: {
        previous: '<i class="fa fa-angle-left"></i>',
        next: '<i class="fa fa-angle-right"></i>',
      },
      blank: "Data Tidak Ditemukan",
      search: "",
      searchPlaceholder: "Cari",
      info: "Item _START_ to _END_ of total _TOTAL_ entri",
    },
  });
  // CUSTOM ENTRY AND ROW LABEL , SEARCH DATATABLES
  $("#TableAdmin_wrapper > .row:first-child").addClass(
    "justify-content-between align-items-center"
  );
  $("#TableAdmin_wrapper > .row:first-child > .col-md-6:first-child").attr(
    "class",
    "col-md-4 col-sm-12"
  );
  $("#TableAdmin_wrapper > .row:first-child > .col-md-6:last-child").attr(
    "class",
    "col-md-8 col-sm-12"
  );
  // CUSTOM SEARCH DATATABLES
  $(".dataTables_filter label").after(
    $("<button><i class='bi bi-search'></i></button>")
      .addClass("btn-search")
      .on("click", function () {
        $(".dataTables_filter input")
          .toggleClass("w-100")
          .toggleClass("border", "2px solid rgba(0, 0, 0, 0.125)");
        $(".dataTables_filter input").toggleClass("search-active");
      })
  );
  // input search
  $(".dataTables_filter input")
    .addClass("input-search")
    .removeClass("form-control-sm form-control")
    .css("outline", "none")
    .removeClass("search-active");
  // pagination
  $(".dataTables_paginate ul.pagination")
    .removeClass("pagination")
    .addClass("paginate");
  // ******* BUTTON FILTER DETAIL PEMESANAN ******* //
  //
  const pathname = window.location.pathname;
  if (pathname.startsWith("/admin/pemesanan/detail")) {
    if (window.matchMedia("(max-width: 768px)").matches) {
      var entry = $(
        "#TableAdmin_wrapper > .row > .col-md-4 > .dataTables_length"
      );
      entry.addClass("justify-content-center align-items-center mb-2");
    }
  }
})(jQuery); // End of use strict
