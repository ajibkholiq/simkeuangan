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
            url: "/api/unit",
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
            { title: "Unit", data: "unit" },
            { title: "Nama", data: "nama_unit" },
            { title: "Alamat", data: "alamat_unit" },
            { title: "No Hp", data: "no_tlp" },
            {
                title: "Logo",
                data: null,
                render : function(data) {
                    return `<a href="assets/img/unit/${data.logo}">${data.logo}</a>`;
                },
            },
           
            { title: "Keterangan", data: "remark" },
           
        ],
    });
});
$("#btn-add").click(() => {
    $("#add-siswa").modal("show");
});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/unit/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
           table.ajax.reload();
        },
    });
});
var uuid;
$("body").on("click", "#bt-edit", function () {
    $("#edit-alamat").hide();
    $.ajax({
        url: "/unit/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            uuid = data.uuid;
            $("#unit").val(data.unit);
            $("#alamat").val(data.alamat_unit);
            $("#nohp").val(data.no_tlp);
            $("#nama").val(data.nama_unit);
            $("#remark").val(data.remark);
            $("#edit-siswa").modal("show");
        },
    });
});
$("#ubah").click(function () {
    $.ajax({
        url: "/unit/" + uuid,
        type: "PUT",
        data: {
            unit : $("#unit").val(),
            alamat :$("#alamat").val(),
            nohp :$("#nohp").val(),
            nama: $("#nama").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit-siswa").modal("hide");
            table.ajax.reload();
        },
    });
});
