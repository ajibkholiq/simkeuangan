let table;
document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
        
        dom: "Bfrtipl",
        buttons: [
            {
                extend: "excel",
                title: "Data Tagihan Siswa",
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: "Excel",
                autoFilter: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
            },
            {
                extend: "print",
                title: "Data Tagihan Siswa",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
            },
        ],
        processing: false,
        ordering: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        language: {
            emptyTable: "Tidak ada data",
        },
        ajax: {
            url: "/api/dataTagihan",
            type: "GET",
        },
        columns: [
            { title: "Siswa", data: "siswa" },
            { title: "Kelas", data: "kelas" },
            { title: "Tahun Ajaran", data: "tahun_pelajaran" },
            { title: "Kode Tagihan", data: "tagihan" },
            { title: "Nominal", data: "nominal" },
            { title: "Keterangan", data: "remark" },
        ],
    
        
    });
});
