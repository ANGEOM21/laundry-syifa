(function ($) {
  "use strict";

  // BUTTON KLIK EDIT PROSESS

  $(document).on("click", ".btn-edit-prosess", function () {
    // RESET FORM EDIT

    $("#edit-prosess form#form-edit-prosess")[0].reset();

    // AMBIL DATA ID

    const id = $(this).data("id");

    $("#edit-prosess").modal("show");

    // AJAK MENGAMBIL DATA SESUAI DENGAN ID

    $.ajax({
      url: `/admin/pemesanan/detail/edit/${id}`,

      method: "POST",

      success: function (response) {
        var res = jQuery.parseJSON(response);

        $("#edit-prosess form#form-edit-prosess #id").val(res.id_pld);

        $("#edit-prosess form#form-edit-prosess #prosess").val(res.prosess);

        var kode_kld = res.name_kld;

        var kode = kode_kld.indexOf("-");

        $("#edit-prosess form#form-edit-prosess #pesanan").val(
          kode_kld.substring(0, kode),
        );
      },
    });
  });

  // EDIT PROSESS PESANAN

  $(document).on("submit", "#form-edit-prosess", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("edit-prosess", true);

    $.ajax({
      type: "POST",

      url: "/admin/pemesanan/detail/edit-prosess",

      data: formData,

      cache: false,

      processData: false,

      contentType: false,

      success: function (response) {
        // console.log(response);

        if (response.status == 200) {
          Swal.fire({
            icon: "success",

            title: response.message,

            showConfirmButton: false,

            timer: 1500,
          });

          // Reset formulir

          $("#edit-prosess form#form-edit-prosess")[0].reset();

          // Menutup modal

          $("#edit-prosess").modal("hide");

          // load tabel admin

          $("#TableAdmin").load(window.location.href + " #TableAdmin");
        } else if (response.status == 400) {
          Swal.fire({
            icon: "warning",

            title: response.message,
          });
        }
      },

      error: function (error) {
        // console.log(error.responseText);

        Swal.fire({
          icon: "error",

          title: "Oops...",

          text: "Gagal mengirim data!",
        });
      },
    });
  });

  // BUTTON EDIT PESANAN MENGAMBIL DATA

  $(document).on("click", ".btn-edit-pesanan", function () {
    // RESET FORM EDIT

    $("#edit-pesanan form#form-edit-pesanan")[0].reset();

    // DECLARASI VARIABEL

    // decalarasi function add ekement dan remove element

    const addElementAfter = (element, html) => element.after(html);

    const removeElement = (element) => element.remove();

    // declarasi variabel

    var kiloan = `

    <div class="col mb-3" id="kiloan">

      <label for="kiloan">Berat Kg</label>

      <input type="number" class="form-control is-valid#" id="berat_kg" name="berat_kg"  placeholder="Kg" required>

    </div>

  `;

    var satuan = `

      <div class="form-row" id="satuan">

        <div class="col mb-3">

          <label for="satuan">Jenis Satuan</label>

          <input type="satuan" class="form-control is-valid#" id="inpt_satuan" name="inpt_satuan"  placeholder="kemeja, boneka, dll" required>

        </div>

        <div class="col mb-3">

          <label for="harga">Harga Satuan</label>

          <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"  placeholder="10000" required>

        </div>

    </div>

    `;

    var express = `

    <div class="col mb-3" id="express">

      <label for="kategori">Kategori Express</label>

      <select class="custom-select" id="kategori_express" name="kategori_express" aria-describedby="kategoriFeedback">

        <option selected value="">--Pilih Kategori Express--</option>

        <option value="express_kiloan">Kiloan</option>

        <option value="express_satuan">Satuan</option>

      </select>

      <small id="passwordHelpBlock" class="form-text text-muted d-flex">

        <p class="text-danger mr-1">* </p> Pilih Kategori

      </small>

    </div>

    `;

    // AMBIL DATA ID

    const id = $(this).data("id");

    $("#edit-pesanan").modal("show");

    // AJAK MENGAMBIL DATA SESUAI DENGAN ID

    $.ajax({
      url: `/admin/pemesanan/detail/edit/${id}`,

      method: "POST",

      success: function (response) {
        var res = jQuery.parseJSON(response);

        // console.log(res);

        $("#edit-pesanan form#form-edit-pesanan #id").val(res.id_pld);

        $("#kategori-pesanan").val(res.nama_kategori);

        removeElement($("#edit-pesanan #kiloan"));

        removeElement($("#edit-pesanan #satuan"));

        removeElement($("#edit-pesanan #express"));

        var val_kiloan = $("#kiloan #berat_kg").val(res.jumlah_kld);

        var kategori = $("#kategori-pesanan").val();

        // VALUE KATEGORI

        switch (kategori) {
          case "kiloan":
            removeElement($("#edit-pesanan #kiloan"));

            addElementAfter($("#edit-pesanan .form-row"), kiloan);

            $("#kiloan #berat_kg").val(res.jumlah_kld);

            break;

          case "satuan":
            removeElement($("#edit-pesanan #satuan"));

            removeElement($("#edit-pesanan #kiloan"));

            addElementAfter($(".form-row"), satuan);

            var nama_kategori = res.name_kld;

            $("#satuan #inpt_satuan").val(nama_kategori.split("-")[1]);

            $("#satuan #harga_satuan").val(res.bayar);

            break;

          case "express":
            removeElement($("#edit-pesanan #express"));

            removeElement($("#edit-pesanan #satuan"));

            removeElement($("#edit-pesanan #kiloan"));

            addElementAfter($(".form-row"), express);

            var opt_express = $("#express #kategori_express");

            var express_name = res.name_kld.split("-")[0];

            var express_kld = express_name.replace(" ", "_");

            opt_express.val($.trim(express_kld));

            switch (opt_express.val()) {
              case "express_kiloan":
                removeElement($("#edit-pesanan #kiloan"));

                removeElement($("#edit-pesanan #satuan"));

                addElementAfter($("#edit-pesanan #express"), kiloan);

                $("#edit-pesanan #kiloan label").text("Berat Kg Express");

                $("#kiloan #berat_kg").val(res.jumlah_kld);

                break;

              case "express_satuan":
                removeElement($("#edit-pesanan #kiloan"));

                removeElement($("#edit-pesanan #satuan"));

                addElementAfter($("#edit-pesanan #express"), satuan);

                $("#edit-pesanan #kiloan label").text("Berat Kg Express");

                $("#edit-pesanan #satuan > div:first label").text(
                  "Jenis Satuan Express",
                );

                $("#edit-pesanan #satuan > div:last label").text(
                  "Harga Satuan Express",
                );

                var nama_kategori = res.name_kld;

                $("#satuan #inpt_satuan").val(nama_kategori.split("-")[1]);

                $("#satuan #harga_satuan").val(res.bayar);

                break;

              default:
                removeElement($("#edit-pesanan #kiloan"));

                removeElement($("#edit-pesanan #satuan"));
            }

            break;

          default:
            //   removeElement($("#tambah-pesanan form#form-admin #kiloan"));

            removeElement($("#edit-pesanan #kilaon"));

            removeElement($("#edit-pesanan #satuan"));

            removeElement($("#edit-pesanan #express"));

            break;
        }
      },
    });

    // CHANGE KATEGORI

    $("#kategori-pesanan").on("change", function () {
      const selectedValue = $(this).val();

      switch (selectedValue) {
        case "kiloan":
          removeElement($("#edit-pesanan #kiloan"));

          removeElement($("#edit-pesanan #satuan"));

          removeElement($("#edit-pesanan #express"));

          addElementAfter($(".form-row"), kiloan);

          break;

        case "satuan":
          removeElement($("#edit-pesanan #satuan"));

          removeElement($("#edit-pesanan #kiloan"));

          removeElement($("#edit-pesanan #express"));

          addElementAfter($(".form-row"), satuan);

          break;

        case "express":
          removeElement($("#edit-pesanan #express"));

          removeElement($("#edit-pesanan #kiloan"));

          removeElement($("#edit-pesanan #satuan"));

          addElementAfter($(".form-row"), express);

          $("#express #kategori_express").on("change", function () {
            const selectExpress = $(this).val();

            switch (selectExpress) {
              case "express_kiloan":
                removeElement($("#edit-pesanan #kiloan"));

                removeElement($("#edit-pesanan #satuan"));

                addElementAfter($("#edit-pesanan #express"), kiloan);

                $("#edit-pesanan #kiloan label").text("Berat Kg Express");

                break;

              case "express_satuan":
                removeElement($("#edit-pesanan #satuan"));

                removeElement($("#edit-pesanan #kiloan"));

                addElementAfter($("#edit-pesanan #express"), satuan);

                $("#edit-pesanan #kiloan label").text("Berat Kg Express");

                $("#edit-pesanan #satuan > div:first label").text(
                  "Jenis Satuan Express",
                );

                $("#edit-pesanan #satuan > div:last label").text(
                  "Harga Satuan Express",
                );

                break;

              default:
                removeElement($("#edit-pesanan #satuan"));

                removeElement($("#edit-pesanan #kiloan"));

                break;
            }
          });

          break;

        default:
          removeElement($("#edit-pesanan #kiloan"));

          removeElement($("#edit-pesanan #satuan"));

          removeElement($("#edit-pesanan #express"));

          break;
      }
    });
  });

  // KIRIM DATA PEMESANAN EDIT

  $(document).on("submit", "#form-edit-pesanan", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    formData.append("edit-prosess", true);

    $.ajax({
      type: "POST",

      url: "/admin/pemesanan/detail/edit-pemesanan",

      data: formData,

      cache: false,

      processData: false,

      contentType: false,

      success: function (response) {
        // console.log(response);

        if (response.status == 200) {
          Swal.fire({
            icon: "success",

            title: response.message,

            showConfirmButton: false,

            timer: 1500,
          });

          // Reset formulir

          $("#edit-pesanan form#form-edit-pesanan")[0].reset();

          // Menutup modal

          $("#edit-pesanan").modal("hide");

          // load tabel

          $("#TableAdmin").load(window.location.href + " #TableAdmin");
        } else if (response.status == 400) {
          Swal.fire({
            icon: "warning",

            title: response.message,
          });

          // Menutup modal

          $("#edit-pesanan").modal("hide");
        }
      },

      error: function (error) {
        // console.log(error.responseText);

        Swal.fire({
          icon: "error",

          title: "Oops...",

          text: "Gagal mengirim data!",
        });
      },
    });
  });

  // EDIT PESANAN
})(jQuery);
