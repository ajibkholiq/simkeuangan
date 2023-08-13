let table;
document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
        dom: "Bfrtipl",
        buttons: [
            {
                extend: "excel",
                title: "Data Tagihan",
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: "Excel",
                autoFilter: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6],
                },
            },
            {
                extend: "print",
                title: "Data Tagihan",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6],
                },
            },
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        processing: false,
        ordering: true,
        language: {
            emptyTable: "Tidak ada data",
        },
        ajax: {
            url: "/api/tagihan",
            type: "GET",
        },
        columns: [
            {
                title: "Action",
                data: null,
                render: function (data, type, row) {
                    return `
                    <div style="display:flex; gap:8px; justify-content: start">
                   <button id="bt-hapus" class="btn btn-outline btn-danger fa fa-trash-o" data-id="${data.uuid}"></button> 
                    <button id="bt-edit" class="btn btn-outline btn-warning fa fa-pencil " data-uuid="${data.uuid}"></button></div>
                   `;
                },
            },
            { title: "Tahun Ajaran", data: "tahun_pelajaran" },
            { title: "Kode", data: "kode" },
            { title: "Nama", data: "nama" },
            { title: "Akun", data: "Nama" },
            { title: "Batas Bayar", data: "batas_bayar" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
$("body").on("click", "#bt-edit", function () {
    $.ajax({
        url: "/tagihan/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            $("#uuid").val(data.uuid);
            $("#tahun").val(data.thn_ajaran_id);
            $("#akun").val(data.akun_id);
            $("#nama").val(data.nama);
            $("#kode").val(data.kode);
            $("#bayar").val(data.batas_bayar);
            $("#remark").val(data.remark);
            $("#edit").modal("show");
        },
    });
});
$("#btn-ubah").on("click", () => {
    $.ajax({
        url: "/tagihan/" + $("#uuid").val(),
        type: "PUT",
        data: {
            tahun: $("#tahun").val(),
            akun: $("#akun").val(),
            nama: $("#nama").val(),
            kode: $("#kode").val(),
            btsbyr: $("#bayar").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit").modal("hide");
            console.log(response);
            toastr.success("Berhasil diubah!", "Data Tagihan");
            table.ajax.reload();
        },
    });
});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/tagihan/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            toastr.success("Berhasil dihapus!", "Data Tagihan");
            table.ajax.reload();
        },
    });
});
