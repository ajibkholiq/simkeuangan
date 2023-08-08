document.addEventListener("DOMContentLoaded", function () {
    let table = new DataTable("#data-table", {
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
            url: "/api/tingkat",
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
            { title: "ID Tingkat", data: "id_tingkat" },
            { title: "Nama", data: "nama_tingkat" },
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
        url: "/tingkat/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
            setTimeout(() => {
                location.reload();
            }, 100);
        },
    });
});
var uuid;
$("body").on("click", "#bt-edit", function () {
    $("#edit-alamat").hide();
    $.ajax({
        url: "/tingkat/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            uuid = data.uuid;
            $("#idtingkat").val(data.id_tingkat);
            $("#nama").val(data.nama_tingkat);
            $("#remark").val(data.remark);
            $("#edit-siswa").modal("show");
        },
    });
});
$("#ubahsiswa").click(function () {
    $.ajax({
        url: "/tingkat/" + uuid,
        type: "PUT",
        data: {
            id_tingkat: $("#idtingkat").val(),
            nama: $("#nama").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit-siswa").modal("hide");
            console.log(response);
            setTimeout(() => {
                location.reload();
            }, 100);
        },
    });
});