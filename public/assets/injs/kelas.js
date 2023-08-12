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
            url: "/api/kelas",
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
            { title: "Kode Kelas", data: "kode_kelas" },
            { title: "Nama", data: "kelas" },
            { title: "Tingkat", data: "nama_tingkat" },
            { title: "Wali Kelas", data: "nama" },
            { title: "Kampus", data: "nama_unit" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
$("body").on("click", "#bt-edit", function () {
    $.ajax({
        url: "/kelas/" + $(this).data("id"),
        type: "GET",
        success: (data) => {
            $("#uuid").val(data.uuid);
            $("#kelas").val(data.kelas);
            $("#kode").val(data.kode_kelas);
            $("#tingkat").val(data.tingkat_id);
            $("#kampus").val(data.unit_id);
            $("#wali").val(data.user_id);
            $("#remark").val(data.remark);
            $("#edit-kelas").modal("show");
        },
    });
});
$("#kelas-save").on("click", () => {
    $.ajax({
        url: "/kelas/" + $("#uuid").val(),
        type: "PUT",
        data: {
            kelas: $("#kelas").val(),
            kode: $("#kode").val(),
            tingkat: $("#tingkat").val(),
            kampus: $("#kampus").val(),
            wali: $("#wali").val(),
            remark: $("#remark").val(),
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: (response) => {
            $("#edit-kelas").modal("hide");
            console.log(response);
            table.ajax.reload();
        },
    });
});
$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/kelas/" + uuid,
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