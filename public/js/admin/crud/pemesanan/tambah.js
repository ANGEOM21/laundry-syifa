(function ($) {
  "use strict";

  if (window.location.pathname === "/admin/pemesanan") {
    $(document).on("click", ".tambah-pesanan ", function () {
      // decalarasi function add ekement dan remove element

      const addElementAfter = (element, html) => element.after(html);

      const removeElement = (element) => element.remove();

      // RESET FORM TAMBAH PESANAN

      var form = $("#tambah-pesanan form")[0];

      form.reset();

      removeElement($("#tambah-pesanan #kiloan"));

      removeElement($("#tambah-pesanan #satuan"));

      removeElement($("#tambah-pesanan #express"));

      // tampilkan modal tambah pesanan

      $("#tambah-pesanan").modal("show");

      // reset inputkiloan dan satuan

      removeElement($("#tambah-pesanan form#kiloan"));

      removeElement($("#tambah-pesanan form#satuan"));

      // declarasi variabel

      // select option tambah

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

      // SELECT OPTION

      // selected option tambah

      $("#kategori").on("change", function () {
        const selectedValue = $(this).val();

        switch (selectedValue) {
          case "kiloan":
            removeElement($("#tambah-pesanan form#form-admin #kiloan"));

            removeElement($("#tambah-pesanan #satuan"));

            removeElement($("#tambah-pesanan #express"));

            addElementAfter($(".form-row"), kiloan);

            break;

          case "satuan":
            removeElement($("#tambah-pesanan #satuan"));

            removeElement($("#tambah-pesanan form#form-admin #kiloan"));

            removeElement($("#tambah-pesanan #express"));

            addElementAfter($(".form-row"), satuan);

            break;

          case "express":
            removeElement($("#tambah-pesanan #express"));

            removeElement($("#tambah-pesanan form#form-admin #kiloan"));

            removeElement($("#tambah-pesanan #satuan"));

            addElementAfter($(".form-row"), express);

            $("#express #kategori_express").on("change", function () {
              const selectExpress = $(this).val();

              switch (selectExpress) {
                case "express_kiloan":
                  removeElement($("#tambah-pesanan form#form-admin #kiloan"));

                  removeElement($("#tambah-pesanan #satuan"));

                  addElementAfter($("#tambah-pesanan #express"), kiloan);

                  $("#tambah-pesanan #kiloan label").text("Berat Kg Express");

                  break;

                case "express_satuan":
                  removeElement($("#tambah-pesanan #satuan"));

                  removeElement($("#tambah-pesanan form#form-admin #kiloan"));

                  addElementAfter($("#tambah-pesanan #express"), satuan);

                  $("#tambah-pesanan #kiloan label").text("Berat Kg Express");

                  $("#tambah-pesanan #satuan > div:first label").text(
                    "Jenis Satuan Express",
                  );

                  $("#tambah-pesanan #satuan > div:last label").text(
                    "Harga Satuan Express",
                  );

                  break;

                default:
                  removeElement($("#tambah-pesanan #satuan"));

                  removeElement($("#tambah-pesanan form#form-admin #kiloan"));

                  break;
              }
            });

            break;

          default:
            removeElement($("#tambah-pesanan form#form-admin #kiloan"));

            removeElement($("#tambah-pesanan #satuan"));

            removeElement($("#tambah-pesanan #express"));

            break;
        }
      });

      // BAGIAN PENGISIAN DATA

      // AMBIL DATA ID

      const id = $(this).data("id");

      $.ajax({
        url: `/admin/customer/edit/${id}`,

        method: "POST",

        success: function (response) {
          var res = jQuery.parseJSON(response);

          $("#tambah-pesanan form#form-admin #id").val(res.id_tmuld);
        },
      });
    });

    // tambah data pesanan

    $(document).on("submit", "#tambah-pesanan form", function (e) {
      e.preventDefault();

      var formData = new FormData(this);

      formData.append("tambah_pesanan", true);

      $.ajax({
        type: "POST",

        url: "/admin/pemesanan/insert",

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

            $("#tambah-pesanan form#form-admin")[0].reset();

            // Menutup modal

            $("#tambah-pesanan").modal("hide");

            // load tabel

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
  }
})(jQuery);
