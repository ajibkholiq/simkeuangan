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
            url: "/api/thn-ajar",
            type: "GET",
        },
        columns: [
            {
                title: "Action",
                data: null,
                render: function (data, type, row) {
                    var clas;
                    if(data.status==='AKTIF'){clas = "btn-warning fa fa-check-square-o ";}else{ clas = "btn-primary fa fa-square-o ";}
                    return `
                    <div style="display:flex; gap:8px; justify-content: start">
                   <button id="bt-hapus" class="btn btn-outline btn-danger fa fa-trash-o" data-id="${data.uuid}"></button> 
                    <button id="bt-edit" class="btn btn-outline ${clas}" data-uuid="${data.uuid}" data-status ="${data.status}" "></button></div>
                   `;
                },
            },
            { title: "Tahun Pelajaran", data: "tahun_pelajaran" },
            { title: "status", data: "status" },
            { title: "Keterangan", data: "remark" },
        ],
    });
});
$("body").on("click", "#bt-edit", function () {
    let uuid = $(this).data("uuid");
    let status = $(this).data("status");
    $.ajax({
        url: "/tahun_pelajaran/" + uuid,
        type: "PUT",
        data: {
            status: status,
            _token: $("input[name='_token']").val(),
            _method: "PUT",
        },
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                location.reload();
            }, 100);
        },
    });
});

$(document).on("click", "#bt-hapus", function () {
    let uuid = $(this).data("id");
    $.ajax({
        url: "/tahun_pelajaran/" + uuid,
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
