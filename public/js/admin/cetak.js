(function ($) {
  "use strict"; // Start of use strict

  //   ********** DATA SEMUA CUSTOMER ********** //

  if (window.location.pathname === "/admin/customer") {
    $("#TableAdmin_wrapper #TableAdmin_length label").before(
      `<div class="dt-buttons">
	<button id="btn_excel" class="dt-button buttons-excel buttons-html5 btn-excel" tabindex="0" aria-controls="TableAdmin" type="button">

  <span>Excel</span>
      <img src='/img/icon/excel.png' width='20px' alt='excel img'>
    </button>
    <button id="btn_pdf"class="dt-button buttons-pdf buttons-html5 btn-excel" tabindex="0" aria-controls="TableAdmin" type="button">
      <span>PDF</span>
      <img class='bg-light rounded rounded-lg ml-1' src='/img/icon/pdf.png' width='20px' alt='pdf img'>
    </button>
    
	</div>`
    );

    // PDF

    $(document).on("click", "#TableAdmin_length #btn_pdf", function () {
      $("#pdfdata_cutomer").modal("show");
      $("#pdfdata_cutomer .modal-body").html(
        `<iframe src="/admin/pdf" frameborder="0" width="100%" height="400"></iframe>`
      );
    });

    // EXCEL

    $(document).on("click", "#TableAdmin_length #btn_excel", function () {
      $("#exceldata_cutomer").modal("show");
      const tableData = [];
      $("#exceldata_cutomer #TableData_ctm tbody tr").each(function () {
        var rowData = [];
        $(this)
          .find("td")
          .each(function () {
            rowData.push($(this).text());
          });
        tableData.push(rowData);
      });

      const xport = document.querySelector("#export-file");
      xport.addEventListener("click", async () => {
        /* dynamically import the script in the event listener */
        const XLSX = await import(
          "https://cdn.sheetjs.com/xlsx-0.20.1/package/xlsx.mjs"
        );

        const wb = XLSX.utils.book_new();

        const data = tableData.map((item) => {
          return {
            nama: item[0],
            no_hp: item[1],
            email: item[2],
          };
        });
        var panjang = data.length + 2;
        const ws = XLSX.utils.json_to_sheet(data);
        XLSX.utils.sheet_add_aoa(ws, [["Nama", "Nomer hanphone", "Email"]], {
          origin: "A1",
        });
        XLSX.utils.book_append_sheet(wb, ws, "data customer");
        const max_width = Math.max(
          data.reduce((w, r) => Math.max(w, r.nama.length), 10),
          data.reduce((w, r) => Math.max(w, r.no_hp.length), 5),
          data.reduce((w, r) => Math.max(w, r.email.length), 5)
        );

        ws["!cols"] = [
          { wch: max_width },
          { wch: max_width },
          { wch: max_width },
        ];

        ws["!rows"] = [{ hpt: 30 }];

        const currentTime = Date.now();

        const date = new Date(currentTime);
        const month = date.getMonth() + 1;
        const monthNames = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];

        const formattedTime = `${date.getDate()}-${
          monthNames[month - 1]
        }-${date.getFullYear()}`;
        XLSX.writeFile(wb, "data-customer_" + formattedTime + ".xlsx");
      });
    });
  }
  //   ********** END DATA SEMUA CUSTOMER ********** //

  // ********** CUSTOMER BELUM BAYAR ********** //

  if (window.location.pathname === "/admin/belum-bayar") {
    // CREATE BUTTON PDF AND EXCEL

    $("#TableAdmin_wrapper #TableAdmin_length label").before(
      `<div class="dt-buttons">
        <button id="btn_excel" class="dt-button buttons-excel buttons-html5 btn-excel" tabindex="0" aria-controls="TableAdmin" type="button">
        <span>Excel</span>
        <img src='/img/icon/excel.png' width='20px' alt='excel img'>
      </button>
      <button id="btn_pdf"class="dt-button buttons-pdf buttons-html5 btn-excel" tabindex="0" aria-controls="TableAdmin" type="button">
        <span>PDF</span>
        <img class='bg-light rounded rounded-lg ml-1' src='/img/icon/pdf.png' width='20px' alt='pdf img'>
      </button>
      </div>`
    );

    // PDF
    $(document).on("click", "#TableAdmin_length #btn_pdf", function () {
      $("#pdfdata_cutomer").modal("show");

      $("#pdfdata_cutomer .modal-body").html(
        `<iframe src="/admin/pdf-belum-bayar" frameborder="0" width="100%" height="400"></iframe>`
      );
    });
    // END PDF

    // EXCEL
    $(document).on("click", "#TableAdmin_length #btn_excel", function () {
      $("#exceldata_cutomer").modal("show");

      //   DATA TABEL CUSTOMER BELUM BAYAR
      const tableData = [];
      $("#exceldata_cutomer #TableData_ctm tbody tr").each(function () {
        var rowData = [];
        $(this)
          .find("td")
          .each(function () {
            rowData.push($(this).text());
          });

        tableData.push(rowData);
      });
      //  END DATA TABEL CUSTOMER BELUM BAYAR
      const xport = document.querySelector("#export-file");
      //   EVENT LISTENER EXCEL SHEETJS
      xport.addEventListener("click", async () => {
        /* dynamically import the script in the event listener */
        const XLSX = await import(
          "https://cdn.sheetjs.com/xlsx-0.20.1/package/xlsx.mjs"
        );
        // create sheet
        const wb = XLSX.utils.book_new();
        // end create sheet
        // loop data table customer dari data table
        const data = tableData.map((item) => {
          return {
            nama: item[0],
            no_hp: item[1],
            kategori: item[2],
            status_bayar: item[3],
          };
        });
        // end loop data table customer dari data table

        // hitung total kefungsi
        const total_bayar = tableData.map((item) => {
          return {
            total: parseFloat(item[4]),
          };
        });
        // hitung total
        var x = total_bayar.map((item) => {
          return item.total;
        });
        const total = x.reduce((accumulator, currentValue) => {
          if (Number.isNaN(currentValue)) {
            return accumulator;
          }
          return accumulator + currentValue;
        }, 0);
        //   end hitung total

        // filter data datatabel
        const filteredData = data.filter((item) => {
          return Object.values(item).every((value) => value !== undefined);
        });
        // create sheet dari data ke json sheet
        const ws = XLSX.utils.json_to_sheet(filteredData);
        // end create sheet dari data ke json sheet
        // append header
        XLSX.utils.sheet_add_aoa(
          ws,
          [["Nama", "Nomer hanphone", "Kategori", "Status"]],
          {
            origin: "A1",
          }
        );
        // end append header

        // append total baris
        XLSX.utils.sheet_add_aoa(
          ws,
          [["TOTAL BELUM BAYAR", "", "", "Rp. " + total]],
          {
            origin: "A" + (data.length + 1),
          }
        );
        // end append total baris

        // append sheet
        XLSX.utils.book_append_sheet(wb, ws, "data customer belum bayar");
        // end append sheet
        // hitung panjang data untuk mengatur ukuran perkolom
        const max_width = Math.max(
          filteredData.reduce((w, r) => Math.max(w, r.nama.length), 10),
          filteredData.reduce((w, r) => Math.max(w, r.no_hp.length), 5),
          filteredData.reduce((w, r) => Math.max(w, r.kategori.length), 5),
          filteredData.reduce((w, r) => Math.max(w, r.status_bayar.length), 5)
        );
        // end hitung panjang data
        // ukuruan perkolom
        ws["!cols"] = [
          { wch: max_width + 10 },
          { wch: max_width },
          { wch: max_width + 8 },
          { wch: max_width - 6 },
        ];
        // end ukuruan perkolom

        // ukuruan baris
        ws["!rows"] = [{ hpt: 30 }];
        // end ukuruan baris
        // hitung format tanggal dan bulan dan tahun
        const currentTime = Date.now();
        const date = new Date(currentTime);
        const month = date.getMonth() + 1;
        // ubah ke string bulan
        const monthNames = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];
        // end ubah ke string bulan

        const formattedTime = `${date.getDate()}-${
          monthNames[month - 1]
        }-${date.getFullYear()}`;
        // end hitung format tanggal dan bulan dan tahun

        // cetak excel
        XLSX.writeFile(
          wb,
          "data-customer-belum-bayar_" + formattedTime + ".xlsx"
        );
        // end cetak excel
      });
      //   END EVENT LISTENER EXCEL SHEETJS
    });
    // END EXCEL
  }
  // **********END CUSTOMER BELUM BAYAR ********** //

  //   ********** CUSTOMER SUDAH BAYAR ********** //
  if (window.location.pathname === "/admin/sudah-bayar") {
    // CREATE BUTTON EXCEL AND PDF
    $("#TableAdmin_wrapper #TableAdmin_length label").before(
      `<div class="dt-buttons">
		<button id="btn_excel" class="dt-button buttons-excel buttons-html5 btn-excel" tabindex="0" aria-controls="TableAdmin" type="button">
			<span>Excel</span>
			<img src='/img/icon/excel.png' width='20px' alt='excel img'>
		</button>
		<button id="btn_pdf"class="dt-button buttons-pdf buttons-html5 btn-excel" tabindex="0" aria-controls="TableAdmin" type="button">
			<span>PDF</span>
			<img class='bg-light rounded rounded-lg ml-1' src='/img/icon/pdf.png' width='20px' alt='pdf img'>
		</button>
		</div>`
    );
    // PDF
    $(document).on("click", "#TableAdmin_length #btn_pdf", function () {
      $("#pdfdata_cutomer").modal("show");
      $("#pdfdata_cutomer .modal-body").html(
        `<iframe src="/admin/pdf-sudah-bayar" frameborder="0" width="100%" height="400"></iframe>`
      );
    });
    // EXCEL
    $(document).on("click", "#TableAdmin_length #btn_excel", function () {
      $("#exceldata_cutomer").modal("show");
      // DATA TABLE CUSTOMER SUDAH BAYAR
      const tableData = [];
      $("#exceldata_cutomer #TableData_ctm tbody tr").each(function () {
        var rowData = [];
        $(this)
          .find("td")
          .each(function () {
            rowData.push($(this).text());
          });
        tableData.push(rowData);
      });
      // END DATA TABLE CUSTOMER SUDAH BAYAR

      // EVENT LISTENER EXCEL SHEETJS
      const xport = document.querySelector("#export-file");
      xport.addEventListener("click", async () => {
        /* dynamically import the script in the event listener */
        const XLSX = await import(
          "https://cdn.sheetjs.com/xlsx-0.20.1/package/xlsx.mjs"
        );
        // cetak excel
        const wb = XLSX.utils.book_new();
        // end cetak excel

        // loop data table customer dari data table
        const data = tableData.map((item) => {
          return {
            nama: item[0],
            no_hp: item[1],
            kategori: item[2],
            status_bayar: item[3],
          };
        });
        // end loop data table customer dari data table

        // hitung total jadi float
        const total_bayar = tableData.map((item) => {
          return {
            total: parseFloat(item[4]),
          };
        });
        // hitung total

        var x = total_bayar.map((item) => {
          return item.total;
        });

        const total = x.reduce((accumulator, currentValue) => {
          if (Number.isNaN(currentValue)) {
            return accumulator;
          }

          return accumulator + currentValue;
        }, 0);
        // end hitung total

        // filter data datatabel
        const filteredData = data.filter((item) => {
          return Object.values(item).every((value) => value !== undefined);
        });
        //   end filter data datatabel

        // create sheet dari data ke json sheet
        const ws = XLSX.utils.json_to_sheet(filteredData);
        // end create sheet dari data ke json sheet

        // append header
        XLSX.utils.sheet_add_aoa(
          ws,
          [["Nama", "Nomer hanphone", "Kategori", "Status"]],
          {
            origin: "A1",
          }
        );
        // end append header

        // append total baris
        XLSX.utils.sheet_add_aoa(ws, [["TOTAL", "", "", "Rp. " + total]], {
          origin: "A" + (data.length + 1),
        });
        // end append total baris

        // append sheet
        XLSX.utils.book_append_sheet(wb, ws, "data customer sudah bayar");
        // end append sheet

        // hitung panjang data untuk mengatur ukuran perkolom
        const max_width = Math.max(
          filteredData.reduce((w, r) => Math.max(w, r.nama.length), 10),
          filteredData.reduce((w, r) => Math.max(w, r.no_hp.length), 5),
          filteredData.reduce((w, r) => Math.max(w, r.kategori.length), 5),
          filteredData.reduce((w, r) => Math.max(w, r.status_bayar.length), 5)
        );
        // end hitung panjang data

        // ukuruan perkolom
        ws["!cols"] = [
          { wch: max_width + 10 },
          { wch: max_width },
          { wch: max_width + 8 },
          { wch: max_width - 6 },
        ];
        // end ukuruan perkolom

        // ukuruan row
        ws["!rows"] = [{ hpt: 30 }];
        // end ukuruan row
        // hitung format tanggal dan bulan dan tahun
        const currentTime = Date.now();
        const date = new Date(currentTime);
        const month = date.getMonth() + 1;
        // ubah ke string bulan
        const monthNames = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];
        // end ubah ke string bulan

        const formattedTime = `${date.getDate()}-${
          monthNames[month - 1]
        }-${date.getFullYear()}`;
        // end hitung format tanggal dan bulan dan tahun

        // cetak excel
        XLSX.writeFile(
          wb,
          "data-customer-sudah-bayar_" + formattedTime + ".xlsx"
        );
        // end cetak excel
      });
      // END EVENT LISTENER EXCEL SHEETJS
    });
  }

  //   ********** END CUSTOMER SUDAH BAYAR ********** //
})(jQuery); // End of use strict
