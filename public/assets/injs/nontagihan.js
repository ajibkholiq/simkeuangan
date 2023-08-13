let table;

document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
        dom: "Bfrtipl",
        buttons: [
            {
                extend: "excel",
                title: "Data NonTagihan",
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: "Excel",
                autoFilter: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5],
                },
            },
            {
                extend: "print",
                title: "Data NonTagihan",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5],
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
            url: "/api/non_tagihan",
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
            { title: "Kode Akun", data: "akun" },
            { title: "Kode Non Tagihan", data: "kode" },
            { title: "Nama", data: "nama" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
$("body").on("click", "#bt-edit", function () {
    $.ajax({
        url: "/non_tagihan/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            $("#uuid").val(data.uuid);
            $("#akun").val(data.akun_id);
            $("#kode").val(data.kode);
            $("#nama").val(data.nama);
            $("#remark").val(data.remark);
            $("#edit").modal("show");
        },
    });
});
$("#btn-ubah").on("click", () => {
    $.ajax({
        url: "/non_tagihan/" + $("#uuid").val(),
        type: "PUT",
        data: {
            akun_id: $("#akuns").val(),
            nama: $("#nama").val(),
            kode: $("#kode").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit").modal("hide");
            toastr.success("Berhasil diubah!", "Data NonTagihan");

            console.log(response);
            table.ajax.reload();
        },
    });
});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/non_tagihan/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            toastr.success("Berhasil dihapus!", "Data NonTagihan");
            table.ajax.reload();
        },
    });
});
