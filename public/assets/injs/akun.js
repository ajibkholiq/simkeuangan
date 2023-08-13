let table;
document.addEventListener("DOMContentLoaded", function () {
    table = new DataTable("#data-table", {
        dom: "Bfrtipl",
        buttons: [
            {
                extend: "excel",
                title: "Data Akun",
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: "Excel",
                autoFilter: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5,6],
                },
            },
            {
                extend: "print",
                title: "Data Akun",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5,6],
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
            url: "/api/akun",
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
            { title: "Kode Akun", data: "kode" },
            { title: "Akun", data: "akun" },
            { title: "Akun Head Sub Sub", data: "Nama" },
            { title: "Akun Head Sub", data: "akun_head_sub" },
            { title: "Akun Head", data: "akun_head" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
$("body").on("click", "#bt-edit", function () {
    $.ajax({
        url: "/akun/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            $("#uuid").val(data.uuid);
            $("#nama").val(data.Nama);
            $("#id").val(data.sub2_akun_id);
            $("#kode").val(data.kode);
            $("#remark").val(data.remark);
            $("#edit").modal("show");
        },
    });
});
$("#btn-ubah").on("click", () => {
    $.ajax({
        url: "/akun/" + $("#uuid").val(),
        type: "PUT",
        data: {
            nama: $("#nama").val(),
            id: $("#id").val(),
            kode: $("#kode").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit").modal("hide");
            toastr.success("Berhasil diubah!", "Data Akun");
            console.log(response);
            table.ajax.reload();
        },
    });
});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/akun/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            toastr.success("Berhasil dihapus!", "Data Akun");
            table.ajax.reload();
        },
    });
});
