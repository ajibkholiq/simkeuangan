let table;
document.addEventListener("DOMContentLoaded",function(){
    table = new DataTable("#data-table", {
        dom: "Bfrtipl",
        buttons: [
            {
                extend: "print",
                title: "Data Akun Head",
                exportOptions: {
                    columns: [1, 2, 3],
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
            url: "api/akun_head",
            type: "GET",
        },
        columns: [
            {
                title: "Action",
                data: null,
                render: function (data, type, row) {
                    return `
                    <div style="display:flex; gap:8px; justify-content: center">
                   <button id="bt-hapus" class="btn btn-outline btn-danger fa fa-trash-o" data-id="${data.uuid}"></button> 
                    <button id="bt-edit" class="btn btn-outline btn-warning fa fa-pencil " data-uuid="${data.uuid}"></button></div>
                   `;
                },
            },
            { title: "Akun Head", data: "akun_head" },
            { title: "Urut", data: "urut" },
            { title: "keterangan", data: "remark" },
        ],
    });
});
$("#btn-add").click(() => {
    $("#add-siswa").modal("show");
});

$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/akun_head/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            toastr.success("Berhasil dihapus!", "Data Akun Head");

          table.ajax.reload();
        },
    });
});
var uuid;
$("body").on("click", "#bt-edit", function () {
    $("#edit-alamat").hide();
    $.ajax({
        url: "/akun_head/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            uuid = data.uuid;
            $("#akun_head").val(data.akun_head);
            $("#urut").val(data.urut);
            $("#remark").val(data.remark);
            $("#edit").modal("show");
        },
    });
});
$("#ubahsiswa").click(function () {
    $.ajax({
        url: "/akun_head/" + uuid,
        type: "PUT",
        data: {
            akun_head: $("#akun_head").val(),
            urut: $("#urut").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit").modal("hide");
            toastr.success("Berhasil diubah!", "Data Akun Head");
            console.log(response);
            table.ajax.reload();
        },
    });
});
