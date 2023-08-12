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
            url: "/api/tghnTingkat",
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
            { title: "Tahun Ajaran", data: "tahun_pelajaran" },
            { title: "Tagihan", data: "nama" },
            { title: "Tingkat", data: "nama_tingkat" },
            { title: "Nominal", data: "nominal" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/tagihan_tingkat/" + uuid,
        type: "DELETE",
        data: {
            _token: $("input[name='_token']").val(),
            _method: "DELETE",
        },
        success: () => {
           table.ajax.reload();;
        },
    });
});
var uuid;
$("body").on("click", "#bt-edit", function () {
    $.ajax({
        url: "/tagihan_tingkat/" + $(this).data("uuid"),
        type: "GET",
        success: (data) => {
            uuid = data.uuid;
            $("#tahun").val(data.tahun_pelajaran);
            $("#tagihan").val(data.nama);
            $("#tingkat").val(data.nama_tingkat);
            $("#nominal").val(data.nominal);
            $("#remark").val(data.remark);
            $("#edit").modal("show");
        },
    });
});
$("#ubah").click(function () {
    $.ajax({
        url: "/tagihan_tingkat/" + uuid,
        type: "PUT",
        data: {
            nominal: $("#nominal").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit").modal("hide");
            console.log(response);
            table.ajax.reload();
        },
    });
});
