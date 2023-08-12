let table;
document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
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
            { title: "Tahun Ajaran", data: "tahun_pelajaran" },
            { title: "Kelas", data: "kelas" },
            { title: "Siswa", data: "siswa" },
            { title: "Kode Tagihan", data: "tagihan" },
            { title: "Nominal", data: "nominal" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
